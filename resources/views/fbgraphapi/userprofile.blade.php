@extends('app')

@section('content')
<div class="container">
   <h1>
   RSVP Status for {{$profile_dtls->first_name}} {{$profile_dtls->last_name}} ({{$fb_userid}})
   </h1>
   <br />
   
   <table width=80%><tr><td>Facebook Event ID</td><td>Event Name</td><td>Facebook User ID</td><td>RSVP Status</td><td>Facebook Name</td></tr>
      @foreach($profile_rsvp as $event)
         <tr>
            <td width=20%>{{$event->fb_eventid}}</td>
            <td>{{$events->where("fb_eventid", "$event->fb_eventid")->first()->eventname}}</td>
            <td width=20%>{{$event->fb_userid}}</td>
            <td width=10%>{{$event->rsvp_status}}</td>
            <td width=20%>{{$event->fb_name}}</td>
         </tr>
      @endforeach
   </table>
   <br /><a href=" {{URL::route('fb_events')}} ">Return</a>
</div>

@endsection
