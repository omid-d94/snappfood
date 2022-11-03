<x-seller-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurant Info') }}
        </h2>
    </x-slot>

    <section class="p-10 mx-auto">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @endif

        <div class=" m-5 shadow-lg">

            @forelse($restaurants as $restaurant)
                <div class="flex justify-around items-center p-16">
                    <div>
                        <a href="{{url("/seller/restaurants/{$restaurant->id}/edit")}}">
                            <button class="px-5 font-semibold py-12 rounded-lg bg-cyan-600 text-white
                            hover:bg-cyan-500">
                                Edit<br>Restaurant<br>Info
                            </button>
                        </a>
                    </div>
                    <div class=" lg:w-1/4 md:w-1/2  w-full">
                        <h1 class="font-bold text-gray-800 text-2xl text-center">{{$restaurant->title}}</h1>
                        <img class="border-4 border-white h-full w-full hover:border-green-500 border-2 rounded-3xl
                    cursor-pointer " src="{{asset
                    ("storage/".$restaurant->logo)}}"
                             alt="">
                    </div>
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
                            @forelse($restaurant->workingTimes as $time)
                                <tr class="hover:bg-green-100 cursor-pointer">
                                    <td class="border-x-2 border-green-800">{{$time->day}}</td>
                                    <td class="border-r-2 border-green-800">{{$time->start}}</td>
                                    <td class="border-r-2 border-green-800">{{$time->end}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No working time has been set!</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div>
                        <p class="font-semibold pb-3">Address: {{$restaurant->address}}</p>
                        <div class="flex items-center pb-3 gap-3">
                            <span class="font-semibold">Score: </span>
                            <div class="flex gap-1">
                                @for($i=1;$i<=$restaurant->score;$i++)
                                    <img class="" src="{{asset("img/star.svg")}}" alt="♥">
                                @endfor
                            </div>
                        </div>
                        <p class="font-semibold pb-3">Phone: {{$restaurant->phone}}</p>
                        <p class="font-semibold pb-3">Send
                            Cost: {{ $restaurant->send_cost}} {{($restaurant->send_cost=="Free")?"":"T"}}</p>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
</x-seller-app-layout>
