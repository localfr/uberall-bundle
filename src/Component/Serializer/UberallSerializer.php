<?php

namespace Localfr\UberallBundle\Component\Serializer;

use Doctrine\Common\Annotations\{AnnotationReader, PsrCachedReader};
use Localfr\UberallBundle\Component\Serializer\Normalizer\ArrayOrNullDenormalizer;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\{
    BadMethodCallException,
    CircularReferenceException,
    ExceptionInterface,
    ExtraAttributesException,
    InvalidArgumentException,
    LogicException,
    RuntimeException,
    UnexpectedValueException
};
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\{
    AbstractNormalizer,
    ConstraintViolationListNormalizer,
    DateIntervalNormalizer,
    DateTimeNormalizer,
    DateTimeZoneNormalizer,
    JsonSerializableNormalizer,
    ObjectNormalizer
};
use Symfony\Component\Serializer\{Serializer, SerializerInterface};

class UberallSerializer
{
    /**
     * @var AdapterInterface $annotationsCacheAdapter
     */
    private $annotationsCacheAdapter;

    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @param AdapterInterface $annotationsCacheAdapter
     */
    public function __construct(AdapterInterface $annotationsCacheAdapter)
    {
        $this->annotationsCacheAdapter = $annotationsCacheAdapter;
        $classMetadataFactory = new ClassMetadataFactory(
            new AnnotationLoader(
                new PsrCachedReader(
                    new AnnotationReader(),
                    $this->annotationsCacheAdapter
                )
            )
        );
        $this->serializer = new Serializer(
            [
                new ArrayOrNullDenormalizer(),
                new ConstraintViolationListNormalizer(),
                new DateIntervalNormalizer(),
                new DateTimeNormalizer(),
                new DateTimeZoneNormalizer(),
                new JsonSerializableNormalizer(),
                new ObjectNormalizer(
                    $classMetadataFactory,
                    null,
                    PropertyAccess::createPropertyAccessor(),
                    new ReflectionExtractor(),
                    new ClassDiscriminatorFromClassMetadata($classMetadataFactory),
                ),
            ],
            [
                new JsonEncoder()
            ]
        );
    }

    /**
     * Serializes data into JSON.
     *
     * @param mixed $data
     * @param array  $context Options available to the normalizers/encoders
     *
     * @return mixed
     */
    public final function serialize($data, array $context = [])
    {
        return $this->serializer->serialize(
            $data,
            'json',
            array_merge(
                [
                    AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false,
                ],
                $context
            )
        );

    }

    /**
     * Deserializes data into the given type.
     *
     * @param string $data
     * @param string $type The expected class to instantiate
     * @param array  $context Options available to the denormalizers/decoders
     *
     * @return mixed
     */
    public final function deserialize(string $data, string $type, array $context = [])
    {
        return $this->serializer->deserialize(
            $data,
            $type,
            'json',
            array_merge(
                [
                    AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true
                ],
                $context
            )
        );
    }

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param mixed  $object  Object to normalize
     * @param array  $context Context options for the normalizer
     *
     * @return array|string|int|float|bool|\ArrayObject|null \ArrayObject is used to make sure an empty object is encoded as an object not an array
     *
     * @throws InvalidArgumentException   Occurs when the object given is not a supported type for the normalizer
     * @throws CircularReferenceException Occurs when the normalizer detects a circular reference when no circular
     *                                    reference handler can fix it
     * @throws LogicException             Occurs when the normalizer is not called in an expected context
     * @throws ExceptionInterface         Occurs for all the other cases of errors
     */
    public final function normalize($data, array $context = [])
    {
        return $this->serializer->normalize(
            $data,
            'json',
            array_merge(
                [
                    AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false
                ],
                $context
            )
        );
    }

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    Data to restore
     * @param string $type    The expected class to instantiate
     * @param array  $context Options available to the denormalizer
     *
     * @return mixed
     *
     * @throws BadMethodCallException   Occurs when the normalizer is not called in an expected context
     * @throws InvalidArgumentException Occurs when the arguments are not coherent or not supported
     * @throws UnexpectedValueException Occurs when the item cannot be hydrated with the given data
     * @throws ExtraAttributesException Occurs when the item doesn't have attribute to receive given data
     * @throws LogicException           Occurs when the normalizer is not supposed to denormalize
     * @throws RuntimeException         Occurs if the class cannot be instantiated
     * @throws ExceptionInterface       Occurs for all the other cases of errors
     */
    public final function denormalize($data, string $type, array $context = [])
    {
        return $this->serializer->denormalize(
            $data,
            $type,
            'json',
            array_merge(
                [
                    AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true
                ],
                $context
            )
        );
    }
}
