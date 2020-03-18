<?php


namespace App\Users;

use App\Blog\Image;
use App\Infrastructure\Doctrine\Flusher;
use App\Infrastructure\FileReferenceCollection;
use App\Infrastructure\ObjectResolver\ValidationException;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Imgproxy\UrlBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * @Route(path="/api")
 * @IsGranted("ROLE_USER")
 */
final class UserController extends AbstractController
{
    /**
     * @Route(path="/users/me", methods={"GET"})
     * @param TokenStorageInterface $tokenStorage
     * @param Connection $connection
     * @return array
     */
    public function me(TokenStorageInterface $tokenStorage, Connection $connection)
    {
        $user = $connection->createQueryBuilder()
            ->select('users.id', 'name', 'email', 'phone_credentials.number as phone', 'roles', 'users.created_at as "createdAt"')
            ->from('users')
            ->leftJoin('users', 'phone_credentials', 'phone_credentials', 'users.id = phone_credentials.id')
            ->andWhere('users.id = :id')
            ->setParameter('id', $tokenStorage->getToken()->getUser()->id())
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        return array_replace($user, [
            'roles' => $connection->convertToPHPValue($user['roles'], 'json_array'),
            'createdAt' => $connection->convertToPHPValue($user['createdAt'], 'datetimetz_immutable')
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
        $usersQb = $connection->createQueryBuilder()
            ->select('users.id', 'name', 'email', 'phone_credentials.number as phone', 'roles', 'users.created_at as "createdAt"')
            ->from('users')
            ->leftJoin('users', 'phone_credentials', 'phone_credentials', 'users.id = phone_credentials.id');

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
     * @return ProfileData
     */
    public function profile(TokenStorageInterface $tokenStorage, Connection $connection, Request $request)
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


        return new ProfileData(
            $user['name'],
            $user['email'],
            $user['phone'],
            $connection->convertToPHPValue($user['roles'], 'json'),
            $user['avatar'] ? $request->getSchemeAndHttpHost() . $user['avatar'] : null,
            $fullName->first,
            $fullName->last,
            $fullName->middle
        );
    }

    /**
     * @Route(path="/profile", methods={"PUT"})
     * @IsGranted("ROLE_USER")
     * @param ProfileData $profileData
     * @param UserRepository $repository
     * @param TokenStorageInterface $tokenStorage
     * @param Flusher $flusher
     * @throws ValidationException
     */
    public function updateProfile(ProfileData $profileData, UserRepository $repository, TokenStorageInterface $tokenStorage, Flusher $flusher)
    {
        $user = $repository->find($tokenStorage->getToken()->getUser()->id());

        if ($profileData->email) {
            $userByEmail = $repository->findOneBy(['email' => $profileData->email]);
            if ($userByEmail && $userByEmail !== $user) {
                throw new ValidationException(new ConstraintViolationList([new ConstraintViolation('Этот email занят другим пользователем', '', [], '', 'email', '')]));
            }
        }
        $user->updateProfile(new FullName($profileData->firstName, $profileData->lastName, $profileData->middleName), $profileData->email);
        $flusher->flush();
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
                'photos'
            ])
            ->from('objects')
            ->andWhere('created_by = :userId')
            ->andWhere('deleted_at IS NULL')
            ->setParameter('userId', $this->getUser()->id());


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


        $objects = (clone $qb)
            ->addSelect('reviews."reviewsCount"')
            ->addSelect('complaints."complaintsCount"')
            ->join('objects', "LATERAL ($reviewsCountQuery)", 'reviews', 'true')
            ->join('objects', "LATERAL ($complaintsCountQuery)", 'complaints', 'true')
            ->setMaxResults($perPage)
            ->setFirstResult(($request->query->getInt('page', 1) - 1) * $perPage)
            ->orderBy('created_at', 'desc')
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
     */
    public function comments(Request $request, Connection $connection, UrlBuilder $urlBuilder)
    {
        $perPage = 10;

        $qb = $connection->createQueryBuilder()
            ->select([
                'id',
                'type',
                'date'
            ])
            ->from('user_comments_history')
            ->andWhere('user_comments_history.user_id = :userId')
            ->setParameter('userId', $this->getUser()->id());

        $items = (clone $qb)
            ->setMaxResults($perPage)
            ->setFirstResult(($request->query->getInt('page', 1) - 1) * $perPage)
            ->orderBy('date', 'desc')
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
}
