<?php

namespace App\Transformers\ListComment;

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
