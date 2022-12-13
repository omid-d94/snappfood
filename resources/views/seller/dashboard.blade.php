<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("seller.dashboard")}}">{{ __('Seller Dashboard') }}</a>
        </span>
            <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("seller.orders.archived")}}">{{ __('Archived Orders') }}</a>
        </span>
        </div>
    </x-slot>
    @if(session('success'))
        <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
            <span class="text-green-900 ">{{ session('success') }}</span>
        </div>
    @elseif(session('fail'))
        <div class=" mx-auto bg-red-100 border-2 text-center w-1/3 border-red-200 rounded-2xl p-5 m-2">
            <span class="text-red-900 ">{{ session('fail') }}</span>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @empty(auth("seller")->user()->restaurants->toArray())
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
                    @endempty
                </div>
                <div class="">
                    <h1 class="text-center font-bold text-2xl my-5">
                        {{request()->routeIs("seller.dashboard")?"Orders":"Archived Orders"}}
                    </h1>
                    <table class="text-center mx-auto border-2 border-green-800">
                        <thead class="bg-green-900 text-white">
                        <tr>
                            <th class="p-2 px-5 font-bold border-r-2 border-white">No.</th>
                            <th class="p-2 px-5 font-bold border-r-2 border-white">Customer</th>
                            <th class="p-2 px-5 font-bold border-r-2 border-white">Order</th>
                            <th class="p-2 px-5 font-bold border-r-2 border-white">Tracking Code</th>
                            <th class="p-2 px-5 font-bold border-r-2 border-white">Request Time</th>
                            <th class="p-2 px-5 font-bold border-r-2 border-white">Status</th>
                            <th class="p-2 px-5 font-bold">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $row=0; @endphp
                        @forelse($orders as $order)
                            <tr class="border-b-2 border-green-800">
                                <td class="px-2 border-r-2 border-green-800">{{++$row}}</td>
                                <td class="px-2 border-r-2 border-green-800">{{$order->user->name}}</td>
                                <td class="px-2 border-r-2 border-green-800">{{$order->id}}</td>
                                <td class="px-2 border-r-2 border-green-800">{{$order->tracking_code}}</td>
                                <td class="px-2 border-r-2 border-green-800">{{$order->created_at}}</td>
                                <td class="px-2 border-r-2 border-green-800">{{$order->status}}</td>
                                <td class="">
                                    <a href="{{route("seller.orders.show",["order"=>$order->id])}}">
                                        <button class="w-full px-10 py-5 bg-green-400 text-white
                                        hover:cursor-pointer hover:bg-green-500">Show
                                            Order
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-red-500" colspan="7">You don't currently have an order!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="w-1/2 text-center mx-auto">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-seller-app-layout>
