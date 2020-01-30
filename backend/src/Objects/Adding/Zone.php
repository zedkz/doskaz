<?php


namespace App\Objects\Adding;


class Zone
{
    public const ATTRIBUTE_NOT_PROVIDED = 'not_provided';
    public const ATTRIBUTE_YES = 'yes';
    public const ATTRIBUTE_NO = 'no';
    public const ATTRIBUTE_UNKNOWN = 'unknown';

    public const ATTRIBUTES = [
        self::ATTRIBUTE_NOT_PROVIDED,
        self::ATTRIBUTE_YES,
        self::ATTRIBUTE_NO,
        self::ATTRIBUTE_UNKNOWN
    ];
}