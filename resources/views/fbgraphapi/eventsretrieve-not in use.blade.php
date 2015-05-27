@extends('app')

@section('content')



<?php 
use App\fb_events;
# variables
   $access_token = "CAAUjFORvNWoBAEZCE1lTZCjnbQIjCkm5GZBlrGfZCb3ZBdoxHmi9q17GWXfrMYCtAo7Cf2Bpdi8aDkD9rQBZAZAiCwemUfJPavImfQMZAkg8cHarjxVHETk6ISR7bhB7roLWTsRPDU46jP4hdkgWY55yS2YBHOqxsX43P6TETVMSZACtZCM7W4T1uQcpPmnrqZAQdYVZAOQGpAm6ZBwZDZD"; #should be permanent

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
   
   //$total += count($data);
?>

   @foreach($data as $event)
      {{$event['id']}}
      <?php
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
      
      echo str_repeat(' ', 2480);

        try { while( @ob_end_flush() ); } catch( Exception $e ) {}
      
      ?>
   @endforeach
   
<?php
   
}
 echo "$count new event(s).<br /><a href=\"" . URL::route('fb_events') . "\">Return</a>"; exit();
?>

@endsection