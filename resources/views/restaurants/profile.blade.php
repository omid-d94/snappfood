<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurant Form') }}
        </h2>
    </x-slot>

    <div class="shadow-lg mt-10 px-10 py-5  gap-4 mx-auto justify-around">
        <div class="">
            <form action="{{url("/seller/restaurants")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex">
                    <div>
                        <!-- Title -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="title">Title</label>
                            <input
                                class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                                type="text" name="title" id="title"
                                value="{{old("title")}}" required autofocus>
                            @error("title") <span
                                class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                        </div>

                        <!-- Type -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="type">Type</label>
                            <select class="w-full border-2 border-blue-200 rounded-lg cursor-pointer font-semibold "
                                    name="type" id="type">
                                <option selected>Choose...</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->name}}">{{ucfirst($category->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Send Cost -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="send_cost">Send Cost</label>
                            <input
                                class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                                type="text" name="send_cost" id="send_cost" value="{{old("send_cost")}}" required>
                            @error("send_cost") <span
                                class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                        </div>

                        <!-- Phone -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="phone">Phone</label>
                            <input
                                class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                                type="text" name="phone" id="phone" value="{{old("phone")}}" required>
                            @error("phone") <span
                                class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                        </div>

                        <!-- Logo -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="logo">Restaurant
                                Logo</label>
                            <input class="w-full cursor-pointer rounded-lg hover:bg-blue-100 font-semibold "
                                   type="file" name="logo" id="image" value="{{old("logo")}}" required>
                            @error("logo") <span
                                class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                        </div>

                        <!-- Bank Account Number -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="account">Bank Account
                                Number</label>
                            <input
                                class="border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                                type="text" name="account" id="account" value="{{old("account")}}" required>
                            @error("account") <span
                                class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                        </div>

                        <!-- Address -->
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="address">Address</label>
                            <textarea
                                class="border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                                name="address" id="address" required>{{old("title")}}</textarea>
                            @error("address") <span
                                class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                        </div>

                    </div>
                    <div class="mb-5 flex flex-col gap-4 items-center mx-auto ">

                        <!-- Schedule -->
                        <table class="border-2 text-center border-green-600">
                            <thead class="bg-green-600 text-white">
                            <tr>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="sat">Sat</label></td>
                                <td><input type="time" name="day[sat][]" value="{{old("day[sat][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[sat][]" value="{{old("day[sat][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="sun">Sun</label></td>
                                <td><input type="time" name="day[sun][]" value="{{old("day[sun][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[sun][]" value="{{old("day[sun][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="mon">Mon</label></td>
                                <td><input type="time" name="day[mon][]" value="{{old("day[mon][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[mon][]" value="{{old("day[mon][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="tue">Tue</label></td>
                                <td><input type="time" name="day[tue][]" value="{{old("day[tue][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[tue][]" value="{{old("day[tue][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="wed">Wed</label></td>
                                <td><input type="time" name="day[wed][]" value="{{old("day[wed][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[wed][]" value="{{old("day[wed][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="thu">Thu</label></td>
                                <td><input type="time" name="day[thu][]" value="{{old("day[thu][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[thu][]" value="{{old("day[thu][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-green-600">
                                <td><label for="fri">Fri</label></td>
                                <td><input type="time" name="day[fri][]" value="{{old("day[fri][0]")}}" id=""
                                           required>
                                </td>
                                <td><input type="time" name="day[fri][]" value="{{old("day[fri][1]")}}" id=""
                                           required>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        {{-- Map --}}

                        <style>
                            .panel {
                                overflow: scroll;
                                margin-left: 10px;
                                margin-top: 10px;
                                width: fit-content;
                                background-color: aliceblue;
                                opacity: 0.9;
                                border: 3px solid #4C3FE4;
                                padding: 10px;
                                position: absolute;
                                z-index: 2;
                            }
                        </style>
                        <div class="shadow-xl"
                             id="map"
                             style="width: 500px; height: 300px; background: #eee; border: 2px solid #aaa;">
                        </div>
                        <input hidden name="latitude" id="lat" value="">
                        <input hidden name="longitude" id="long" value="">
                    </div>

                </div>
                <div class="text-center">
                    <button type="submit"
                            class="font-bold hover:bg-blue-500 text-lg px-14 py-3 bg-blue-600 text-white
                                rounded-xl">Save
                    </button>
                </div>
            </form>
        </div>
        @if($errors->any())
            {{--            @dd($errors)--}}
        @endif

    </div>


    <script type="text/javascript">
        var myMap = new L.Map('map', {
            key: 'web.21db42cac1c0476aaa730307bf676874',
            maptype: 'dreamy',
            poi: true,
            traffic: false,
            center: [35.699739, 51.338097],
            zoom: 14
        });

        //add markers
        // if (beneficiary.length) {
        //     beneficiary.forEach(function (data, i) {
        //         let [lat, long] = [data[0], data[1]];
        //         let label = data[2];
        //         if (lat && long) {
        //             marker = new L.marker([lat, long])
        //                 .bindPopup(label)
        //                 .addTo('map');
        //
        //         } else {
        //             console.log('no geo data available for: ' + label)
        //         }
        //     })
        // }
    </script>


</x-seller-app-layout>
