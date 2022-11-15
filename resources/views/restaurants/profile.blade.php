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
                                    <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                                @endforeach
                            </select>
                            @error("type") <span
                                class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
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
                    </div>

                </div>
                <hr class="my-3 h-10">
                <div class="flex justify-between items-center">
                    <!-- Address -->
                    <div>
                        <div class="py-3">
                            <label class="font-semibold text-gray-700 px-3" for="address">Address</label>
                            <textarea
                                class="border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                                name="address" rows="8" id="address" required>{{old("title")}}</textarea>
                            @error("address") <span
                                class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                        </div>
                    </div>
                    {{-- Latitude & Longitude --}}
                    <div>
                        <div>
                            <label class="font-semibold text-gray-700 px-3" for="latitude">Latitude</label>
                            <input class="px-3 border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100
                            font-semibold "
                                   name="latitude" id="latitude" value="{{old("latitude")}}" required>
                            @error("latitude")
                            <span class="font-semibold text-lg text-red-600">{{$message}}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="font-semibold text-gray-700 px-3" for="longitude">Longitude</label>
                            <input class="px-3 border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100
                            font-semibold "
                                   name="longitude" id="longitude" value="{{old("longitude")}}" required>
                            @error("longitude")
                            <span class="font-semibold text-lg text-red-600">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        {{-- Map --}}
                        <div class="shadow-xl "
                             id="map"
                             style="width: 500px; height: 300px; background: #eee; border: 2px solid #aaa;">
                        </div>
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

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        var map, latitude, longitude, marker, latLong, address;
        latitude = document.querySelector('#latitude');
        longitude = document.querySelector('#longitude');
        address = document.querySelector('#address');
        map = new L.Map('map', {
            key: 'web.21db42cac1c0476aaa730307bf676874',
            maptype: 'dreamy',
            poi: true,
            traffic: false,
            center: [35.699739, 51.338097],
            zoom: 14
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
                    address.value=res.data.formatted_address;
                }
            ).catch(
                err => alert("ERROR! CAN NOT RECEIVE ADDRESS BY LOCATION")
            );

        });
    </script>


</x-seller-app-layout>
