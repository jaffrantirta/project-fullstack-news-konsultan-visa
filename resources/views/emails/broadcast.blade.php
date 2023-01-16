@component('mail::message')

<h1>New Applicant</h1>
<p>Name: {{$data['name']}}</p>
<p>Email: {{$data['email']}}</p>
<p>Phone: {{$data['phone']}}</p>
<p>Country: {{$data['country']}}</p>
<p>Service: {{$data['service']}}</p>
<p>Position: {{$data['position']}}</p>

@component('mail::button', ['url' => $data['cv']])
Show CV
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
