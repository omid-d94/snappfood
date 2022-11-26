<x-mail::message>
# Hi, {{$user["name"]}}

Your payment done successfully!
Tracking Code: {{$tracking_code}}
Total Payment: {{$total}}

<x-mail::button :url="'http://127.0.0.1:8888/'">
Back to {{ config('app.name') }}
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
