<?php

namespace App\Transformers\CreateComment;

use League\Fractal\TransformerAbstract;
use App\Models\Product;

class ProductTransformers extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
        ];
    }
}
