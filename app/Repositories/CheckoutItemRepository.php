<?php
namespace App\Repositories;

use App\Models\CheckoutItem;
use Illuminate\Support\Facades\DB;

class CheckoutItemRepository extends BaseRepository
{
    public function __construct(CheckoutItem $model)
    {
        parent::__construct($model);
    }


    public function createCheckoutItems(array $data, int $id)
    {
        $items = $data['items'];
        foreach ($items as $key => $value){
            $formatData = $this->formatCheckoutItems($value, $id);
            $this->model->create($formatData);
        }
        return ;
    }

    public function formatCheckoutItems(array $value, int $id)
    {
       return [
                'checkout_id' => $id,
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'price_at_checkout' => $value['price_at_checkout'],
            ];
    }
}
