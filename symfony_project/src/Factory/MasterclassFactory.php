<?php

namespace App\Factory;

use App\Entity\Masterclass;
use App\Repository\MasterclassRepository;
use App\Repository\UserSiteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Masterclass>
 *
 * @method        Masterclass|Proxy                     create(array|callable $attributes = [])
 * @method static Masterclass|Proxy                     createOne(array $attributes = [])
 * @method static Masterclass|Proxy                     find(object|array|mixed $criteria)
 * @method static Masterclass|Proxy                     findOrCreate(array $attributes)
 * @method static Masterclass|Proxy                     first(string $sortedField = 'id')
 * @method static Masterclass|Proxy                     last(string $sortedField = 'id')
 * @method static Masterclass|Proxy                     random(array $attributes = [])
 * @method static Masterclass|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MasterclassRepository|RepositoryProxy repository()
 * @method static Masterclass[]|Proxy[]                 all()
 * @method static Masterclass[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Masterclass[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Masterclass[]|Proxy[]                 findBy(array $attributes)
 * @method static Masterclass[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Masterclass[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class MasterclassFactory extends ModelFactory
{
    private static $instruments = [
        'Violon',
        'Piano',
        'Trompette',
        'Harpe',
        'Flute',
        'Tuba',
        'Cymbals'
    ];

    public function __construct(UserSiteRepository $userSiteRepository)
    {
        parent::__construct();
        $this->userSiteRepository = $userSiteRepository;
    }

    protected function getDefaults(): array
    {
        $users = $this->userSiteRepository->findAll();
        $students = [];
        
        foreach ($users as $user) {
            if (in_array("ROLE_STUDENT", $user->getRoles())) {
                array_push($students, $user);
            }
        }

        return [
            'analysis' => self::faker()->text(),
            'instruments' => self::faker()->randomElement(self::$instruments),
            'student' => self::faker()->randomElement($students),
            'musicSheet' => MusicSheetFactory::random(),
            'masterclassVideo' => MasterclassVideoFactory::random()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Masterclass $masterclass): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Masterclass::class;
    }
}
