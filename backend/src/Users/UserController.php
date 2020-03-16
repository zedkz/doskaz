<?php


namespace App\Users;

use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
     * @Route(path="/profile")
     * @IsGranted("ROLE_USER")
     * @param TokenStorageInterface $tokenStorage
     * @param Connection $connection
     */
    public function profile(TokenStorageInterface $tokenStorage, Connection $connection, Request $request)
    {
        $user = $connection->createQueryBuilder()
            ->select('users.id', 'name', 'email', 'phone_credentials.number as phone', 'roles', 'avatar')
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


        return new ProfileData(
            $user['name'],
            $user['email'],
            $user['phone'],
            $connection->convertToPHPValue($user['roles'], 'json'),
            $user['avatar'] ? $request->getSchemeAndHttpHost() . $user['avatar'] : null
        );
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route(path="/profile/chooseAvatarPreset/{presetNumber}", methods={"POST"}, requirements={"presetNumber" = "\d+"})
     * @param $preset
     * @param UserRepository $repository
     */
    public function chooseAvatarPreset($preset, UserRepository $repository, Flusher $flusher): array
    {
        $presets = [
            1 => 'av1.svg',
            2 => 'av2.svg',
            3 => 'av3.svg',
            4 => 'av4.svg',
            5 => 'av5.svg',
            6 => 'av6.svg',
        ];

        if (!array_key_exists($preset, $presets)) {
            throw new NotFoundHttpException(sprintf('Preset "%s" not exists!', $presets));
        }
        $selected = $presets[$preset];
        $user = $repository->find($this->getUser()->id());
        $avatar = sprintf('/static/presets/%s', $selected);
        $user->changeAvatar($avatar);
        $flusher->flush();
        return [
            'avatar' => $avatar
        ];
    }
}
