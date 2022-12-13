<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                    <a class="block relative h-48 rounded overflow-hidden">
                        <img {{$attribute->merge(["class"="object-cover object-center w-full h-full block"])}}
                             src="{{$src}}">
                    </a>
                    <div class="mt-4">
                        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                        <h2 class="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                        <p class="mt-1">$16.00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
