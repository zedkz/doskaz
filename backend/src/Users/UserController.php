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
    public function profile(TokenStorageInterface $tokenStorage, Connection $connection)
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
}
