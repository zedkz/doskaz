<?php


namespace App\Infrastructure\Api;


use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ExceptionNormalizer implements NormalizerInterface
{
    private $isDebug = false;

    public function __construct(bool $debug = false)
    {
        $this->isDebug = $debug;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $result = [
            'message' => $this->isDebug ? $object->getMessage() : 'Server error',
            'code' => 500
        ];

        if ($this->isDebug) {
            $result['stack'] = $object->getTrace();
        }

        return $result;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Exception;
    }

}