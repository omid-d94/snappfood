@php
    use Illuminate\Support\Js;
@endphp
<x-seller-app-layout>
    <x-slot name="header">
        <div class="flex gap-8">
        <span class="font-semibold text-xl text-gray-800 leading-tight hover:text-green-700">
            <a href="{{route("seller.reports.index")}}">{{ __('Reports') }}</a>
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
    <div class=" m-5 mx-auto p-10 shadow-2xl">
        <div class="mx-10 my-5 p-5 flex gap-10 justify-between">
            <div>
                <ul>
                    <li>
                        <span class="font-semibold text-lg text-gray-700">Total Orders: </span>
                        <span class="font-bold text-xl">{{$count}} Numbers</span>
                    </li>
                    <li>
                        <span class="font-semibold text-lg text-gray-700">Total Income: </span>
                        <span class="font-bold text-xl">{{$totalIncome}}T</span>
                    </li>
                </ul>
            </div>
            <div>
                <form action="{{route("seller.reports.filter.between")}}" method="POST">
                    @csrf
                    <label class="font-bold text-lg" for="from">From: </label>
                    <input type="date" name="from" id="from"
                           min="{{now()->startOfYear()}}" value="{{old("from")}}"
                           max="{{now()}}">
                    @error("from")<span class="font-bold text-red-600">{{$message}}</span> @enderror
                    <label class="font-bold text-lg" for="to">To: </label>
                    <input type="date" name="to" id="to"
                           min="{{now()->startOfYear()}}" max="{{now()}}"
                           value="{{old("to")}}">
                    @error("to")<span class="font-bold text-red-600">{{$message}}</span> @enderror
                    <button class="bg-yellow-500 text-white font-bold py-3 px-3 " type="submit">Filter</button>
                </form>
            </div>
            <div class="flex flex-col gap-3">

                <div>
                    <a href="{{route("seller.reports.export.excel")}}">
                        <button class="font-bold text-xl text-white bg-green-500 hover:bg-green-600 hover:cursor-pointer
                rounded-xl px-10 py-3">
                            Excel
                        </button>
                    </a>
                </div>
                <div>
                    <a href="{{route("seller.reports.export.csv")}}">
                        <button class="font-bold text-xl text-white bg-cyan-500 hover:bg-cyan-600 hover:cursor-pointer
                rounded-xl px-10 py-3">
                            CSV
                        </button>
                    </a>
                </div>
                <div>
                    <a href="{{route("seller.reports.export.pdf")}}">
                        <button class="font-bold text-xl text-white bg-purple-500 hover:bg-purple-600
                        hover:cursor-pointer
                rounded-xl px-10 py-3">
                            PDF
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-2/3 mx-auto">
            <canvas id="income_chart" class="bg-white"></canvas>
        </div>
    </div>

    {{-- Chart Script --}}
    <script type="text/javascript">

        var countLabel = {{ Js::from($countLabel) }};
        var countDate = {{ Js::from($countData) }};
        const data = {
            labels: countLabel,
            datasets: [{
                label: 'Order Count',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: countDate,
            }],
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('income_chart'),
            config,
        );

    </script>
</x-seller-app-layout>
