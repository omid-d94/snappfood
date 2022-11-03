<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Food Menu') }}
        </h2>
    </x-slot>

    <section class="p-10 mx-auto">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @endif

        <div class=" m-5 shadow-lg">

            @forelse($foods=[] as $food)
                <div class="flex justify-around items-center p-16">
                    <div>
                        <a href="{{url("/seller/restaurants/{$food->id}/edit")}}">
                            <button class="px-5 font-semibold py-12 rounded-lg bg-cyan-600 text-white
                            hover:bg-cyan-500">
                                Edit<br>Food<br>Info
                            </button>
                        </a>
                    </div>
                    <div class=" lg:w-1/4 md:w-1/2  w-full">
                        <h1 class="font-bold text-gray-800 text-2xl text-center">{{$food->title}}</h1>
                        <img class="border-4 border-white h-full w-full hover:border-green-500 border-2 rounded-3xl
                    cursor-pointer " src="{{asset
                    ("storage/".$food->image_path)}}"
                             alt="">
                    </div>
                </div>
                <div>
                    <p class="font-semibold pb-3">Phone: {{$food->raw_material}}</p>
                    <p class="font-semibold pb-3">Price: {{ $food->price}} </p>
                </div>
            @empty
            @endforelse
        </div>
    </section>
</x-seller-app-layout>
