<x-mail::message>
# Hi, {{$user["name"]}}

You have received your order.
Thanks for your shopping.
Hoping to see you again ☺

<x-mail::button :url="'http://127.0.0.1:8888/'">
Back to {{ config('app.name') }}
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
