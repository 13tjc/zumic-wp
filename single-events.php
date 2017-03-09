<?php 
$has_right_col = get_field( "media_column" ) ? true : false;
$grid_l = $has_right_col ? 'grid-6' : 'grid-8';
?>
<style>
  table.zumic-table {margin-left: 10px;}
  .title-headline2{border-bottom: 10px solid #979797;width: 275px;margin-left: -15px;}
  .popmcxx{line-height:50px;width:325px;}
  .addthis_toolbox {display: none!important;}
  div.yasr-container-custom-text-and-overall {display: none;}
  div.yasr-container-custom-text-and-visitor-rating { display: none;}
  .img-wrapper img {width: 100px;}
  div.widget.clicky-popular-posts-widget .single-title {width: 100%!important;margin-right: -163px!important;}
  div.block-related.clearfix.sidebar {width: 103%!important;}
@media only screen and (min-width: 768px) { 
  .title-headline2{border-bottom: 10px solid #979797;width: 275px;margin-left: -5px;color:#ddd;}
  div.block-related-latest-news.grid-4.last {width: 34%!important;} 
  div.widget.clicky-popular-posts-widget .single-title {margin-right: -96px!;}
  .single-title h1 {margin-left: -160px!important;}
}
@media only screen and (min-width: 1030px) { 
  .popmcxx{line-height:50px;width:305px;}
  div.block-related-latest-news.grid-4.last {margin-top: -25px!important;}
  div.widget.clicky-popular-posts-widget .single-title {margin-left: -99px!important;}
  .img-wrapper img { width: 105px;}
  div.block-related.clearfix.sidebar {width: 100%!important;}
  .title-headline {width: 325px;}
  .single-title h1 {margin-left: -160px!important;}
}
</style>
<?php get_header(); ?>
      <div id="content">
        <div id="inner-content" class="wrap clearfix">
            <div id="main" class="first clearfix" role="main">
              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                <section class="entry-content clearfix <?php echo $grid_l; ?> scrollable-col">
<div class="body-border">
                  <header >
                    <h1 class="page-title">
                      <?php
                        $title = the_title('', '', false); 
                        echo $title;
                      ?>
                    </h1> 
                  </header>
            <div class="eventbody main">
            <?php
                if(has_post_thumbnail()){ ?>          
                    <?php the_post_thumbnail('event-img'); ?>
              <?php
                }else{
                echo '<img src="wp-content/uploads/2014/10/eventdefault.jpg">';
                }
            ?>
<?php
    $date = date("Y-m-d");
    $eventdate = get_field('event_date');
      if ( strtotime($date) > strtotime($eventdate) ) { ?>
    <style>.eventcont{display: none;}</style>
<?php } ?>
<div class="eventcont">        
<div id="tickets" class="component tickets">
  <br><br><br>
  <h2 style="margin-top:auto;margin-bottom:20px!important;padding-top:130px" class="title-headline">Tickets</h2>
<!--PrimeTickets|--><?php if( get_field('url_ticketmaster') ){  ?>
                         <div class="ticket-wrapper">
                            <div class="ticket-cell buy-button-container">
                                  <?php if( get_field('sold_out') ) { ?>
                                  <h3 class="buy-tickets new-tab button"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></h3><br>
                                  <?php } elseif ( get_field('free_show') ) { ?>
                                  <h3 class="buy-tickets new-tab button"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></h3><br>
                                  <?php } else { ?>
                                  <span class="buy-tickets new-tab button">
                                    <span> 
                                      <a target="_new" href="<?php the_field( 'url_ticketmaster' ); ?>">
                                        <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/09/ticketmaster-logo.jpg">
                                      </a>  
                                    </span>
                                  </span>
                                  <?php } ?>   
                            </div>
                        </div> 
                    <?php }elseif( get_field('url_livenation') ){  ?>
                                  <div class="ticket-wrapper">
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button">  <a href="<?php the_field( 'url_livenation' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"> </a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button">
                                          <span>
                                            <a href="<?php the_field( 'url_livenation' ); ?>" target="_blank">
                                              <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/live-nation-logox.jpg">
                                            </a> 
                                          </span>
                                        </span>
                                        <?php } ?>
                                      </div>
                                  </div>
                    <?php }elseif( get_field('url_ticketfly') ){  ?>
                                  <div class="ticket-wrapper">
                                   
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ){ ?>
                                        <h3 class="buy-tickets new-tab button">
                                           <a href="<?php the_field( 'url_ticketfly' ); ?>" target="_blank">
                                          <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">
                                          </a>  
                                        </h3>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button">
                                           <a href="<?php the_field( 'url_ticketfly' ); ?>" target="_blank">
                                          <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">
                                          </a>  
                                        </h3>
                                        <br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button">
                                          <span>
                                             <a href="<?php the_field( 'url_ticketfly' ); ?>" target="_blank">
                                            <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketfly-logo-1.jpg">
                                            </a>  
                                          </span>
                                        </span>
                                        <?php } ?>
                                      </div>
                                          
                                  </div> 
                    <?php }elseif( get_field('url_venue') ){  ?>
                                  <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_venue' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">     </a> </h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_venue' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">     </a> </h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_venue' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/venue-ticketsx.jpg">     </a> </span></span>
                                        <?php } ?> 
                                      </div>
                                       
                                  </div>
                    <?php }elseif( get_field('url_ticketweb') ){  ?>
                                   <div class="ticket-wrapper">
                                   
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"> <a href="<?php the_field( 'url_ticketweb' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"> <a href="<?php the_field( 'url_ticketweb' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span> <a href="<?php the_field( 'url_ticketweb' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketweb-logo.jpg"></a></span></span>
                                        <?php } ?>
                                      </div>
                                      
                                  </div>
                    <?php }elseif( get_field('url_eventim_de') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_eventim_de' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">  </a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_eventim_de' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">  </a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_eventim_de' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/eventim-logo.jpg">  </a></span></span>
                                        <?php } ?>
                                      </div>
                                  
                                  </div>
                    <?php }elseif( get_field('url_ticketcorner') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_ticketcorner' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_ticketcorner' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_ticketcorner' ); ?>" target="_blank"> <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/06/tickercorner-logo.jpg"></a></span></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_ticketone') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_ticketone' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">      </a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_ticketone' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">      </a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_ticketone' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/ticketone-it-logo.jpg">      </a></span></span>fvg
                                        <?php } ?>
                                      </div>
                              
                                  </div>
                    <?php }elseif( get_field('url_stubwire') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_stubwire' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_stubwire' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_stubwire' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/stubwire-logo.jpg"></a></span></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_eventim_uk') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_eventim_uk' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_eventim_uk' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_eventim_uk' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/eventim-logo.jpg"></a></span></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_ticketek') ){  ?>
                                   <div class="ticket-wrapper">
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_ticketek' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">  </a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_ticketek' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">  </a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_ticketek' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/ticketek-tickets.jpg">  </a></span></span>
                                        <?php } ?>
                                      </div>
                                  
                                  </div>
                     <?php }elseif( get_field('url_clubtix') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_clubtix' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg">  </a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_clubtix' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg">  </a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button ticNoimg"><a href="<?php the_field( 'url_clubtix' ); ?>" target="_blank"><span>Clubtix</span>  </a></span>
                                        <?php } ?>
                                      </div>
                                  
                                  </div>
                    <?php }elseif( get_field('url_billettservice') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_billettservice' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_billettservice' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button ticNoimg"><a href="<?php the_field( 'url_billettservice' ); ?>" target="_blank"><span>BillettService.no</span></a></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_seatwave') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_seatwave' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_seatwave' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button ticNoimg"><a href="<?php the_field( 'url_seatwave' ); ?>" target="_blank"><span>Seatwave</span></a></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>    
                    <?php }elseif( get_field('url_eventbrite') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                         <span class="buy-tickets new-tab button"><span><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/eventbrite-logo.jpg"></a></span></span>
                                         <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_francebillet') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_francebillet' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_francebillet' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button" style="background-color:black;"><a href="<?php the_field( 'url_francebillet' ); ?>" target="_blank"><span>FranceBillet.com</span></a></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_evenko') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_evenko' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_evenko' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_evenko' ); ?>" target="_blank"> <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/evenko-logo.jpg"></a></span></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_flavorus') ){  ?>
                                   <div class="ticket-wrapper">
                                    
                                      <div class="ticket-cell buy-button-container">
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_flavorus' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_flavorus' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span> <a href="<?php the_field( 'url_flavorus' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/flavorus-logo.jpg"></a></span></span>
                                        <?php } ?>
                                      </div>
                                    
                                  </div>
                    <?php }elseif( get_field('url_axs') ){  ?>
                                  <div class="ticket-wrapper">
                                    
                                    <div class="ticket-cell buy-button-container">
                                        
                                        <?php if( get_field('sold_out') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_axs' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/04/sold-out-tickets.jpg"></a></h3><br>
                                        <?php } elseif ( get_field('free_show') ) { ?>
                                        <h3 class="buy-tickets new-tab button"><a href="<?php the_field( 'url_axs' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/05/free-concert-tickets.jpg"></a></h3><br>
                                        <?php } else { ?>
                                        <span class="buy-tickets new-tab button"><span><a href="<?php the_field( 'url_axs' ); ?>" target="_blank"><img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/axs-logo.jpg"></a></span></span>
                                        <?php } ?>
                                        
                                    </div>
                                         
                                  </div>
                      <?php } else { ?>
                    <?php } ?> 
                    <?php if( get_field('url_vip') ){  ?>
                               <span class="buy-tickets new-tab button" style="margin-left:2px;"><a href="<?php the_field( 'url_vip' ); ?>" target="_blank"><span>VIP Tickets</span> </a> </span> <br><br>
                          <?php } ?>
                                                  
                    <?php 
                    if( 
                      ( !get_field('url_ticketmaster') ) &&
                      ( !get_field('url_vip') ) && 
                      ( !get_field('url_livenation') ) &&
                      ( !get_field('url_axs') ) &&
                      ( !get_field('url_ticketfly') ) &&
                      ( !get_field('url_venue') ) &&
                      ( !get_field('url_ticketweb') ) &&
                      ( !get_field('url_eventim_de') ) &&
                      ( !get_field('url_ticketcorner') ) &&
                      ( !get_field('url_ticketone') ) &&
                      ( !get_field('url_stubwire') ) &&
                      ( !get_field('url_eventim_uk') ) &&
                      ( !get_field('url_eventbrite') ) &&
                      ( !get_field('url_ticketek') ) &&
                      ( !get_field('url_clubtix') ) &&
                      ( !get_field('url_evenko') ) &&
                      ( !get_field('url_billettservice') ) &&
                      ( !get_field('url_seatwave') ) &&
                      ( !get_field('url_flavorus') ) &&
                      ( !get_field('url_francebillet') )
                     ): 
                     ?>
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
                     <?php if ( get_field('website')): ?>
                     <span class="price" style="color:white;">Check With Venue
                      <a href="<?php the_field( "website" ); ?>" target="_blank">Website</a>.
                     </span> 
                         <?php else: 
                           echo "Check With Venue<br><br>";
                         endif; ?>
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
                    <?php endif; ?><!-- ::|:Prime Tickets:|:: end-->
                    <?php
                    if( 
                      ( !get_field('url_stubhub') ) &&
                      ( !get_field('url_superstar') ) && 
                      ( !get_field('url_ticketsnow') ) &&
                      ( !get_field('url_ticketliquidator') ) &&
                      ( !get_field('url_viagogo') )
                     ): 
                     ?>
                  <style>#sec-ticc{display:none;}</style>
                     <?php else: ?>
                  <style>.sec-ticc{display:inline;}</style>
                   <?php endif;  ?>
                  <!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->
                      <?php if( get_field('url_superstar') ): ?>
                          <div class="ticket-wrapper">
                            <div class="ticket-cell buy-button-container">
                                <span class="buy-tickets new-tab button">
                                  <span>
                                    <a href="<?php the_field( 'url_superstar' ); ?>" target="_blank">
                                      <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/superstartickets-logo.jpg">
                                    </a>
                                  </span>
                                </span>
                            </div>
                        </div>
                      <?php endif; ?>
                  <!-- ||||||||||||||||||||||||||||||||||||||||||||||||||| -->
                      <?php if( get_field('url_viagogo') ): ?> 
                            <div class="ticket-wrapper">
                              <div class="ticket-cell buy-button-container">
                                  <span class="buy-tickets new-tab button">
                                    <span>
                                      <a href="<?php the_field( 'url_viagogo' ); ?>" target="_blank">
                                        <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/viagogo-logo.jpg">
                                      </a>
                                    </span>
                                  </span>
                              </div> 
                          </div>
                      <?php endif; ?>
                  <!-- |||||||||||||||||||||||||||||||||||||||||||||||| -->
                      <?php if( get_field('url_ticketliquidator') ): ?> 
                            <div class="ticket-wrapper">
                              <div class="ticket-cell buy-button-container">
                                <a href="<?php the_field( 'url_ticketliquidator' ); ?>" target="_blank">
                                  <span class="buy-tickets new-tab button"><span>Ticket Liquidator</span></span>
                                </a>
                              </div>
                          </div>
                      <?php endif; ?>
                  <!-- |||||||||||||||||||||||||||||||||||||||||||||||| -->
                      <?php if( get_field('url_stubhub') ): ?>
                            <div class="ticket-wrapper">
                              <div class="ticket-cell buy-button-container">
                                  <span class="buy-tickets new-tab button">
                                    <span>
                                    <a href="<?php the_field( 'url_stubhub' ); ?>" target="_blank">
                                     <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/stubhub-logo.jpg">
                                    </a>
                                   </span>
                                 </span>
                             </div>
                          </div> 
                      <?php endif; ?>
                  <!-- ||||||||||||||||||||||||||||||||||||||||||||||||| -->
                      <?php if( get_field('url_ticketsnow') ): ?> 
                            <div class="ticket-wrapper">
                              <div class="ticket-cell buy-button-container">
                                  <span class="buy-tickets new-tab button">
                                    <span>
                                      <a href="<?php the_field( 'url_ticketsnow' ); ?>" target="_blank">
                                        <img style="width:190px;height:60px;border-radius:6px;" src="http://zumic.com/wp-content/uploads/2015/03/ticketsnow-logo.jpg">
                                      </a>
                                    </span>
                                  </span>
                              </div>                           
                          </div>  
                      <?php endif; ?>              
     </div>
  </div> 
  <div><?php the_field('set_list');?></div>
  <center style="clear:both;">
  <br>
  <?php the_content(); ?>
  </center>            
   <h2 class="title-headline more-info" style="padding-top:10px;">More Info</h2>
   <span class="tags-title2" performer="<?php
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
                              $tags_output[] = "" . $value->slug ." " . $value->name . "";
                            } else {
                              $tags_output[] = "" . $value->slug ." " . $value->name . "";
                            }
                          }
                          if($tags_output) {
                              print implode(', ', $tags_output);
                          }else{
                            echo "TBA";
                          }
                        ?>">Artists:</span>
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
                              $tags_output[] = "<a style='color:#78c0eb;' class='tags-title2' href='/artists/" . $value->slug ."'>" . $value->name . "</a>";
                            } else {
                              $tags_output[] = "<a style='color:#78c0eb;' class='tags-title2' href='/tag/" . $value->slug ."'>" . $value->name . "</a>";
                            }
                          }
                          if($tags_output) {
                              print implode(', ', $tags_output);
                          }else{
                            echo "TBA";
                          }
                        ?><br>
                 <?php if( get_field('event_date') ): ?>
                  <strong class="tags-title2" startDate="<?php
                      $dateformatstring = "l, F jS, Y ";
                      $unixtimestamp = strtotime(get_field('event_date'));
                      echo date_i18n($dateformatstring, $unixtimestamp);
                      ?>">Date:</strong>
                    <?php
                      $dateformatstring = "l, F jS, Y ";
                      $unixtimestamp = strtotime(get_field('event_date'));
                      echo date_i18n($dateformatstring, $unixtimestamp);
                      ?>
                    <?php endif; ?><br>
                    <?php if( get_field('end_date') ): ?> 
                  <strong class="tags-title2" >To:</strong>
                    <?php
                      $dateformatstring = "l, F jS, Y ";
                      $unixtimestamp = strtotime(get_field('end_date'));
                      echo date_i18n($dateformatstring, $unixtimestamp);
                      ?>
                    <?php endif; ?>
                    <br>
            <!-- ||Time||||||||| -->
                <div class="time">
                  <strong class="tags-title2 time" >Time:</strong>
                      <?php
                        $dateformatstring1 = "g:i a ";
                        $unixtimestamp1 = strtotime(get_field('event_time'));
                        $unixtimestamp2 = strtotime(get_field('show_time'));
                        $unixtimestamp3 = strtotime(get_field('door_time'));
                      ?>
                    <?php if( get_field('door_time') && get_field('show_time') ){  ?>

                              <strong>Door Time:&nbsp;</strong><?php echo date_i18n($dateformatstring1, $unixtimestamp3); ?><br>
                              <strong>Show Time:&nbsp;</strong><?php echo date_i18n($dateformatstring1, $unixtimestamp2); ?><br>
                        <?php  }elseif( get_field('event_time') ){  ?>
                        
                                <?php echo date_i18n($dateformatstring1, $unixtimestamp1); ?><br>
                        <?php }else{ ?>
                        <style> .time{display: none;}</style>
                        <br>
                    <?php }; ?> 
                </div> 
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
                      <strong class="tags-title2" style="">Venue: <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></strong>
                      <br>
                      <strong class="tags-title2" style="" location="<?php the_field( "address_street, address_city'" ); ?>">Address: <a href="https://maps.google.com/maps?center=<?php the_field('address_name'); ?> ?>&q=<?php the_field('address_name'); ?>" target="_blank" >(map)</a></strong>
                      <br>
                      <?php the_field( "address_street" ); ?>
                      <br>
                      <?php the_field( 'address_city' );?>,
                      <?php the_field( 'address_state' ); ?>
                      <?php the_field( 'address_postcode'  ); ?>
                      <br>
                      <?php the_field( 'address_country' ); ?>
                      <br>
                      <?php if( get_field('phone_number') ): ?>
                      <strong class="tags-title2" style="">Phone: <?php the_field( 'phone_number' ); ?>
                      </strong>
                      <?php endif; ?>
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
                      <strong class="tags-title2"><?php echo get_the_term_list( get_the_ID(), 'media-type', '<span class="tags-title">' . __( 'Media Type:', 'bonestheme' ) . '</span> ', ', ' ) ?></strong><br>
                      <strong class="tags-title2"><?php echo get_the_term_list( get_the_ID(), 'music-genres', '<span class="tags-title">' . __( 'Genres:', 'bonestheme' ) . '</span> ', ', ' ) ?></strong><br>
                      <strong class="tags-title2"><?php echo get_the_term_list( get_the_ID(), 'local-music', '<span class="tags-title">' . __( 'Location:', 'bonestheme' ) . '</span> ', ', ' ) ?></strong>  
                <br>
                <p style="font-weight: normal;clear:both;padding-top:10px!important;">The cheapest ticket option is usually the primary ticket seller, but sometimes you can find tickets below face value through secondary ticket sellers.
                <br>
                <br>
                SuperStar Tickets is Zumic's preferred ticket broker, because they don't add any unexpected fees or service charges.  Use discount code <b>SHOPCONCERTS</b> for 5% off your order.</p>
                <br>
          

                <div>
                  <center style="width:255px;margin-left:25%;">
                    <div style="float:right;" class="g-plus" data-action="share" data-annotation="bubble">
                      <script type="text/javascript">
                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/platform.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                      </script>
                    </div>
                    <div style="float:left;padding-right:5px;" class="fb-like" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="">
                    </div>
                    <div style="float:left;padding-right:5px;">
                      <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div> 
                  </center>
                </div>
                <br>





                <div class="block-related clearfix sidebar">
                      <div class="mmcxx">
                        <div class="float-event">
                          <br><br><br>
                          <div class="zumic-a">
                               <div class="event-ad-top">
                                  <?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
                                </div>       
                          </div>
                        </div>
                        <div style="float:left;">
                           <h2 class="title-headline2" class="popmcxx">Popular Today</h2>
                                    
                                            <?php
                                                the_widget(
                                                 'Clicky_Popular_Posts_Widget', [
                                                  'site_id'    =>  '100591291',
                                                  'site_key'   =>  '46a8d7ed022b30ce',
                                                  'number'     =>  4,
                                                  'post_types' =>  array( 'post', 'music-videos' ),
                                                  'date'       =>  'last-1-days',

                                                  ] 
                                                );
                                            ?>
                        </div>
                      </div>
                </div>
              
                </section>
                <!-- |||||||||||||||||||||||||=========||||||||||||||||||||| -->
                <?php if( $has_right_col ): ?>
                  <section class="entry-content media-content clearfix grid-6 last scrollable-col">
                  </section>
                <?php else: ?>
                <div class="sidebar grid-4 last clearfix" role="complementary">
                  <div stlye="margin-left:0px;">
                  <?php echo apply_filters( 'the_content', get_post_field( 'post_content', 184350 ) ); ?>  
                  </div>  
                  <br>   
                <!--SideBARIB -->
                <!--||||||||||||||||||||||||||||||GEO-LOCATION|||||||||||||||||||||-->
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
                         <div class="folded"><h2><strong><a href="http://zumic.com/local-concert-listings/">shows near you</a></strong></h2></div>
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
                                'posts_per_page' => 200, 
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
                                        <div class="single-title">
                                          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                            <h3><?php the_title(); ?></h3>
                                          </a>
                                        </div>
                                    </div>                     
                        <?php  endwhile;
                        wp_reset_postdata(); ?>
                                </div>  
                        <?php } ?>
                        <div class="zumic-a clearfix">
                            <h3>Powered By</h3>
                            <a href="https://www.superstartickets.com/Concerts" target="_blank" style="width:310px;border:none;padding-left:12px;">
                                <img src="http://zumic.com/wp-content/uploads/2015/03/SUPERSTAR_LOGOv2-03-11.jpg" >   
                            </a>
                        </div> 
                      </div>
                    <br>
                    <div class="sidecenterhal">
                        <div class="block-newsletter-signup clearfix">
                            <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
                        </div>
                    </div>
              <!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
              <?php get_sidebar(); ?>
              </div>
              <?php endif; ?>
              </article>
              <?php endwhile; ?>
              <?php else : ?>
              <?php endif; ?>
              </div>
                <div class="zumic-a clearfix" style="width:100%; padding-left:0px;">
                  <?php //echo get_responsive_adsense( get_the_ID(), '4683217536' ); ?>
                </div>
              </div>
              </div>
              <?php get_footer(); ?>
