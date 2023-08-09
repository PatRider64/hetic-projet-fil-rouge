<?php

namespace App\Factory;

use App\Entity\Compositor;
use App\Repository\CompositorRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Compositor>
 *
 * @method        Compositor|Proxy                     create(array|callable $attributes = [])
 * @method static Compositor|Proxy                     createOne(array $attributes = [])
 * @method static Compositor|Proxy                     find(object|array|mixed $criteria)
 * @method static Compositor|Proxy                     findOrCreate(array $attributes)
 * @method static Compositor|Proxy                     first(string $sortedField = 'id')
 * @method static Compositor|Proxy                     last(string $sortedField = 'id')
 * @method static Compositor|Proxy                     random(array $attributes = [])
 * @method static Compositor|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CompositorRepository|RepositoryProxy repository()
 * @method static Compositor[]|Proxy[]                 all()
 * @method static Compositor[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Compositor[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Compositor[]|Proxy[]                 findBy(array $attributes)
 * @method static Compositor[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Compositor[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CompositorFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'biography' => self::faker()->text(),
            'birthDate' => self::faker()->dateTime(),
            'deathDate' => self::faker()->dateTime(),
            'firstName' => self::faker()->firstName(),
            'name' => self::faker()->lastName()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Compositor $compositor): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Compositor::class;
    }
}
