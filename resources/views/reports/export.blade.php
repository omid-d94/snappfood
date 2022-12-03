<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Customer</th>
        <th>Order</th>
        <th>Tracking Code</th>
        <th>Request Time</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @php $row=0; @endphp
    @forelse($orders as $order)
        <tr>
            <td>{{++$row}}</td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->tracking_code}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->status}}</td>
        </tr>
    @empty
        <tr>
            <td class="text-red-500" colspan="6">You don't currently have an order!</td>
        </tr>
    @endforelse
    </tbody>
</table>
