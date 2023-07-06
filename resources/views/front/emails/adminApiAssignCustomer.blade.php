@component('mail::message')
# Dear {{ $name }},

# This email is to inform you that you are assigned to trainer for training. Trainer name is {{ $trainer }}..

Start Date: {{ $start_date }}
Start Time: {{ $start_time }}

@component('mail::button', ['url' => $start_url])
    Click Here to start the meeting
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
