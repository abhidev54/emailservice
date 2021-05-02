@component('mail::message')
{{ $data['content']}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent