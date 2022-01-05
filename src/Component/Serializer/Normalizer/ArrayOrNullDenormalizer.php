<?php

namespace Localfr\UberallBundle\Component\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\{
    CacheableSupportsMethodInterface,
    ContextAwareDenormalizerInterface,
    DenormalizerAwareInterface,
    DenormalizerAwareTrait,
    DenormalizerInterface
};
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @final
 */
class ArrayOrNullDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface, SerializerAwareInterface, CacheableSupportsMethodInterface
{
    use DenormalizerAwareTrait;

    /**
     * {@inheritdoc}
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): array
    {
        if (null === $this->denormalizer) {
            throw new BadMethodCallException('Please set a denormalizer before calling denormalize()!');
        }
        if (\is_null($data)) {
            return [];
        }
        if (!\is_array($data)) {
            throw new InvalidArgumentException('Data expected to be an array, '.get_debug_type($data).' given.');
        }
        if (!str_ends_with($type, '[]')) {
            throw new InvalidArgumentException('Unsupported class: '.$type);
        }

        $type = substr($type, 0, -2);

        $builtinType = isset($context['key_type']) ? $context['key_type']->getBuiltinType() : null;
        foreach ($data as $key => $value) {
            if (null !== $builtinType && !('is_'.$builtinType)($key)) {
                throw new NotNormalizableValueException(sprintf('The type of the key "%s" must be "%s" ("%s" given).', $key, $builtinType, get_debug_type($key)));
            }

            $data[$key] = $this->denormalizer->denormalize($value, $type, $format, $context);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        if (null === $this->denormalizer) {
            throw new BadMethodCallException(sprintf('The nested denormalizer needs to be set to allow "%s()" to be used.', __METHOD__));
        }

        return str_ends_with($type, '[]')
            && $this->denormalizer->supportsDenormalization($data, substr($type, 0, -2), $format, $context);
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated call setDenormalizer() instead
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        if (!$serializer instanceof DenormalizerInterface) {
            throw new InvalidArgumentException('Expected a serializer that also implements DenormalizerInterface.');
        }

        if (Serializer::class !== debug_backtrace()[1]['class'] ?? null) {
            trigger_deprecation('symfony/serializer', '5.3', 'Calling "%s" is deprecated. Please call setDenormalizer() instead.');
        }

        $this->setDenormalizer($serializer);
    }

    /**
     * {@inheritdoc}
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return $this->denormalizer instanceof CacheableSupportsMethodInterface && $this->denormalizer->hasCacheableSupportsMethod();
    }
}
