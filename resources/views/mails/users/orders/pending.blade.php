<x-mail::message>
# Hi, {{$user["name"]}}

Your order on pending,
please be patient...
Thank you for choosing us

<x-mail::button :url="'http://127.0.0.1:8888/'">
Back to {{ config('app.name') }}
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
