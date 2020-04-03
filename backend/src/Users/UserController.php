<?php


namespace App\Users;

use App\AdminpanelPermissions\AdminpanelPermission;
use App\Blog\Image;
use App\Infrastructure\Doctrine\Flusher;
use App\Infrastructure\Doctrine\Transactional;
use App\Infrastructure\FileReferenceCollection;
use App\Infrastructure\Firebase\Exception;
use App\Infrastructure\Firebase\InvalidIdToken;
use App\Infrastructure\Firebase\ProfileFetcher;
use App\Infrastructure\ObjectResolver\ValidationException;
use App\Levels\LevelRepository;
use App\Tasks\CurrentTaskDataProvider;
use App\UserEvents\UserEventsFinder;
use App\Users\Security\PhoneAuth\Credentials;
use App\Users\Security\PhoneAuth\CredentialsRepository;
use Doctrine\DBAL\Connection;
use Imgproxy\UrlBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Webmozart\Assert\Assert;

/**
 * @Route(path="/api")
 * @IsGranted("ROLE_USER")
 */
final class UserController extends AbstractController
{
    /**
     * @Route(path="/admin/profile", methods={"GET"})
     * @param TokenStorageInterface $tokenStorage
     * @param Connection $connection
     * @return array
     */
    public function me(TokenStorageInterface $tokenStorage, Connection $connection)
    {
        $this->denyAccessUnlessGranted('adminpanel_access');

        $user = $connection->createQueryBuilder()
            ->select('users.id', 'full_name->>\'firstAndLast\' as name', 'email', 'phone_credentials.number as phone', 'roles', 'users.created_at as "createdAt"')
            ->from('users')
            ->leftJoin('users', 'phone_credentials', 'phone_credentials', 'users.id = phone_credentials.id')
            ->andWhere('users.id = :id')
            ->setParameter('id', $tokenStorage->getToken()->getUser()->id())
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        return array_replace($user, [
            'roles' => $connection->convertToPHPValue($user['roles'], 'json_array'),
            'createdAt' => $connection->convertToPHPValue($user['createdAt'], 'datetimetz_immutable'),
            'permissions' => array_filter(AdminpanelPermission::ALL, function ($permission) {
                return $this->isGranted($permission);
            })
        ]);
    }

    /**
     * @Route(path="/users", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Connection $connection
     * @return array
     */
    public function list(Request $request, Connection $connection)
    {
        $filter = json_decode($request->query->get('filter', '{}'), true);

        $usersQb = $connection->createQueryBuilder()
            ->select('users.id', 'full_name->>\'firstAndLast\' as name', 'email', 'phone_credentials.number as phone', 'roles', 'users.created_at as "createdAt"')
            ->from('users')
            ->leftJoin('users', 'phone_credentials', 'phone_credentials', 'users.id = phone_credentials.id');


        foreach ($filter as $key => $value) {
            if (empty($value)) {
                continue;
            }
            switch ($key) {
                case 'email':
                    $usersQb->orWhere('email ilike :email')
                        ->setParameter('email', "%$value%");
                    break;
                case 'phone':
                    $usersQb->orWhere('phone_credentials.number ilike :phone')
                        ->setParameter('phone', "%$value%");
                    break;
            }
        }

        $count = (clone $usersQb)->select('count(*)')->execute()->fetchColumn();

        $items = array_map(function ($user) use ($connection) {
            return array_replace($user, [
                'roles' => $connection->convertToPHPValue($user['roles'], 'json_array'),
                'createdAt' => $connection->convertToPHPValue($user['createdAt'], 'datetimetz_immutable')
            ]);
        }, $usersQb->setMaxResults(20)->setFirstResult($request->query->getInt('offset'))->orderBy('id', 'desc')->execute()->fetchAll());

        return [
            'items' => $items,
            'count' => $count
        ];
    }

    /**
     * @Route(path="/users/{id}", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param $id
     * @param Connection $connection
     * @return array
     */
    public function user($id, Connection $connection)
    {
        $user = $connection->createQueryBuilder()
            ->select('users.id', 'name', 'email', 'phone_credentials.number as phone', 'roles', 'users.created_at as "createdAt"')
            ->from('users')
            ->leftJoin('users', 'phone_credentials', 'phone_credentials', 'users.id = phone_credentials.id')
            ->andWhere('users.id = :id')
            ->setParameter('id', $id)
            ->execute()
            ->fetch();

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return array_replace($user, [
            'roles' => $connection->convertToPHPValue($user['roles'], 'json_array'),
            'createdAt' => $connection->convertToPHPValue($user['createdAt'], 'datetimetz_immutable')
        ]);
    }

    /**
     * @Route(path="/users/{id}", methods={"PUT"})
     * @IsGranted("ROLE_ADMIN")
     * @param User $user
     * @param UserData $data
     * @param Flusher $flusher
     */
    public function update(User $user, UserData $data, Flusher $flusher)
    {
        $user->update($data);
        $flusher->flush();
    }

    /**
     * @Route(path="/profile", methods={"GET"})
     * @IsGranted("ROLE_USER")
     * @param TokenStorageInterface $tokenStorage
     * @param Connection $connection
     * @param Request $request
     * @param CurrentTaskDataProvider $currentTaskProvider
     * @param LevelRepository $levelRepository
     * @return ProfileData
     */
    public function profile(TokenStorageInterface $tokenStorage, Connection $connection, Request $request, CurrentTaskDataProvider $currentTaskProvider, LevelRepository $levelRepository)
    {
        $user = $connection->createQueryBuilder()
            ->select('users.id', 'name', 'email', 'phone_credentials.number as phone', 'roles', 'avatar', 'full_name')
            ->from('users')
            ->leftJoin('users', 'phone_credentials', 'phone_credentials', 'users.id = phone_credentials.id')
            ->andWhere('users.id = :id')
            ->setParameter('id', $tokenStorage->getToken()->getUser()->id())
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        /*return array_replace($user, [
            'roles' => $connection->convertToPHPValue($user['roles'], 'json_array'),
            'createdAt' => $connection->convertToPHPValue($user['createdAt'], 'datetimetz_immutable'),
            'avatar' => $request->getSchemeAndHttpHost() . '/static/ava.png'
        ]);*/

        /**
         * @var $fullName FullName
         */
        $fullName = $connection->convertToPHPValue($user['full_name'], FullName::class);


        $level = $levelRepository->find($user['id']);


        return new ProfileData(
            $user['name'],
            $user['email'],
            $user['phone'],
            $connection->convertToPHPValue($user['roles'], 'json'),
            $user['avatar'] ? $request->getSchemeAndHttpHost() . $user['avatar'] : null,
            $fullName->first,
            $fullName->last,
            $fullName->middle,
            $currentTaskProvider->forUser($user['id']),
            [
                'current' => $level->value(),
                'currentPoints' => $level->points(),
                'progressToNext' => $level->progressToNextLevel(),
                'nextLevelThreshold' => $level->nextLevelThreshold()
            ],
            [
                'objects' => $connection->createQueryBuilder()->select('COUNT(*) FROM objects WHERE created_by = :userId')->setParameter('userId', $user['id'])->execute()->fetchColumn(),
                'complaints' => $connection->createQueryBuilder()->select('COUNT(*) FROM complaints WHERE complainant_id = :userId')->setParameter('userId', $user['id'])->execute()->fetchColumn(),
            ],
            new UserAbilities(
                $this->isGranted(UserAbility::AVATAR_UPLOAD),
                $this->isGranted(UserAbility::STATUS_CHANGE),
            )
        );
    }

    /**
     * @Route(path="/profile", methods={"PUT"})
     * @IsGranted("ROLE_USER")
     * @param UpdateUserProfileData $profileData
     * @param UserRepository $repository
     * @param TokenStorageInterface $tokenStorage
     * @param ProfileFetcher $profileFetcher
     * @param CredentialsRepository $credentialsRepository
     * @param Transactional $transactional
     * @throws ValidationException
     */
    public function updateProfile(
        UpdateUserProfileData $profileData,
        UserRepository $repository,
        TokenStorageInterface $tokenStorage,
        ProfileFetcher $profileFetcher,
        CredentialsRepository $credentialsRepository,
        Transactional $transactional
    )
    {
        $user = $repository->find($tokenStorage->getToken()->getUser()->id());

        if ($profileData->email) {
            $userByEmail = $repository->findOneBy(['email' => $profileData->email]);
            if ($userByEmail && $userByEmail !== $user) {
                throw new ValidationException(new ConstraintViolationList([new ConstraintViolation('Этот email занят другим пользователем', '', [], '', 'email', '')]));
            }
        }

        $transactional->transaction(function () use ($tokenStorage, $repository, $profileData, $profileFetcher, $credentialsRepository, $user) {
            if ($profileData->phoneChangeToken) {
                try {
                    $userProfile = $profileFetcher->fetch($profileData->phoneChangeToken);
                    Assert::notEmpty($userProfile->phoneNumber);
                    $existingCredentials = $credentialsRepository->findByPhoneNumber($userProfile->phoneNumber);
                    if ($existingCredentials) {
                        if ($existingCredentials->id() !== $user->id()) {
                            throw new ValidationException(new ConstraintViolationList([new ConstraintViolation('Этот номер занят другим пользователем', '', [], '', 'phoneChangeToken', '')]));
                        }
                    } else {
                        $credentials = $credentialsRepository->find($user->id());
                        if ($credentials) {
                            $credentials->changeNumber($userProfile->phoneNumber);
                        } else {
                            $credentials = new Credentials($user->id(), $userProfile->phoneNumber);
                            $credentialsRepository->add($credentials);
                        }
                    }
                } catch (InvalidIdToken $exception) {
                    throw new ValidationException(new ConstraintViolationList([new ConstraintViolation('Неверный id токен', '', [], '', 'phoneChangeToken', '')]));
                }
            }
            $user->updateProfile(new FullName($profileData->firstName, $profileData->lastName, $profileData->middleName), $profileData->email);
        });
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route(path="/profile/chooseAvatarPreset/{presetNumber}", methods={"POST"}, requirements={"presetNumber" = "\d+"})
     * @param $presetNumber
     * @param UserRepository $repository
     * @param Flusher $flusher
     * @return array
     */
    public function chooseAvatarPreset($presetNumber, UserRepository $repository, Flusher $flusher): array
    {
        $presets = [
            1 => 'av1.svg',
            2 => 'av2.svg',
            3 => 'av3.svg',
            4 => 'av4.svg',
            5 => 'av5.svg',
            6 => 'av6.svg',
        ];

        if (!array_key_exists($presetNumber, $presets)) {
            throw new NotFoundHttpException(sprintf('Preset "%s" not exists!', $presets));
        }
        $selected = $presets[$presetNumber];
        $user = $repository->find($this->getUser()->id());
        $avatar = sprintf('/static/presets/%s', $selected);
        $user->changeAvatar($avatar);
        $flusher->flush();
        return [
            'avatar' => $avatar
        ];
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route(path="/profile/avatar", methods={"DELETE"})
     * @param UserRepository $repository
     * @param Flusher $flusher
     */
    public function removeAvatar(UserRepository $repository, Flusher $flusher)
    {
        $user = $repository->find($this->getUser()->id());
        $user->removeAvatar();
        $flusher->flush();
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route(path="/profile/objects", methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @param UrlBuilder $urlBuilder
     * @return array
     */
    public function objects(Request $request, Connection $connection, UrlBuilder $urlBuilder)
    {
        $perPage = 10;

        $qb = $connection->createQueryBuilder()
            ->select([
                'id',
                'title',
                'created_at as date',
                'overall_score_movement as "overallScore"',
                'photos',
            ])
            ->from('objects')
            ->andWhere('created_by = :userId')
            ->andWhere('deleted_at IS NULL')
            ->setParameter('userId', $this->getUser()->id());


        $overallScore = $request->query->get('overallScore', 'all');
        if ($overallScore !== 'all') {
            $qb->andWhere('overall_score_movement = :score')
                ->setParameter('score', $overallScore);
        }

        $reviewsCountQuery = $connection->createQueryBuilder()
            ->select('count(*) AS "reviewsCount"')
            ->from('object_reviews')
            ->andWhere('object_id = objects.id')
            ->getSQL();

        $complaintsCountQuery = $connection->createQueryBuilder()
            ->select('count(*) AS "complaintsCount"')
            ->from('complaints')
            ->andWhere('object_id = objects.id')
            ->getSQL();

        [$field, $sort] = explode('_', $request->query->get('sort', 'date_desc'));

        $objects = (clone $qb)
            ->addSelect('reviews."reviewsCount"')
            ->addSelect('complaints."complaintsCount"')
            ->join('objects', "LATERAL ($reviewsCountQuery)", 'reviews', 'true')
            ->join('objects', "LATERAL ($complaintsCountQuery)", 'complaints', 'true')
            ->setMaxResults($perPage)
            ->setFirstResult(($request->query->getInt('page', 1) - 1) * $perPage)
            ->orderBy($field, $sort)
            ->execute()
            ->fetchAll();

        return [
            'pages' => $qb->select('CEIL(count(*)::FLOAT / :perPage)::INT')->setParameter('perPage', $perPage)->execute()->fetchColumn(),
            'items' => array_map(function ($object) use ($connection, $request, $urlBuilder) {

                $image = null;
                /**
                 * @var $photos FileReferenceCollection
                 */
                $photos = $connection->convertToPHPValue($object['photos'], FileReferenceCollection::class);
                if ($photos->count()) {
                    $image = $request->getSchemeAndHttpHost() . $urlBuilder->build('local:///storage/' . $photos->first()->relativePath, 220, 160)->toString();
                }

                return [
                    'id' => $object['id'],
                    'title' => $object['title'],
                    'date' => $connection->convertToPHPValue($object['date'], 'datetimetz_immutable'),
                    'overallScore' => $object['overallScore'],
                    'reviewsCount' => $object['reviewsCount'],
                    'complaintsCount' => $object['complaintsCount'],
                    'image' => $image
                ];
            }, $objects)
        ];
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route(path="/profile/comments", methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @param UrlBuilder $urlBuilder
     * @return array
     */
    public function comments(Request $request, Connection $connection, UrlBuilder $urlBuilder)
    {
        $perPage = 10;

        $qb = $connection->createQueryBuilder()
            ->select([
                'id',
                'type',
                'date',
            ])
            ->from('user_comments_history')
            ->andWhere('user_comments_history.user_id = :userId')
            ->setParameter('userId', $this->getUser()->id());

        $items = (clone $qb)
            ->setMaxResults($perPage)
            ->setFirstResult(($request->query->getInt('page', 1) - 1) * $perPage)
            ->orderBy($request->query->get('sort', 'date'), 'desc')
            ->execute()
            ->fetchAll();


        $postComments = $connection->createQueryBuilder()
            ->select([
                'blog_comments.id',
                'blog_comments.text',
                'blog_posts.title',
                'blog_posts.slug_value as slug',
                'blog_categories.slug_value as "categorySlug"',
                'blog_posts.image'
            ])
            ->from('blog_comments')
            ->leftJoin('blog_comments', 'blog_posts', 'blog_posts', 'blog_posts.id = blog_comments.post_id')
            ->leftJoin('blog_posts', 'blog_categories', 'blog_categories', 'blog_posts.category_id = blog_categories.id')
            ->andWhere('blog_comments.id in (:ids)')
            ->setParameter('ids', array_column($items, 'id'), Connection::PARAM_STR_ARRAY)
            ->execute()
            ->fetchAll(\PDO::FETCH_UNIQUE);


        $objectReviews = $connection->createQueryBuilder()
            ->select([
                'object_reviews.id',
                'object_reviews.text',
                'objects.title',
                'objects.id as "objectId"',
                'objects.photos'
            ])
            ->from('object_reviews')
            ->leftJoin('object_reviews', 'objects', 'objects', 'objects.id = object_reviews.object_id')
            ->andWhere('object_reviews.id in (:ids)')
            ->setParameter('ids', array_column($items, 'id'), Connection::PARAM_STR_ARRAY)
            ->execute()
            ->fetchAll(\PDO::FETCH_UNIQUE);

        $mappedItems = array_map(function ($item) use ($connection, $postComments, $objectReviews, $request, $urlBuilder) {
            $result = [
                'date' => $connection->convertToPHPValue($item['date'], 'datetimetz_immutable'),
                'type' => $item['type']
            ];

            if (array_key_exists($item['id'], $postComments)) {
                $postComment = $postComments[$item['id']];
                $result['slug'] = $postComment['slug'];
                $result['categorySlug'] = $postComment['categorySlug'];
                $result['title'] = $postComment['title'];
                $result['text'] = $postComment['text'];

                /**
                 * @var $image Image|null
                 */
                $image = $connection->convertToPHPValue($postComment['image'], Image::class);
                if ($image) {
                    $result['image'] = $request->getSchemeAndHttpHost() . $image->resize(140, 100);
                }
            }

            if (array_key_exists($item['id'], $objectReviews)) {
                $objectReview = $objectReviews[$item['id']];
                $result['title'] = $objectReview['title'];
                $result['text'] = $objectReview['text'];
                $result['objectId'] = $objectReview['objectId'];

                /**
                 * @var $photos FileReferenceCollection
                 */
                $photos = $connection->convertToPHPValue($objectReview['photos'], FileReferenceCollection::class);
                if ($photos->count()) {
                    $result['image'] = $request->getSchemeAndHttpHost() . $urlBuilder->build('local:///storage/' . $photos->first()->relativePath, 140, 100)->toString();
                }
            }

            return $result;

        }, $items);

        return [
            'pages' => $qb->select('CEIL(count(*)::FLOAT / :perPage)::INT')->setParameter('perPage', $perPage)->execute()->fetchColumn(),
            'items' => $mappedItems
        ];
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route(path="/profile/complaints", methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @param UrlBuilder $urlBuilder
     * @return array
     */
    public function complaints(Request $request, Connection $connection, UrlBuilder $urlBuilder)
    {
        $perPage = 10;

        $qb = $connection->createQueryBuilder()
            ->from('complaints')
            ->andWhere('complainant_id = :userId')
            ->setParameter('userId', $this->getUser()->id());

        [$field, $sort] = explode('_', $request->query->get('sort', 'date_desc'));


        $items = (clone $qb)->select([
            'id',
            'created_at',
            'created_at as date',
            'content->>\'objectName\' as "title"',
            'content->>\'photos\' as photos',
            'content->>\'type\' as type'
        ])
            ->orderBy($field, $sort)
            ->setMaxResults($perPage)
            ->setFirstResult(($request->query->getInt('page', 1) - 1) * $perPage)
            ->execute()->fetchAll();

        return [
            'pages' => $qb->select('CEIL(count(*)::FLOAT / :perPage)::INT')->setParameter('perPage', $perPage)->execute()->fetchColumn(),
            'items' => array_map(function ($item) use ($connection, $request, $urlBuilder) {

                $image = null;
                $photos = $connection->convertToPHPValue($item['photos'], 'json');
                if (count($photos)) {
                    $image = $request->getSchemeAndHttpHost() . $urlBuilder->build('local://' . $photos[0], 220, 160)->toString();
                }

                return [
                    'id' => $item['id'],
                    'type' => $item['type'],
                    'title' => $item['title'],
                    'date' => $connection->convertToPHPValue($item['created_at'], 'datetimetz_immutable'),
                    'image' => $image,
                ];
            }, $items)
        ];
    }

    /**
     * @Route(path="/profile/tasks", methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @return mixed[]
     */
    public function tasks(Request $request, Connection $connection)
    {
        $perPage = 10;

        $query = "
               select completed_at, 'Заполните профиль' as type, 4 as points
                  from profile_completion_tasks
                  where user_id = :userId
                  union all select completed_at, 'Добавьте 1 объект' as type, reward as points from daily_tasks where user_id = :userId
                  union all select completed_at, 'Верифицируйте 1 объект' as type, reward as points from daily_verification_tasks where user_id = :userId
        ";

        [$field, $sort] = explode('_', $request->query->get('sort', 'completedAt_desc'));

        $qb = $connection->createQueryBuilder()
            ->select(
                'completed_at as "completedAt"',
                'type',
                'points'
            )
            ->from("($query)", 'tasks')
            ->setParameter('userId', $this->getUser()->id());

        return [
            'pages' => (clone $qb)->select('CEIL(count(*)::FLOAT / :perPage)::INT')->setParameter('perPage', $perPage)->execute()->fetchColumn(),
            'items' => $qb->orderBy('"' . $field . '"', $sort)
                ->setMaxResults($perPage)
                ->setFirstResult(($request->query->getInt('page', 1) - 1) * $perPage)
                ->execute()
                ->fetchAll()
        ];
    }

    /**
     * @Route(path="/profile/events", methods={"GET"})
     * @param UserEventsFinder $eventsFinder
     * @return array
     */
    public function events(UserEventsFinder $eventsFinder)
    {
        return $eventsFinder->execute($this->getUser()->id(), 1, 'date', 'desc');
    }
}
