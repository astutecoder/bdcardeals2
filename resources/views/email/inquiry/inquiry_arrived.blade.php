@component('mail::message')
# Received New Enquiry

From: **{{ $name }}**

Email: {{ $email }}

Phone: {{ $phone }}

Subject: {{ $subject }}

@if($inq_for)
Inquired Car: {{ $inq_for }}
@endif
@if($inq_for_source)
Source Code: {{ $inq_for_source }}
@endif



Message:
@component('mail::panel')
{{ $msg }}
@endcomponent

Regards,<br>
BD Car Deals EmailBot
@endcomponent
