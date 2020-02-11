<?php


namespace App\Objects\Adding;

use Doctrine\ORM\Mapping as ORM;
use App\Objects\Adding\Form;

/**
 * @ORM\Entity()
 * @ORM\Table(name="adding_requests")
 */
class AddingRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var integer|null
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $userId;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    /**
     * @var Form
     * @ORM\Column(type=Form::class, options={"jsonb" = true})
     */
    private $data;

    public function __construct(int $userId, Form $data)
    {
        $this->userId = $userId;
        $this->data = $data;
        $this->createdAt = new \DateTimeImmutable();
    }
}