<?php


namespace App\Objects\Adding;


use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Embeddable()
 */
class AccessibilityScore
{
    public const SCORE_FULL_ACCESSIBLE = 'full_accessible';

    public const SCORE_NOT_ACCESSIBLE = 'not_accessible';

    public const SCORE_PARTIAL_ACCESSIBLE = 'partial_accessible';

    private const SCORE_VARIANTS = [
        self::SCORE_FULL_ACCESSIBLE,
        self::SCORE_NOT_ACCESSIBLE,
        self::SCORE_PARTIAL_ACCESSIBLE,
        self::SCORE_NOT_PROVIDED
    ];

    public const SCORE_NOT_PROVIDED = 'not_provided';

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $movement;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $limb;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $vision;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $hearing;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $intellectual;

    public static function new(string $movement, string $limb, string $vision, string $hearing, string $intellectual): self
    {
        Assert::oneOf($movement, self::SCORE_VARIANTS);
        Assert::oneOf($limb, self::SCORE_VARIANTS);
        Assert::oneOf($vision, self::SCORE_VARIANTS);
        Assert::oneOf($hearing, self::SCORE_VARIANTS);
        Assert::oneOf($intellectual, self::SCORE_VARIANTS);
        $self = new self();
        $self->movement = $movement;
        $self->limb = $limb;
        $self->vision = $vision;
        $self->hearing = $hearing;
        $self->intellectual = $intellectual;
        return $self;
    }

    public static function notProvided(): self
    {
        $self = new self();
        $self->movement = self::SCORE_NOT_PROVIDED;
        $self->limb = self::SCORE_NOT_PROVIDED;
        $self->vision = self::SCORE_NOT_PROVIDED;
        $self->hearing = self::SCORE_NOT_PROVIDED;
        $self->intellectual = self::SCORE_NOT_PROVIDED;
        return $self;
    }

    public static function fullAccessible(): self
    {
        $self = new self();
        $self->movement = self::SCORE_FULL_ACCESSIBLE;
        $self->limb = self::SCORE_FULL_ACCESSIBLE;
        $self->vision = self::SCORE_FULL_ACCESSIBLE;
        $self->hearing = self::SCORE_FULL_ACCESSIBLE;
        $self->intellectual = self::SCORE_FULL_ACCESSIBLE;
        return $self;
    }

    public static function partialAccessible(): self
    {
        $self = new self();
        $self->movement = self::SCORE_PARTIAL_ACCESSIBLE;
        $self->limb = self::SCORE_PARTIAL_ACCESSIBLE;
        $self->vision = self::SCORE_PARTIAL_ACCESSIBLE;
        $self->hearing = self::SCORE_PARTIAL_ACCESSIBLE;
        $self->intellectual = self::SCORE_PARTIAL_ACCESSIBLE;
        return $self;
    }

    public static function notAccessible(): self
    {
        $self = new self();
        $self->movement = self::SCORE_NOT_ACCESSIBLE;
        $self->limb = self::SCORE_NOT_ACCESSIBLE;
        $self->vision = self::SCORE_NOT_ACCESSIBLE;
        $self->hearing = self::SCORE_NOT_ACCESSIBLE;
        $self->intellectual = self::SCORE_NOT_ACCESSIBLE;
        return $self;
    }

    public function equalsTo($other): bool
    {
        if ($other instanceof AccessibilityScore) {
            return
                $other->movement === $this->movement
                && $other->limb === $this->limb
                && $other->vision === $this->vision
                && $other->hearing === $this->hearing
                && $other->intellectual === $this->intellectual;
        }
        return false;
    }

    public static function average(self ...$scores): self
    {
        $movement = 0;
        $limb = 0;
        $vision = 0;
        $hearing = 0;
        $intellectual = 0;

        $filtered = array_filter($scores, function (AccessibilityScore $score) {
            return !$score->equalsTo(AccessibilityScore::notProvided());
        });

        if(count($filtered) === 0) {
            return AccessibilityScore::notProvided();
        }

        foreach ($filtered as $score) {
            $movement += array_search($score->movement, self::SCORE_VARIANTS);
            $limb += array_search($score->limb, self::SCORE_VARIANTS);
            $vision += array_search($score->vision, self::SCORE_VARIANTS);
            $hearing += array_search($score->hearing, self::SCORE_VARIANTS);
            $intellectual += array_search($score->intellectual, self::SCORE_VARIANTS);
        }

        return self::new(
            self::SCORE_VARIANTS[(int)round($movement / count($filtered))],
            self::SCORE_VARIANTS[(int)round($limb / count($filtered))],
            self::SCORE_VARIANTS[(int)round($vision / count($filtered))],
            self::SCORE_VARIANTS[(int)round($hearing / count($filtered))],
            self::SCORE_VARIANTS[(int)round($intellectual / count($filtered))]
        );
    }
}