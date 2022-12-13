<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("admin.comments.index")}}">{{ __('Comments') }}</a>
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

    <div class=" m-5 mx-auto">
        <div class="mx-10 my-5 p-5 shadow-2xl">
            <table class="text-center mx-auto border-2 border-gray-700">
                <thead class="bg-gray-700 text-white font-bold">
                <tr>
                    <th class="p-3 border-white border-r-2 ">No.</th>
                    <th class="p-3 border-white border-r-2 ">Restaurant</th>
                    <th class="p-3 border-white border-r-2 ">Seller</th>
                    <th class="p-3 border-white border-r-2 ">Message</th>
                    <th class="p-3 border-white border-r-2 ">Date</th>
                    <th class="p-3 border-white border-r-2 ">Status</th>
                    <th class="p-3 ">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white ">
                @php
                    $row=0;
                @endphp
                @forelse($comments as $comment)
                    <tr class="border-gray-700 border-b-2 hover:bg-gray-50 ">
                        <td class="border-r-2 border-gray-700 px-5 py-3 font-semibold">{{++$row}}</td>
                        <td class="border-r-2 border-gray-700 px-5 py-3
                        font-semibold">{{$comment->order->restaurant->title}}</td>
                        <td class="border-r-2 border-gray-700 px-5 py-3
                        font-semibold">{{$comment->order->restaurant->seller->name}}</td>
                        <td class="border-r-2 border-gray-700 px-5 py-3 font-semibold">{{$comment->message}}</td>
                        <td class="border-r-2 border-gray-700 px-5 py-3 font-semibold">{{$comment->created_at}}</td>
                        <td class="border-r-2 border-gray-700 px-5 py-3 font-semibold">{{$comment->is_confirmed}}</td>
                        <td class="flex gap-3 hover:cursor-pointer">
                            <form
                                action="{{route("admin.comments.confirm.delete",
                                parameters:["comment"=>$comment->id])}}"
                                method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="bg-red-700 text-white px-2 py-4 h-full w-full font-bold
                                hover:bg-red-800
                                hover:text-red-50"
                                        type="submit">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-3" colspan="7">
                            <span class="text-xl text-red-600 font-semibold">☺ YOU HAVE NO REQUEST YET! ☺</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$comments->links()}}
        </div>
    </div>

</x-admin-app-layout>
