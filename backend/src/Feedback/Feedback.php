<?php


namespace App\Feedback;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="feedback")
 */
class Feedback
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    /**
     * Feedback constructor.
     * @param string $name
     * @param string $email
     * @param string $text
     */
    public function __construct(string $name, string $email, string $text)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
        $this->createdAt = new \DateTimeImmutable();
    }
}
