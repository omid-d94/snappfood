<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("food-party.index")}}">{{ __('Back') }}</a>
        </span>
        </div>
    </x-slot>

    <h2 class="text-center font-bold text-xl py-5 text-gray-800 bg-white">
        {{ __('Add Food To Food Party') }}
    </h2>
    <form action="{{route("food-party.store")}}"
          method="POST">
        @csrf
        <div class="flex flex-col gap-5 mx-auto items-start w-1/3 p-5 shadow-xl bg-white">
            <div>
                <label class="font-bold text-gray-800 text-lg"
                       for="foods">Foods</label>
                <select name="foods" id="foods"
                        class="border-2 border-green-300 rounded-lg w-full">
                    <option value="" selected>Choose...</option>
                    @forelse($foods as $food)
                        <option value="{{$food->id}}">{{$food->title}}</option>
                    @empty
                        <option value="">You Have No Food</option>
                    @endforelse
                </select>
                @error("foods") <p class="font-semibold text-red-600 ">{{$message}}</p> @enderror
            </div>
            <div>
                <label class="font-bold text-gray-800 text-lg" for="count">Count</label>
                <input type="number" name="count" id="count" min="0" max="5" maxlength="1"
                       class="border-2 border-green-300 w-full rounded-lg" value="{{old("count")}}}">
                @error("count") <p class="font-semibold text-red-600 ">{{$message}}</p> @enderror
            </div>
            <div>
                <label class="font-bold text-gray-800 text-lg" for="discount">Discount</label>
                <select name="discount" id="discount"
                        class="border-2 border-green-300 rounded-lg w-full">
                    <option value="" selected>Choose...</option>
                    @forelse($discounts as $discount)
                        <option value="{{$discount->id}}">{{$discount->percent}}%</option>
                    @empty
                        <option value="">No Discount Founded!</option>
                    @endforelse
                </select>
                @error("discount") <p class="font-semibold text-red-600 ">{{$message}}</p> @enderror
            </div>
            <button type="submit"
                    class="bg-green-600 font-bold text-xl px-10 py-5 text-white rounded-xl self-center">
                Add
            </button>
        </div>
    </form>
</x-seller-app-layout>
