<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Validation;

use EoneoPay\Utils\AnnotationReader;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use ReflectionClass;
use Symfony\Component\Serializer\Annotation\Groups;
use Tests\EoneoPay\PhpSdk\Helpers\InterfaceFinder;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @coversNothing
 */
class EntityGroupsTest extends TestCase
{
    /**
     * Test that all properties of 'Entities' have valid Groups annotations.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\AnnotationCacheException
     * @throws \ReflectionException
     */
    public function testGroups(): void
    {
        $reader = new AnnotationReader();

        $finder = new InterfaceFinder(\dirname(__DIR__, 2) . '/src/Endpoints');
        $classes = $finder->find(EntityInterface::class);

        $groups = [];
        foreach ($classes as $class) {
            $groups[$class] = $reader->getClassPropertyAnnotation($class, Groups::class);
        }

        foreach ($groups as $class => $groupValues) {
            $classReflection = new ReflectionClass($class);
            if ($classReflection->isInterface() === true || $classReflection->isAbstract()) {
                continue;
            }

            $actions = \array_keys((new $class())->uris());

            foreach ($groupValues as $property => $annotation) {
                $groupValues = $annotation->getGroups();
                $badPropertyGroups = \array_diff($groupValues, $actions);
                self::assertEmpty($badPropertyGroups, \sprintf(
                    '%s:$%s contains the following @Groups that are not found in it\'s actions from uris(): %s',
                    $class,
                    $property,
                    \implode(', ', $badPropertyGroups)
                ));
            }
        }
    }
}
