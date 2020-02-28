<?php


namespace App\Infrastructure;


use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class FileNormalizer extends AbstractNormalizer
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return new FileReference($data);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
     /*   if($type === FileReference::class) {
            dd($data);
        }*/

        return $type === FileReference::class;
    }

    /**
     * @param FileReference $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|mixed|string|null
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $object->link();
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof FileReference;
    }
}