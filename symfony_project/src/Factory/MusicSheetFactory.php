<?php

namespace App\Factory;

use App\Entity\MusicSheet;
use App\Repository\MusicSheetRepository;
use App\Repository\CompositorRepository;
use App\Service\UploadHelper;
use Symfony\Component\HttpFoundation\File\File;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<MusicSheet>
 *
 * @method        MusicSheet|Proxy                     create(array|callable $attributes = [])
 * @method static MusicSheet|Proxy                     createOne(array $attributes = [])
 * @method static MusicSheet|Proxy                     find(object|array|mixed $criteria)
 * @method static MusicSheet|Proxy                     findOrCreate(array $attributes)
 * @method static MusicSheet|Proxy                     first(string $sortedField = 'id')
 * @method static MusicSheet|Proxy                     last(string $sortedField = 'id')
 * @method static MusicSheet|Proxy                     random(array $attributes = [])
 * @method static MusicSheet|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MusicSheetRepository|RepositoryProxy repository()
 * @method static MusicSheet[]|Proxy[]                 all()
 * @method static MusicSheet[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static MusicSheet[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static MusicSheet[]|Proxy[]                 findBy(array $attributes)
 * @method static MusicSheet[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static MusicSheet[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class MusicSheetFactory extends ModelFactory
{
    private $helper;
    private static $templateSheet = [
        'blue_product.png',
        'dark_blue_product.png',
        'green_product.png',
        'orange_product.png',
        'pink_product.png',
        'purple_product.png',
        'red_product.png',
        'yellow_product.png',
    ];

    public function __construct(UploadHelper $helper)
    {
        parent::__construct();
        $this->helper = $helper;
    }

    protected function getDefaults(): array
    {
        $originalMusicSheetName = self::faker()->randomElement(self::$templateSheet);
        $musicSheetName = $this->helper->fixtureMusicSheetUpload(
            new File(__DIR__ . '/Template_images/' . $originalMusicSheetName)
        );

        return [
            'compositor' => CompositorFactory::random(),
            'fileName' => $musicSheetName,
            'originalFileName' => $originalMusicSheetName,
            'mimeType' => 'image/png'
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(MusicSheet $musicSheet): void {})
        ;
    }

    protected static function getClass(): string
    {
        return MusicSheet::class;
    }
}
