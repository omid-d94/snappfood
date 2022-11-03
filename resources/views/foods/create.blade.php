<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Food To Your Menu') }}
        </h2>
    </x-slot>

    <div class="mx-auto px-16 py-10 m-10 ">
        <form action="{{url("/seller/foods")}}}" method="POST">
            @csrf
            <div class="flex flex-col gap-3 mx-36">
                <div class="flex justify-between items-center">
                    <!-- Title -->
                    <div class="py-3 ">
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
                                <option value="{{$category->title}}">{{ucfirst($category->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Price -->
                    <div class="py-3">
                        <label class="font-semibold text-gray-700 px-3" for="price">Price</label>
                        <input
                            class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" name="price" id="price"
                            value="{{old("price")}}" required>
                        @error("price") <span class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                    </div>
                </div>
                <!-- Raw Material -->
                <div class="py-3">
                    <label class="font-semibold text-gray-700 px-3" for="raw_material">Raw Material</label>
                    <textarea
                        class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                        type="text" name="raw_material" id="raw_material"
                    >{{old("raw_material")}}</textarea>
                    @error("raw_material") <span
                        class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                </div>
                <!-- Image -->
                <div class="py-3">
                    <label class="font-semibold text-gray-700 px-3" for="image">Food Image</label>
                    <input class="w-full cursor-pointer rounded-lg hover:bg-blue-100 font-semibold "
                           type="file" name="image" id="image" value="{{old("image")}}" required>
                    @error("image") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
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


</x-seller-app-layout>
