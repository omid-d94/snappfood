<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("food-party-management.index")}}">{{ __('Back') }}</a>
        </span>
        </div>
    </x-slot>
    <h2 class="text-center font-bold text-xl py-5 text-green-800 bg-white">
        {{ __('Edit Food Party ').$foodParty->id }}
    </h2>
    <form action="{{url("/admin/food-party-management/$foodParty->id")}}"
          method="POST">
        @csrf
        @method("PUT")
        <div class="flex flex-col gap-5 mx-auto items-center justify-center w-1/3 p-5 shadow-xl bg-white">
            <div>
                <label class="font-bold text-green-800 text-lg"
                       for="start">Start Time</label>
                <input type="time" name="start" id="start" value="{{$foodParty->start}}"
                       class="border-green-300 rounded-lg w-full border-2">
                @error("start") <p class="font-semibold text-red-600 ">{{$message}}</p> @enderror
            </div>
            <div>
                <label class="font-bold text-green-800 text-lg"
                       for="start">End Time</label>
                <input type="time" name="end" id="end" value="{{$foodParty->end}}"
                       class="border-green-300 rounded-lg w-full border-2">
                @error("end") <p class="font-semibold text-red-600 ">{{$message}}</p> @enderror
            </div>
            <button type="submit"
                    class="bg-green-600 font-bold text-xl w-full hover:bg-green-700 px-10 py-5 text-white rounded-xl
                    self-center">
                Update
            </button>
        </div>
    </form>
</x-admin-app-layout>

