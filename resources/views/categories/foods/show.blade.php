<x-admin-app-layout>
    <div class="container m-5 flex gap-12">
        <div class="flex flex-col gap-4">
            <div>
                <p class="h-full w-full cursor-pointer hover:text-green-700  text-4xl text-red-900 font-bold
                            p-4">{{$category->title}}</p>
            </div>
            <div class="">
                <form action="{{url("/admin/foodCategories/{$category->id}")}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"
                            class="hover:bg-red-500 px-8 font-bold w-full text-lg py-3 bg-red-600 text-white
                rounded-2xl">Delete
                    </button>
                </form>
            </div>
            <div>
                <a href="{{url("/admin/foodCategories/{$category->id}/edit")}}">
                    <button type="submit"
                            class="hover:bg-cyan-500 px-10 w-full font-bold text-lg py-3
                            bg-cyan-600 text-white rounded-2xl">
                        Edit
                    </button>
                </a>
            </div>
        </div>
        <div class=" lg:w-1/3 md:w-1/2 w-full">
            <img class="h-full w-full hover:border-green-500 border-2 rounded-xl border-red-500
                            rounded-full cursor-pointer"
                 src="{{asset("storage/".$category->image_path)}}"
                 alt="{{$category->title}}">
        </div>
    </div>
</x-admin-app-layout>
