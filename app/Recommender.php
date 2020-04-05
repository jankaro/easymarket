<?php


namespace App;


use http\Env\Request;

class Recommender
{
    public static function similarProducts($products_array, $product_id){
        $products        = $products_array;
        $selectedId      = $product_id;
        $selectedProduct = $products[$product_id-1];

        $selectedProducts = array_filter($products, function ($product) use ($selectedId) { return $product['id'] === $selectedId; });
        if (count($selectedProducts)) {
            $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
        }
        //dd($selectedProducts);

        $productSimilarity = new ProductSimilarity($products);
        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
        $similarProducts = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);
        return $similarProducts;
    }


}
