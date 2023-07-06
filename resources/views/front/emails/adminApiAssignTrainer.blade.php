@component('mail::message')
# Dear {{ $trainerData['name'] }},

#This email is to inform you that you are assigned to customers for training session.

Start Date: {{ $trainerData['start_date'] }}
Start Time: {{ $trainerData['start_time'] }}

@component('mail::button', ['url' => $trainerData['start_url']])
    Click Here to start the meeting
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
