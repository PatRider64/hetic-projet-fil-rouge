<?php

namespace App\Factory;

use App\Entity\UserSite;
use App\Repository\UserSiteRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<UserSite>
 *
 * @method        UserSite|Proxy                     create(array|callable $attributes = [])
 * @method static UserSite|Proxy                     createOne(array $attributes = [])
 * @method static UserSite|Proxy                     find(object|array|mixed $criteria)
 * @method static UserSite|Proxy                     findOrCreate(array $attributes)
 * @method static UserSite|Proxy                     first(string $sortedField = 'id')
 * @method static UserSite|Proxy                     last(string $sortedField = 'id')
 * @method static UserSite|Proxy                     random(array $attributes = [])
 * @method static UserSite|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UserSiteRepository|RepositoryProxy repository()
 * @method static UserSite[]|Proxy[]                 all()
 * @method static UserSite[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static UserSite[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static UserSite[]|Proxy[]                 findBy(array $attributes)
 * @method static UserSite[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static UserSite[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UserSiteFactory extends ModelFactory
{
    private $hasher;
    private static $roles = ['ROLE_STUDENT', 'ROLE_TEACHER', 'ROLE_SUBSCRIBER'];

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
        $this->hasher = $hasher;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'firstName' => self::faker()->firstName(),
            'name' => self::faker()->lastName(),
            'videoCount' => self::faker()->numberBetween(0, 20),
            'coursesTaken' => self::faker()->numberBetween(0, 20),
            'roles' => [self::faker()->randomElement(self::$roles)]
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this->afterInstantiate(function (UserSite $user) {
            // $email = strtolower($user->getFirstName() . strtolower($user->getName() . '@gmail.com'));
            // $user->setEmail($email);
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
            // $user->setRoles(['ADMIN']);
        });
    }

    protected static function getClass(): string
    {
        return UserSite::class;
    }
}
