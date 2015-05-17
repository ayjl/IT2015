
@extends('app')

@section('content')

<?php 
use App\fb_rsvp;

if (!isset($_REQUEST['event_id'])) {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=./fb_events\" />";
	} else {
		$event_id = $_REQUEST['event_id'];
		
		$criteria = array('fb_eventid' => $event_id);

		$rsvp = fb_rsvp::where(array('fb_eventid' => $event_id))->orderBy('fb_name', 'ASC')->get();
		
		#... time zone problems
		
		date_default_timezone_set('Australia/Sydney');
		$lastupdated_query = (fb_rsvp::where('fb_eventid' , '=', $event_id)->select('updated_at')->orderBy('updated_at', 'ASC')->first()); //time in UTC... BUT what if its not UTC...
		//if (!is_null($lastupdated_query)) {
			//var_dump ($lastupdated_query->updated_at);
			$lastupdated = date('r', strtotime($lastupdated_query->updated_at) + date('Z', strtotime($lastupdated_query->updated_at))); //... so change it back to Sydney =) 
		//} else {
			//$lastupdated = "";
		//}
?>

<div class="container">
    <h1>
        RSVP list for Event ID {{$event_id}}
    </h1>
	(as at: {{$lastupdated}})<br /><br />(<a href="fb_rsvp_retrieve?event_id={{$event_id}}">update list</a>)<br />
    <table width=80%><tr><td>id</td><td>Facebook Event ID</td><td>Forms Event ID</td><td>Facebook User ID</td><td>Facebook Name</td><td>RSVP Status</td><td>Facebook</td></tr>
        @foreach($rsvp as $user)
        	<tr>
        	<td width=5%>{{$user->id}}</td>
            <td>{{$user->fb_eventid}}</td>
            <td>{{$user->forms_eventid}}</td>
            <td>{{$user->fb_userid}}</td>
            <td>{{$user->fb_name}}</td>
            <td>{{$user->rsvp_status}}</a></td>
            <td></td>
            </tr>
        @endforeach
    </table>
</div>
<?php
}
?>
<br /><a href="fb_events">Return</a>
@endsection
