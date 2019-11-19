@component('mail::message')
# New Donation

{{$donation->donator}} has donated ${{$donation->ammount}}.  Here is the contact information:

{{$donation->donator}}
{{$donation->email}}
{{$donation->phone}}
{{$donation->address}}
{{$donation->address2 ? $donation->address2 : ''}}
{{$donation->city}} {{$donation->state}}, {{$donation->zip}}
@endcomponent