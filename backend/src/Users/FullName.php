<?php


namespace App\Users;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;

/**
 * @ODM()
 */
class FullName
{
    /**
     * @var string|null
     */
    public $first;

    /**
     * @var string|null
     */
    public $last;

    /**
     * @var string|null
     */
    public $middle;

    /**
     * FullName constructor.
     * @param string|null $first
     * @param string|null $last
     * @param string|null $middle
     */
    public function __construct(?string $first = null, ?string $last = null, ?string $middle = null)
    {
        $this->first = $first;
        $this->last = $last;
        $this->middle = $middle;
    }


    public static function parseFromString(string $fullName): self
    {
        $parts = explode(' ', $fullName);
        return new self(...$parts);
    }
}