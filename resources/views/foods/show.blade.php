<x-seller-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/seller/foods")}}">{{ __('Back To Menu') }}</a>
        </span>
    </x-slot>
    <div class="mx-10 my-5 flex gap-6  ">
        <div class=" lg:w-1/4 md:w-1/2  w-full">
            <img class="border-4 border-white h-full w-full hover:border-green-500 border-2 rounded-3xl
                    cursor-pointer " src="{{asset
                    ("storage/".$food->image_path)}}"
                 alt="">
        </div>
        <div class="bg-white p-10 flex flex-col gap-5">
            <div>
                <span class="text-red-800">Title: </span>
                <span class="text-xl font-bod text-gray-700 pt-4">{{$food->title}}</span>
            </div>
            <div>
                <span class="text-red-800">Price: </span>
                <span class="text-xl font-bod text-gray-700 pt-4">{{$food->price}}</span>
            </div>
            <div>
                <span class="text-red-800">Discount: </span>
                <span class="text-xl font-bod text-gray-700 pt-4">{{($discount->title)??"No Discount"}}</span>
            </div>
            <div>
                <span class="text-red-800">Discounted Price: </span>
                <span class="text-xl font-bod text-gray-700 pt-4">{{(($discount->factor)??1)*$food->price}}</span>
            </div>
            <div>
                <span class="text-red-800">Raw Material: </span>
                <span class="text-xl font-bod text-gray-700 pt-4">{{$food->raw_material}}</span>
            </div>
            <div>
                <span class="text-red-800">Category: </span>
                <span class="text-xl font-bod text-gray-700 pt-4">{{$category->title}}</span>
            </div>

        </div>
    </div>


</x-seller-app-layout>
