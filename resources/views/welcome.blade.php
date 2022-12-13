<x-guest-layout>
    <div class="flex justify-between">
        <div>
            @if (Route::has('login'))
                <div class="hidden  top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="">
                            <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-green-500 text-white ">Dashboard
                            </button>
                        </a>
                    @else
                        <div class="flex ">
                            <a href="{{ route('login') }}">
                                <button class="hover:bg-red-500 px-5 py-3 rounded-l-lg bg-green-500 text-white ">Log in
                                </button>
                            </a>

                            <a href="{{ route('register') }}">
                                <button class="hover:bg-red-500 px-5 py-3 rounded-r-lg bg-green-500 text-white ">
                                    Register
                                </button>
                            </a>
                        </div>
                    @endauth
                </div>
            @endif
        </div>
        <div>
            {{-- Seller Login|Register|Dashboard --}}
            @if (Route::has('seller.login'))
                <div class="hidden text-center top-0 right-0 px-6 py-4 sm:block">
                    @auth('seller')
                        <a href="{{ url('/seller/dashboard') }}"
                           class="">
                            <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-green-500 text-white ">Dashboard
                            </button>
                        </a>
                    @else
                        <div class="flex flex-col items-center justify-center">

                            <div class="flex">
                                <a href="{{ route('seller.login') }}">
                                    <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-blue-500 text-white ">
                                        Sellers
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            @endif
        </div>
    </div>
    <div class="">
        <div class="justify-center items-center flex m-10">
            <img src="{{asset("/img/background.png")}}" alt="">
        </div>
    </div>
</x-guest-layout>
