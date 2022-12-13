<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("banners.index")}}">{{ __('Banners') }}</a>
        </span>
            <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("banners.create")}}">{{ __('Add-Banner') }}</a>
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

    <div class="my-10 border-2 border-red-200 mx-auto w-8/12 mb-10">
        <div class="slideshow-container">
            @php $count=0 @endphp
            @forelse($banners as $banner)
                <div class="mySlides fade">
                    <div class="numbertext">{{++$count}} / {{count($banners)}}</div>
                    <a href="{{route("banners.show",$banner->id)}}">
                        <img src="{{asset("storage/".$banner->image)}}"
                             style="width:100%"
                             title="{{$banner->title}}">
                    </a>
                    <a href="{{route("banners.edit",$banner->id)}}">
                        <div class="text">{{$banner->title}}</div>
                        <button class="font-bold text-xl text-white bg-blue-600 hover:bg-blue-500 px-4
                        py-4 ">Edit
                        </button>
                    </a>
                </div>
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            @empty

            @endforelse
        </div>
        <br>
        <div style="text-align:center">
            @php $count=0 @endphp
            @forelse($banners as $banner)
                <span class="dot" onclick="currentSlide({{++$count}})"></span>
            @empty
            @endforelse
        </div>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

    </script>
</x-admin-app-layout>
