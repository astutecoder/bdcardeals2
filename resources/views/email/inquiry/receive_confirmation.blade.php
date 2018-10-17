@component('mail::message')
# Hello, {{$name}}!

@component('mail::panel')
Your Enquiry Has Been Received
@endcomponent

Thanks for your message. We will get back to you soon.

@component('mail::button', ['url' => 'https://www.bdcardeals.com', 'color'=> 'success'])
Back to site
@endcomponent

Regards,<br>
BD Car Deals
@endcomponent
