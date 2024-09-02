<?php

use GuzzleHttp\Client;

define('APP', __DIR__);

require APP . '/vendor/autoload.php';

try {
    $connection = require APP . '/src/service.php';
} catch (Exception $exception) {
    echo 'Error connection to DB: ' . $exception->getMessage() . PHP_EOL;
    exit();
}

$client = new Client([
    'base_uri' => 'https://dummyjson.com/',
]);
$response = $client->request('GET', 'products/search?q=iphone');
$body = $response->getBody();
$stringBody = (string)$body;
$products = json_decode($stringBody, true);
$queryBuilder = $connection->createQueryBuilder();
foreach ($products['products'] as $product) {
    $queryBuilder
        ->insert('products')
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
            'name' => $product['title'],
            'description' => $product['description'],
            'category' => $product['category'],
            'price' => $product['price'],
            'discount' => $product['discountPercentage'],
            'rating' => $product['rating'],
            'stock' => $product['stock'],
            'brand' => $product['brand'],
            'sku' => $product['sku'],
            'thumbnail' => $product['thumbnail'],
        ])
        ->executeQuery();
}