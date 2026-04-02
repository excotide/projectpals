@component('mail::message')
# Pesan Baru dari ProjectPals

**Nama:** {{ $name }}  
**Email:** {{ $email }}

**Pesan:**  
{{ $message }}

@component('mail::button', ['url' => 'mailto:' . $email])
Balas Email
@endcomponent

Terima kasih,  
{{ config('app.name') }}
@endcomponent