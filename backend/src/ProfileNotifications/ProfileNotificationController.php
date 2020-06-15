<?php


namespace App\ProfileNotifications;


use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/profileNotifications")
 * @IsGranted("ROLE_USER")
 */
class ProfileNotificationController extends AbstractController
{
    /**
     * @Route(methods={"GET"})
     * @param Connection $connection
     * @return array
     */
    public function list(Connection $connection)
    {
        $notifications = $connection->createQueryBuilder()
            ->select('id', 'data')
            ->from('profile_notifications')
            ->where('closed_at IS NULL')
            ->orderBy('created_at', 'asc')
            ->andWhere('user_id = :userId')
            ->setParameter('userId', $this->getUser()->id())
            ->execute()
            ->fetchAll();

        return array_map(fn($notification) => [
            'id' => $notification['id'],
            'data' => $connection->convertToPHPValue($notification['data'], ProfileNotificationData::class)
        ], $notifications);
    }

    /**
     * @param ProfileNotification $notification
     * @param Flusher $flusher
     * @Route(path="/{id}", methods={"DELETE"})
     */
    public function close(ProfileNotification $notification, Flusher $flusher)
    {
        $notification->close();
        $flusher->flush();
    }
}