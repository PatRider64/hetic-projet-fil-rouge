<?php

namespace App\Factory;

use App\Entity\MasterclassVideo;
use App\Repository\MasterclassVideoRepository;
use App\Service\UploadHelper;
use Symfony\Component\HttpFoundation\File\File;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<MasterclassVideo>
 *
 * @method        MasterclassVideo|Proxy                     create(array|callable $attributes = [])
 * @method static MasterclassVideo|Proxy                     createOne(array $attributes = [])
 * @method static MasterclassVideo|Proxy                     find(object|array|mixed $criteria)
 * @method static MasterclassVideo|Proxy                     findOrCreate(array $attributes)
 * @method static MasterclassVideo|Proxy                     first(string $sortedField = 'id')
 * @method static MasterclassVideo|Proxy                     last(string $sortedField = 'id')
 * @method static MasterclassVideo|Proxy                     random(array $attributes = [])
 * @method static MasterclassVideo|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MasterclassVideoRepository|RepositoryProxy repository()
 * @method static MasterclassVideo[]|Proxy[]                 all()
 * @method static MasterclassVideo[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static MasterclassVideo[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static MasterclassVideo[]|Proxy[]                 findBy(array $attributes)
 * @method static MasterclassVideo[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static MasterclassVideo[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class MasterclassVideoFactory extends ModelFactory
{
    private $helper;
    private static $templateSheet = [
        'Me at the zoo.mp4',
        'Funny 2 second video.mp4',
        'Monkey swimming in Bali.mp4',
    ];

    public function __construct(UploadHelper $helper)
    {
        parent::__construct();
        $this->helper = $helper;
    }

    protected function getDefaults(): array
    {
        $originalMasterclassVideoName = self::faker()->randomElement(self::$templateSheet);
        $masterclassVideoName = $this->helper->fixtureMasterclassVideoUpload(
            new File(__DIR__ . '/Template_videos/' . $originalMasterclassVideoName)
        );

        return [
            'fileName' => $masterclassVideoName,
            'originalFileName' => $originalMasterclassVideoName,
            'mimeType' => 'video/mp4'
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(MasterclassVideo $masterclassVideo): void {})
        ;
    }

    protected static function getClass(): string
    {
        return MasterclassVideo::class;
    }
}
