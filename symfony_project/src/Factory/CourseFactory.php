<?php

namespace App\Factory;

use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\UserSiteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Course>
 *
 * @method        Course|Proxy                     create(array|callable $attributes = [])
 * @method static Course|Proxy                     createOne(array $attributes = [])
 * @method static Course|Proxy                     find(object|array|mixed $criteria)
 * @method static Course|Proxy                     findOrCreate(array $attributes)
 * @method static Course|Proxy                     first(string $sortedField = 'id')
 * @method static Course|Proxy                     last(string $sortedField = 'id')
 * @method static Course|Proxy                     random(array $attributes = [])
 * @method static Course|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CourseRepository|RepositoryProxy repository()
 * @method static Course[]|Proxy[]                 all()
 * @method static Course[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Course[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Course[]|Proxy[]                 findBy(array $attributes)
 * @method static Course[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Course[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CourseFactory extends ModelFactory
{
    public function __construct(UserSiteRepository $userSiteRepository)
    {
        parent::__construct();
        $this->userSiteRepository = $userSiteRepository;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $users = $this->userSiteRepository->findAll();
        $teachers = [];
        
        foreach ($users as $user) {
            if (in_array("ROLE_TEACHER", $user->getRoles())) {
                array_push($teachers, $user);
            }
        }

        return [
            'title' => self::faker()->text(50),
            'teacher' => self::faker()->randomElement($teachers),
            'content' => self::faker()->text()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Course $course): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Course::class;
    }
}
