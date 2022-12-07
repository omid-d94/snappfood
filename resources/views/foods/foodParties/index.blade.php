<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/seller/foods")}}">{{ __('Back-To-Menu') }}</a>
        </span>
            <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("food-party.create")}}">{{ __('Add-Food-To-Food-Party') }}</a>
        </span>
        </div>
    </x-slot>

    <section class="p-10 mx-auto">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @elseif(session("fail"))
            <div class=" mx-auto bg-red-100 border-2 text-center w-1/3 border-red-200 rounded-2xl p-5 m-2">
                <span class="text-red-900 ">{{ session('fail') }}</span>
            </div>
        @endif
    </section>

    <table class="border-2 border-blue-600 mx-auto text-center">
        <thead class="bg-blue-600 text-white font-bold">
        <tr>
            <th class="p-3 border-r-2 border-white ">Title</th>
            <th class="p-3 border-r-2 border-white ">Count</th>
            <th class="p-3 border-r-2 border-white ">Start</th>
            <th class="p-3">End</th>
        </tr>
        </thead>
        <tbody>
        @forelse($foods as $food)
            @foreach($food->foodParties as $item)
                <tr class="p-3 border-b-2 border-blue-600">
                    <td class="p-3 border-r-2 border-blue-600 ">{{$food->title}}</td>
                    <td class="p-3 border-r-2 border-blue-600 ">{{$item->pivot->count}}</td>
                    <td class="p-3 border-r-2 border-blue-600 ">{{$item->start}}</td>
                    <td class="p-3 border-r-2 border-blue-600 ">{{$item->end}}</td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td class="px-5 py-3" colspan="5">
                    <span class="text-xl text-red-600 font-semibold">☺ THE FOOD LIST IS EMPTY! ☺</span>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</x-seller-app-layout>
