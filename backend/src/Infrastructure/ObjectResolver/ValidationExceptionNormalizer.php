<?php
declare(strict_types=1);

namespace App\Infrastructure\ObjectResolver;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ValidationExceptionNormalizer implements NormalizerInterface
{
    /**
     * @param ValidationException $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string|void
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'message' => 'Bad Request',
            'code' => 400,
            'errors' => $object->constrainViolationList()
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ValidationException;
    }
}
