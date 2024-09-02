<?php

use App\Models\Product;
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
    $productObject = new Product($queryBuilder);
    $productObject->setName($product['title']);
    $productObject->setDescription($product['description']);
    $productObject->setCategory($product['category']);
    $productObject->setPrice($product['price']);
    $productObject->setDiscount($product['discountPercentage']);
    $productObject->setRating($product['rating']);
    $productObject->setStock($product['stock']);
    $productObject->setBrand($product['brand']);
    $productObject->setSku($product['sku']);
    $productObject->setThumbnail($product['thumbnail']);
    $productObject->save();

}