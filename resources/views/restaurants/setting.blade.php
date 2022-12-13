<x-seller-app-layout>

    <div class=" m-5 shadow-lg">
        <form action="{{route("seller.restaurants.changeSetting")}}" method="POST">

            @csrf
            @method("PUT")

            {{-- Restaurant OPEN/CLOSE --}}
            <label for="open">Open</label>
            <input type="radio" name="is_open" id="open" value="{{$isOpen}}">

            <label for="close">Close</label>
            <input type="radio" name="is_open" id="close" value="{{$isOpen}}">

            <!-- Schedule -->
            <table>
                <thead class="bg-green-600 text-white">
                <tr>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                </thead>
                <tbody>
                @forelse($workingTimes as $time)
                    <tr>
                        <td><label for="sat">{{ucfirst($time->day)}}</label></td>
                        <td><input type="time" name="day[{{$time->day}}][]" value="{{$time->start}}" id=""></td>
                        <td><input type="time" name="day[{{$time->day}}][]" value="{{$time->end}}" id=""></td>
                    </tr>
                @empty
                    <tr>
                        <td><label for="sat">Sat</label></td>
                        <td><input type="time" name="day[sat][]" id=""></td>
                        <td><input type="time" name="day[sat][]" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="sun">Sun</label></td>
                        <td><input type="time" name="day[sun][]" id=""></td>
                        <td><input type="time" name="day[sun][]" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="mon">Mon</label></td>
                        <td><input type="time" name="day[mon][]" id=""></td>
                        <td><input type="time" name="day[mon][]" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="tue">Tue</label></td>
                        <td><input type="time" name="day[tue][]" id=""></td>
                        <td><input type="time" name="day[tue][]" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="wed">Wed</label></td>
                        <td><input type="time" name="day[wed][]" id=""></td>
                        <td><input type="time" name="day[wed][]" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="thu">Thu</label></td>
                        <td><input type="time" name="day[thu][]" id=""></td>
                        <td><input type="time" name="day[thu][]" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="fri">Fri</label></td>
                        <td><input type="time" name="day[fri][]" id=""></td>
                        <td><input type="time" name="day[fri][]" id=""></td>
                    </tr>
                @endforelse
                </tbody>
            </table>


        </form>
    </div>

</x-seller-app-layout>
