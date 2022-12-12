<?php

namespace App\Factory;

use App\Entity\Messages;
use App\Repository\MessagesRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Messages>
 *
 * @method static Messages|Proxy createOne(array $attributes = [])
 * @method static Messages[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Messages[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Messages|Proxy find(object|array|mixed $criteria)
 * @method static Messages|Proxy findOrCreate(array $attributes)
 * @method static Messages|Proxy first(string $sortedField = 'id')
 * @method static Messages|Proxy last(string $sortedField = 'id')
 * @method static Messages|Proxy random(array $attributes = [])
 * @method static Messages|Proxy randomOrCreate(array $attributes = [])
 * @method static Messages[]|Proxy[] all()
 * @method static Messages[]|Proxy[] findBy(array $attributes)
 * @method static Messages[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Messages[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MessagesRepository|RepositoryProxy repository()
 * @method Messages|Proxy create(array|callable $attributes = [])
 */
final class MessagesFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Messages $messages): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Messages::class;
    }
}
