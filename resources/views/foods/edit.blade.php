<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/seller/foods")}}">{{ __('Back To Menu') }}</a>
        </span>
        </div>
    </x-slot>

    <div class="mx-auto  px-16 py-10 m-10 ">
        <h2 class="mx-36 mb-10 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing of '). $food->title .__(' food') }}
        </h2>
        <form action="{{url("/seller/foods/$food->id")}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="flex flex-col w-2/3 mx-auto gap-3 mx-36">
                <div class="flex justify-between items-center">
                    <!-- Title -->
                    <div class="py-3 w-2/5">
                        <label class="font-semibold text-gray-700 px-3" for="title">Title</label>
                        <input
                            class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" name="title" id="title"
                            value="{{$food->title}}" required autofocus>
                        @error("title") <span class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                    </div>
                    <!-- Price -->
                    <div class="py-3 w-2/5">
                        <label class="font-semibold text-gray-700 px-3" for="price">Price</label>
                        <input
                            class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                            type="text" name="price" id="price"
                            value="{{$food->price}}" required>
                        @error("price") <span class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <!-- Type -->
                    <div class="w-2/5 py-3">
                        <label class="font-semibold text-gray-700 px-3" for="type">Type</label>
                        <select class="w-full border-2 border-blue-200 rounded-lg cursor-pointer font-semibold "
                                name="food_category" id="type" required>
                            <option value="" selected>Choose...</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{ucfirst($category->title)}}</option>
                            @endforeach
                        </select>
                        @error("food_category") <span
                            class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                    </div>

                    <!-- Discount -->
                    <div class="py-3 w-2/5">
                        <label class="font-semibold text-gray-700 px-3" for="discount">Discount</label>
                        <select class="w-full border-2 border-blue-200 rounded-lg cursor-pointer font-semibold "
                                name="discount_id" id="discount">
                            <option value="" selected>No Discount</option>
                            @foreach($discounts as $discount)
                                <option value="{{$discount->id}}">{{ucfirst($discount->title)}}</option>
                            @endforeach
                        </select>
                        @error("discount_id") <span
                            class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                    </div>
                </div>
                <!-- Raw Material -->
                <div class="py-3">
                    <label class="font-semibold text-gray-700 px-3" for="raw_material">Raw Material</label>
                    <textarea
                        class="w-full border-2 border-blue-200 rounded-lg hover:bg-blue-100 font-semibold "
                        type="text" name="raw_material" id="raw_material"
                    >{{$food->raw_material}}</textarea>
                    @error("raw_material") <span
                        class="font-semibold text-lg text-blue-600">{{$message}}</span> @enderror
                </div>
                <!-- Image -->
                <div class="py-3">
                    <label class="font-semibold text-gray-700 px-3" for="image">Food Image</label>
                    <input class="w-full cursor-pointer rounded-lg hover:bg-blue-100 font-semibold "
                           type="file" name="image_path" id="image">
                    @error("image_path") <span class="font-semibold text-lg text-red-600">{{$message}}</span> @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="font-bold hover:bg-blue-500 text-lg px-14 py-3 bg-blue-600 text-white
                                rounded-xl">Update
                    </button>
                </div>

            </div>

        </form>
    </div>


</x-seller-app-layout>

