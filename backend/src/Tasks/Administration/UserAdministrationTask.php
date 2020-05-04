<?php


namespace App\Tasks\Administration;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_administration_tasks")
 */
class UserAdministrationTask
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }
}