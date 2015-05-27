@extends('app')

@section('content')
   <div class="container">
      <h1>Events</h1>
      <br />(<a href="fb_events_retrieve">update list</a>)
      <br />
      <table width=80%><tr><td>id</td><td>Facebook Event ID</td><td>Forms Event ID</td><td>Event Name</td><td>Date/Time</td><td>RSVP List</td><td>Facebook</td></tr>
         @foreach($events as $event)
            <tr>
               <td width=5%>{{$event->id}}</td>
               <td>{{$event->fb_eventid}}</td>
               <td>{{$event->forms_eventid}}</td>
               <td>{{$event->eventname}}</td>
               <td>{{$event->starttime}}</td>
               <td><a href={{URL::route("fb_rsvp",$event->fb_eventid)}}>RSVP List</a></td>
               <td><a href="http://fb.com/{{$event->fb_eventid}}">Facebook</a></td>
            </tr>
         @endforeach
      </table>
   </div>
@endsection
