<?php
/**
* Music genres taxonomy page
*/
?>
<style>
#left-column ul li a {color: white!important;}
.body-border{
  height: 1000px
}
</style>


<!-- <link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css"> -->

<?php get_header(); ?>



    <div id="content">



        <div id="inner-content" class="wrap clearfix">
          


<div class="body-border2">
<div id="main" class="clearfix" role="main"> 
            
    <div id="left-column">             
        <h1 class="title-headline">All Music Genres</h1>
                
                <article class="">

                    <?php 
                    $orderby = 'menu_order';
                    $show_count = 0; 
                    $style = 'list'; 
                    $pad_counts = 0;
                    $hierarchical = 1; 
                    $taxonomy = 'music-genres';
                    $title = '';
                    
                    
                    $args = array(
                      'orderby' => $orderby,
                      'style'  => $style,
                      'show_count' => $show_count,
                      'pad_counts' => $pad_counts,
                      'hierarchical' => $hierarchical,
                      'taxonomy' => $taxonomy,
                      'title_li' => $title
                    );
                    ?>
                    <ul class="orderlist">
                   

                            <?php wp_list_categories($args);  ?>
                     
                    </ul>

                        
                </article>
                            
            </div>
            
   

</div>
</div>
<div class="sidebar grid-4 last clearfix" role="complementary">

           <div class="zumic-a clearfix">
                    <?php echo get_adsense( get_the_ID(), '5470875933', '336x280'); ?>
             </div>

            <div class="block-newsletter-signup clearfix">
                <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
            </div>
      
            <div class="zumic-a clearfix">
                <?php include( TEMPLATEPATH."/parts/fb-likebox.php" ); ?>
            </div>

            <div class="zumic-a clearfix">
                <?php include( TEMPLATEPATH . "/parts/tw-widget.php" ); ?>
            </div>

            <?php get_sidebar(); ?>

        </div>
</div>
  <div class="zumic-a clearfix" style="width:100%; padding-left:12px;">
            <?php echo get_responsive_adsense( get_the_ID(), '4683217536' ); ?>
        </div>
</div>

<?php get_footer(); ?>
