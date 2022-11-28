<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("seller.comments.index")}}">{{ __('Comments') }}</a>
        </span>
        </div>
    </x-slot>
    <section class="p-10 mx-auto">
        @if(session('success'))
            <div class=" mx-auto bg-green-100 border-2 text-center w-1/3 border-green-200 rounded-2xl p-5 m-2">
                <span class="text-green-900 ">{{ session('success') }}</span>
            </div>
        @elseif(session('fail')))
        <div class=" mx-auto bg-red-100 border-2 text-center w-1/3 border-red-200 rounded-2xl p-5 m-2">
            <span class="text-red-900 ">{{ session('fail') }}</span>
        </div>
        @endif
    </section>
    <div class=" m-5 mx-auto">
        <div class="mx-10 my-5 p-5 shadow-2xl">
            <table class="text-center mx-auto border-2 border-red-900">
                <thead class="bg-red-900 text-white font-bold">
                <tr>
                    <th class="p-3 border-white border-r-2 ">No.</th>
                    <th class="p-3 border-white border-r-2 ">Message</th>
                    <th class="p-3 border-white border-r-2 ">Answer</th>
                    <th class="p-3 border-white border-r-2 ">Order No.</th>
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
                    <tr class="border-red-900 border-b-2 hover:bg-red-50 ">
                        <td class="border-r-2 border-red-900 px-5 py-3 font-semibold">{{++$row}}</td>
                        <td class="border-r-2 border-red-900 px-5 py-3 font-semibold">{{$comment->message}}</td>
                        <td class="border-r-2 border-red-900 px-5 py-3 font-semibold">{{$comment->answer??"_"}}</td>
                        <td class="border-r-2 border-red-900 font-semibold">
                            <a class=""
                               href="{{route("seller.orders.show",["order"=>$comment->order_id])}}">
                                <button class="w-full h-full px-10 py-5 bg-green-400 text-white
                                        hover:cursor-pointer hover:bg-green-500">
                                    {{$comment->order_id}}
                                </button>
                            </a>
                        </td>
                        <td class="border-r-2 border-red-900 px-5 py-3 font-semibold">{{$comment->created_at}}</td>
                        <td class="border-r-2 border-red-900 px-5 py-3 font-semibold">{{$comment->is_confirmed}}</td>
                        <td class="flex gap-3 hover:cursor-pointer">
                            <form
                                action="{{route("seller.comments.confirm", parameters:["comment"=>$comment->id])}}"
                                method="POST">
                                @csrf
                                @method("PATCH")
                                <button class="bg-green-900 text-white px-2 py-4 h-full w-full font-bold
                                hover:bg-green-700
                                hover:text-green-50"
                                        type="submit">Confirm
                                </button>
                            </form>
                            <form
                                action="{{route("seller.comments.reject", parameters:["comment"=>$comment->id])}}"
                                method="POST">
                                @csrf
                                @method("PUT")
                                <button class="bg-purple-900 text-white px-2 py-4 h-full w-full font-bold hover:bg-purple-700
                                hover:text-purple-50"
                                        type="submit">Reject
                                </button>
                            </form>
                            <form
                                action="{{route("seller.comments.delete.request",
                                parameters:["comment"=>$comment->id])}}"
                                method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="bg-yellow-900 text-white px-2 py-4 h-full w-full font-bold
                                hover:bg-yellow-700
                                hover:text-yellow-50"
                                        type="submit">Delete
                                </button>
                            </form>
                            <a class="bg-blue-900 text-white px-2 py-4 h-full w-full font-bold hover:bg-blue-700
                            hover:text-blue-50"
                               href="{{route("seller.comments.reply",["comment"=>$comment->id])}}">
                                Replying To...
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-3" colspan="7">
                            <span class="text-xl text-red-600 font-semibold">☺ YOU HAVE NO COMMENT YET! ☺</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$comments->links()}}
        </div>
    </div>
</x-seller-app-layout>
