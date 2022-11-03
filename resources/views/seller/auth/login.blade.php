<x-seller-guest-layout>
    <div>

        {{-- Admin Login|Register|Dashboard --}}
        @if (Route::has('admin.login'))
            <div class="hidden float-left top-0 right-0 px-6 py-4 sm:block">
                @auth("admin")
                    <a href="{{ url('/admin/dashboard') }}"
                       class="">
                        <button class="hover:bg-red-500 px-5 py-3 rounded-lg bg-green-500 text-white ">Dashboard
                        </button>
                    </a>
                @else
                    <div class="flex flex-col items-center justify-center">

                        <span class="font-semibold text-xl">Admin</span>
                        <div class="flex">
                            <a href="{{ route('admin.login') }}">
                                <button class="hover:bg-red-500 px-5 py-3 rounded-l-lg bg-green-500 text-white ">Log in
                                </button>
                            </a>

                            <a href="{{ route('admin.register') }}">
                                <button class="hover:bg-red-500 px-5 py-3 rounded-r-lg bg-green-500 text-white ">
                                    Register
                                </button>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
    <x-auth-card>


        <x-slot name="logo">
            <a href="/">
                <x-snappfood-logo class="w-20 h-20 rounded-full"/>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <form method="POST" action="{{ route('seller.login') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')"/>

                <x-text-input id="email" class="block mt-1 w-full" type="email"
                              name="email" :value="old('email')"
                              required autofocus/>

                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center justify-center mt-4">
                <div class="self-start">
                    <div>
                        @if (Route::has('seller.password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="{{ route('seller.password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div>
                        @if (Route::has('seller.register'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="{{ route('seller.register') }}">
                                {{ __('Dont have an account?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div>
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-seller-guest-layout>
