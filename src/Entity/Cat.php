<?php

namespace App\Entity;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Cat
{
    private string $name;

    private string $breed;

    private ?int $age;

    private ?string $color;

    private ?float $weight;

    public function __construct(array $catProperties)
    {
        $optionResolver = new OptionsResolver();
        $optionResolver->setDefined(['name', 'breed', 'age', 'weight', 'color']);
        $optionResolver->setRequired(['name', 'breed']);

        $optionResolver->setAllowedTypes('name', ['string']);
        $optionResolver->setAllowedTypes('breed', ['string']);
        $optionResolver->setAllowedTypes('weight', ['null', 'float']);
        $optionResolver->setAllowedTypes('age', ['null', 'int']);
        $optionResolver->setAllowedValues('age', function (?int $value) : bool {
            return $value == null || $value > 0;
        });

        $optionResolver->setAllowedTypes('color', ['null', 'string']);
        $optionResolver->setAllowedValues('color', ['w', 'g', 'b']);
        $optionResolver->setNormalizer('color',  function (Options $options, string $value): string {
            return match ($value) {
                'w' => 'white',
                'g' => 'gray',
                'b' => 'black',
            };
        });

        $resolvedProperties = $optionResolver->resolve($catProperties);
        $this->name = $resolvedProperties['name'];
        $this->breed= $resolvedProperties['breed'];
        $this->age= $resolvedProperties['age'] ?? null;
        $this->color = $resolvedProperties['color'] ?? null;
        $this->weight = $resolvedProperties['weight'] ?? null;

    }



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

}