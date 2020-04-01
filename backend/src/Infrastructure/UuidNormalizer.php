<?php


namespace App\Infrastructure;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class UuidNormalizer extends AbstractNormalizer
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return Uuid::fromString($data);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === UuidInterface::class || is_subclass_of($type, UuidInterface::class);
    }

    /**
     * @param $object UuidInterface
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $object->toString();
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof UuidInterface;
    }


}