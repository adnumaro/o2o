<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Domain;

use O2O\Integration\PunkApi\Domain\ValueObject\Description;
use O2O\Integration\PunkApi\Domain\ValueObject\FirstBrewed;
use O2O\Integration\PunkApi\Domain\ValueObject\Id;
use O2O\Integration\PunkApi\Domain\ValueObject\ImageUrl;
use O2O\Integration\PunkApi\Domain\ValueObject\Name;
use O2O\Integration\PunkApi\Domain\ValueObject\Slogan;

final class Beer
{
    private Id $id;

    private Name $name;

    private Description $description;

    private Slogan $slogan;

    private ImageUrl $imageUrl;

    private FirstBrewed $firstBrewed;

    public function __construct(
        Id $id,
        Name $name,
        Description $description,
        Slogan $slogan,
        ImageUrl $imageUrl,
        FirstBrewed $firstBrewed
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->slogan = $slogan;
        $this->imageUrl = $imageUrl;
        $this->firstBrewed = $firstBrewed;
    }

    public function toArray()
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'description' => $this->description->value(),
            'slogan' => $this->slogan->value(),
            'image_url' => $this->imageUrl->value(),
            'first_brewed' => $this->firstBrewed->value(),
        ];
    }
}
