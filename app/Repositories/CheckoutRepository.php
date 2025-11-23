<?php
namespace App\Repositories;

use App\Models\Checkout;
use Illuminate\Support\Facades\DB;

class CheckoutRepository extends BaseRepository
{
    public function __construct(Checkout $model)
    {
        parent::__construct($model);
    }

    public function createCheckout(array $data)
    {
        $formatData = $this->formatCheckout($data);
        return $this->model->create($formatData);
    }

    public function formatCheckout(array $data)
    {
        return [
            'user_id' => $data['user_id'],
            'status' => $data['status'] ?? 'pending',
            'order_date' => $data['order_date'] ?? now(),
            'total_price' => collect($data['items'])->sum(function ($item) {
                return $item['quantity'] * $item['price_at_checkout'];
            }),
        ];
    }

}
