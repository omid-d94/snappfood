<x-mail::message>
# Hi, {{$user["name"]}}

Your order has been sent
and will arrive soon.
We hope you enjoy it ☺

<x-mail::button :url="'http://127.0.0.1:8888/'">
Back to {{ config('app.name') }}
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
