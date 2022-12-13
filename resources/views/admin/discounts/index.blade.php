<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/admin/discounts")}}">{{ __('Discounts') }}</a>
        </span>
            <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{url("/admin/discounts/create")}}">{{ __('Make-New-Discount') }}</a>
        </span>
        </div>
    </x-slot>

    <section class="container">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @endif
    </section>

    <div class=" m-5 shadow-lg">

        <div class="mx-10 my-5 p-16 flex flex-col justify-center">
            <table class="text-center ">
                <thead class="bg-purple-900 text-white">
                <tr>
                    <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">No.</td>
                    <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Title</td>
                    <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Expired at</td>
                    <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Percent</td>
                    <td class="px-5 py-3 font-bold text-lg border-r-2 border-white">Code</td>
                    <td class="px-5 py-3 font-bold text-lg " colspan="2">Action</td>
                </tr>

                </thead>
                <tbody class="bg-white ">
                @php
                    $row=0;
                @endphp
                @forelse($discounts as $discount)
                    <tr class="hover:bg-purple-100 cursor-pointer">
                        <td class="border-r-2 border-purple-600 px-5 py-3 font-semibold">{{++$row}}</td>
                        <td class="border-r-2 border-purple-900 px-5 py-3 font-semibold">{{$discount->title}}</td>
                        <td class="border-r-2 border-purple-900 px-5 py-3 font-semibold">{{$discount->expired_at}}</td>
                        <td class="border-r-2 border-purple-900 px-5 py-3 font-semibold">{{$discount->percent}}</td>
                        <td class="border-r-2 border-purple-900 px-5 py-3 font-semibold">{{$discount->code}}</td>
                        <td class="px-5 py-3 font-semibold bg-yellow-600 text-white
                            cursor-pointer hover:bg-yellow-500 ">
                            <a href="{{url("/admin/discounts/{$discount->id}/edit")}}">
                                Edit
                            </a>
                        </td>
                        <td class="bg-red-600 text-white px-5 py-3 hover:bg-red-500 cursor-pointer font-semibold">
                            <form action="{{url("/admin/discounts/{$discount->id}")}}" method="POST">
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
                        <td class="px-5 py-3" colspan="5">
                            <span class="text-xl text-red-600 font-semibold">☺ THERE IS NO DISCOUNT YET! ☺</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
</x-admin-app-layout>
