<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurant Form') }}
        </h2>
    </x-slot>

    <div class="shadow-lg mt-10 px-10 py-5 flex gap-4 mx-auto justify-around">
        <div class="">
            <form action="{{url("/seller/restaurants")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <!-- Title -->
                    <div class="py-3">
                        <label class="font-semibold text-gray-700 px-3" for="title">Title</label>
                        <input
                            class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" name="title" id="title"
                            value="{{old("title")}}" required autofocus>
                        @error("title") <span class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
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
                        @error("phone") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                    </div>

                    <!-- Logo -->
                    <div class="py-3">
                        <label class="font-semibold text-gray-700 px-3" for="logo">Restaurant
                            Logo</label>
                        <input class="w-full cursor-pointer rounded-lg hover:bg-blue-100 font-semibold "
                               type="file" name="logo" id="image" value="{{old("logo")}}" required>
                        @error("logo") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                    </div>
                    <!-- Bank Account Number -->
                    <div class="py-3">
                        <label class="font-semibold text-gray-700 px-3" for="account">Bank Account
                            Number</label>
                        <input
                            class="border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" name="account" id="account" value="{{old("account")}}" required>
                        @error("account") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                    </div>

                    <!-- Address -->
                    <div class="py-3">
                        <label class="font-semibold text-gray-700 px-3" for="address">Address</label>
                        <textarea
                            class="border-2 w-full border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                            name="address" id="address" required>{{old("title")}}</textarea>
                        @error("address") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit"
                                class="font-bold hover:bg-blue-500 text-lg px-14 py-3 bg-blue-600 text-white
                                rounded-xl">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @if($errors->any())
            {{--            @dd($errors)--}}
        @endif
        <div class="flex items-center flex-col">
            <!-- Schedule -->
            <div class="mb-5 mx-auto ">
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
                        <td><input type="time" name="day[sat][]" value="{{old("day[sat][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[sat][]" value="{{old("day[sat][1]")}}" id="" required>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-green-600">
                        <td><label for="sun">Sun</label></td>
                        <td><input type="time" name="day[sun][]" value="{{old("day[sun][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[sun][]" value="{{old("day[sun][1]")}}" id="" required>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-green-600">
                        <td><label for="mon">Mon</label></td>
                        <td><input type="time" name="day[mon][]" value="{{old("day[mon][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[mon][]" value="{{old("day[mon][1]")}}" id="" required>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-green-600">
                        <td><label for="tue">Tue</label></td>
                        <td><input type="time" name="day[tue][]" value="{{old("day[tue][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[tue][]" value="{{old("day[tue][1]")}}" id="" required>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-green-600">
                        <td><label for="wed">Wed</label></td>
                        <td><input type="time" name="day[wed][]" value="{{old("day[wed][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[wed][]" value="{{old("day[wed][1]")}}" id="" required>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-green-600">
                        <td><label for="thu">Thu</label></td>
                        <td><input type="time" name="day[thu][]" value="{{old("day[thu][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[thu][]" value="{{old("day[thu][1]")}}" id="" required>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-green-600">
                        <td><label for="fri">Fri</label></td>
                        <td><input type="time" name="day[fri][]" value="{{old("day[fri][0]")}}" id="" required>
                        </td>
                        <td><input type="time" name="day[fri][]" value="{{old("day[fri][1]")}}" id="" required>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="600" height="400" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Tehran&t=&z=11&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <a href="https://fmovies-online.net"></a><br>
                    <style>.mapouter {
                            position: relative;
                            text-align: right;
                            height: 400px;
                            width: 600px;
                        }</style>
                    <a href="https://www.embedgooglemap.net">google embed map</a>
                    <style>.gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 400px;
                            width: 600px;
                        }</style>
                </div>
            </div>
        </div>
    </div>
</x-seller-app-layout>
