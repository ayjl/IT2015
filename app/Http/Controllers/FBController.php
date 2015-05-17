<?php namespace App\Http\Controllers;

use App\fb_events;
use App\fb_rsvp;
use App\fb_user;

class FBController extends Controller {

    /**
     * 
     *
     * @return Response
     */
    public function eventslist()
    {
        $events = fb_events::orderBy('starttime', 'DESC')->get();

        return view('fbgraphapi.eventslist',
            [
                'events' => $events
            ]
        );
    }
	
	public function eventsretrieve()
    {
        $events = fb_events::all();

        return view('fbgraphapi.eventsretrieve',
            [
                'events' => $events
            ]
        );
    }

	public function rsvplist()
    {
        $rsvp = fb_rsvp::all();

        return view('fbgraphapi.rsvplist');
    }

	public function rsvpretrieve()
    {
        $rsvp = fb_rsvp::all();

        return view('fbgraphapi.rsvpretrieve',
            [
                'rsvp' => $rsvp
            ]
        );
    }
	
	
	
	public function userretrieve($id)
    {
        $user = fb_user::where('fb_userid', '=', $id)->first(); // in development...

            if(is_null($user)){
                $user = new fb_user;
            }

            $access_token = "CAAUjFORvNWoBAEZCE1lTZCjnbQIjCkm5GZBlrGfZCb3ZBdoxHmi9q17GWXfrMYCtAo7Cf2Bpdi8aDkD9rQBZAZAiCwemUfJPavImfQMZAkg8cHarjxVHETk6ISR7bhB7roLWTsRPDU46jP4hdkgWY55yS2YBHOqxsX43P6TETVMSZACtZCM7W4T1uQcpPmnrqZAQdYVZAOQGpAm6ZBwZDZD";
			$graph_url = "https://graph.facebook.com/$id?&access_token=" . $access_token;
			$requests = file_get_contents($graph_url);
			$fb_response = json_decode($requests,true);

            $user->first_name    = $fb_response['first_name'];
            $user->last_name     = $fb_response['last_name'];
			$user->fb_userid     = $fb_response['id'];

            $user->save();   

        return "$id done";
    }
	
	
	public function profile($id)
    {
        $profile = fb_events::find($id);

        if(!isset($profile)){
            return Redirect::route('???');
        }

        return view('fbgraphapi.profile',
            [
                'profile' => $profile
            ]
        );
    }
	
   
}
