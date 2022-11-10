<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/admin/discounts")}}">{{ __('Back To Discounts') }}</a>
        </span>
        </div>
    </x-slot>

    <form action="{{route("discounts.index")}}" method="POST">
        @csrf

        <div class="mx-auto bg-gray-50 shadow-xl justify-center items-center w-1/2 mt-20 p-20">
            <div class="pb-10">
                <h1 class="font-bold text-2xl text-gray-700 text-center">Create New Discount</h1>
            </div>
            <div class="mb-4">
                <label class="font-bold text-xl text-gray-800" for="title">Title:</label>
                <input class="rounded-2xl border-2 border-blue-200 hover:border-blue-300 p-2 w-full"
                       name="title" id="title" placeholder="Write Here ... "
                       value="{{old("title")}}" >
                @error("title") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="font-bold text-xl text-gray-800" for="percent">Percent:</label>
                <select class="rounded-2xl border-2 border-blue-200 hover:border-blue-300 p-2 w-full"
                        name="percent" id="percent" >
                    <option value="" selected>Choose...</option>
                    @for($i=10;$i<100;$i+=10)
                        <option value="{{$i}}">{{$i}}%</option>
                    @endfor
                </select>
                @error("percent") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="font-bold text-xl text-gray-800" for="expired_at">Expired at:</label>
                <input class="rounded-2xl border-2 border-blue-200 hover:border-blue-300 p-2 w-full"
                       type="datetime-local" name="expired_at" id="expired_at" value="{{old("expired_at")}}"
                       aria-valuemin="{{now()->addHour()}}" aria-valuemax="{{now()->addMonths(6)}}">
                @error("expired_at") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
            </div>

            <div class="mb-4 text-center">
                <button type="submit"
                        class="bg-blue-700 hover:bg-blue-500 rounded-2xl px-10 py-4 font-bold text-white">
                    Create
                </button>
            </div>
        </div>

    </form>

</x-admin-app-layout>

