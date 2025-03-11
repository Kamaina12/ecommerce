
@extends('components.layouts.app')

@section('content')
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
      <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
      <div class="flex flex-col md:flex-row gap-4">
        <div class="md:w-3/4">
          <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
            <table class="w-full">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cart_items as $items)
                <tr wire:key="{{$items['product_id']}}">
                    <td>
                      <div class="flex items-center">
                        <img class="h-16 w-16 mr-4" src="{{ asset('storage/' . $items['image']) }}" alt="{{$items['name']}}">
                        <span>{{$items['name']}}</span>
                      </div>
                    </td>
                    <td>{{ number_format($items['unit_amount'], 2) }} INR</td>
                    <td>
                      <div class="flex items-center">
                        <button wire:click="updateQuantity({{$items['product_id']}}, -1)">-</button>
                        <span>{{$items['quantity']}}</span>
                        <button wire:click="updateQuantity({{$items['product_id']}}, 1)">+</button>
                      </div>
                    </td>
                    <td>{{ number_format($items['total_amount'], 2) }} INR</td>
                    <td><button wire:click="removeItem({{$items['product_id']}})">Remove</button></td>
                  </tr>
                @empty
                 <tr>
                    <td colspan="5">No items available in cart!</td>
                 </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="md:w-1/4">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2>Summary</h2>
            <div class="flex justify-between">
              <span>Grand Total</span>
              <span>{{ number_format($grand_total, 2) }} INR</span>
            </div>
            @if($cart_items)
            <button>Checkout</button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
