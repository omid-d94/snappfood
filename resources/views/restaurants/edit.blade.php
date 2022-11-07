<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setting') }}
        </h2>
    </x-slot>

    <div class="px-16 mt-10 mx-auto shadow-lg">
        <form action="{{url("/seller/restaurants/{$restaurant->id}")}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div>
                <div class="flex items-center py-5 px-10 justify-between  bg-white">
                    <!-- Title -->
                    <div class="flex gap-4 p-8 items-center">
                        <label class="font-semibold text-gray-700 px-3" for="title">Title</label>
                        <input
                            class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" name="title" id="title" value="{{$restaurant->title}}" required autofocus>
                    </div>

                    <!-- Type -->
                    <div class="flex gap-4 p-8 items-center ">
                        <label class="font-semibold text-gray-700 px-3" for="type">Type</label>
                        <select class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                                name="type" id="type" required>
                            @foreach($categories as $category)
                                <option value="{{$category->name}}">{{ucfirst($category->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Restaurant OPEN/CLOSE --}}
                    <div class="flex gap-4 p-8">
                        <span class="font-semibold text-gray-700">Status:</span>
                        <div class="flex gap-2">
                            <div>
                                <label for="open">Open</label>
                                <input type="radio" name="is_open" id="open"
                                       value="1" {{($restaurant->is_open=="Open")?" checked":""}}>
                            </div>
                            <div>
                                <label for="close">Close</label>
                                <input type="radio" name="is_open" id="close"
                                       value="0" {{($restaurant->is_open=="Close")?"checked":""}}>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center py-5 px-10 justify-around  bg-white border-t-4 border-gray-300">

                    <!-- Phone -->
                    <div class="flex gap-4 p-8 items-center rounded-t-lg">
                        <label class="font-semibold text-gray-700" for="phone">Phone</label>
                        <input
                            class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" value="{{$restaurant->phone}}" name="phone" id="phone" required>
                    </div>
                    <!-- Logo -->
                    <div class="flex gap-4 p-8 items-center  rounded-t-lg">
                        <label class="font-semibold text-gray-700" for="logo">Restaurant
                            Logo</label>
                        <input class="cursor-pointer rounded-lg hover:bg-blue-100 font-semibold "
                               value="{{old("logo")}}" type="file" name="logo" id="image">
                    </div>
                    <!-- Bank Account Number -->
                    <div class="flex gap-4 p-8 items-center rounded-t-lg">
                        <label class="font-semibold text-gray-700" for="account">
                            Bank Account Number
                        </label>
                        <input
                            class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                            value="{{$restaurant->account}}" type="text" name="account" id="account" required>
                    </div>
                </div>
                <div class="flex justify-between py-3 pb-10 bg-white border-t-4 border-gray-300 py-5 px-10 ">
                    <!-- Address -->
                    <div class="flex flex-col items-start ">
                        <label class="font-semibold text-gray-700 px-3" for="address">Address</label>
                        <textarea
                            class="border-2 border-red-200 text-lg rounded-lg hover:bg-blue-100 font-semibold "
                            name="address" cols="30" rows="5" id="address" required>{{$restaurant->address}}</textarea>
                    </div>

                    <!-- Send Cost -->
                    <div class="flex gap-4 p-8 items-center rounded-t-lg">
                        <label class="font-semibold text-gray-700" for="send_cost">
                            Send Cost
                        </label>
                        <input
                            class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                            value="{{$restaurant->send_cost}}" type="text" name="send_cost" id="send_cost">
                    </div>

                    <!-- Schedule -->
                    <div>
                        <table class="text-center border-b-2 border-green-800">
                            <thead class="bg-green-800 text-white border-2 border-green-800 ">
                            <tr>
                                <th class="p-2">Day</th>
                                <th class="p-2">Start Time</th>
                                <th class="p-2">End Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($workingTimes as $time)
                                <tr class="hover:bg-green-100 cursor-pointer">
                                    <td class="border-x-2 border-green-800">
                                        <label for="sat">{{ucfirst($time->day)}}</label>
                                    </td>
                                    <td class="border-x-2 border-green-800">
                                        <input type="time"
                                               name="day[{{$time->day}}][]"
                                               value="{{$time->start}}">
                                    </td>
                                    <td class="border-x-2 border-green-800">
                                        <input type="time"
                                               name="day[{{$time->day}}][]"
                                               value="{{$time->end}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="self-end pb-10 text-center">
                    <button type="submit" class="font-bold text-lg px-14 py-3 bg-blue-600 text-white
                                    rounded-xl">Save Change
                    </button>
                </div>
                @if($errors->any())
                    {{--                    @dd($errors)--}}
                @endif

            </div>
        </form>
    </div>
</x-seller-app-layout>
