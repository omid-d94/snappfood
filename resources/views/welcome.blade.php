<x-guest-layout>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="">
                    <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-green-500 text-white ">Dashboard</button>
                </a>
            @else
                <div class="flex ">
                    <a href="{{ route('login') }}">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-l-lg bg-green-500 text-white ">Log in</button>
                    </a>

                    <a href="{{ route('register') }}">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-r-lg bg-green-500 text-white ">Register
                        </button>
                    </a>
                </div>
            @endauth
        </div>
    @endif

    {{-- Admin Login|Register|Dashboard --}}
    @if (Route::has('admin.login'))
        <div class="hidden float-left top-0 right-0 px-6 py-4 sm:block">
            @auth('admin')
                <a href="{{ url('/admin/dashboard') }}"
                   class="">
                    <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-green-500 text-white ">Dashboard</button>
                </a>
            @else
                <div class="flex ">
                    <p>Admin</p>
                    <a href="{{ route('admin.login') }}">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-l-lg bg-green-500 text-white ">Log in</button>
                    </a>

                    <a href="{{ route('admin.register') }}">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-r-lg bg-green-500 text-white ">Register
                        </button>
                    </a>
                </div>
            @endauth
        </div>
    @endif

    {{-- Seller Login|Register|Dashboard --}}
    @if (Route::has('seller.login'))
        <div class="hidden text-center top-0 right-0 px-6 py-4 sm:block">
            @auth('seller')
                <a href="{{ url('/seller/dashboard') }}"
                   class="">
                    <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-green-500 text-white ">Dashboard</button>
                </a>
            @else
                <div class="flex ">
                    <p>Seller</p>
                    <a href="{{ route('seller.login') }}">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-l-lg bg-green-500 text-white ">
                            Log in
                        </button>
                    </a>

                    <a href="{{ route('seller.register') }}">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-r-lg bg-green-500 text-white">
                            Register
                        </button>
                    </a>
                </div>
            @endauth
        </div>
    @endif

    <div class="container">
        <div class="justify-center items-center flex m-10">
            <img src="{{asset("/img/background.png")}}" alt="">
        </div>
    </div>
</x-guest-layout>
