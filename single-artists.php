<?php
/**
* Artist page template
**/
?>
<style>
th:nth-child(4) {
    display: table-cell!important;}
    th:nth-child(5) {
    display: table-cell!important;}
  .body-border {width: 309px!important;}
  .zumic-table td:nth-child(3) {display: none!important;}
  th:nth-child(3) {display: none!important;}
  .img-tour img {margin-left: -0%!important;}
  .gmap {margin-top: auto;}
  b, strong, .strong {color: black!important;}
  .home-rating {padding-bottom: 8px;margin-right: -27px!important;color: white;padding-right: 25%;float: right!important;}
@media only screen and (min-width: 481px) {
  .home-rating {padding-bottom: 8px;margin-right: -21px;color: white;padding-top: 20px;}
  .gmap {margin-top: -50px;}
  th:nth-child(3) {display: table-cell!important;}
  .zumic-table td:nth-child(3) {display: table-cell!important;}
  .body-border2 {background-color: black!important;}
  .body-border {background: black;width: 962px!important;max-width: 1000px!important;}
  .post .kk-star-ratings.lft{display: none;}
  td.bit-rsvp {display: none;}
  .post .authorstars p {display: none;}
}

@media only screen and (min-width: 768px){
th:nth-child(4) {
    display: table-cell!important;
}

}

}
</style>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<?php get_header(); ?>
<script type="text/javascript">
$(document).ready(function(){
  if (window.location.href.match(/\#tour-dates/)){
       document.getElementById("id2").style.display = "none";
       document.getElementById("id1").style.display = "block";
  }else{
      document.getElementById("id1").style.display = "none";
      document.getElementById("id2").style.display = "block";
  }
});
</script>
<?php
   $posttags = get_the_tags();
       if ($posttags) {
         foreach($posttags as $tag) {
           //echo $tag->name . ' '; 
         }
} 
?>
<!-- $$$$$$$$$$$$||TOURTEMPLETE||$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div id="id1" style="display:none">  
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div id="content">
    <div id="inner-content" class="wrap clearfix">
<div id="main" class="first clearfix" role="main">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
    <section class="entry-content clearfix <?php echo $grid_l; ?> scrollable-col">
      <div class="body-border">
            <?php
                $tags = wp_get_post_tags( $post->ID );
                $artist_id = $tags[0]->term_id;
                $args = array(
                    'post_type' => 'artists',
                    'tag__in' => array( $artist_id ),
                    'posts_per_page' => 1,
                    //'offset' => 1,
                    );
                ?>
                <?php $the_query = new WP_Query($args); ?>
                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
              
                  <center>
                    <div class="img-tour">  
                        <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
                    </div>
                    <div class="folded3">
                        <h2 class="page-title music-videos-title entry-title" style="text-transform:uppercase;font-size:1.7em;">
                          <?php echo $tag->name . ' '; ?> Tour Dates & Tickets 
                        </h2>
                    </div>
                  </center>
              <br><br>  
       <?php endwhile; ?>
       <?php  wp_reset_postdata(); ?>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
    <?php
        function get_client_ip_env() {  
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        $geoplugin  = maybe_unserialize( wp_remote_fopen('http://www.geoplugin.net/php.gp?ip=' . get_client_ip_env()) );
        $user_lat   = $geoplugin['geoplugin_latitude'];
        $user_long  = $geoplugin['geoplugin_longitude'];
    ?>
<div class="hide">
  <h2>Concerts Near You</h2>
  <table class="zumic-table tdate"  border="1" cellpadding="3">
  <tbody>
  <th><div class="tourdate">Date</div></th>
  <th><div class="tourcv">City/Venue</div></th>
  <th><div class="ticshow"><div class="tourtic">Offical Tickets</div></div></th>
  <th style="display:table-cell!important;"><div class="ticshow"><div class="tourtic">Ticket Reseller</div></div></th>
  <th style="display:table-cell!important;"><div class="tourtic" >More Info</div></th>
  </tbody>
  </table>
</div>
      <?php
          $timecutoff = date("Y-m-d");
          $args = array(
              'post_type' => 'events',
              'orderby' => 'meta_value',
              'meta_key' => 'event_date',
              'meta_compare' => '>=',
              'meta_value' => $timecutoff,
              'showposts' => 10005,
              'order' => 'ASC',
              'tag_slug__and'   => $tag->name . ' ',
                   );
          $my_query = new WP_Query($args);
          if ($my_query->have_posts()) : while ($my_query->have_posts()) :
          $my_query->the_post();
          $eventdate = get_post_meta($post->ID, "eventdate", true);
          $event_lat  = get_field( 'gp_latitude' ); 
          $event_long = get_field( 'gp_longitude' ); 
          $earth_radius = 3960.00; # in miles
          $lat_1 = $event_lat;
          $lon_1 = $event_long;
          $lat_2 = $user_lat;
          $lon_2 = $user_long;
          $delta_lat = $lat_2 - $lat_1 ;
          $delta_lon = $lon_2 - $lon_1 ;
          $hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2); 
          $max_distance = 100;    
      ?>
    <?php if ($hav_distance <= $max_distance) { ?>
 <style type="text/css">
    .hide{display: inline-block!important;}
    </style>
   <table class="zumic-table tdate" border="1" cellpadding="3">
            <tbody>
              <tr style="display:none!important;">
              <div style="display:none!important;">
              <th style="display:none!important;"></th>
              <th style="display:none!important;"></th>
              <th style="display:none!important;"></th>
              </div>
              </tr>
              <tr>
              <td>
              <b><div class="eventtic">
                <div class="noday">
              <?php
                $dateformatstring = "l,";
                $datebreak = "M j";
                $unixtimestamp = strtotime(get_field('event_date'));
                echo date_i18n($dateformatstring, $unixtimestamp);
              ?>
                </div>
              <br />
              <?php
                echo date_i18n($datebreak, $unixtimestamp);
              ?>
              </div></b>
              </td>
              <td>
              <div class="eventtit">
                <a style="color:black;"href="<?php the_permalink() ?>">
                   <?php // THE TITLE //
                      global $post;
                        $s = $post->post_title;
                        echo substr($s, 0, strrpos($s, 'on') - 1);
                    ?>
                </a>
              </div>
              </td>
              <div class="ticshow">
                <td>
                  <div class="ticshow">
                      <div class="eventtic">
                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                          <?php
                            $axs = get_field('url_axs');                  $eventko = get_field('url_evenko');
                            $live = get_field( 'url_livenation' );        $stubhub = get_field('url_stubhub');
                            $subw = get_field('url_stubwire');            $ticfly = get_field( 'url_ticketfly' );
                            $ticmaster = get_field( 'url_ticketmaster' ); $ticweb = get_field( 'url_ticketweb' );
                            $venue = get_field('url_venue');              $eventbrite = get_field('url_eventbrite');
                            $eventtime = get_field('url_eventim_de');     $ticketek = get_field('url_ticketek');
                            $ticketone = get_field('url_ticketone');      $flavorus = get_field('url_flavorus');
                            $ticketcorner = get_field('url_ticketcorner');
                              if ( $ticmaster ) { ?>

                                        <a href="<?php the_field( 'url_ticketmaster' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/09/ticketmaster-logo.jpg">   
                                        <?php } ?>
                                        </a>

                              <?php }elseif( $live ) { ?>

                                        <a href="<?php the_field( 'url_livenation' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/live-nation-logox.jpg">  
                                        <?php } ?> 
                                        </a>
                                  
                              <?php }elseif($ticfly){ ?>

                                        <a href="<?php the_field( 'url_ticketfly' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketfly-logo-1.jpg">  
                                        <?php } ?>
                                        </a>

                              <?php }elseif($eventko) { ?> 

                                        <a href="<?php the_field( 'url_evenko' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/evenko-logo.jpg">
                                        <?php } ?>
                                        </a>
                               
                              <?php }elseif($subw) { ?>  

                                        <a href="<?php the_field( 'url_stubwire' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/stubwire-logo.jpg">
                                        <?php } ?>
                                        </a>
                                    
                              <?php }elseif($ticweb) { ?> 

                                        <a href="<?php the_field( 'url_ticketweb' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketweb-logo.jpg">
                                        <?php } ?>
                                        </a>
                                   
                                <?php }elseif($eventko) { ?>  

                                        <a href="<?php the_field( 'url_evenko' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/evenko-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($eventtime) { ?> 

                                        <a href="<?php the_field( 'url_eventim_de' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/eventim-logo.jpg">
                                        <?php } ?>
                                        </a>

                                 <?php }elseif($venue) { ?> 

                                        <a href="<?php the_field( 'url_venue' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/venue-ticketsx.jpg">
                                        <?php } ?>
                                        </a>

                              <?php }elseif($eventbrite) { ?>  

                                        <a href="<?php the_field( 'url_eventbrite' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/eventbrite-logo.jpg">
                                        <?php } ?>
                                        </a>

                              <?php }elseif($ticketek) { ?>  

                                        <a href="<?php the_field( 'url_ticketek' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/ticketek-tickets.jpg">
                                        <?php } ?>
                                        </a>
                                <?php }elseif($ticketone) { ?>  

                                        <a href="<?php the_field( 'url_ticketone' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/ticketone-it-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($flavorus) { ?>  

                                        <a href="<?php the_field( 'url_flavorus' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/flavorus-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($ticketcorner) { ?>  

                                        <a href="<?php the_field( 'url_ticketcorner' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/06/tickercorner-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($axs) { ?>


                                        <a href="<?php the_field( 'url_axs' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/axs-logo.jpg">
                                        <?php } ?>
                                        </a>
                                   
                              <?php }else{ ?>
                                  <img style="width:auto;height:30px;border:none;" src="http://zumic.com/wp-content/uploads/2015/03/ticc2.png">
                          <?php } ?>        
                          </a>
                      </div>
                    </div>
                  </td>
                </div>
                 <div class="ticshow">
                    <td style="display:inline!important;">
                    <div class="ticshow">
                      <div class="eventtic">
                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php 
                            $supstar = get_field( 'url_superstar');
                            $ticnow  = get_field('url_ticketsnow');
                            $viago   = get_field('url_viagogo');
                        if ( $supstar ) { ?>
                                        <a href="<?php the_field( 'url_superstar' ); ?>" target="_blank" >
                                            <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/superstartickets-logo.jpg">
                                        </a>
                          <?php  } elseif( $ticnow ) { ?>
                                        <a href="<?php the_field( 'url_ticketsnow' ); ?>" target="_blank" >
                                            <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketsnow-logo.jpg">
                                        </a>
                          <?php  } elseif($viago)  { ?>
                                        <a href="<?php the_field( 'url_viagogo' ); ?>" target="_blank" >
                                            <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/viagogo-logo.jpg">
                                        </a>
                          <?php }else{ ?>
                                <img style="width:auto;height:32px;border:none;" src="http://zumic.com/wp-content/uploads/2015/03/ticc2.png">
                          <?php } ?>
                          </a>
                      </div> 
                    </div>
                    </td>
                  </div>
                      <td style="display:inline!important;">
                <div class="ticshow">
                  <div class="eventtic">
                  <a style="background-color:black;" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                       <?php
                    if(has_post_thumbnail()){
                      the_post_thumbnail( 'tour-img' );
                    }
                      else{
                         echo '<img style="width:auto;height:50px;background-color:black;" src="http://zumic.com/wp-content/uploads/2015/03/zumic-logo-brushed-steel.png">';
                        }
                   ?>
                  </a>
                  </div>
                </div>
                <div class="ticnoshow">
                 <div class="eventtic">
                  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                       <?php
                    if(has_post_thumbnail()){
                      echo "<div style='color:black;'>Tickets</div>";
                    }
                      else{
                         echo "<div style='color:black;'>Tickets</div>";
                        }
                   ?>
                  </a>
                  </div>
                </div>
                </td>
              </tr>
            </tbody>
           </table> 
        
    <?php } ?>

    <?php endwhile; 
    wp_reset_postdata(); ?>

    <?php else: ?>

          
    <?php  endif; ?>
    <?php  wp_reset_postdata(); ?>
   
    <br>
  

<br>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->


<!--     vcvxvxvxvxvxvxvxcvcxvcxvcxvxcvxcvcxvcxvcxvcxvcxvxcvcx     -->

  
<div class="gmap">   
        <div class="bod">
          <div class="hidex">
              <h2>Full Tour</h2>
          <table class="zumic-table tdate"  border="1" cellpadding="3">
          <tbody>
          <th><div class="tourdate">Date</div></th>
          <th><div class="tourcv">City/Venue</div></th>
          <th><div class="ticshow"><div class="tourtic">Offical Tickets</div></div></th>
          <th style="display:table-cell!important;"><div class="ticshow"><div class="tourtic">Ticket Reseller</div></div></th>
          <th style="display:table-cell!important;"><div class="tourtic">More Info</div></th>
          </tbody>
          </table>
          
        </div>
        <div class="hidey">
          <h2>No Events Scheduled! Stay Tuned.</h2>
          </div>
          <?php
              
              $timecutoff = date("Y-m-d");
                $args = array(
                  'post_type'    => 'events',
                  'orderby'      => 'meta_value',
                  'meta_key'     => 'event_date',
                  'meta_compare' => '>=',
                  'tag_slug__and'   => $tag->name . ' ',
                  'meta_value'   => $timecutoff,
                  'showposts'    => -1,
                  'order'        => 'ASC'
                  
                  );
              $my_query = new WP_Query($args);
              if ($my_query->have_posts()) : while ($my_query->have_posts()) :
              $my_query->the_post();
              $eventdate = get_post_meta($post->ID, "eventdate", true);
          ?>
          <style type="text/css">
    .hidex{display: inline-block;}
    .hidey{display: none;}
    </style>
          <table class="zumic-table tdate" border="1" cellpadding="3">
            <tbody>
              <tr style="display:none!important;">
              <div style="display:none!important;">
              <th style="display:none!important;"></th>
              <th style="display:none!important;"></th>
              <th style="display:none!important;"></th>
              </div>
              </tr>
              <tr>
              <td>
              <b>
                <div class="eventtic">
                <div class="noday">
              <?php
                $dateformatstring = "l,";
                $datebreak = "M j";
                $unixtimestamp = strtotime(get_field('event_date'));
                echo date_i18n($dateformatstring, $unixtimestamp);
              ?>
                </div>
              <br />
              <?php
                echo date_i18n($datebreak, $unixtimestamp);
              ?>
              <br>
             
              <?php if (get_field('end_date')) { ?>
                to
              <br>
            <?php
                $dateformatstring1 = "l,";
                $datebreak1 = "M j";
                $unixtimestamp1 = strtotime(get_field('end_date'));
                echo date_i18n($dateformatstring1, $unixtimestamp1);
              ?>
                </div>
             
              <?php
                echo date_i18n($datebreak1, $unixtimestamp1);
              ?>
              <?php } ?>
              
           
              </div>
            </b>
              </td>
              <td>
              <div class="eventtit">
<a style="color:black;"href="<?php the_permalink() ?>">
                 <?php // THE TITLE //
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                                
                               //echo substr($titlesub, 0, strrpos($titlesub, 'ON') - 1);

                            ?>

                </a>
              </div>


              </td>
              <div class="ticshow">
                <td>
                  <div class="ticshow">
                      <div class="eventtic">
                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">

                          <?php
                            $axs = get_field('url_axs');               $eventko = get_field('url_evenko');
                            $live = get_field( 'url_livenation' );     $subw = get_field('url_stubwire');
                            $ticfly = get_field( 'url_ticketfly' );    $ticmaster = get_field( 'url_ticketmaster' );
                            $ticweb = get_field( 'url_ticketweb' );    $venue = get_field('url_venue');
                            $eventbrite = get_field('url_eventbrite'); $eventtime = get_field('url_eventim_de');
                            $ticketek = get_field('url_ticketek');     $ticketone = get_field('url_ticketone'); 
                            $flavorus = get_field('url_flavorus');     $ticketcorner = get_field('url_ticketcorner');
                            if ( $ticmaster ) { ?>

                                        <a href="<?php the_field( 'url_ticketmaster' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/09/ticketmaster-logo.jpg">   
                                        <?php } ?>
                                        </a>

                              <?php }elseif( $live ) { ?>

                                        <a href="<?php the_field( 'url_livenation' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/live-nation-logox.jpg">  
                                        <?php } ?> 
                                        </a>
                                  
                              <?php }elseif($ticfly){ ?>

                                        <a href="<?php the_field( 'url_ticketfly' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketfly-logo-1.jpg">  
                                        <?php } ?>
                                        </a>

                              <?php }elseif($eventko) { ?> 

                                        <a href="<?php the_field( 'url_evenko' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/evenko-logo.jpg">
                                        <?php } ?>
                                        </a>
                               
                              <?php }elseif($subw) { ?>  

                                        <a href="<?php the_field( 'url_stubwire' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/stubwire-logo.jpg">
                                        <?php } ?>
                                        </a>
                                    
                              <?php }elseif($ticweb) { ?> 

                                        <a href="<?php the_field( 'url_ticketweb' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketweb-logo.jpg">
                                        <?php } ?>
                                        </a>
                                   
                                <?php }elseif($eventko) { ?>  

                                        <a href="<?php the_field( 'url_evenko' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/evenko-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($eventtime) { ?> 

                                        <a href="<?php the_field( 'url_eventim_de' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/eventim-logo.jpg">
                                        <?php } ?>
                                        </a>

                                 <?php }elseif($venue) { ?> 

                                        <a href="<?php the_field( 'url_venue' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/venue-ticketsx.jpg">
                                        <?php } ?>
                                        </a>

                              <?php }elseif($eventbrite) { ?>  

                                        <a href="<?php the_field( 'url_eventbrite' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/eventbrite-logo.jpg">
                                        <?php } ?>
                                        </a>

                              <?php }elseif($ticketek) { ?>  

                                        <a href="<?php the_field( 'url_ticketek' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/ticketek-tickets.jpg">
                                        <?php } ?>
                                        </a>

                              <?php }elseif($ticketone) { ?>  

                                        <a href="<?php the_field( 'url_ticketone' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/ticketone-it-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($flavorus) { ?>  

                                        <a href="<?php the_field( 'url_flavorus' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/flavorus-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($ticketcorner) { ?>  

                                        <a href="<?php the_field( 'url_ticketcorner' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/06/tickercorner-logo.jpg">
                                        <?php } ?>
                                        </a>

                                <?php }elseif($axs) { ?>


                                        <a href="<?php the_field( 'url_axs' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/axs-logo.jpg">
                                        <?php } ?>
                                        </a>
                                   
                              <?php }else{ ?>
                                  <img style="width:auto;height:30px;border:none;" src="http://zumic.com/wp-content/uploads/2015/03/ticc2.png">
                          <?php } ?>  
                          </a>
                      </div>
                    </div>
                  </td>
                </div>
                 <div class="ticshow">
                    <td style="display:inline!important;">
                    <div class="ticshow1">
                      <div class="eventtic">
                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php 
                            $supstar = get_field( 'url_superstar');
                            $ticnow = get_field('url_ticketsnow');
                            $viago  = get_field('url_viagogo');
                            $stubhub = get_field('url_stubhub');
                        if ( $supstar ) { ?>

                                          <a href="<?php the_field( 'url_superstar' ); ?>" target="_blank" >
                                                  <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/superstartickets-logo.jpg">
                                          </a>

                          <?php  } elseif( $ticnow ) { ?>

                                          <a href="<?php the_field( 'url_ticketsnow' ); ?>" target="_blank" >
                                                <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketsnow-logo.jpg">
                                          </a>

                          <?php  } elseif($viago)  { ?>
                               
                                          <a href="<?php the_field( 'url_viagogo' ); ?>" target="_blank" >
                                            <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/viagogo-logo.jpg">
                                          </a>                               
                          
                          <?php } elseif($stubhub) { ?> 
                                
                                          <a href="<?php the_field( 'url_stubhub' ); ?>" target="_blank" >
                                             <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/stubhub-logo.jpg">
                                          </a>
                                
                          <?php } else { ?>
                                <img style="auto;height:30px;border:none;" src="http://zumic.com/wp-content/uploads/2015/03/ticc2.png">
                      <?php } ?>

                          </a>
                      </div> 
                    </div>
                    </td>
                  </div>
                      <td style="display:inline!important;">
                <div class="ticshow">
                  <div class="eventtic">
                  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                       <?php
                    if(has_post_thumbnail()){
                      the_post_thumbnail( 'tour-img' );
                    }
                      else{
                         echo '<img  style="width:auto;height:50px;background:black;" src="http://zumic.com/wp-content/uploads/2015/03/zumic-logo-brushed-steel.png">';
                        }
                   ?>
                  </a>
                  </div>
                </div>
                <div class="ticnoshow">
                 <div class="eventtic">
                  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                       <?php
                    if(has_post_thumbnail()){
                      echo "<div style='color:black;'>Tickets</div>";
                    }
                      else{
                         echo "<div style='color:black;'>Tickets</div>";
                        }
                   ?>
                  </a>
                  </div>
                </div>
                </td>
              </tr>
            </tbody>
           </table>
          <?php endwhile; else: ?>
            <style >
              h6.title-headline{
                display: none;
              }
              .tagstitle{
                display: none;
              }
              .zumic-table{
                display: none;
              }
            </style>
          <?php endif; ?>
          <?php  wp_reset_postdata(); ?>
          </tr>
      </div>

        <div class="tags-wrapper">
                      <p class="tags"><?php echo get_the_term_list( get_the_ID(), 'media-type', '<span class="tags-title">' . __( 'Media Type:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
                      <p class="tags"><?php //echo get_the_term_list( get_the_ID(), 'music-genres', '<span class="tags-title">' . __( 'Genres:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
                      <p class="tags"><?php //echo get_the_term_list( get_the_ID(), 'local-music', '<span class="tags-title">' . __( 'Locations:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
                      <p class="tags">
                      <?php
                        $tags = wp_get_post_tags( $post->ID, ['fields' => 'all'] );
                        $tags_output = [];
                        foreach ($tags as $key => $value) {
                          $args = [
                            'name' => $value->slug,
                            'post_type' => 'artists',
                            'post_status' => 'publish',
                            'numberposts' => 1
                          ];
                          $artist_page = get_posts($args);
                          if($artist_page) {
                            //$tags_output[] = "<a href='/artists/" . $value->slug ."'>" . $value->name . "</a>";
                          } else {
                            //$tags_output[] = "<a href='/tag/" . $value->slug ."'>" . $value->name . "</a>";
                          }
                        }
                        if($tags_output) {
                            print implode(', ', $tags_output);
                        }
                      ?>
                    </p>
        </div>
</div>
<!-- \|/= --><!-- \|/= -->
<!-- \|/= --><!-- \|/= -->


  <?php
      $timecutoff = date("Y-m-d");
        $args = array(
          'post_type'    => 'events',
          'orderby'      => 'meta_value',
          'meta_key'     => 'event_date',
          'meta_compare' => '>=',
          'tag_slug__and'  => $tag->name . ' ',
          'meta_value'   => $timecutoff,
          'posts_per_page'    => -1,
          'order'        => 'ASC'
          );
$my_query = new WP_Query($args);
            $locations = array();
                    while ($my_query->have_posts()) : $my_query->the_post();
                    global $post;
                    $date = $post->ID;
                    $permalink = get_permalink($date);
                    $permalink2 =  "<a href='" . $permalink . "'>". (get_the_title()) . "</a>";
                        $locations[] = array(
                            $permalink2,
                            get_field( "gp_latitude" ),
                            get_field( "gp_longitude" ),
                        );
    ?>
<?php endwhile; 

wp_reset_postdata(); ?>

<script>
   
  var gmarkers = [];

  function initialize() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 2,
      center: new google.maps.LatLng(40.7484, -73.9857),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var j;
    for (var i = 0; i < locations.length; i++) {
      var latlng = new google.maps.LatLng(locations[i][1], locations[i][2]);
      for (j = 0; j < gmarkers.length; j++) {
        if (latlng.equals(gmarkers[j].getPosition())) {
          gmarkers[j].IWcontent += "<hr>" + locations[i][0];
          break;
        }
      }
      if (i == 0 || j == gmarkers.length) {
        var marker = new google.maps.Marker({
          position: latlng,
          map: map,
          IWcontent: locations[i][0]
        });
        google.maps.event.addListener(marker, 'click', function(evt) {
          infowindow.setContent(this.IWcontent);
          infowindow.open(map, this);
        });
        gmarkers.push(marker);
      }
    }
  }
  google.maps.event.addDomListener(window, 'load', initialize);   



  var locations = <?php echo json_encode($locations) ?>;

</script>


  <h2>Map</h2>
<div id="map" style="width:auto;height:400px;color:black!important;"></div>


<!-- \/= --><!-- \/= -->
<!-- \/= --><!-- \/= -->
     
<?php
/* draws a calendar */
function draw_calendar($month,$year){

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

  /* table headings */
  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

  /* days and weeks vars now ... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
    $calendar.= '<td class="calendar-day">';
      /* add in the day number */
      $calendar.= '<div class="day-number">'.$list_day.'</div>';

      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;

  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';
  
  /* all done, return result */
  return $calendar;
}

/* sample usages */
// $month = date('n');
// $year = date('Y');
// echo "<h2>" . date('F') . " " . date('Y') . "</h2>"; 
// echo draw_calendar($month,$year);
?>
<br>
</section>
<?php if( $has_right_col ): ?>
<?php else: ?>
<div class="sidebar grid-4 last clearfix" role="complementary">


  <br>                   
  <?php //get_sidebar(); ?>
  </div>
  <?php endif; ?>
  <footer class="article-footer"></footer>
  </article>
  <?php endwhile; ?>
  <?php else : ?>
  <?php endif; ?>
  </div>
</div>
</div>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$END$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
</div>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$END$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->







<!-- $$$$$$$$$$$$$$$||ARISTS PAGE||$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<div  id="id2" style="display:none">

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<div id="main" class="grid-4 first clearfix" role="main">
          <div class="body-border2">
      				<h1 class="title entry-title"><?php the_title(); ?></h1>
      				  <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
              <a href="http://zumic.com/artists/<?php echo $post->post_name; ?>/tour"></a>
          </div>
<br>
<br>
<div class="body-border2" stlye="background-color:black!important;">
<a href="<?php echo $post->post_name; ?>/?view#tour-dates">   <h2 class='title-headline'>Tour Dates</h2></a>
<br>
<script>
$(document).ready(function() {
      if ($(".art-near").find(".TiqiqEventsList").length == 0){ 
        $(".art-near").hide();
        }
});
</script> 
<div class="art-near">
   <tr>                                              
<!--||||||||||||||||||||$$$shows near you$$$|||||||||||||||||||||||||||||||-->
      <?php
          $geoplugin  = maybe_unserialize( wp_remote_fopen('http://www.geoplugin.net/php.gp?ip=' . get_client_ip_env()) );
          $user_lat   = $geoplugin['geoplugin_latitude'];
          $user_long  = $geoplugin['geoplugin_longitude'];
      ?>
      <h4>shows near you</h4>   
              <?php
                  $timecutoff = date("Y-m-d");
                   $tags = wp_get_post_tags( $post->ID );
                      $artist_id  = $tags[0]->term_id;   $artist_idd = $tags[1]->term_id;
                      $artist_id2 = $tags[2]->term_id;   $artist_id3 = $tags[3]->term_id;
                      $artist_id4 = $tags[4]->term_id;   $artist_id5 = $tags[5]->term_id;
                      $artist_id6 = $tags[6]->term_id;   $artist_id7 = $tags[7]->term_id;
                      $artist_id8 = $tags[8]->term_id;   $artist_id9 = $tags[9]->term_id;
                      $artist_id10 = $tags[10]->term_id; $artist_id11 = $tags[11]->term_id;
                      $artist_id12 = $tags[12]->term_id; $artist_id13 = $tags[13]->term_id;
                      $artist_id14 = $tags[14]->term_id; $artist_id15 = $tags[15]->term_id;
                      $artist_id16 = $tags[16]->term_id; $artist_id17 = $tags[17]->term_id;
                      $artist_id18 = $tags[18]->term_id; $artist_id19 = $tags[19]->term_id;
                      $artist_id20 = $tags[20]->term_id;
                  $args = array(
                      'post_type' => array('events'),
                      'orderby' => 'meta_value',
                      'meta_key' => 'event_date',
                      'meta_compare' => '>=',
                      'meta_value' => $timecutoff,
                      'posts_per_page' => 350, 
                      'order' => 'ASC',
                      'ignore_sticky_posts' => true,
                      'tag__in' => array( $artist_id,   $artist_idd,  $artist_id2,
                                                  $artist_id3,  $artist_id4,  $artist_id5,
                                                  $artist_id6,  $artist_id7,  $artist_id8,
                                                  $artist_id9,  $artist_id10, $artist_id11, 
                                                  $artist_id12, $artist_id13, $artist_id14,
                                                  $artist_id15, $artist_id16, $artist_id17,
                                                  $artist_id18, $artist_id19, $artist_id20
                                                   ),
                           );
                  $my_query = new WP_Query($args);
                  if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                  $my_query->the_post();
                      $eventdate = get_post_meta($post->ID, "eventdate", true);
                      $event_lat  = get_field( 'gp_latitude' ); 
                      $event_long = get_field( 'gp_longitude' ); 
                      $earth_radius = 3960.00; # in miles
                      $lat_1 = $event_lat;
                      $lon_1 = $event_long;
                      $lat_2 = $user_lat;
                      $lon_2 = $user_long;
                      $delta_lat = $lat_2 - $lat_1 ;
                      $delta_lon = $lon_2 - $lon_1 ;
                      $hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2); 
                      $max_distance = 70;  
              ?>
                  <?php if ($hav_distance <= $max_distance) { ?>
               
                  <div class="TiqiqEventsList" href="<?php the_permalink() ?>">
                                                  <div class="TiqiqEventRow">
                                                  
                                                      <div class="TiqiqEventDate" >
                                                          <strong>    
                                                          <a href="<?php the_permalink() ?>" style="color:#ddd;">
                                                              <span>
                                                                    <?php
                                                                      $dateformatstring = "l,";
                                                                      $datebreak = "M j";
                                                                      $unixtimestamp = strtotime(get_field('event_date'));
                                                                      echo date_i18n($dateformatstring, $unixtimestamp);
                                                                    ?>
                                                                    <br>
                                                                    <?php
                                                                      echo date_i18n($datebreak, $unixtimestamp);
                                                                    ?>
                                                                    <br>
                                                                    <?php if (get_field('end_date')) { ?>
                                                                      to
                                                                    <br>
                                                                    <?php
                                                                      $dateformatstring1 = "l,";
                                                                      $datebreak1 = "M j";
                                                                      $unixtimestamp1 = strtotime(get_field('end_date'));
                                                                      echo date_i18n($dateformatstring1, $unixtimestamp1);
                                                                    ?>
                                                                    <br>
                                                                    <?php
                                                                      echo date_i18n($datebreak1, $unixtimestamp1);
                                                                    ?>
                                                                    <?php }?>
                                                              </span>
                                                          </a> 
                                                          </strong>  

                                                      </div>
                                                       <div class="TiqiqEventName">
                                                         
                                                          <a href="<?php the_permalink() ?>" target="" title="">
                                                              <span class="TiqiqEventVenueNameText" style="padding-left:15px;color:#ddd;">
                                                                    
                                                                      <?php
                                                                            global $post;
                                                                                $s = $post->post_title;
                                                                                echo substr($s, 0, strrpos($s, 'on') - 1);
                                                                            ?>
                                                              </span>
                                                          </a>                                                      
                                                      </div>  
                                                    <!--   <div class="TiqiqEventBuy">
                                                          <a href="<?php the_permalink() ?>" class="TiqiqEventBuyButton" title="" style="color:#ddd;"><strong>Tickets</strong></a>
                                                      </div> -->
                                                  </div>
                                                                
                                  </div>
                                  <?php }  ?>
                                  <?php endwhile; else: ?>
                                         <style type="text/css">
                                          .art-near{display: none;}
                                         </style>
                                    <?php endif; ?>
                                    <?php  wp_reset_postdata(); ?>
          </tr>
  <!--||||||||||||||||END||||||||||||$$$shows near you$$$||||||||||||||||||||-->
<br>
<div style="border-style:solid;border-width:5px;border-color:#ddd;"></div>  
</div>
<h4>full tour</h4>
<br>
                    <tr> 
                    <?php
                    $tags = wp_get_post_tags( $post->ID );
                    $artist_id  = $tags[0]->term_id;   $artist_idd = $tags[1]->term_id;
                    $artist_id2 = $tags[2]->term_id;   $artist_id3 = $tags[3]->term_id;
                    $artist_id4 = $tags[4]->term_id;   $artist_id5 = $tags[5]->term_id;
                    $artist_id6 = $tags[6]->term_id;   $artist_id7 = $tags[7]->term_id;
                    $artist_id8 = $tags[8]->term_id;   $artist_id9 = $tags[9]->term_id;
                    $artist_id10 = $tags[10]->term_id; $artist_id11 = $tags[11]->term_id;
                    $artist_id12 = $tags[12]->term_id; $artist_id13 = $tags[13]->term_id;
                    $artist_id14 = $tags[14]->term_id; $artist_id15 = $tags[15]->term_id;
                    $artist_id16 = $tags[16]->term_id; $artist_id17 = $tags[17]->term_id;
                    $artist_id18 = $tags[18]->term_id; $artist_id19 = $tags[19]->term_id;
                    $artist_id20 = $tags[20]->term_id;
                    $timecutoff = date("Y-m-d");
                        $args = array(
                            'post_type' => 'events',
                            'orderby' => 'meta_value',
                            'meta_key' => 'event_date',
                            'meta_compare' => '>=',
                            'tag__in' => array( $artist_id,   $artist_idd,  $artist_id2,
                                                $artist_id3,  $artist_id4,  $artist_id5,
                                                $artist_id6,  $artist_id7,  $artist_id8,
                                                $artist_id9,  $artist_id10, $artist_id11, 
                                                $artist_id12, $artist_id13, $artist_id14,
                                                $artist_id15, $artist_id16, $artist_id17,
                                                $artist_id18, $artist_id19, $artist_id20
                                                 ),
                            'meta_value' => $timecutoff,
                            'order' => 'ASC',
                            'showposts' => 500,
                        );
                    $my_query = new WP_Query($args);
                    if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                    $my_query->the_post();
                    $eventdate = get_post_meta($post->ID, "eventdate", true);
                    ?>
                    <div class="TiqiqEventsList" href="<?php the_permalink() ?>">
                                    <div class="TiqiqEventRow">
                                    
                                        <div class="TiqiqEventDate" >
                                            <strong>    
                                            <a href="<?php the_permalink() ?>" style="color:#ddd;">
                                                <span>
                                                  <?php
                                                        $dateformatstring = "l,";
                                                        $datebreak = "M j";
                                                        $unixtimestamp = strtotime(get_field('event_date'));
                                                        echo date_i18n($dateformatstring, $unixtimestamp);
                                                      ?>
                                                      
                                                      <br />
                                                      <?php
                                                        echo date_i18n($datebreak, $unixtimestamp);
                                                      ?>
                                                      <br>
                                                     
                                                      <?php if (get_field('end_date')) { ?>
                                                        to
                                                      <br>
                                                    <?php
                                                        $dateformatstring1 = "l,";
                                                        $datebreak1 = "M j";
                                                        $unixtimestamp1 = strtotime(get_field('end_date'));
                                                        echo date_i18n($dateformatstring1, $unixtimestamp1);
                                                      ?>
                                                      <br>
                                                      <?php
                                                        echo date_i18n($datebreak1, $unixtimestamp1);
                                                      ?>
                                                      <?php } ?>
                                                
                                                </span>
                                            </a> 
                                            </strong>  

                                        </div>
                                         <div class="TiqiqEventName">
                                           
                                            <a href="<?php the_permalink() ?>" target="" title="">
                                                <span class="TiqiqEventVenueNameText" style="padding-left:15px;color:#ddd;">
                                                       <?php
                                                        global $post;
                                                            $s = $post->post_title;
                                                            echo substr($s, 0, strrpos($s, 'on') - 1);
                                                        ?>
                                                         <!--  <div style="font-weight:900;margin-bottom:-20px;">
                                                          <?php
                                                                $terms = get_the_terms( get_the_ID(), 'local-music', '<span class="tags-title">' . __( '', 'bonestheme' ) . '</span> ', ', '  );
                                                                if ( $terms && ! is_wp_error( $terms ) ) {  
                                                                $terms = array_values($terms);
                                                            ?>
                                                            <?php echo $terms[0]->name; ?>
                                                            <?php } else{ ?>
                                                         
                                                              <?php the_field('location'); ?>
                                                           <?php }; ?>
                                                             </div>
                                                            

                                                          <?php 
                                                            if( get_field('venue') ){ ?>
                                                                <?php the_field('venue'); ?><br>
                                                            <?php } else { ?>
                                                            <?php
                                                                $terms = get_the_terms( get_the_ID(), 'venue-name', '<span class="tags-title">' . __( '', 'bonestheme' ) . '</span> ', ', '  );
                                                                if ( $terms && ! is_wp_error( $terms ) ) :
                                                                $terms = array_values($terms);
                                                            ?>
                                                                <?php echo $terms[0]->name; ?>
                                                            <?php endif; ?>
                                                            <br>
                                                        <?php } ?> -->
                                                       
                                                </span>
                                            </a>
                                          
                                        </div>
                                        
                                        <!-- <div class="TiqiqEventBuy">
                                            <a href="<?php the_permalink() ?>" class="TiqiqEventBuyButton" title="" style="color:#ddd;">
                                              <strong>Tickets</strong></a>
                                        </div> -->
                                    </div>
                                                  
                    </div>

                        <?php endwhile; else: ?>
                            <ul>
                                <li><?php _e('No Events Scheduled! Stay Tuned.'); ?></li>
                            </ul>
                        <?php endif; ?>
                        <?php  wp_reset_postdata(); ?>
                    </tr>
                    <br>

 <div class="zumic-a clearfix">
        <h3 style="margin-top:-10px!important;">Powered By</h3>
    
        <a href="https://www.superstartickets.com/<?php echo $post->post_name;?>" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:200px;!important" src="http://zumic.com/wp-content/uploads/2015/03/SUPERSTAR_LOGOv2-03-11.jpg" >   
        </a>
        
    </div>  

				<div class="collapsible-row">
					<div class="collapsible-wrapper open">
						<div class="collapsible-handlediv" title="Click to toggle"></div>
						<h3 class="collapsible-hndle">Artist Information</h3>
						<div class="collapsible-body">

							<div class="artist-info-area">
								<?php if( get_post_meta($post->ID, "CURRENT MEMBERS", true) ): ?>
									<h4>CURRENT MEMBERS:</h4>
									<p><?php echo (get_post_meta($post->ID, 'CURRENT MEMBERS', true)); ?></p>
								<?php else: ?><?php endif; ?>

								<?php if( get_post_meta($post->ID, "PAST MEMBERS", true) ): ?>
									<h4>PAST MEMBERS:</h4>
									<p><?php echo (get_post_meta($post->ID, 'PAST MEMBERS', true)); ?></p>
								<?php else: ?><?php endif; ?>

								<?php if( get_post_meta($post->ID, "YEARS ACTIVE", true) ): ?>
									<h4>YEARS ACTIVE:</h4>
									<p><?php echo (get_post_meta($post->ID, 'YEARS ACTIVE', true)); ?></p>
								<?php else: ?><?php endif; ?>

								<h4>GENRES:</h4>
								<p class="genre"><span class="terms" style="color:">
								<?php echo get_the_term_list( $post->ID, 'music-genres', '', '<br>', '' ); ?></span></p>


								<?php if( get_post_meta($post->ID, "ORIGIN", true) ): ?>
									<h4>ORIGIN:</h4>
									<p><?php echo (get_post_meta($post->ID, 'ORIGIN', true)); ?></p>
								<?php else: ?><?php endif; ?>
								 
								<?php if( get_post_meta($post->ID, "BIRTH NAME", true) ): ?>
									<h4>BIRTH NAME:</h4>
									<p><?php echo (get_post_meta($post->ID, 'BIRTH NAME', true)); ?></p>
								<?php else: ?><?php endif; ?>

								<?php if( get_post_meta($post->ID, "ALIAS", true) ): ?>
									<h4>ALIAS:</h4>
									<p><?php echo (get_post_meta($post->ID, 'ALIAS', true)); ?></p>
								<?php else: ?><?php endif; ?>

								<?php if( get_post_meta($post->ID, "MAIN INSTRUMENTS", true) ): ?>
									<h4>MAIN INSTRUMENTS:</h4>
									<p><?php echo (get_post_meta($post->ID, 'MAIN INSTRUMENTS', true)); ?></p>
								<?php else: ?><?php endif; ?>

								<?php if( get_post_meta($post->ID, "Record Label", true) ): ?>
									<h4>Record Label(S):</h4>
									<p><?php echo (get_post_meta($post->ID, 'Record Label', true)); ?></p>
								<?php else: ?><?php endif; ?>
							</div>

						</div>
					</div>
				</div>
</div>

				<?php get_sidebar(); ?>

				<div class="zumic-a">
					<?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
				</div>

			</div>

<div id="main" class="grid-8 last clearfix" role="main">
<div class="body-border2">
				<?php
//for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
        if ($tags) {
        $first_tag = $tags[0]->term_id;

                $args=array(
                    'tag__in' => array($first_tag),
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=>5,
                    'caller_get_posts'=>1

                );

        

    wp_reset_query();

    }

?>
<?php           
                $tags = wp_get_post_tags( $post->ID );
                $artist_id = $tags[0]->term_id;// Artist name located in first tag
                // $queried_object = get_queried_object();
                // $term_id = $queried_object->term_id;
                $filter = $_GET['show'];
                $args = array(
                    'post_type' => array( 'post', 'music-videos' ),
                    'posts_per_page' => -1,
                    'tag__in' => array( $artist_id ),
                    //'post_status' => 'publish',
                    //'paged' => get_query_var('paged'),
                    'date_query' => array( array(
                        'after' => '1400 weeks ago'
                        ) 
                    ),
                  
                );
                switch ( $filter ) {
                case 'latest':  
                        $orderby = 'post_date DESC';           
                        $args[ 'orderby' ] = 'post_date';
                break;
                case 'hot':
                        $args[ 'orderby' ] = 'menu_order post_date';
                        $args[ 'date_query' ] = array( array('after' => '5 years ago'));
                        
                    
                break;
                case 'bestofmonth':

                        $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
                        $args[ 'orderby' ] = 'menu_order post_date';


                break;
                case 'bestofyear':

                        $args[ 'date_query' ] = array( array('after' => '365 day ago'));//change to 365 days
                        $args[ 'orderby' ] = 'menu_order post_date';


                break;
                
                default:
                        $args[ 'orderby' ] = 'post_date';
                break;
               }


                query_posts($args);
        ?>

                <h1 class="title-headline"><?php single_cat_title(); ?> Music FEED </h1>

				<?php 
// gets the current URI, remove the left / and then everything after the / on the right
$directory = explode('/',ltrim($_SERVER['REQUEST_URI'],'/'));
//echo 'DIRECTORY IS '.$directory[0].'<br>';
// foreach ($directory as $d) {
//     echo 'incl '.$d.'<br>';
// }
// loop through each directory, check against the known directories, and add class   
$directories = array("?show=hot",         "?show=latest",   "?show=bestofmonth", "?show=bestofyear",
                     "?show=video",    "?show=audio",    "?show=albums",      "?lshow=video", 
                     "?lshow=audio",   "?lshow=albums",  "?show=videob",      "?show=audiob",
                     "?show=albumsb",  "?show=videoby",  "?show=audioby",     "?show=albumsby",
                     "?show=allpost",  "?lshow=allpost", "?show=allpostb",    "?show=allpostby",
                     "?show=whatshot" ); // set home as 'index', but can be changed based of the home uri
foreach ($directories as $folder){
//$active[$folder] = ($directory[0] == $folder)? "active":"noactive";
    $active[$folder] = (in_array($folder, $directory))? "active":"noactive";
    //echo 'active '.$folder.' is '.$active[$folder].'<br>';
}
//echo $active['?show=albumsby'];
?>
<div id="topnav" class="container1">
    <?php $newVariable = single_cat_title("", false); ?>
      <ul class="nav1">
        <li class="<?php echo $active['?show=latest']?>">
            <a id="latest" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=latest">Latest</a>
            <ul class="nav1" >
               <li class="<?php echo $active['?lshow=video']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?lshow=video">Videos</a></li>
               <li class="<?php echo $active['?lshow=audio']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?lshow=audio">Singles</a></li>
               <li class="<?php echo $active['?lshow=albums']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?lshow=albums">Albums</a></li>
               <li id="li_all" class="<?php echo $active['?show=latest']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=latest">All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=bestofmonth']?>">
            <a id="bestofmonth" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofmonth">Best Of Month</a>
            <ul class="nav1">
                   <li class="<?php echo $active['?show=videob']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=videob">Videos</a></li>
                   <li class="<?php echo $active['?show=audiob']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audiob">Singles</a></li>
                   <li class="<?php echo $active['?show=albumsb']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albumsb">Albums</a></li>
                   <li id="all_b" class="<?php echo $active['?show=bestofmonth']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofmonth" >All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=bestofyear']?>">
            <a id="bestofyear" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofyear">Best Of Year</a>
             <ul class="nav1">
                   <li class="<?php echo $active['?show=videoby']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=videoby">Videos</a></li>
                   <li class="<?php echo $active['?show=audioby']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audioby">Singles</a></li>
                   <li class="<?php echo $active['?show=albumsby']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albumsby" class="<?php echo $active['?show=albumsby']?>">Albums</a></li>
                   <li id="all_by" class="<?php echo $active['?show=bestofyear']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofyear">All Posts</a></li> 
            </ul>
        </li> 
        <li class="<?php echo $active['?show=hot']?>">
            <a  id="hot" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=hot">All TIme</a>
            <ul class="nav1">
               <li id="li_video" class="<?php echo $active['?show=video']?>"><a id="a_video" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=video">Videos</a></li>
               <li id="li_audio" class="<?php echo $active['?show=audio']?>"><a id="a_audio" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audio" >Singles</a></li>
               <li id="li_albums" class="<?php echo $active['?show=albums']?>"><a id="a_albums" href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albums">Albums</a></li>
               <li id="all_l" class="<?php echo $active['?show=hot']?>"><a href="/artists/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=hot">All Posts</a></li> 
            </ul>
        </li>
      </ul>  
</div>
  <br>
  <br>


<script>
main_links = ["video", "audio", "albums", "allpost"];
category_links = ["hot", "latest", "bestofmonth", "bestofyear"];
allposts_links = [
    "li_all",
    "all_l",
    "all_b",
    "all_by"];
$(document).ready(function() {
    // for (ai in allposts_links) {
    //     ale = allposts_links[ai];
    //     if ($("#" + ale).attr("class") == "active") {
    //         // $("#" + ale).siblings().addClass("active");
    //         // $("#" + ale).siblings().removeClass("noactive");
    //         for (qi in main_links) {
    //             $("#li_"+main_links[qi]).addClass("active");
    //             $("#li_"+main_links[qi]).removeClass("noactive");

    //         }
    //     }
    // }

    //Default to LATEST if nothing is selected
    if (window.location.href.search(/\?.*/g) < 0) {
        //$("#hot").addClass("active"); //attempt at class
        $("#li_all").addClass("active");

        //manual css
         $('#latest').css('background', '-webkit-gradient(linear,left top,left bottom,from(#000000),to(#363636))' );
         $('#latest').css('height', '42px');
       
    }

    //Find all active links
    active_links = $("li.active>a");
    for (lk in active_links) {
        link = active_links[lk];
        href = link.href;

        //Subcategory links (video, audio, albums)
        for (qi in main_links) {
            q = main_links[qi];
            //console.log("finding " + q + " in " + href);

            //Update relevant li
            if (href && href.indexOf(q) > -1) {         //See which page we're on
                $("#li_"+q).addClass("active"); // and highlight it
                $("#li_"+q).removeClass("noactive");

                // for (c in category_links) {
                //   cat = $("#" + category_links[c]);
                //   cat.href = 
                // }


                //category_links = ["hot", "latest", "bestofmonth", "bestofyear"];

                //Update the parent links so they stay linked to subcategory e.g. from hot-video to latest-video
                //use base_link to maintain genre
                base_link = window.location.href.replace(/\?.*/g, "");
                $("#hot").attr("href", base_link + "?show=" + q);
                console.log($("#hot").attr("href"));
                $("#latest").attr("href", base_link + "?lshow=" + q);
                $("#bestofmonth").attr("href", base_link + "?show=" + q + "b");
                $("#bestofyear").attr("href", base_link + "?show=" + q + "by"); 
                
                $("#a_"+q).attr("href", href);
                console.log(q + " href is now " + href);

                //Updating subcategory hrefs as well as parent CSS
                if (href.indexOf("lshow") > -1) { //latest
                    console.log("latest");
                    $("#latest").css({
                                // "z-index":"2",
                                // "margin":"3px 0 0",
                                // "height":"43px",
                                // "color":"#404040",
                               "background":"#525252,#5E5E5E",
                                // "border-color":"#ccc",
                                // "border-width":"1px 0",
                                // "background-image":"-webkit-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-moz-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-o-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"linear-gradient(to bottom, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "-webkit-box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)",
                                //"box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
                                //"box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)"
                            });

                    $("#latest").parent().removeClass("noactive");
                    $("#latest").parent().addClass("active");


                    //Update siblings' hrefs
                    siblings = $("#li_"+q).siblings();
                    for (ci in siblings) {
                        sib = siblings[ci].children[0];
                        if (sib.href.search(/=$/) > -1) {
                            sib.href = sib.href + "latest";
                        }
                        else {
                            sib.href = sib.href.replace("show", "lshow");
                        }
                        console.log(sib.id + "'s href is now " + sib.href);
                    }
                }
                else if (href.search(/by$/) > -1) { //best of year
                    console.log("best of year");
                    $("#bestofyear").css({
                                // "z-index":"2",
                                // "margin":"3px 0 0",
                                // "height":"43px",
                                // "color":"#404040",
                                 "background":"#525252,#5E5E5E",
                                // "border-color":"#ccc",
                                // "border-width":"1px 0",
                                // "background-image":"-webkit-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-moz-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-o-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"linear-gradient(to bottom, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "-webkit-box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)",
                                //"box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)"
                               // "box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
                            });

                    $("#bestofyear").parent().removeClass("noactive");
                    $("#bestofyear").parent().addClass("active");

                    siblings = $("#li_"+q).siblings();
                    for (ci in siblings) {
                        sib = siblings[ci].children[0];
                        if (sib.href.search(/=$/) > -1) {
                            sib.href = sib.href + "bestofyear";
                        }
                        else {
                            sib.href = sib.href + "by"
                        }
                        console.log(sib.id + "'s href is now " + sib.href);
                    }
                }
                else if (href.search(/b$/) > -1) { //best of month
                    console.log("best of month");
                    $("#bestofmonth").css({
                                // "z-index":"2",
                                // "margin":"3px 0 0",
                                // "height":"43px",
                                // "color":"#404040",
                                 "background":"#525252,#5E5E5E",
                                // "border-color":"#ccc",
                                // "border-width":"1px 0",
                                // "background-image":"-webkit-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-moz-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-o-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"linear-gradient(to bottom, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "-webkit-box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)",
                                //"box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)"
                               // "box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
                            });

                    $("#bestofmonth").parent().removeClass("noactive");
                    $("#bestofmonth").parent().addClass("active");

                    siblings = $("#li_"+q).siblings();
                    for (ci in siblings) {
                        sib = siblings[ci].children[0];
                        if (sib.href.search(/=$/) > -1) {
                            sib.href = sib.href + "bestofmonth";
                        }
                        else {
                            sib.href = sib.href + "b"
                        }
                        console.log(sib.id + "'s href is now " + sib.href);
                    }
                }
                //else if (href.search(/=$/) > -1) { //hot
                else { //hot
                    console.log("hot");
                    $("#hot").css("background", "#525252,#5E5E5E");

                    $("#hot").css({
                                // "z-index":"2",
                                // "margin":"3px 0 0",
                                // "height":"43px",
                                // "color":"#404040",
                                "background":"#525252,#5E5E5E",
                                // "border-color":"#ccc",
                                // "border-width":"1px 0",
                                // "background-image":"-webkit-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-moz-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"-o-linear-gradient(top, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "background-image":"linear-gradient(to bottom, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0))",
                                // "-webkit-box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)",
                                //"box-shadow":"inset 0 1px rgba(255, 255, 255, 0.35), inset 0 -1px 1px rgba(0, 0, 0, 0.05), 1px 0 rgba(0, 0, 0, 0.05), -1px 0 rgba(0, 0, 0, 0.05), 0 1px rgba(255, 255, 255, 0.4)"
                               // "box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
                            });

                    $("#hot").parent().removeClass("noactive");
                    $("#hot").parent().addClass("active");
                }
                // else {
                //     $("#hot").addClass("active");
                //     $("#hot").removeClass("noactive");
                // }
                break;
            } //end q
        }
    }
});
</script>





<!-- ||========================================FIlter alltime============================================= VIII.V.MMXIV|| -->
<?php
$filter = $_GET['show'];

switch ( $filter ) {
        case 'audio':

                $args[ 'date_query' ] = array( array('after' => '5 years ago'));//change to 30 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'audio-single'
                            )
                    );           
        break;
        case 'video':
              $args[ 'date_query' ] = array( array('after' => '5 years ago'));
              $args[ 'orderby' ] = 'menu_order post_date';
              $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'video'
                            )
                    );   
        break;
        case 'albums':
                 $args[ 'date_query' ] = array( array('after' => '5 years ago'));
                 $args[ 'orderby' ] = 'menu_order post_date';
                 $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'full-album-stream'
                            )
                    );       
        break;
         case 'allpost':
                  $args[ 'date_query' ] = array( array('after' => '5 years ago'));
                $args[ 'orderby' ] = 'menu_order post_date';   

        break;
        default:               
        break;
}
query_posts( $args );
?>
<!-- ||======================================== ||||||||||||============================================= VIII.V.MMXIV|| --> 

<!-- ||========================================FIlter LATEST============================================= VIII.V.MMXIV|| -->   
<?php
$filter = $_GET['lshow'];

switch ( $filter ) {
        case 'audio':
               
                $orderby = 'post_date DESC';           
                $args[ 'orderby' ] = 'post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'audio-single'
                            )
                    );      
        break;
        case 'video':

                $orderby = 'post_date DESC';           
                $args[ 'orderby' ] = 'post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'video'
                            )
                    );       
        break;
        case 'albums':

                $orderby = 'post_date DESC';           
                $args[ 'orderby' ] = 'post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'full-album-stream'
                            )
                    );           
        break;
        case 'allpost':

                 $orderby = 'post_date DESC';           
                 $args[ 'orderby' ] = 'post_date';          
                
        break;
      
        default:      
        break;
}
query_posts( $args );
?>
<!-- ||========================================|||||||||||====================================================== VIII.V.MMXIV|| -->

<!-- ||========================================FIlter BEST OF MONTH============================================= VIII.V.MMXIV|| -->   
<?php
$filter = $_GET['show'];
switch ( $filter ) {
        case 'audiob':
                
                $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'audio-single'
                            )
                    );      
        break;
        case 'videob':

                 $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
                $args[ 'orderby' ] = 'menu_order post_date';
                 $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'video'
                            )
                    );        
        break;
        case 'albumsb':

               $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
               $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'full-album-stream'
                            )
                    );          
        break;
        case 'allpostb':

                $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
                $args[ 'orderby' ] = 'menu_order post_date';
               
        break;
      
        default:    
        break;
}
query_posts( $args );
?>
<!-- ||========================================|||||||||||||||||||============================================= VIII.V.MMXIV|| -->

<!-- ||========================================FIlter best of year============================================= VIII.V.MMXIV|| -->   
<div>
<?php
$filter = $_GET['show'];

switch ( $filter ) {
        case 'audioby':
                
                $args[ 'date_query' ] = array( array('after' => '365 days ago'));//change to 365 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'audio-single'
                            )
                    );      
        break;
        case 'videoby':

                $args[ 'date_query' ] = array( array('after' => '365 days ago'));//change to 365 days
                $args[ 'orderby' ] = 'menu_order post_date';
                 $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'video'
                            )
                    );           
        break;
        case 'albumsby':

                $args[ 'date_query' ] = array( array('after' => '365 days ago'));//change to 365 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'full-album-stream'
                            )
                    );           
        break;
        case 'allpostby':

                $args[ 'date_query' ] = array( array('after' => '365 days ago'));//change to 365 days
                $args[ 'orderby' ] = 'menu_order post_date';
                
        break;
      
        default:     
        break;
}
query_posts( $args );
?>           
</div>  
<!-- ||========================================||||||||============================================= VIII.V.MMXIV|| -->
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">

                    <header class="article-header">
                        <h2 class=""><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                        <p class="byline vcard"><?php
                            printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
                        ?></p>

                    </header>

                    <section class="entry-content clearfix">
                           <div class="centerimg">    
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail( 'related-thumb' ); ?>
                        </a>
                        </div>
                        <div class="excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                          <div class="home-rating">
                                <?php if(get_field('star_rating') == "0.0"){ ?>
                                <?php echo " "; ?>
                                <?php } ?>
                                <?php if(get_field('star_rating') == "1.0"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/1rate1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "1.5"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/1half1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "2.0"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/2rate1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "2.5"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/2half1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "3.0"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/3rate1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "3.5"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/3half1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "4.0"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/4rate1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "4.5"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/4half1.png" >
                                <?php } ?>
                                <?php if(get_field('star_rating') == "5.0"){ ?>
                                <p>ZUMIC RATING: </p>
                                <img src="http://zumic.com/wp-content/uploads/2015/01/5rate1.png" >
                                <?php } ?>
                    </div>
                         


                        <div class="social-share clearfix">
                            
                            <div class="clearfix"></div>
                        </div>

                    </section>

                    <footer class="article-footer">

                    </footer>

                </article>

				<?php endwhile; ?>

					<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
						<?php bones_page_navi(); ?>
					<?php } else { ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
								<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
							</ul>
						</nav>
					<?php } ?>

					<?php // wp_reset_query(); ?>

				<?php else : ?>

						<article id="post-not-found" class="hentry clearfix">
							<header class="article-header">
								<h1><?php _e( 'No Post In Current Filter.', 'bonestheme' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><strong><?php echo single_cat_title(); ?>'s Latest Posts:</strong></p>
							</section>
							<hr>
							<hr>
							<ul>

                                <?php
                                $tags = wp_get_post_tags( $post->ID );
                                $artist_id = $tags[0]->term_id;
                                $args = array(
                                    'post_type' => array( 'post', 'music-videos' ),
                                    'showposts' => 25,
                                    'orderby' => 'post_date DESC',
                                    'tag__in' => array( $artist_id )
                                    //'paged' => get_query_var('paged'),
                                    );

                                ?>

                                <?php $the_query = new WP_Query($args); ?>
                                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">

				                    <header class="article-header">
				                        <h2 class=""><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				                        <p class="byline vcard"><?php
				                            printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
				                        ?></p>

				                    </header>

				                    <section class="entry-content clearfix">
                                        <div class="centerimg">    
    				                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    				                            <?php the_post_thumbnail( 'related-thumb' ); ?>
    				                        </a>
                                        </div>
				                        
				                        <div class="excerpt">
				                            <?php the_excerpt(); ?>
				                        </div>
                                        

				                        <div class="social-share clearfix">
				                            
				                            <div class="clearfix"></div>
				                        </div>

				                    </section>

				                    <footer class="article-footer">

				                    </footer>

				                </article>
                                <?php endwhile;?>
                            </ul>

						</article>

				<?php endif; ?>
</div>
			</div>

		</div>

	</div>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
</div>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<?php get_footer(); ?>