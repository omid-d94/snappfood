<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{--                    @if(!auth("seller")->user()->restaurants()->seller_id)--}}
                    <p class="font-bold text-red-600 text-lg py-3">
                        <a class=""
                           href="{{url("/seller/restaurants/create")}}">
                            <button
                                class="font-bold hover:bg-red-500 text-lg text-white px-5 py-3
                                bg-red-600
                                ">
                                Let's create profile your restaurant
                            </button>
                        </a>
                    </p>
                    {{--                    @endif  --}}
                </div>
            </div>
        </div>
    </div>
</x-seller-app-layout>
