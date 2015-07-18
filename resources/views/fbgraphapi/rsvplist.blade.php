@extends('app')

@section('content')

<?php 
use App\fb_rsvp;

     
#... time zone problems
   date_default_timezone_set('Australia/Sydney'); 
   $lastupdated_query = (fb_rsvp::where('fb_eventid' , '=', $event_id)->select('updated_at')->orderBy('updated_at', 'DESC')->first());
   $lastupdated = date('r', strtotime($lastupdated_query->updated_at));
#...

?>
       
<div class="container">
<h1>RSVP list for "{{$events->eventname}}" ({{$event_id}})</h1> 
(as at: {{$lastupdated}})<br /><br />
(<a href="{{URL::route('fb_rsvp_retrieve', $event_id)}}">update list</a>)<br />

<table width=98%><tr><td>id</td><td>Facebook Event ID</td><td>Forms Event ID</td><td>Facebook User ID</td><td>Facebook Name</td><td>RSVP Status</td><td>Facebook</td><td>Last Updated</td></tr>
   @foreach($rsvp as $user)
      <tr>
         <td width=5%>{{$user->id}}</td>
         <td>{{$user->fb_eventid}}</td>
         <td>{{$user->forms_eventid}}</td>
         <td><a href={{URL::route("fb_user_retrieve",$user->fb_userid)}}>{{$user->fb_userid}}</a></td>
         <td>{{$user->fb_name}}</td>
         <td><?php echo $user->rsvp_status; ?></td>
         <td></td>
         <td>{{$user->updated_at}}</td>
      </tr>
   @endforeach
</table>
<br /><a href=" {{URL::route('fb_events')}} ">Return</a>
</div>

      
@endsection
