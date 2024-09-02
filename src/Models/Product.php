<?php

namespace App\Models;

use Doctrine\DBAL\Query\QueryBuilder;

class Product
{
    private string $table = 'products';
    private string $name;
    private string $description;
    private string $category;
    private float $price;
    private float $discount;
    private float $rating;
    private string $stock;
    private string $brand;
    private string $sku;
    private string $thumbnail;

    public function __construct(
        private QueryBuilder $queryBuilder
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    public function getStock(): string
    {
        return $this->stock;
    }

    public function setStock(string $stock): void
    {
        $this->stock = $stock;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function save()
    {
        $this->queryBuilder
            ->insert($this->table)
            ->values([
                'name' => ':name',
                'description' => ':description',
                'category' => ':category',
                'price' => ':price',
                'discount' => ':discount',
                'rating' => ':rating',
                'stock' => ':stock',
                'brand' => ':brand',
                'sku' => ':sku',
                'thumbnail' => ':thumbnail',
            ])
            ->setParameters([
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'category' => $this->getCategory(),
                'price' => $this->getPrice(),
                'discount' => $this->getDiscount(),
                'rating' => $this->getRating(),
                'stock' => $this->getStock(),
                'brand' => $this->getBrand(),
                'sku' => $this->getSku(),
                'thumbnail' => $this->getThumbnail(),
            ])
            ->executeQuery();
    }
}