<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("seller.comments.index")}}">{{ __('Back To Comments') }}</a>
        </span>
        </div>
    </x-slot>
    <div class="mx-auto text-center bg-white p-10 w-1/2 mt-10">
        <form action="{{route("seller.comments.sending.reply",parameters: ["comment"=>$comment->id])}}"
              method="POST">
            @csrf
            @method("PATCH")
            <div class="flex flex-col gap-8 ">
                <div class="flex flex-col gap-2 ">
                    <label class="text-lg font-bold self-start"
                           for="message">Customer's Message</label>
                    <textarea name="message"
                              class="border-2 p-5 rounded-xl hover:bg-cyan-50 border-cyan-600"
                              id="message"
                              readonly>{{$comment->message}}
                    </textarea>
                </div>
                <div class="flex flex-col gap-2 ">
                    <label class="text-lg font-bold self-start"
                           for="answer">Your Answer</label>
                    <textarea name="answer"
                              id="answer"
                              class="border-2 p-5 rounded-xl hover:bg-cyan-50 border-cyan-600">{{$comment->answer}}{{old
                              ("answer")}}
                    </textarea>
                    @error("answer") <span class="font-semibold text-red-600">{{$message}}</span>@enderror
                </div>
                <div class="text-center ">
                    <button type="submit"
                            class="w-full bg-cyan-600 text-white px-10 py-4  font-bold rounded-lg
        hover:bg-cyan-500 border-2 border-cyan-500">
                        Reply
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-seller-app-layout>
