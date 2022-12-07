<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report {{now()->format("Y-m-d")}}</title>
</head>
<body>

<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Customer</th>
        <th>Order</th>
        <th>Tracking Code</th>
        <th>Request Time</th>
        <th>Status</th>
        <th>Income</th>
    </tr>
    </thead>
    <tbody>
    @php $row=0 @endphp
    @forelse($orders as $order)
        <tr>
            <td>{{++$row}}</td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->tracking_code}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->total}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">You don't currently have an order!</td>
        </tr>
    @endforelse
    </tbody>
    <tfoot>
    <tr></tr>
    <tr></tr>
    <tr>
        <td>Count:</td>
        <td>{{count($orders)}}</td>
    </tr>
    <tr>
        <td>Total Income:</td>
        <td>{{$total}}</td>
    </tr>
    <tr>
        <td>From:</td>
        <td>{{$from}}</td>
    </tr>
    <tr>
        <td>To:</td>
        <td>{{$to}}</td>
    </tr>
    </tfoot>
</table>
</body>
</html>

