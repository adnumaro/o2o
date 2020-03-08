<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure;

use O2O\Integration\PunkApi\Domain\Beer;
use O2O\Integration\PunkApi\Domain\BeerCollection;
use O2O\Integration\PunkApi\Domain\IRepository;
use O2O\Integration\PunkApi\Domain\ValueObject\Description;
use O2O\Integration\PunkApi\Domain\ValueObject\FirstBrewed;
use O2O\Integration\PunkApi\Domain\ValueObject\Id;
use O2O\Integration\PunkApi\Domain\ValueObject\ImageUrl;
use O2O\Integration\PunkApi\Domain\ValueObject\Name;
use O2O\Integration\PunkApi\Domain\ValueObject\Slogan;
use O2O\Integration\PunkApi\Infrastructure\Service\Client;

final class Repository implements IRepository
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $criteria
     * @return BeerCollection
     */
    public function searchBeerByFood(string $criteria): BeerCollection
    {
        $res = $this->client->searchByFood($criteria);
        $content = json_decode($res->getBody()->getContents(), true);
        $collection = new BeerCollection();

        foreach ($content as $item) {
            $collection->add(
                new Beer(
                    new Id($item['id']),
                    new Name($item['name']),
                    new Description($item['description']),
                    new Slogan($item['description']),
                    new ImageUrl($item['image_url']),
                    new FirstBrewed($item['first_brewed']),
                )
            );
        }

        return $collection;
    }

    /**
     * @param Id $id
     * @return Beer
     */
    public function beerDetails(Id $id): Beer
    {
        $res = $this->client->searchById((string)$id);
        $content = json_decode($res->getBody()->getContents(), true);

        return new Beer(
            $id,
            new Name($content[0]['name']),
            new Description($content[0]['description']),
            new Slogan($content[0]['description']),
            new ImageUrl($content[0]['image_url']),
            new FirstBrewed($content[0]['first_brewed']),
        );
    }
}
