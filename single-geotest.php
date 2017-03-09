<?php 
$has_right_col = get_field( "media_column" ) ? true : false;
$grid_l = $has_right_col ? 'grid-6' : 'grid-8';
?>
<style>
div.yasr-container-custom-text-and-overall {
  display: none;
}
div.yasr-container-custom-text-and-visitor-rating {
  display: none;
}

</style>


<?php get_header(); ?>

      <div id="content">

        <div id="inner-content" class="wrap clearfix">

            <div id="main" class="first clearfix" role="main">
              <?php echo do_shortcode('[ssba]'); ?>

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

                <section class="entry-content clearfix <?php echo $grid_l; ?> scrollable-col">

                  <header class="article-header">


                    <h1 id="page_title" class="page-title music-videos-title entry-title">

                      <?php
                        $title = the_title('', '', false); 
                        echo strtoupper($title);
                      ?>
                    </h1>
                    
                 
                    
                  </header>

                  
                
               
              <div class="eventbody">

    
                  <p class="tags">
                   
                <?php
                    if(has_post_thumbnail()){
                      the_post_thumbnail( 'related-thumb' );}
                      else{
                         echo '<img src="wp-content/uploads/2014/10/eventdefault.jpg">';
                        }
                   ?>
                   <?php
                      $thumbnail_id=get_the_post_thumbnail($post->ID);
                      preg_match ('/src="(.*)" class/',$thumbnail_id,$link);
                      echo $link[1];
                    ?>
          <a href="<?php echo $link[1]; ?>" rel="lightbox">
            <?php the_post_thumbnail('related-thumb'); ?>
          </a>
        
    

                <div class="eventcont">
                 



                   <p class="tags4">

                    <?php if( get_field('event_date') ): ?>


                <strong class="tags-title2" >Date:</strong>
                    <br>
                  <?php
                    $dateformatstring = "l, F jS, Y ";
                    $unixtimestamp = strtotime(get_field('event_date'));
                    echo date_i18n($dateformatstring, $unixtimestamp);
                    ?>
                  <?php endif; ?>
                  <br>

                <strong class="tags-title2" >Time:</strong>
                    <br>
                    <?php
                    $dateformatstring1 = "g:i a ";
                    $unixtimestamp1 = strtotime(get_field('event_time'));
                    $unixtimestamp2 = strtotime(get_field('show_time'));
                    $unixtimestamp3 = strtotime(get_field('door_time'));
                    ?>
                   
                  
                  <?php if( get_field('door_time') && get_field('show_time') ): ?>

                              <p><strong>Door Time:&nbsp;</strong><?php echo date_i18n($dateformatstring1, $unixtimestamp3); ?></p>
                              <p><strong>Show Time:&nbsp;</strong><?php echo date_i18n($dateformatstring1, $unixtimestamp2); ?></p>
                      <?php  else: ?>
                      <?php if( get_field('event_time') ): ?>
                              <p><?php echo date_i18n($dateformatstring1, $unixtimestamp1); ?></p>
                      <?php endif; ?>
                  <?php endif; ?>

                          <!-- 
                          <?php if( get_field('show_time') ): ?>
                          <p><strong>Show Time:&nbsp;</strong><?php echo date_i18n($dateformatstring1, $unixtimestamp2); ?></p>
                          <?php  else: ?>
                          <?php if( get_field('event_time') ): ?>
                          <p><?php echo date_i18n($dateformatstring1, $unixtimestamp1); ?></p>
                          <?php endif; ?>

                          <?php endif; ?> -->

                          <!-- 
                          <?php if(the_field('event_time')){  
                          echo date_i18n($dateformatstring1, $unixtimestamp1);
                          ?>
                          <?php }else{
                          echo "Check with venue";
                          } ?> 
                          -->
                    
                    <?php
                      $taxonomy = 'venue-name';
                      $param_type = 'venue-name';
                      $tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
                      if ($tags) {
                        foreach ($tags as $tag) {
                          $args = array(
                                      'post_type' => 'venues',
                                      "$param_type" => $tag->slug,
                                      'post__not_in' => array($post->ID),
                                      'showposts'=> 1,    
                                  );
                          $my_query = new WP_Query($args);
                          if( $my_query->have_posts() ) {
                            while ($my_query->have_posts()) : $my_query->the_post(); 
                    ?>   
                    <br>
                    <strong class="tags-title2" style="">Address: <a href="https://maps.google.ca/maps?center=<?php the_field('address_name'); ?> ?>&q=<?php the_field('address_name'); ?>" target="_blank" >(map)</a>
                     </strong>
                     <br>
                           <?php the_field( "address_street" ); ?>
                      <br>
                        <?php the_field( 'address_city' );?>,
                        <?php the_field( 'address_state' ); ?>
                        <?php the_field( 'address_postcode'  ); ?>
                      <br>
                        <?php the_field( 'address_country' ); ?>

                        <br>
                      
                        <?php $found_none = '';
                            endwhile;
                          }
                        }
                      }
                      if ($found_none) {
                      echo $found_none;
                      }
                      wp_reset_query();
                    ?>

                    </p>
                  </div>
              </div>
              <br>
              <br>  
              <br>
              <br>
              <br>
              <br>
              <?php the_content(); ?>



<div id="tickets" class="component tickets">
  <h2 style="margin-top:336px" class="title-headline">Buy Tickets</h2>
  <?php if( get_field('sold_out') ){ ?>
  <style>
  .tickets .button.new-tab{
    display: none!important;
  }
  </style>
    <h3 class="soldout">SOLD OUT!</h3>
<?php } else { } ?>

<!-- ::|:Prime Tickets:|:: -->
  <?php if( get_field('url_ticketmaster') ){  ?>
              <div class="ticket-wrapper">
                <a href="<?php the_field( 'url_ticketmaster' ); ?>" target="_blank">
                  <div class="ticket-cell">
                    <span class="vendor">Ticketmaster/Livenation:</span>
                  </div>
                  <div class="ticket-cell">
                        <span class="price">
                        <span class="addendum"></span>
                        </span>
                  </div>
                  <div class="ticket-cell buy-button-container">
                      <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span>
                      </span>              
                  </div>
                </a>
              </div> 
  <?php }elseif( get_field('url_axs') ){  ?>
              <div class="ticket-wrapper">
                <a href="<?php the_field( 'url_axs' ); ?>" target="_blank">
                  <div class="ticket-cell">
                    <span class="vendor">AXS:</span>
                  </div>
                  <div class="ticket-cell">
                        <span class="price">
                          <span class="addendum"></span>
                        </span>
                  </div>
                  <div class="ticket-cell buy-button-container">
                      <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
                  </div>
                </a>       
              </div>
  <?php }elseif( get_field('url_ticketweb') ){  ?>
               <div class="ticket-wrapper">
                <a href="<?php the_field( 'url_ticketweb' ); ?>" target="_blank">
                  <div class="ticket-cell">
                    <span class="vendor">TicketWeb:</span>
                  </div>
                  <div class="ticket-cell">
                        <span class="price">
                          &nbsp;<?php //the_field( 'price_superstar' ); ?>
                          <span class="addendum"></span>
                        </span>
                  </div>
                  <div class="ticket-cell buy-button-container">
                      <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
                  </div>
                </a>
              </div>
  <?php } else { ?>
<span class="vendor">Primary Tickets:</span>

                <span class="price">
              Check With Venue/ Artists
                </span>
        
  <?php } ?> 


  
      <!-- ||||||||||||||||||||||||||||||||||||||||||||||||||| -->
  <?php if( get_field('url_stubhub') ): ?>
        <div class="ticket-wrapper">
        <a href="<?php the_field( 'url_stubhub' ); ?>" target="_blank">
          <div class="ticket-cell">
            <span class="vendor">StubHub:</span>
          </div>
          <div class="ticket-cell">
                <span class="price">
                  <span class="addendum"></span>
                </span>
          </div>
          <div class="ticket-cell buy-button-container">
              <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
          </div>
        </a>
      </div> 
  <?php elseif( get_field('url_vip') ): ?>
        <div class="ticket-wrapper">
        <a href="<?php the_field( 'url_vip' ); ?>" target="_blank">
          <div class="ticket-cell">
            <span class="vendor">VIP Tickets:</span>
          </div>
          <div class="ticket-cell">
                <span class="price">
                  <span class="addendum"></span>
                </span>
          </div>
          <div class="ticket-cell buy-button-container">
              <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
          </div>
        </a>
      </div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->
  <?php elseif( get_field('url_superstar') ): ?>
        <div class="ticket-wrapper">
        <a href="<?php the_field( 'url_superstar' ); ?>" target="_blank">
          <div class="ticket-cell">
            <span class="vendor">SuperStar Tickets:</span>
          </div>
          <div class="ticket-cell">
                <span class="price">
                  <span class="addendum"></span>
                </span>
          </div>
          <div class="ticket-cell buy-button-container">
              <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
          </div>
        </a>
      </div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->
  <?php elseif( get_field('url_ticketsnow') ): ?> 
        <div class="ticket-wrapper">
        <a href="<?php the_field( 'url_ticketsnow' ); ?>" target="_blank">
          <div class="ticket-cell">
            <span class="vendor">Tickets Now:</span>
          </div>
          <div class="ticket-cell">
                <span class="price">
                  <span class="addendum"></span>
                </span>
          </div>
          <div class="ticket-cell buy-button-container">
              <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
          </div>
        </a>
      </div>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->
  <?php elseif( get_field('url_ticketliquidator') ): ?> 
        <div class="ticket-wrapper">
        <a href="<?php the_field( 'url_ticketliquidator' ); ?>" target="_blank">
          <div class="ticket-cell">
            <span class="vendor">Ticket Liquidator:</span>
          </div>
          <div class="ticket-cell">
                <span class="price">
                  <span class="addendum"></span>
                </span>
          </div>
          <div class="ticket-cell buy-button-container">
              <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
          </div>
        </a>
      </div>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||| -->
  <?php elseif( get_field('url_viagogo') ): ?> 
        <div class="ticket-wrapper">
        <a href="<?php the_field( 'url_viagogo' ); ?>" target="_blank">
          <div class="ticket-cell">
            <span class="vendor">Viagogo:</span>
          </div>
          <div class="ticket-cell">
                <span class="price">
                  <span class="addendum"></span>
                </span>
          </div>
          <div class="ticket-cell buy-button-container">
              <span class="buy-tickets new-tab button"><span>Buy&nbsp;tickets</span></span>
          </div>
        </a>
  <?php endif; ?>
      </div>
<!--  |||||||||||||||||||||||||||||||||||||||||||||| -->


          



              <!--  <div class="ticket-wrapper"> -->
               
               
              




               <!-- || Primary Ticket  link & Price|| -->
               <!-- <div class="ticket-cell">
                    <h1>Tiqiq:</h1><a href="<?php the_field( 'url_tiqiq' ); ?>">Tickets</a>
                    
                    <br>
                    <h1>Ticket Master:</h1><a href="<?php the_field( 'url_ticketmaster' ); ?>">Tickets</a>
              
                    <br> 
                    <h1>Superstar Tickets:</h1><a href="<?php the_field( 'url_superstar' ); ?>">Tickets</a>
                    </div>
                    </div> 
               -->
                

                <!--   <div class="tags-wrapper">

                    <p class="tags"><?php echo get_the_term_list( get_the_ID(), 'media-type', '<span class="tags-title">' . __( 'Media Type:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
                    <p class="tags"><?php echo get_the_term_list( get_the_ID(), 'music-genres', '<span class="tags-title">' . __( 'Genres:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
                    <p class="tags"><?php echo get_the_term_list( get_the_ID(), 'local-music', '<span class="tags-title">' . __( 'Locations:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
                    <p class="tags">
                      <span class="tags-title">Tags:</span>
                      <?php
                        $tags = wp_get_post_tags( $post->ID, ['fields' => 'all'] );
                        $tags_output = array(
                            "artists" => [],
                            "venues" => [],
                            "tags" => []
                          );
                        foreach ($tags as $key => $value) {
                          //echo $value->slug;
                          $artist_args = [
                            'name' => $value->slug,
                            'post_type' => 'artists',
                            'post_status' => 'publish',
                            'numberposts' => 1
                          ];
                          $venue_args = [
                            'name' => $value->slug,
                            'post_type' => 'venues',
                            'post_status' => 'publish',
                            'numberposts' => 1
                          ];
                          $artist_page = get_posts($artist_args);
                          $venue_page = get_posts($venue_args);
                          if($artist_page) {
                            $tags_output['artists'][] = "<a href='/artists/" . $value->slug ."'>" . $value->name . "</a>";
                          }
                          else if($venue_page) {
                            $tags_output['venues'][] = "<a href='/venues/" . $value->slug ."'>" . $value->name . "</a>";
                          }
                          //else {
                            $tags_output['tags'][] = "<a href='/tag/" . $value->slug ."'>" . $value->name . "</a>";
                          //}
                        }

                        if($tags_output) {
                            print implode(', ', $tags_output['tags']);
                        }
                      ?>
                    </p>
                  </div> -->

                  <div class="social-share clearfix">

                    <div class="social-share-link">
                      <div class="share-link-box">
                        <?php // print get_permalink(); ?>
                      </div>
                    </div>

                    <?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
                    
                  </div>

                  <div id="comments" class="comments">
                    <div class="comments-curtain"></div>
                    <?php comments_template(); ?>
                  </div>

                </section>
                
                <?php if( $has_right_col ): ?>
                  <section class="entry-content media-content clearfix grid-6 last scrollable-col">
                    

                    <div class="zumic-a clearfix">
                      <?php echo get_adsense( get_the_ID(), '6947609136', '336x280' ); ?>
                    </div>

                  </section>

                <?php else: ?>

<div class="sidebar grid-4 last clearfix" role="complementary">


                    <div class="block-newsletter-signup3 clearfix">
                        <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
                        </div> 
                  


      <?php 
        $post_tags = wp_get_post_terms( 
          get_the_ID(), 
          'post_tag', 
          ['fields' => 'slugs'] 
        );
        $related_artists = get_artists_by_slug( $post_tags );
        if( $related_artists ):
      ?>
        <div class="block-related-artists">
          <h2 class="title-headline">Artists</h2><br>
          <?php 
            foreach( $related_artists as $key => $artist ): 
          ?>
            <div class="related-posts-item clearfix">
              <div class="img-wrapper">
                <?php printf( "<a href='/artists/%s'>%s</a>", $artist->post_name, get_the_post_thumbnail( $artist->ID, 'col-4-img-thumb' ) ); ?>
              </div>
              </br>
              <div class="single-title" style="margin-top:15px;"><br>
                <?php printf( "<a href='%s' style='margin-top: 20px;' title='%s'><h3>%s</h3></a>", $artist->post_name, $artist->post_title, $artist->post_title ); ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>




       
<h2 class="title-headline">Venue</h2><br>

<?php
$backup = $post;  // backup the current object
$found_none = '<h2>No Venue.</h2>';
$taxonomy = 'venue-name';//  e.g. post_tag, category, custom taxonomy
$param_type = 'venue-name'; //  e.g. tag__in, category__in, but genre__in will NOT work
$tax_args=array('orderby' => 'none');
$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
if ($tags) {
  foreach ($tags as $tag) {
    $args = array(
                'post_type' => 'venues',
                "$param_type" => $tag->slug,
                'post__not_in' => array($post->ID),
                'showposts'=> 1,    
            );
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
         
              <div class="block-related-artists">
              <div class="related-posts-item clearfix">
              <div class="img-wrapper">
                 <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                   <?php if(has_post_thumbnail()){
                        the_post_thumbnail( 'related-thumb' );
                      }else{
                         echo "<img src='wp-content/uploads/2014/09/venuedefault.jpg'>"; }
                   ?>
                 </a>
              </div>
              </br>
              <div class="single-title" style="margin-top:15px;"><br>

                <h3><a href="<?php the_permalink() ?>"><?php the_title()?></a></h3>
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


   
<?php get_sidebar(); ?>

</div>

                <?php endif; ?>

                <footer class="article-footer"></footer>

              </article>

              <?php endwhile; ?>

              <?php else : ?>

                  <article id="post-not-found" class="hentry clearfix">
                  
                    <header class="article-header">
                      <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
                    </header>

                    <section class="entry-content">
                      <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
                    </section>

                    <footer class="article-footer">
                      <p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
                    </footer>

                  </article>

              <?php endif; ?>

            </div>

            <?php 
              // global $post;
              // $tags = wp_get_post_tags( $post->ID, ['fields' => 'ids'] );
              // $types = array( 'music-videos' );
              // $related_artists = get_related_artists_by_tags( $types, get_the_ID(), $tags );
              
              // if( $related_artists->posts ):
              if( false ):
            ?>

            <div class="block-related-music clearfix">
              <h1>Related Music</h1>
              <?php
                  $i = 1;
                  foreach( $related_artists->posts as $post ):
                    setup_postdata( $post );
              ?>
                  <div class="related-posts-item entry-content clearfix grid-3<?php if($i % 4 == 0) echo ' last'; ?>">
                    <div class="img-wrapper">
                      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail( 'related-thumb' ); ?>
                      </a>
                    </div>
                    <div class="post-date"><?php echo get_the_time('M j, Y'); ?></div>
                    <div class="title-wrapper">
                      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                        <?php echo get_the_title(); ?>
                      </a>
                    </div>
                  </div>
              <?php $i++; endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="block-related clearfix sidebar">

            <div class="zumic-a clearfix">
              <?php// echo get_responsive_adsense( get_the_ID(), '919205536' ); ?>
            </div>
            
              <?php // if( $has_right_col ): ?>
                <div class="block-related-music grid-4">
                  <?php echo show_related_posts( ['music-videos'], 4, 'sm-thumb', 0, 'Related Music' ); ?>
                </div>
              <?php // endif; ?>

              <div class="block-related-news grid-4">
                <?php echo show_related_posts( ['post'], 4, 'sm-thumb', 0, 'Related News' ); ?>
              </div>
              
              <div class="block-related-latest-news grid-4 last">
                <?php 
                  echo '<h2 class="title-headline">New Music</h2>';
                  include( TEMPLATEPATH . "/parts/latest-news-sm.php" );
                ?>
              </div>
            </div>

            <div class="zumic-a clearfix">
              <?php //echo get_responsive_adsense( get_the_ID(), '468217536' ); ?>
            </div>

        </div>

      </div>

      <script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/lightbox.min.js"></script>

<?php get_footer(); ?>

