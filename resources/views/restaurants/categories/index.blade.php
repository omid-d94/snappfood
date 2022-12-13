<x-admin-app-layout>
    <section class="container">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
    @endif

    <!-- Create New Category for Restaurant -->
        <div class="mx-auto text-center">
            <div class="mt-5">
                @auth('admin')
                    <a href="{{url("/admin/restaurant-categories/create")}}">
                        <button class="font-bold hover:bg-blue-500 px-5 py-3 bg-blue-600 text-white rounded-2xl">
                            Add New Category For Restaurant
                        </button>
                    </a>
                @endauth
            </div>
            <div class="px-5 py-24 mx-auto">
                <div class="justify-center flex flex-wrap p-5 m-5 gap-3">
                    @forelse($categories as $category)
                        <div class=" lg:w-1/4 md:w-1/2 flex flex-col items-center w-full">
                            <a href="{{url("/admin/restaurant-categories/{$category->id}")}}">
                                <img class="hover:border-green-500 border-2 rounded-full border-red-500
                            rounded-full cursor-pointer w-36 h-36"
                                     src="{{asset("storage/".$category->image_path)}}"
                                     alt="{{$category->name}}">

                                <h3 class="cursor-pointer hover:text-green-700 text-xl text-red-700 font-bold
                            p-4">{{$category->name}}</h3>
                            </a>
                        </div>
                    @empty
                        <div class="mx-auto ">
                            <p class="text-center font-bold text-2xl text-red-500">
                                No categories have been created yet!
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-admin-app-layout>
