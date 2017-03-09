<style>
div.concertsb6 {margin-top: 100px;}
h1#page_title {width: auto;}
.page-title {font-size: 1.7em;text-transform: uppercase;width: 65%;}
.entry-content .addthis_toolbox {margin-left: -100px;}
div#main {width: 100%;}
div.sidecenter2 {margin-top: 0px;}
.sec-content {margin-top: 200px;}
div.concertsb2 {margin-left: 3%!important;}
div.sidebar.grid-4.last.clearfix {margin-top: -100px!important;}
.tags-wrapper img {float: left;margin-top: -100px;padding-bottom: 0px!important;padding-right: 0px!important;margin-left: -10px;}
.comments{padding-top:0px;} 
@media only screen and (max-device-width: 480px) { 
.comments{padding-top:auto;}
.bb2 {padding-left: 0px!important;width: 465px;}
.page-title {width: 308px;margin-top: 0px!important;}
.sec-content {margin-top: -40px;}
}
@media only screen and (min-width: 1030px) {
.body-border2 {max-width: 640px!important;}
}
@media only screen and (min-width: 1240px) {
.body-border2 {max-width: 740px!important;}
}
</style>
<?php get_header(); ?>
 <div id="content">

<div id="inner-content" class="wrap clearfix">

<div id="main" class="first clearfix" role="main">
   

  <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

    <section class="entry-content clearfix <?php echo $grid_l; ?> scrollable-col">

<div class="body-border2"> 
                <header class="article-header">
                  <h1 id="page_title" class="page-title music-videos-title entry-title">
                    <?php the_title(); ?>
                  </h1> 
                </header>                          
    <section>
        <div id="main" class="grid-8 first clearfix" role="main">

        <div class="main-content">
                        <div class="venueimg">
                         <?php
                          if(has_post_thumbnail()){
                            the_post_thumbnail( 'related-thumb' );}
                            else{
                               echo "<img src='wp-content/uploads/2014/09/venuedefault.jpg'>";
                              }
                         ?> 
                       </div>    
                         <br>
                         <br>
               <div class="venue-info">
                        
                          <?php if ( get_field('address_name')): ?>
                            <span class="tags-title2" style="">Address: <a href="https://maps.google.ca/maps?center=<?php the_field('address_name'); ?> ?>&q=<?php the_field('address_name'); ?>" target="_blank" >(map)</a>
                             </span>
                             <br>
                              <?php the_field( "address_street" ); ?>
                            <br>
                              <?php the_field( 'address_city' );?>,
                              <?php the_field( 'address_state' ); ?>
                              <?php the_field( 'address_postcode'  ); ?>
                            <br>
                              <?php the_field( 'address_country' ); ?>
                        <br>
                          <?php endif; ?>

                           <?php if( get_field('phone_number') ): ?>
                            
                              <span class="tags-title2">Phone number: </span>
                            <br>
                              <?php the_field('phone_number'); ?>
                           
                          <?php endif; ?>
                        <br>
                        <br>
                            <?php if( get_field('website') ){  ?>
                                <strong style="font-size:18px;"><a href="<?php the_field( 'website' );?>" target="_blank">-Offical Venue Website-</a><br><br>
                        
                                </strong>
                                <?php } else { ?>
                                <?php echo " "; ?>
                            <?php } ?> 
                            
                   </div>    
      </div> 
      <div class="sec-content">
                      <div class="tags-wrapper">
                          <h2 class='title-headline' style="font-weight:normal!important;">Concert Calendar</h2>     

          <?php
      


          //for in the loop, display all "content", regardless of post_type,
          //that have the same custom taxonomy (e.g. genre) terms as the current post
          $backup = $post;  // backup the current object
          $found_none = '<h2>No Upcoming Events In Our Database.</h2>';
          $taxonomy = 'venue-name';//  e.g. post_tag, category, custom taxonomy
          $param_type = 'venue-name'; //  e.g. tag__in, category__in, but genre__in will NOT work
          //$post_types = get_post_types( 'events' );
          $timecutoff = date("Y-m-d");
          //$tax_args=array('orderby' => 'none');
          $tags = get_the_terms( $post->ID , 'venue-name' );
          if ($tags) {
            foreach ($tags as $tag) {
              $args = array(
                        'post_type' => 'events',
                        'meta_value' => $timecutoff,
                        'orderby' => 'meta_value',
                        'meta_key' => 'event_date',
                        'meta_compare' => '>=',
                        //'value' => date('Y-m-d', strtotime('-6 hours')), //value of "order-date"
                        'order' => 'ASC',
                        'venue-name' => $tag->slug,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 133, 
                        'caller_get_posts'=>1,

                    );
            $my_query = null;
            $my_query = new WP_Query($args);
            if( $my_query->have_posts() ) {
              while ($my_query->have_posts()) : $my_query->the_post(); ?>

                <div class="TiqiqEventsList">
                        <div class="TiqiqEventRow">
                            <div class="TiqiqEventDate">
                                <strong>
                                  <a href="<?php the_permalink() ?>" class="TiqiqEventBuyButton" title="">
                                  <span style="color:#ddd;">
                                  <?php
                                    $dateformatstring = "l, M jS ";
                                    $unixtimestamp = strtotime(get_field('event_date'));
                                    echo date_i18n($dateformatstring, $unixtimestamp);
                                  ?>
                                </span>
                              </br></strong>          
                           </div>
                            <div class="TiqiqEventName">
                            
                            <span class="TiqiqEventVenueNameText" style="padding:10px;color:#ddd;"><b><?php the_field( "artists" ); ?></b><br></span>
                            </div>
                            <div class="TiqiqEventBuy">
                            <strong>Tickets</strong>
                              </a>
                              </div>
                          </div>              
                  </div>
                <?php $found_none = '';
              endwhile;
            }
          }
        }
        if ($found_none) {
        echo $found_none;
        }
        $post = $backup;  // copy it back
        wp_reset_query(); // to use the original query again
        ?>
      </div>
      <br>
       <div class="social-share clearfix">
                          <div class="social-share-link">
                            <div class="share-link-box">
                              <?php // print get_permalink(); ?>
                            </div>
                          </div>
                          
                  </div>  

           <div id="comments" class="comments" >
              <div class="comments-curtain"></div>
              <?php comments_template(); ?>
            </div>
             </div>
      </section>   
</div>


<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->


<div class="sidebar grid-4 last clearfix" role="complementary">
                     
<!--SideBARAIIB -->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--||||||||||||||||||||||||||||||GEO-LOCATION|||||||||||||||||||||-->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<div class="concertsb6" >
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
        function get_client_ip_server() {
            $ipaddress = '';
            if ($_SERVER['HTTP_CLIENT_IP'])
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if($_SERVER['HTTP_X_FORWARDED_FOR'])
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if($_SERVER['HTTP_X_FORWARDED'])
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if($_SERVER['HTTP_FORWARDED_FOR'])
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if($_SERVER['HTTP_FORWARDED'])
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if($_SERVER['REMOTE_ADDR'])
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        $geoplugin  = maybe_unserialize( wp_remote_fopen('http://www.geoplugin.net/php.gp?ip=' . get_client_ip_env()) );
        $user_lat   = $geoplugin['geoplugin_latitude'];
        $user_long  = $geoplugin['geoplugin_longitude'];
    ?>
    <h3></h3>
    <div class="zumic-a clearfix">
         <a href="" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:auto!important" src="http://zumic.com/wp-content/uploads/2015/03/zumic-logo-brushed-steel.png" >   
        </a>
          <div class="sidebar-geotitle">

           <div class="folded"><h2><strong>shows near you</strong></h2></div>
                
            <div style="" id="panel2">
                      <form action="local-concert-listings/" method="get">
                        <input  id="address" size="9" type="text" placeholder="ZIP Code" name="zipcode"/>
                  <div style="display:none;">
                          <input id="volume" size="1" name="miles" value="70" placeholder="70"></input>
                  </div>      
                        <input  type="submit" value="GO" name="SubmitButton" onclick="codeAddress()" />
                      </form>    
                </div>
        </div>  
    </div>                  
    <h3 class="tagstitle" style="font-size:13px;"></h3> 
            <?php
                $timecutoff = date("Y-m-d");
                $args = array(
                    'post_type' => array('events'),
                    'orderby' => 'meta_value',
                    'meta_key' => 'event_date',
                    'meta_compare' => '>=',
                    'meta_value' => $timecutoff,
                    'posts_per_page' => 70, 
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

            ?>
    <?php if ($hav_distance <= $max_distance) { ?>
    <style>
        .sidebar-geotitle2{display: none;}
        .hideclass{display: none;}
        .sidebar-geotitle{display: inline!important;}
    </style>
    <div class="hov">   
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
           <table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#ddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#ddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                            <?php // THE TITLE //
                                $titlesub = get_the_title();
                                echo substr( $titlesub, 0, -15); 
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table>  
            <br>
        </a>
        </div>  
        
    <?php } ?>

    <?php endwhile; 
    wp_reset_postdata(); ?>
    <?php else: ?>
    <style>
        .sidebar-geotitle{display: none;}
        .hideclass{display: none;}
    </style>
    <div class="sidebar-geotitle2">
        <p>presents top tours</p>
        <hr style="margin-right:15px;margin-left:25px;height:.2%;">
    </div>
        <div>
            <?php
                $args = array(
                    'post_type' => array( 'post', 'music-videos' ), 
                    'post_status' => 'publish', 
                    'posts_per_page' => 2, 
                    'orderby'  => 'menu_order',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => array( 'concert-announcements' ),
                            'operator' => 'IN'
                        )
                    ),  
                );
                $the_query = new WP_Query($args);
                while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
                <div class="item link" data-href="<?php the_permalink(); ?>">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                         <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
                    </a>
                    <div class="single-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a></div>
                </div>                     
                <?php 
                endwhile;
                wp_reset_postdata();
                ?>
        </div>
        <br>        
    <?php  endif; ?>
    <?php  wp_reset_postdata(); ?>
        </tr>
    <br>
    <?php if ($hav_distance >= $max_distance) { ?>
    <style>
        .sidebar-geotitle{display: none;}
    </style>
    <div class="hideclass">
        <div class="sidebar-geotitle2">
            <p>presents top tours</p>
            <hr style="margin-right:15px;margin-left:25px;height:.2%;">
        </div>
                <?php
                    $args = array(
                        'post_type' => array( 'post', 'music-videos' ), 
                        'post_status' => 'publish', 
                        'posts_per_page' => 2, 
                        'orderby'  => 'menu_order',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => array( 'concert-announcements' ),
                                'operator' => 'IN'
                            )
                        ),  
                    );
                    $the_query = new WP_Query($args);
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                ?>  
                <div class="item link" data-href="<?php the_permalink(); ?>">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                         <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
                    </a>
                    <div class="single-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a></div>
                </div>                     
    <?php  endwhile;
    wp_reset_postdata(); ?>
            </div>  
    <?php } ?>
    <div class="zumic-a clearfix">
        <h3>Powered By</h3><br>
        <a href="https://www.superstartickets.com/Concerts" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:200px;!important" src="http://dev.zumic.com/wp-content/uploads/2015/03/SUPERSTAR_LOGOv2-03-11.jpg" >   
        </a>
        
    </div> 
</div>
<br>
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<div class="sidecenter2">
                      <div class="block-newsletter-signup2 clearfix">
                        <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
                      </div>
                   </div>
</div>
   <div class="zumic-a clearfix" style="width:100%; padding-left:12px;">
                  <?php echo get_responsive_adsense( get_the_ID(), '4683217536' ); ?>
              </div>
              <br><br>
  </div>
</div>   

      <script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/lightbox.min.js"></script>                    
<?php get_footer(); ?>





