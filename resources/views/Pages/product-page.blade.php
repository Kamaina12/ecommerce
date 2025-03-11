@extends('components.layouts.app')

@section('content')
<div> <!-- Root div -->
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
            <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
                <div class="flex flex-wrap mb-24 -mx-3">
                    <!-- Sidebar -->
                    <div class="w-full pr-2 lg:w-1/4">
                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                            <h2 class="text-2xl font-bold dark:text-gray-400">Categories</h2>
                            <ul>
                                @foreach ($categories as $cat)
                                <li class="mb-4">
                                    <label class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" wire:model="selected_categories" value="{{ $cat->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $cat->name }}</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                            <h2 class="text-2xl font-bold dark:text-gray-400">Brand</h2>
                            <ul>
                                @foreach ($brands as $bra)
                                <li class="mb-4">
                                    <label class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model="selected_brands" value="{{ $bra->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">{{ $bra->name }}</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                            <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
                            <div class="font-semibold">₹{{ number_format($price_range, 2) }}</div>
                            <input type="range" wire:model="price_range" class="w-full h-1 bg-blue-100 rounded cursor-pointer" max="500000" step="1000">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-blue-400">₹1,000</span>
                                <span class="text-lg font-bold text-blue-400">₹500,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Products List -->
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="px-3 mb-4">
                            <div class="flex justify-between bg-gray-100 dark:bg-gray-900 p-2">
                                <select wire:model="sort" class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                    <option value="latest">Sort by Latest</option>
                                    <option value="price">Sort by Price</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-wrap">
                            @foreach ($products as $product)
                            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                                <div class="border border-gray-300 dark:border-gray-700">
                                    <a href="/products/{{ $product->slug }}">
                                        <img src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto">
                                    </a>
                                    <div class="p-3">
                                        <h3 class="text-xl font-medium dark:text-gray-400">{{ $product->name }}</h3>
                                        <p class="text-lg text-green-600 dark:text-green-600">₹{{ number_format($product->price, 2) }}</p>
                                    </div>
                                    <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                        <button wire:click.prevent="addToCart({{ $product->id }})" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5z"></path>
                                            </svg>
                                            <span wire:loading.remove>Add to Cart</span>
                                            <span wire:loading>Adding...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end mt-6">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div> <!-- Closing the root div -->
@endsection
