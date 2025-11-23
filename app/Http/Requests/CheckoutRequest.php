<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required|integer|min:1',
            'status' => 'nullable|string|in:pending,paid,shipped,canceled',
            'order_date' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|min:1',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price_at_checkout' => 'required|numeric|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'user',
            'status' => 'order status',
            'order_date' => 'order date',
            'items' => 'order items',
            'items.*.product_id' => 'product',
            'items.*.quantity' => 'quantity',
            'items.*.price_at_checkout' => 'price at checkout',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The user ID is required.',
            'user_id.integer'  => 'The user ID must be a valid integer.',
            'user_id.min'      => 'The user ID must be at least 1.',
            'status.in' => 'Invalid order status. Allowed values: pending, paid, shipped, canceled.',
            'order_date.date' => 'The order date must be a valid date.',
            'items.required' => 'You must provide at least one item in the order.',
            'items.array' => 'Items must be an array.',
            'items.min' => 'You must provide at least one item in the order.',
            'items.*.product_id.required' => 'The product ID is required for each item.',
            'items.*.product_id.integer' => 'Each product ID must be a valid integer.',
            'items.*.product_id.min' => 'Each product ID must be at least 1.',
            'items.*.quantity.required' => 'Please enter a quantity for each item.',
            'items.*.quantity.integer' => 'Quantity must be a whole number.',
            'items.*.quantity.min' => 'Quantity must be at least 1.',
            'items.*.price_at_checkout.required' => 'Price at checkout is required for each item.',
            'items.*.price_at_checkout.numeric' => 'Price at checkout must be numeric.',
            'items.*.price_at_checkout.min' => 'Price at checkout cannot be negative.',
        ];
    }
}
