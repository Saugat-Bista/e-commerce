@component('mail::message')
# Introduction

Welcome {{$user['name']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
