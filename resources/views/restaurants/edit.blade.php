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
                                <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
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
                    <div>
                        <div class="flex flex-col items-start mb-3">
                            <label class="font-semibold text-gray-700 px-3" for="address">Address</label>
                            <textarea
                                class="border-2 border-red-200 text-lg rounded-lg hover:bg-blue-100 font-semibold "
                                name="address" cols="30" rows="5" id="address"
                                required>{{$restaurant->address}}</textarea>
                        </div>
                        {{-- Latitude --}}
                        <div class="flex flex-col items-start mb-3">
                            <label class="font-semibold text-gray-700 px-3" for="latitude">Latitude</label>
                            <input class="px-3 border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100
                            font-semibold "
                                   name="latitude" id="latitude" value="{{$restaurant->latitude}}" required>
                            @error("latitude")
                            <span class="font-semibold text-lg text-red-600">{{$message}}</span>
                            @enderror
                        </div>
                        {{-- Longitude --}}
                        <div class="flex flex-col mb-3 items-start ">
                            <label class="font-semibold text-gray-700 px-3" for="longitude">Longitude</label>
                            <input class="px-3 border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100
                            font-semibold "
                                   name="longitude" id="longitude" value="{{$restaurant->longitude}}" required>
                            @error("longitude")
                            <span class="font-semibold text-lg text-red-600">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- Send Cost -->
                        <div class="flex flex-col items-start rounded-t-lg">
                            <label class="font-semibold px-3 text-gray-700" for="send_cost">
                                Send Cost
                            </label>
                            <input
                                class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                                value="{{$restaurant->send_cost}}" type="text" name="send_cost" id="send_cost">
                        </div>
                    </div>
                    {{-- Map --}}
                    <div class="shadow-xl "
                         id="map"
                         style="width: 400px; height: 400px; background: #eee; border: 2px solid #aaa;">
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
                    <button type="submit"
                            class="font-bold text-lg px-14 py-3 bg-blue-600 text-white rounded-xl
                            hover:bg-blue-500">Save
                        Change
                    </button>
                </div>
                @if($errors->any())
                    {{--                                        @dd($errors)--}}
                @endif

            </div>
        </form>
    </div>

    {{-- Map --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        var map, latitude, longitude, marker, latLong, address;
        latitude = document.querySelector('#latitude');
        longitude = document.querySelector('#longitude');
        console.log(parseFloat(latitude.value) + "," + parseFloat(longitude.value));
        address = document.querySelector('#address');
        map = new L.Map('map', {
            key: 'web.21db42cac1c0476aaa730307bf676874',
            maptype: 'dreamy',
            poi: true,
            traffic: false,
            center: [parseFloat(latitude.value), parseFloat(longitude.value)],
            zoom: 20
        });
        map.on('click', function (e) {
            latitude.value = e.latlng.lat.toString();
            longitude.value = e.latlng.lng.toString();
            axios({
                method: "GET",
                url: "https://api.neshan.org/v5/reverse",
                params: {
                    lat: latitude.value,
                    lng: longitude.value,
                },
                headers: {
                    'Api-key': 'service.8b88f801c9664f628249057c3a85f391',
                }
            }).then(
                function (res) {
                    console.log(res);
                    address.value = res.data.formatted_address;
                }
            ).catch(
                err => alert("ERROR! CAN NOT RECEIVE ADDRESS BY LOCATION")
            );

        });
    </script>

</x-seller-app-layout>
