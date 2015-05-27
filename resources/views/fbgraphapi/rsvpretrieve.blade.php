@extends('app')

@section('content')

<style>
@charset "utf-8";
/* CSS Document */

.meter_container {
    display: block;
    position: fixed;
    top: 25%;
   left: 50%;
   transform: translate(-50%, -50%);
    width: 50%;
    height: auto;
    border: 1px solid black;
    background-color: #c0c0c0;
    border-radius: 7px;
}

.meter_container h1 {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 24px;
    text-align: center;
    margin: 0px;
    padding: 0px;
}

.meter { 
    height: 20px;  /* Can be anything */
    position: relative;
    margin: 0px 10px 10px 10px; /* Just for demo spacing */
    background: #555;
    -moz-border-radius: 25px;
    -webkit-border-radius: 25px;
    border-radius: 25px;
    padding: 10px;
    -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
    -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
    box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
}

.meter > h4 {
    text-align: center;
}

.meter > span {
    display: block;
    height: 100%;
       -webkit-border-top-right-radius: 20px;
    -webkit-border-bottom-right-radius: 20px;
           -moz-border-radius-topright: 20px;
        -moz-border-radius-bottomright: 20px;
               border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        -webkit-border-top-left-radius: 20px;
     -webkit-border-bottom-left-radius: 20px;
            -moz-border-radius-topleft: 20px;
         -moz-border-radius-bottomleft: 20px;
                border-top-left-radius: 20px;
             border-bottom-left-radius: 20px;
    background-color: #8A0013;
    background-image: -webkit-gradient(
      linear,
      left bottom,
      left top,
      color-stop(0, f0a3a3),
      color-stop(1, f42323)
    );
    background-image: -moz-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(84,240,84) 69%
     );
    -webkit-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    -moz-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    position: relative;
    overflow: hidden;
}

.meter > span:after, .animate > span > span {
    content: "";
    position: absolute;
    top: 0; left: 0; bottom: 0; right: 0;
    background-image: 
       -webkit-gradient(linear, 0 0, 100% 100%, 
          color-stop(.25, rgba(255, 255, 255, .2)), 
          color-stop(.25, transparent), color-stop(.5, transparent), 
          color-stop(.5, rgba(255, 255, 255, .2)), 
          color-stop(.75, rgba(255, 255, 255, .2)), 
          color-stop(.75, transparent), to(transparent)
       );
    background-image: 
            -moz-linear-gradient(
              -45deg, 
          rgba(255, 255, 255, .2) 25%, 
          transparent 25%, 
          transparent 50%, 
          rgba(255, 255, 255, .2) 50%, 
          rgba(255, 255, 255, .2) 75%, 
          transparent 75%, 
          transparent
       );
    z-index: 1;
    -webkit-background-size: 50px 50px;
    -moz-background-size: 50px 50px;
    -webkit-animation: move 2s linear infinite;
       -webkit-border-top-right-radius: 8px;
    -webkit-border-bottom-right-radius: 8px;
           -moz-border-radius-topright: 8px;
        -moz-border-radius-bottomright: 8px;
               border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        -webkit-border-top-left-radius: 20px;
     -webkit-border-bottom-left-radius: 20px;
            -moz-border-radius-topleft: 20px;
         -moz-border-radius-bottomleft: 20px;
                border-top-left-radius: 20px;
             border-bottom-left-radius: 20px;
    overflow: hidden;
}

.animate > span:after {
    display: none;
}

@-webkit-keyframes move {
    0% {
       background-position: 0 0;
    }
    100% {
       background-position: 50px 50px;
    }
}
</style>




<?php 

use App\fb_rsvp;
use App\fb_user;

# variables
$access_token = "CAAUjFORvNWoBAEZCE1lTZCjnbQIjCkm5GZBlrGfZCb3ZBdoxHmi9q17GWXfrMYCtAo7Cf2Bpdi8aDkD9rQBZAZAiCwemUfJPavImfQMZAkg8cHarjxVHETk6ISR7bhB7roLWTsRPDU46jP4hdkgWY55yS2YBHOqxsX43P6TETVMSZACtZCM7W4T1uQcpPmnrqZAQdYVZAOQGpAm6ZBwZDZD"; #should be permanent



$selected_fields_array = array('attending.limit(500)' , 'maybe.limit(500)' , 'declined.limit(500)' , 'noreply.limit(500)'); #data to get
$selected_fields_string = implode($selected_fields_array,",");

# obtain data from fb and turn into an array.
$graph_url = "https://graph.facebook.com/" . $event_id . "?fields=" . $selected_fields_string . "&access_token=" . $access_token;
$requests = file_get_contents($graph_url);
$fb_response = json_decode($requests,true);

$attending = $fb_response['attending']['data'];
$maybe = $fb_response['maybe']['data'];
$declined = $fb_response['declined']['data'];
$noreply = $fb_response['noreply']['data'];

$i = 0;
$total = (count($attending) + count($maybe) + count($declined) + count($noreply));
echo "Total number: " . $total . "<br>Completed: ";

$list = array();


require_once("../resources/views/fbgraphapi/progressbar/object.php");
ob_start();
ini_set('max_execution_time', 300); 
	
$po = new ProgressObj();
$po->text = "Updating database...";
$po->DisplayMeter(); 
$po->Calculate($total);
ob_end_flush();
foreach ($selected_fields_array as $status) {
?>
   @foreach(${str_replace(".limit(500)", "", $status)} as $user)
   
	  <?php
      
      $criteria = array('fb_eventid' => $event_id, 'fb_userid' => $user['id']);
      
      $row = fb_rsvp::where($criteria)->first();
      
      if (is_null($row)) {
		 echo "added ";
		 $row = new fb_rsvp;
      }
      
      $row->fb_eventid  = $event_id;
      $row->fb_userid   = $user['id'];
      $row->rsvp_status = $user['rsvp_status'];
      $row->fb_name     = $user['name'];
      $row->updated_at  = NULL; //to ensure updated_at field gets updated even if no change
      
      $row->save();
     
      
      $row = fb_user::where('fb_userid', '=', $user['id'])->first();
      
      if(is_null($row)){
		 $row = new fb_user;
      }
      $row->fb_userid = $user['id'];
      $row->save();   
           
      
      echo str_repeat(' ', 2480);
      $po->Animate();
      try { while( @ob_end_flush() ); } catch( Exception $e ) {}
      
      $i ++;
      echo "$i, ";
      
      if ($i >= $total) {
		 echo "<p>All Completed :)<br /><a href=\"" . URL::route('fb_events') . "\">Return</a>";
		 exit;
      }
      ?>
   @endforeach
   
   <?php 
}
?>

@endsection