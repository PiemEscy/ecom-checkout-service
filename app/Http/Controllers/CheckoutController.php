<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CheckoutRepository;
use App\Repositories\CheckoutItemRepository;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function __construct(CheckoutRepository $checkoutRepo, CheckoutItemRepository $checkoutItemRepo)
    {
        $this->checkoutRepo = $checkoutRepo;
        $this->checkoutItemRepo = $checkoutItemRepo;
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->validated();
        $insert = $this->storeProcess($data);

        return response()->json([
            'success' => $insert,
            'message' => ($insert) ? 'insert successfully!' : 'failed to insert data.'
        ], 201);
    }

    public function storeProcess($data)
    {
        return $this->checkoutRepo->rollBackFunction(function () use ($data) {
            $checkout = $this->checkoutRepo->createCheckout($data);
            $checkoutItems = $this->checkoutItemRepo->createCheckoutItems($data, $checkout->id);
        }, 'Error creating record');
    }
}
