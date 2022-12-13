<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("food-party-management.index")}}">{{ __('Food-Parties') }}</a>
        </span>
            <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("food-party-management.create")}}">{{ __('Make-Food-Party') }}</a>
        </span>
        </div>
    </x-slot>
    <section class="container">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('fail'))
            <div class=" mx-auto bg-red-100 border-2 text-center w-1/3 border-red-200 rounded-2xl p-5 m-2">
                <span class="text-red-900 ">{{ session('fail') }}</span>
            </div>
        @endif
    </section>

    <div class=" m-5 mx-auto">
        <div class="mx-10 my-5 p-5 shadow-2xl">
            <table class="text-center mx-auto border-2 border-yellow-700">
                <thead class="bg-yellow-700 text-white font-bold">
                <tr>
                    <th class="p-3 border-white border-r-2 ">No.</th>
                    <th class="p-3 border-white border-r-2 ">Start</th>
                    <th class="p-3 border-white border-r-2 ">End</th>
                    <th class="p-3 border-white border-r-2 ">Number</th>
                    <th class="p-3 border-white border-r-2 ">Status</th>
                    <th class="p-3" colspan="2">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white ">
                @php
                    $row=0;
                @endphp
                @forelse($foodParties as $foodParty)
                    <tr class="border-yellow-700 border-b-2 hover:bg-gray-50 ">
                        <td class="border-r-2 border-yellow-700 px-5 py-3 font-semibold">{{++$row}}</td>
                        <td class="border-r-2 border-yellow-700 px-5 py-3
                        font-semibold">{{$foodParty->start}}</td>
                        <td class="border-r-2 border-yellow-700 px-5 py-3
                        font-semibold">{{$foodParty->end}}</td>
                        <td class="border-r-2 border-yellow-700 px-5 py-3
                        font-semibold">{{$foodParty->id}}</td>
                        <td class="border-r-2 border-yellow-700 px-5 py-3
                        font-semibold">{{$foodParty->deleted_at!==null?"Expired":"Active"}}</td>
                        <td class="flex items-center gap-3 hover:cursor-pointer">
                            <form
                                action="{{route("food-party-management.destroy",
                                parameters:["food_party_management"=>$foodParty->id])}}"
                                method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="bg-red-700 text-lg text-white px-2 py-4 h-full w-full font-bold
                                hover:bg-red-800
                                hover:text-red-50"
                                        type="submit">Delete
                                </button>
                            </form>
                        </td>
                        @if(is_null($foodParty->deleted_at))
                            <td>
                                <a class=""
                                   href="{{url("/admin/food-party-management/".$foodParty->id."/edit")}}">
                                    <button class="bg-green-700 text-lg text-white px-2 py-4 h-full w-full font-bold
                                hover:bg-green-800
                                hover:text-red-50">Edit
                                    </button>
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-3" colspan="7">
                            <span class="text-xl text-red-600 font-semibold">☺ YOU HAVE NO FOOD PARTY YET! ☺</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$foodParties->links()}}
        </div>
    </div>

</x-admin-app-layout>
