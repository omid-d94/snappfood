<x-admin-app-layout>
    <div class="m-6 mx-auto shadow-lg p-5 container">
        <h1 class="text-center font-bold text-3xl text-green-600 ">Create New Category For Foods </h1>
        <form method="POST" action="{{url("/admin/food-categories")}}" enctype="multipart/form-data">
            @csrf
            <div class="bg-gray-200 my-5 rounded-lg border mx-auto w-2/5">
                <div class="p-5">
                    <label class="font-semibold " for="title">Category Title:</label>
                    <input class="border border-gray-200 rounded-lg hover:bg-green-100"
                           value="{{old('title')}}"
                           type="text" name="title" id="title" placeholder="write here...">
                    @error('title') <p class="text-md font-bold text-red-600 ">{{$message}}</p> @enderror
                </div>

                <div class="p-5">
                    <label class="font-semibold" for="image">Category Image:</label>

                    <div class="flex justify-center items-center w-full">
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
                                <p class="text-xs text-white ">SVG, PNG, JPG or GIF (MAX. 2048KB)
                                </p>
                                @error('image')
                                <p class="mb-2 text-md font-bold text-red-600  ">{{$message}}</p> @enderror
                            </div>
                            <input id="dropzone-file" value="{{old('image')}}"
                                   type="file" name="image" class="hidden" accept="image/*">
                        </label>
                    </div>

                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                        class="hover:bg-green-500 px-16 font-bold text-xl py-3 bg-green-600 text-white
                rounded-2xl">Save
                </button>
            </div>
        </form>
    </div>
</x-admin-app-layout>
