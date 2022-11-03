<x-seller-app-layout>
    <div class="px-16 mx-auto shadow-lg">
        <h1 class="font-bold text-2xl text-center text-red-600 ">Restaurant Setting</h1>
        <form action="{{url("/seller/restaurants")}}" method="POST" enctype="multipart/form-data">
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
                                <input type="radio" name="is_open" id="open">
                            </div>
                            <div>
                                <label for="close">Close</label>
                                <input type="radio" name="is_open" id="close">
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
                               value="{{old("logo")}}" type="file" name="logo" id="image" required>
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
                <!-- Address -->
                <div class="flex justify-between py-3 pb-10 bg-white border-t-4 border-gray-300 py-5 px-10 ">
                    <div class="flex flex-col items-start ">
                        <label class="font-semibold text-gray-700 px-3" for="address">Address</label>
                        <textarea
                            class="border-2 border-red-200 text-lg rounded-lg hover:bg-blue-100 font-semibold "
                            name="address" cols="30" rows="5" id="address" required>{{$restaurant->address}}</textarea>
                    </div>
                    <div class="self-end pb-10">
                        <button type="submit" class="font-bold text-lg px-14 py-3 bg-blue-600 text-white
                                    rounded-xl">Save Change
                        </button>
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

            </div>
        </form>
    </div>
</x-seller-app-layout>
