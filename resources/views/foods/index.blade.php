<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/seller/foods")}}">{{ __('Menu') }}</a>
        </span>
            <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/seller/foods/create")}}">{{ __('Add-Food') }}</a>
        </span>
        </div>
    </x-slot>

    <section class="p-10 mx-auto">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @endif

        <div class=" m-5 shadow-lg">

            <div class="mx-10 my-5 p-16 flex flex-col justify-center">
                <table class="text-center ">
                    <thead class="bg-cyan-900 text-white">
                    <tr>
                        <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">No.</td>
                        <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Title</td>
                        <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Raw Material</td>
                        <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Price</td>
                        <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Discount</td>
                        <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Discounted Price</td>
                        <td class="px-5 py-3 font-bold text-lg " colspan="3">Action</td>
                    </tr>

                    </thead>
                    <tbody class="bg-white ">
                    @php
                        $row=0;
                    @endphp
                    @forelse($foods as $food)
                        <tr>
                            <td class="border-r-2 border-cyan-900 px-5 py-3 font-semibold">{{++$row}}</td>
                            <td class="border-r-2 border-cyan-900 px-5 py-3 font-semibold">{{$food->title}}</td>
                            <td class="border-r-2 border-cyan-900 px-5 py-3 font-semibold">{{$food->raw_material}}</td>
                            <td class="border-r-2 border-cyan-900 px-5 py-3 font-semibold">{{$food->price}}</td>
                            <td class="border-r-2 border-cyan-900 px-5 py-3
                            font-semibold">{{($food->discount->percent)??0}}%</td>
                            <td class="border-r-2 border-cyan-900 px-5 py-3
                            font-semibold">{{($food->price)*(($food->discount->factor)??1)}}</td>
                            <td class="px-5 py-3 font-semibold bg-green-600 text-white
                            cursor-pointer hover:bg-green-500 ">
                                <a href="{{url("/seller/foods/{$food->id}")}}">
                                    Show
                                </a>
                            </td>
                            <td class="px-5 py-3 font-semibold bg-cyan-600 text-white
                            cursor-pointer hover:bg-cyan-500 ">
                                <a href="{{url("/seller/foods/{$food->id}/edit")}}">
                                    Edit
                                </a>
                            </td>
                            <td class="bg-red-600 text-white px-5 py-3 hover:bg-red-500 cursor-pointer font-semibold">
                                <form action="{{url("/seller/foods/{$food->id}")}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-3" colspan="7">
                                <span class="text-xl text-red-600 font-semibold">☺ THE FOOD MENU IS EMPTY! ☺</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
{{$foods->links()}}
                </div>
            </div>
        </div>
    </section>
</x-seller-app-layout>
