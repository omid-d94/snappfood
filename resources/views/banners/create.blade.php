<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("banners.index")}}">{{ __('Back To Banners') }}</a>
        </span>
        </div>
    </x-slot>
    <div class="mx-auto m-10 p-5">
        <h1 class="my-3 text-center font-bold text-green-600 hover:text-blue-600 text-2xl bg-white py-5">
            Add New Banner
        </h1>
        <form action="{{route("banners.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{--title--}}
            <div class="py-5 mx-auto text-center w-1/2 flex flex-col">
                <label for="title"
                       class="font-bold text-xl text-gray-700 self-start items-start">Title</label>
                <input class="border border-gray-200 rounded-lg hover:bg-yellow-100 w-full"
                       value="{{old('title')}}"
                       type="text" name="title" id="title" placeholder="write here...">
                @error('title') <p class="text-md font-bold text-red-600 ">{{$message}}</p> @enderror
            </div>
            {{--image--}}
            <div class="justify-center items-center mx-auto w-1/2 flex flex-col">
                <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64
                        bg-green-300 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer
                        hover:bg-green-400 ">
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                             stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mb-2 text-sm text-white"><span
                                class="font-semibold">Click to upload</span>
                            or drag and drop</p>
                        <p class="text-xs text-white ">SVG, PNG, JPG or GIF (MAX. 3072KB)
                        </p>
                        @error('image')
                        <p class="mb-2 text-md font-bold text-red-600">{{$message}}</p> @enderror
                    </div>
                    <input id="dropzone-file" value="{{old('image')}}"
                           type="file" name="image" class="hidden" accept="image/*">
                </label>
            </div>
            <div class="justify-center items-center mx-auto text-center my-5">
                <button type="submit"
                        class="font-bold text-2xl text-green-700 text-center
                        hover:text-blue-600 px-10 py-5
                        bg-white mx-auto border-2 border-green-500
                        hover:border-blue-300">
                    Add
                </button>
            </div>
        </form>
    </div>
</x-admin-app-layout>
