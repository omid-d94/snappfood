<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("banners.index")}}">{{ __('Back To Banners') }}</a>
        </span>
        </div>
    </x-slot>

    <div class="flex flex-col gap-3 items-center p-10 mb-10">
        <div>
            <h1 class="font-bold text-2xl text-green-800 text-center">
                {{$banner->title}}
            </h1>
        </div>
        <div class="w-1/2">
            <img src="{{asset("storage/".$banner->image)}}" alt="{{$banner->title}}">
        </div>
        <form action="{{route("banners.destroy",$banner->id)}}" method="POST">
            @csrf
            @method("DELETE")
            <button class="bg-red-500 font-bold text-xl rounded-lg px-10 py-5 text-white">
                Delete Banner
            </button>
        </form>
    </div>
</x-admin-app-layout>
