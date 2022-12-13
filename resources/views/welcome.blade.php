<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        @vite('resources/css/app.css')

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-10">
                <div>
                    <h1 class="font-bold text-3xl">{{$product->name}}</h1>
                    <p>{{$product->description}}</p>
                </div>

                <div class="font-bold">
                    <p>Current price</p>
                    <p class="text-2xl">{{$product->bids()->max('price')}}</p>
                </div>

                <div class="font-bold">
                    <p>Optimal price</p>
                    <p class="text-2xl">{{$product->optimal_price}}</p>
                </div>

                <div class="font-bold">
                    <p>Blitz price</p>
                    <p class="text-2xl">{{$product->blitz_price}}</p>
                </div>

                @auth
                    @if(auth()->user()->id != $product->user->id)
                    <div class="font-bold">
                        <p>Your price</p>
                        <form method="POST" action="{{route('bids.store')}}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}"/>
                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="old('price')" required autofocus autocomplete="price" />
                            <x-primary-button>{{__('PLACE YOUR BID')}}</x-primary-button>
                        </form>
                    </div>

                    <div class="font-bold">
                        <p>Buy this product right now</p>
                        <form method="GET" action="{{route('success')}}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}"/>
                            <x-primary-button>{{__('BUY RIGHT NOW')}}</x-primary-button>
                        </form>
                    </div>
                    @else
                        <div class="font-bold">
                            <p>Bids count</p>
                            <p class="text-2xl">{{$product->bids->count()}}</p>
                        </div>
                    @endif
                @else
                    <div class="font-bold">
                        <p>Please log in to place your bid.</p>
                    </div>
                @endauth
            </div>
        </div>
    </body>
</html>
