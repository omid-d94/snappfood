<x-seller-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container shadow-lg px-10 py-5">
                        <h1 class="font-bold text-xl ">Restaurant Form</h1>
                        <p class="font-bold text-red-600 text-lg py-3">↓Please before do any thing fill this form↓</p>
                        <form action="{{url("/seller/restaurants")}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <!-- Title -->
                                <div class="py-3">
                                    <label class="font-semibold text-gray-700 px-3" for="title">Title</label>
                                    <input class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                                           type="text" name="title" id="title" required autofocus>
                                </div>
                                <!-- Phone -->
                                <div class="py-3">
                                    <label class="font-semibold text-gray-700 px-3" for="title">Phone</label>
                                    <input class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                                           type="text" name="phone" id="phone" required>
                                </div>
                                <!-- Logo -->
                                <div class="py-3">
                                    <label class="font-semibold text-gray-700 px-3" for="image">Restaurant Logo</label>
                                    <input class="cursor-pointer rounded-lg hover:bg-blue-100 font-semibold "
                                           type="file" name="image" id="image" required>
                                </div>
                                <!-- Bank Account Number -->
                                <div class="py-3">
                                    <label class="font-semibold text-gray-700 px-3" for="title">Bank Account
                                        Number</label>
                                    <input class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                                           type="text" name="account" id="account" required>
                                </div>

                                <!-- Address -->
                                <div class="py-3">
                                    <label class="font-semibold text-gray-700 px-3" for="title">Address</label>
                                    <textarea
                                        class="border-2 border-red-200 rounded-lg hover:bg-blue-100 font-semibold "
                                        name="address" id="address" required>
                                </textarea>
                                </div>
                                <div>
                                    <button type="submit" class="font-bold text-lg px-14 py-3 bg-blue-600 text-white
                                    rounded-xl">Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-seller-app-layout>
