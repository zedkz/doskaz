<?php


namespace App\Infrastructure\Api;


use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HttpExceptionNormalizer implements NormalizerInterface
{
    private $isDebug = false;

    public function __construct(bool $debug = false)
    {
        $this->isDebug = $debug;
    }

    /**
     * @param HttpExceptionInterface|\Exception $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $result = [
            'message' => $object->getMessage(),
            'code' => $object->getStatusCode()
        ];

        if ($this->isDebug) {
            $result['stack'] = $object->getTrace();
        }

        return $result;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof HttpExceptionInterface;
    }

}