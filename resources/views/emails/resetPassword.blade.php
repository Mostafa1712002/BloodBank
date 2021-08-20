@component('mail::message')
# Introduction
<p>Hello our dear  client {{ $client->name }}</p>
<p>your pin Code is <h1>{{ $client->pin_code }}</h1></p>

@component('mail::button', ['url' => ''], "color: success")
verfiy
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
