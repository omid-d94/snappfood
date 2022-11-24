@php
    use App\Models\Order;
@endphp
<x-seller-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("seller.dashboard")}}">{{ __('Back To Orders') }}</a>
        </span>
    </x-slot>
    <div>
        <h1 class="text-center font-bold text-2xl my-5">Order {{$order->id}}</h1>
        <div class="flex gap-5 justify-center mx-auto ">
            <div>
                <table class="text-center mx-auto border-2 border-blue-800">
                    <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="p-2 px-5 font-bold border-r-2 border-white">No.</th>
                        <th class="p-2 px-5 font-bold border-r-2 border-white">Food</th>
                        <th class="p-2 px-5 font-bold border-r-2 border-white">Count</th>
                        <th class="p-2 px-5 font-bold">Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $row=0; @endphp
                    @forelse($order->foods as $food)
                        <tr>
                            <td class="px-2 border-r-2 border-blue-800">{{++$row}}</td>
                            <td class="px-2 border-r-2 border-blue-800">{{$food->title}}</td>
                            <td class="px-2 border-r-2 border-blue-800">{{$food->pivot->count}}</td>
                            <td class="px-2 border-r-2 border-blue-800">
                                @isset($food->discount->percent){{$food->discount->percent."%"}}
                                @else
                                    No Discount
                                @endisset
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-red-500" colspan="4">You don't currently have an order!</td>
                        </tr>
                    @endforelse
                    <tr class="border-t-2 border-blue-800">
                        <td class="px-2 border-r-2 border-blue-800">Total Payment</td>
                        <td colspan="3" class="text-start">{{$order->total}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <form action="{{route("seller.orders.update.status",["order"=>$order->id])}}" method="POST">
                    @csrf
                    @method("PATCH")
                    <div class="flex flex-col items-center gap-4">
                        <div class="bg-white p-10">
                            <label for="Pending">Pending</label>
                            <input type="radio" name="status" id="Pending"
                                   value={{Order::PENDING}}
                                {{($order->status=="PENDING")?" checked ":""}}>

                            <label for="Preparing">Preparing</label>
                            <input type="radio" name="status" id="Preparing"
                                   value={{Order::PREPARING}}
                                {{($order->status=="PREPARING")?" checked ":""}}>

                            <label for="Sent">Sent</label>
                            <input type="radio" name="status" id="Sent"
                                   value={{Order::SEND_TO_DESTINATION}}
                                {{($order->status=="SEND_TO_DESTINATION")?" checked ":""}}>

                            <label for="Delivered">Delivered</label>
                            <input type="radio" name="status" id="Delivered"
                                   value={{Order::DELIVERED}}
                                {{($order->status=="DELIVERED")?" checked ":""}}>
                        </div>
                        <div>
                            <button type="submit"
                                    class="text-center bg-blue-800 text-white rounded-lg px-10 py-5 hover:bg-blue-700
                    hover:cursor-pointer">Change Status
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('input:radio [name="status"]').on("click", function (e) {
            $.ajax({
                url: '/seller/orders/{{$order->id}}',
                method: "PATCH",
                data: {
                    status: e.val(),
                    _token: '{{ csrf_token() }}',
                },
            }).success(function (response) {
                console.log(response);
            }).error(function (error) {
                console.log(error);
            });
        });
    </script>
</x-seller-app-layout>
