<?php namespace App\Http\Controllers;

use App\fb_events;
use App\fb_rsvp;
use App\fb_user;
use Redirect;

class FBController extends Controller {

   public function eventslist() {
     $events = fb_events::orderBy('starttime', 'DESC')->get();
     return view('fbgraphapi.eventslist',
       [
         'events' => $events
       ]
     );
   }
   
   public function eventsretrieve() {
     $events = fb_events::all();
     $access_token = "CAAUjFORvNWoBAEZCE1lTZCjnbQIjCkm5GZBlrGfZCb3ZBdoxHmi9q17GWXfrMYCtAo7Cf2Bpdi8aDkD9rQBZAZAiCwemUfJPavImfQMZAkg8cHarjxVHETk6ISR7bhB7roLWTsRPDU46jP4hdkgWY55yS2YBHOqxsX43P6TETVMSZACtZCM7W4T1uQcpPmnrqZAQdYVZAOQGpAm6ZBwZDZD";
     
     # obtain data from fb and turn into an array.
     
     $next = 1; $count = 0; $total = 0;
     
     
     $graph_url = "https://graph.facebook.com/asocunsw?fields=events&limit=100&access_token=" . $access_token;
       
      while ($next != 0) {
         $next = 0;
         $requests = file_get_contents($graph_url);
         $fb_response = json_decode($requests,true);
         
         if (array_key_exists("events", $fb_response)) {
            $data = $fb_response['events']['data'];
            if (array_key_exists("next", $fb_response['events']['paging'])) {
            $graph_url = $fb_response['events']['paging']['next'];
            $next = 1;
            }
         } else {
            $data = $fb_response['data'];
            if (array_key_exists("next", $fb_response['paging'])) {
            $graph_url = $fb_response['paging']['next'];
            $next = 1;
            }
         }
         
         foreach ($data as $event) {
            $row = fb_events::where('fb_eventid', '=', $event['id'])
                            ->first();
            if (is_null($row)) {
            $row = new fb_events;
            }
            
            $row->fb_eventid = $event['id'];
            $row->eventname  = $event['name'];
            $row->starttime  = $event['start_time'];
  
            $row->save();
            $count ++;
         }
      }
     return "$count new event(s).<br /><a href=\"" . route('fb_events') . "\">Return</a>"; /*view('fbgraphapi.eventsretrieve', ['events' => $events])*/
    }

   public function rsvplist($id) {
     //$rsvp = fb_rsvp::all();
     $exist = fb_events::where(array('fb_eventid' => $id))->get();
     $rsvp = fb_rsvp::where(array('fb_eventid' => $id))->orderBy('fb_name', 'ASC')->get();
     
     if ($exist->isEmpty() or !isset($id)) {
       return Redirect::route('fb_events');
     } else {
       if ($rsvp->isEmpty()) {
         return Redirect::route('fb_rsvp_retrieve',$id);
       } else {
         return view('fbgraphapi.rsvplist',
            [
              'rsvp'     => $rsvp,
              'event_id' => $id
            ]
         );
       }
     }
   }

   public function rsvpretrieve($id) {
     $exist = fb_events::where(array('fb_eventid' => $id))->get();

     if ($exist->isEmpty() or !isset($id)) {
       return Redirect::route('fb_events');
     } else {
       return view('fbgraphapi.rsvpretrieve',
         [
            'event_id' => $id
         ]
       );
     }
   }
   
   public function userretrieve($id) {
     $user = fb_user::where('fb_userid', '=', $id)->first(); // in development...

     if (is_null($user)){
       $user = new fb_user;
     }

     $access_token = "CAAUjFORvNWoBAEZCE1lTZCjnbQIjCkm5GZBlrGfZCb3ZBdoxHmi9q17GWXfrMYCtAo7Cf2Bpdi8aDkD9rQBZAZAiCwemUfJPavImfQMZAkg8cHarjxVHETk6ISR7bhB7roLWTsRPDU46jP4hdkgWY55yS2YBHOqxsX43P6TETVMSZACtZCM7W4T1uQcpPmnrqZAQdYVZAOQGpAm6ZBwZDZD";
     $graph_url = "https://graph.facebook.com/$id?&access_token=" . $access_token;
     $requests = file_get_contents($graph_url);
     $fb_response = json_decode($requests,true);
     
     if (isset($fb_response['middle_name'])) {
       $middle_name = $fb_response['middle_name'];
     } else {
       $middle_name = "";  
     }
     
     $user->first_name = $fb_response['first_name'] . " " . $middle_name;
     $user->last_name  = $fb_response['last_name'];
     $user->fb_userid  = $fb_response['id'];
     
     $user->save();   
     
     $profile_rsvp = fb_rsvp::where('fb_userid', '=', "$id")->get();
     $profile_dtls = fb_user::where('fb_userid', '=', "$id")->first();
     $events = fb_events::orderBy('starttime', 'DESC')->get();
     
     //return Redirect::route('profile',$id);
     return view('fbgraphapi.userprofile',
       [
         'profile_rsvp' => $profile_rsvp,
         'profile_dtls' => $profile_dtls,
         'events'       => $events,
         'fb_userid'    => $id
       ]
     );
    }
   
   
   public function profile($id) {     

     /*if (!isset($profile)) {
       return Redirect::route('fb_events'); 
     }*/

     //if ($profile_dtls->isEmpty()) {
       return Redirect::route('fb_user_retrieve',$id);
     //} else {
       
     //}

   }
   
   
}
