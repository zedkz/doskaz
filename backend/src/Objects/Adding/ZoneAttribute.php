<?php


namespace App\Objects\Adding;


interface ZoneAttribute
{
    public const NOT_PROVIDED = 'not_provided';
    public const YES = 'yes';
    public const NO = 'no';
    public const UNKNOWN = 'unknown';

    public const ATTRIBUTES = [
        self::NOT_PROVIDED,
        self::YES,
        self::NO,
        self::UNKNOWN
    ];
}