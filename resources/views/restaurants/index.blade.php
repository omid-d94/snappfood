<x-app-layout>
    <div class="container">
        <table>
            <thead>
            <tr>
                <th>Logo</th>
                <th>Title</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
            @forelse($restaurants as $restaurant)
                <tr>
                    <td>{{asset($restaurant->logo)}}</td>
                    <td>{{$restaurant->title}}</td>
                    <td>{{$restaurant->restaurantCategory->name}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No restaurant found to display</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
