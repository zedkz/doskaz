<?php


namespace App\Objects\Adding;


use Webmozart\Assert\Assert;

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

    public $movement;

    public $limb;

    public $vision;

    public $hearing;

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

    public static function fullAccessible(): self {
        $self = new self();
        $self->movement = self::SCORE_FULL_ACCESSIBLE;
        $self->limb = self::SCORE_FULL_ACCESSIBLE;
        $self->vision = self::SCORE_FULL_ACCESSIBLE;
        $self->hearing = self::SCORE_FULL_ACCESSIBLE;
        $self->intellectual = self::SCORE_FULL_ACCESSIBLE;
        return $self;
    }

    public static function notAccessible(): self {
        $self = new self();
        $self->movement = self::SCORE_NOT_ACCESSIBLE;
        $self->limb = self::SCORE_NOT_ACCESSIBLE;
        $self->vision = self::SCORE_NOT_ACCESSIBLE;
        $self->hearing = self::SCORE_NOT_ACCESSIBLE;
        $self->intellectual = self::SCORE_NOT_ACCESSIBLE;
        return $self;
    }
}