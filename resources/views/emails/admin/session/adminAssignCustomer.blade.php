@component('mail::message')
# Dear {{ $customerData['name'] }},

# This email is to inform you that you are assigned to trainer for training. Trainer name is {{ $customerData['trainer'] }}..

Start Date: {{ $customerData['start_date'] }}
Start Time: {{ $customerData['start_time'] }}

@component('mail::button', ['url' => $customerData['start_url']])
    Click Here to start the meeting
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
