<?php
/**
 * Local Concert Listings
 **/
?>
<style>
  b, strong, .strong {color: black!important;}
  .body-border {
    background: black;
    width: 100%!important;
    max-width: 963px!important;
    margin: 0 auto;
}
  }
  .img-tour img{width:100%!important;height:auto;margin: 0 auto!important;}
  .zumic-table td:nth-child(3) {display: none!important;}
  th:nth-child(3) {display: none!important;}
  .eventtit {width: 150px;} 
  .tourtic { width: 60px;}
  input[type="submit"] {margin-top: 8px;}
@media only screen and (min-width: 481px) {
  .tourtic {width: 104px!important;}
  .img-tour img{width:100%!important;height:auto;margin: 0 auto!important}
  .eventtit {width: 481px;}
  th:nth-child(3) {display: table-cell!important;}
  .zumic-table td:nth-child(3) {display: table-cell!important;}
   .body-border {
    background: black;
    width: 100%!important;
    max-width: 963px!important;
    margin: 0 auto;
}
  .body-border2 {color: white;background-color: black;border: 1px solid;border-color: black black black;
  width: 100%;max-width: 750px;padding: 2.6041667%;float: left;border-left: 1px solid black;
  border-right:1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;border-radius: 5px;
  margin-bottom:10px;padding-right:8px;padding-left: 12px;background-image: none;}
  .body-border2 h2 a{color: white;}
  .search-results-item.clearfix:hover{background-color: #191919!important;}
  .title-headline { border-bottom: 4px solid #979797; }
  p:hover{color: white;}
  .wrap .grid-8.last { width: auto!important;}
  img.attachment-tour-img.wp-post-image {height:50px;width:auto;max-width:100px;}
  div#panel {margin-top: -15px;}

}
</style>
<?php get_header(); ?>

<!-- $$$$$$$$$$$$||TOURTEMPLETE||$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div id="id1" >  
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<div id="content">
    <div id="inner-content" class="wrap clearfix">
<div id="main" class="first clearfix" role="main">
<div class="body-border">
<center>
    <div class="img-tour">  
       <img style="width:100%;height:auto;margin: 0 auto!important;" src="http://zumic.com/wp-content/uploads/2015/04/zumic-banner.jpg">
    </div>
    <div class="folded3">
        <h2 class="page-title music-videos-title entry-title" style="text-transform:uppercase;font-size:1.7em;">
            Local Concert Listings
        </h2>
    </div>
</center>
<br><br>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--||||||||||||||||||||||||||||||GEO-LOCATION|||||||||||||||||||||--> 
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
        
        $zip = $_GET['zipcode'];
        $miles = $_GET['miles'];
        $zipcode = $zip;
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false";
        $details = maybe_unserialize( wp_remote_fopen($url) );
        $result = json_decode($details,true);
        $lat = $result['results'][0]['geometry']['location']['lat'];
        $lng = $result['results'][0]['geometry']['location']['lng'];
        $titlebar = $result['results'][0]['address_components'][1]['long_name'];
        $geoplugin  = maybe_unserialize( wp_remote_fopen('http://www.geoplugin.net/php.gp?ip=' . get_client_ip_env()) );
        $user_lat   = $geoplugin['geoplugin_latitude'];
        $user_long  = $geoplugin['geoplugin_longitude'];

        $urlzip     = get_query_var( 'zip', $zip ); 

    ?>
    <h3></h3>
    <div>
    <?php    
        if(isset($_GET['SubmitButton'])){ 
          if ($_GET['zipcode'] != 0) {
           $user_lat = $lat;
           $user_long = $lng; ?>
            <style>
            .tour-title{display: none;}
            .ttitle{display: inline-block;}
            </style>

    <?php  }  
            }elseif($lat = null && $lat = null){
              echo "Entered zipcode not in database";
            }  
    ?>

    <div style="width:100%">
      <div style="float:left;margin-top:-30px;">
        <h3 class="tour-title">Concert listings near <?php echo $geoplugin['geoplugin_city']; ?></h3>
        <h3 id="qwe"class="ttitle">Concert listings near <?php echo $titlebar; ?></h3>
      </div>
      <div style="margin-left:497px;">
        <!--  <label for=fader>Miles</label>
        <input type=range min="0" max="200"  value="70" id="fader" step="5" oninput="outputUpdate(value)">
        <input for=fader id="volume" name="miles" size="3">70</input>  -->
    </div>

      <div style="float:right;" id="panel">
              <form action="" method="get">
                 <label >Miles</label>
                 <input id="volume" size="3" value="<?php echo $miles; ?>" placeholder="70"></input>
                  <input type="range" min="5" max="200" value="<?php echo $miles; ?>"  step="5" size="5" name="miles" oninput="outputUpdate(value)"/> 
                  
                  <script>
                    function outputUpdate(vol) {
                    document.querySelector('#volume').value = vol;
                    }
                  </script>
                <input  id="address" size="12" type="text" placeholder="Zip Code" value="<?php echo $urlzip; ?>"name="zipcode"/>
                <input type="submit" value="Find Shows" name="SubmitButton" onclick="codeAddress()" />
              </form>    
      </div> 
    </div>
  <br> <br>
  <table class="zumic-table tdate"  border="1" cellpadding="3">
  <tbody>
  <th><div class="tourdate">Date</div></th>
  <th><div class="tourcv">Artist / Location</div></th>
  <th><div class="ticshow"><div class="tourtic">Primary Tickets</div></div></th>
  <!-- <th><div class="ticshow"><div class="tourtic">Secondery  Tickets</div></div></th> -->
   <th><div class="tourtic">More Info</div></th> 
  </tbody>
  </table>
</div>
                    
    <h3 class="tagstitle" style="font-size:0px;"></h3> 
            <?php
                $timecutoff = date("Y-m-d");
                // $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'events',
                    'orderby' => 'meta_value',
                    'meta_key' => 'event_date',
                    'meta_compare' => '>=',
                    'meta_value' => $timecutoff,
                     'paged' => get_query_var('paged'),
                    'posts_per_page' => 1350, 
                    'order' => 'ASC',
                    'ignore_sticky_posts' => true
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
                    if(isset($_GET['SubmitButton'])){
                       $max_distance = $miles;
                     }

            ?>

                          
    <?php if ($hav_distance <= $max_distance) { ?>

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
              </div></b>
              </td>
              <td>
              <div class="eventtit">
                <a style="color:black;"href="<?php the_permalink() ?>">
                  <b>  <?php // THE TITLE //
                            $titlesub = get_the_title();
                            echo substr( $titlesub, 0, -15); 
                        ?>
                  </b>

                </a>
              </div>
              </td>

              
              <div class="ticshow">
                <td>
                  <div class="ticshow">
                      <div class="eventtic">
                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                          <?php
                            $axs = get_field('url_axs');
                            $evenko = get_field('url_evenko');
                            $live = get_field( 'url_livenation' );
                            $stubhub = get_field('url_stubhub');
                            $subw = get_field('url_stubwire');
                            $ticfly = get_field( 'url_ticketfly' );
                            $ticmaster = get_field( 'url_ticketmaster' );
                            $ticweb = get_field( 'url_ticketweb' );
                            $ticketone = get_field('url_ticketone'); 
                            $flavorus = get_field('url_flavorus');
                            $ticketcorner = get_field('url_ticketcorner');
                            //$venue = get_field('url_venue');

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
               
                              <?php }elseif($stubhub) { ?> 

                                        <a href="<?php the_field( 'url_stubhub' ); ?>" target="_blank" >
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/03/stubhub-logo.jpg">  
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

                              <?php }elseif( get_field('url_venue') ){  ?>

                                        <a href="<?php the_field( 'url_venue' ); ?>" target="_blank">
                                        <?php if( get_field('sold_out') ){ ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                        <?php } else { ?>
                                        <img style="width:100px;height:32px;" src="http://zumic.com/wp-content/uploads/2015/04/venue-ticketsx.jpg">
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

                                <img style="width:auto;height:32px;border:none;" src="http://zumic.com/wp-content/uploads/2015/03/ticc2.png">

                          <?php } ?>
                    

                          </a>
                      </div>
                    </div>
                  </td>
                </div>
                 <div class="ticshow">
                    <td>
                    <div class="ticshow">
                      <div class="eventtic">
                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
<!-- 
                        <?php 
                       
                            $supstar = get_field( 'url_superstar');
                            $ticnow  = get_field('url_ticketsnow');
                            $viago   = get_field('url_viagogo');

                        if ( $supstar ) { 
                        ?>
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
                      <?php } ?> -->


                          </a>
                      </div> 
                    </div>
                    </td>
                  </div>
                      <td>
                <div class="ticshow">
                  <div class="eventtic">
                  <a style="background-color:black;max-width:100px;!important" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
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
        <br>        
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
        </tr>
    <br>
    <?php if ($hav_distance >= $max_distance) { ?>
    <style>
        .sidebar-geotitle{display: none;}
    </style>
    
    <?php } ?>
   

<br>
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->


</div>
</div>
</div>



<?php get_footer(); ?>