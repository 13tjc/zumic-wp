<?php
/**
* Music genres taxonomy page
*/
?>
<style>
div.folded2 h1 {padding: 4px 25px!important;}
.excerpt {color: white!important;}
ins.adsbygoogle {margin-left: -14px;margin-top: 16px;}
.sidebar {margin-left: -10px;}
.sidecenter {margin-left: 0px!important;}
div.block-top-artists {margin-left: 1px;}
.authorstars p {margin-top: 2px!important;}
li.cat-item.cat-item{border-bottom-style: solid!important;}
li.cat-item:hover {background-color:#F0F0F0;}
.post .kk-star-ratings.lft{display: none!important;}
.post .fakeclass p{  display: none!important;}
.post .authorstars p{display: none;}
#page-wrap {margin-top: 145px!important;}
</style>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<?php get_header(); ?>
<div id="content">
<div id="inner-content" class="wrap clearfix">
<div id="main" class="grid-8 first clearfix" role="main">
    <div class="body-border2">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style2.css" />
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>    
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-easing-1.3.pack.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-easing-compatibility.1.2.pack.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/coda-slider.1.1.1.pack.js"></script>
            <script type="text/javascript">
                var theInt = null;
                var $crosslink, $navthumb;
                var curclicked = 0;
                theInterval = function(cur){
                    clearInterval(theInt);
                    if( typeof cur != 'undefined' )
                        curclicked = cur;
                    $crosslink.removeClass("active-thumb");
                    $navthumb.eq(curclicked).parent().addClass("active-thumb");
                        $(".stripNav ul li a").eq(curclicked).trigger('click');
                    
                    theInt = setInterval(function(){
                        $crosslink.removeClass("active-thumb");
                        $navthumb.eq(curclicked).parent().addClass("active-thumb");
                        $(".stripNav ul li a").eq(curclicked).trigger('click');
                        curclicked++;
                        if( 6 == curclicked )
                            curclicked = 0;
                        
                    }, 3500);
                };
                $(function(){
                    $("#page-wrap").show();
                   
                    $("#main-photo-slider").codaSlider();
                    $navthumb = $(".nav-thumb");
                    $crosslink = $(".cross-link");                 
                     $navthumb
                    .hover(function() {
                        var $this = $(this);
                        theInterval($this.parent().attr('id').slice(1) - 1);
                        return false;
                    });
                    theInterval();
                });


               $(document).ready(function() {
                          if ($(".slider-wrap").find(".panel").length == 0){ 
                             $("#page-wrap").hide();
                             $("margin-slide").show();
                            }else{
                                 $("margin-slide").hide();
                            }
                    });

            </script>
<br>
<div class="margin-slide"> 
<div id="page-wrap" style="display:none;" >                                
    <div class="slider-wrap">
        <div id="main-photo-slider" class="csw" >
            <div class="panelContainer">
                <?php
                $queried_object = get_queried_object();
                $term_id = $queried_object->term_id;
                $args = array('post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby' => 'menu_order post_date','date_query' => array( array(
                        'after' => '30 days ago' ) ),
                        'tax_query' => array(
                                array(
                                    'taxonomy' => 'music-genres',
                                    'field' => 'id',
                                    'terms' => array( $term_id ),
                                )
                            )
                        );
                $loop = new WP_Query( $args ); ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="panel" title="Panel 1">
                    <div class="wrapper">
                        <center style="vertical-align:middle;">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'post-img-l' ); ?>
                            </a> 
                        </center>
                    </div>
                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
                            <div class="stitle">
                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                            </div>
                        </div> 
                </div>
                 <?php endwhile;  ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| -->
                <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 1,'date_query' => array( array(
                        'after' => '30 days ago') ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                      $loop = new WP_Query( $args ); ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                  <div class="panel" title="Panel 2">
                    <div class="wrapper">
                        <center style="vertical-align:middle;">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'post-img-l' ); ?>
                            </a>
                        </center>
                    </div>
                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
                             <div class="stitle">
                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                            </div>
                        </div>
                </div>
                 <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| -->  
                <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 2,'date_query' => array( array(
                        'after' => '30 days ago') ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                      $loop = new WP_Query( $args ); ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="panel" title="Panel 3">
                    <div class="wrapper">
                        <center style="vertical-align:middle;">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'post-img-l' ); ?>
                            </a>
                        </center>
                    </div>
                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
                            <div class="stitle">
                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                            </div>
                        </div>
                </div>
                 <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| -->  
                <?php
                    $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 3,
                          'date_query' => array( array('after' => '30 days ago') ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                    $loop = new WP_Query( $args );
                    ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                <div class="panel" title="Panel 4">
                    <div class="wrapper">
                        <center style="vertical-align:middle;">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                              <?php the_post_thumbnail( 'post-img-l' ); ?>
                            </a>
                        </center>
                    </div>
                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
                             <div class="stitle">
                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                            </div>
                        </div>
                </div>
                 <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| --> 
                <?php
                    $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 4,
                          'date_query' => array( array('after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ) );
                    $loop = new WP_Query( $args );
                    ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                <div class="panel" title="Panel 5">
                    <div class="wrapper">
                        <center style="vertical-align:middle;">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'post-img-l' ); ?>
                            </a>
                        </center>
                    </div>
                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
                             <div class="stitle">
                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                            </div>
                        </div>
                </div>
                 <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| --> 
                <?php
                    $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 5,
                          'date_query' => array( array('after' => '30 days ago') ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ) );
                    $loop = new WP_Query( $args );
                    ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                <div class="panel" title="Panel 6">
                    <div class="wrapper">
                        <center style="vertical-align:middle;">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                               <?php the_post_thumbnail( 'post-img-l' ); ?>
                            </a>
                        </center>
                    </div>
                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
                             <div class="stitle">
                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                            </div>
                        </div>
                </div>
                 <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| --> 
            </div>
        </div>
        <div class="thumb-box">
                 <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','date_query' => array( array(
                                'after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                       $loop = new WP_Query( $args ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                   <div class="containers">     
                            <a  id="#1" href="<?php the_permalink() ?>" class="cross-link" >
                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
                            </a>
                    </div>
                    <div class="space">a</div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                
                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 1,'date_query' => array( array(
                                'after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                          $loop = new WP_Query( $args ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div class="containers">     
                            <a  id="#2" href="<?php the_permalink() ?>" class="cross-link" >
                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
                            </a>
                    </div> 
                    <div class="space">a</div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 2,'date_query' => array( array(
                                'after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                          $loop = new WP_Query( $args ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                    <div class="containers">     
                            <a  id="#3" href="<?php the_permalink() ?>" class="cross-link" >
                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
                            </a>
                    </div>
                    <div class="space">a</div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                   <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 3,'date_query' => array( array(
                                'after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                          $loop = new WP_Query( $args ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                    <div class="containers">     
                            <a  id="#4" href="<?php the_permalink() ?>" class="cross-link" >
                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
                            </a>
                    </div>
                    <div class="space">a</div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 4,'date_query' => array( array(
                                'after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                          $loop = new WP_Query( $args ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                    <div class="containers">     
                            <a  id="#5" href="<?php the_permalink() ?>" class="cross-link" >
                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
                            </a>
                    </div>
                    <div class="space">a</div>
                     <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 5, 'date_query' => array( array(
                                'after' => '30 days ago' ) ),'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    ));
                          $loop = new WP_Query( $args ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                    <div class="containers">     
                            <a  id="#6" href="<?php the_permalink() ?>" class="cross-link" >
                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
                            </a>
                    </div>
                     <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
        
        </div>
    </div>
</div>
</div>
<br><br>
<br><br>
<br><br><br><br>
         <?php
                $queried_object = get_queried_object();
                $term_id = $queried_object->term_id;
                $filter = $_GET['show'];
                $args = array(
                    'post_type' => array( 'post', 'music-videos' ),
                    'posts_per_page' => 30,
                    'post_status' => 'publish',
                    'paged' => get_query_var('paged'),
                    'date_query' => array( array(
                        'after' => '4 days ago'
                        ) ),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'music-genres',
                            'field' => 'id',
                            'terms' => array( $term_id ),
                        )
                    )
                );
                switch ( $filter ) {
                case 'latest':  

                        $orderby = 'post_date DESC';
                        $args[ 'date_query' ] = array( array('after' => '8000 days ago'));           
                        $args[ 'orderby' ] = 'post_date';
                        $args[ 'tax_query' ] = array( array('taxonomy' => 'music-genres',
                                                            'field'    => 'id',
                                                            'terms'    => array( $term_id )
                                                        ));
                break;
                case 'hot':
                
                        $args[ 'orderby' ] = 'menu_order post_date';
                        $args[ 'date_query' ] = array( array('after' => '4 years ago'));
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
                         $args[ 'date_query' ] = array( array('after' => '8000 days ago')); 
                break;
               }


                query_posts($args);
        ?>
<div class="folded2">
<!--Whats hot begin-->
<?php if ($filter === "video") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music Videos of All Time</h1>
<?php } ?>
<?php if ($filter === "audio") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music of All Time</h1>
<?php } ?> 
<?php if ($filter === "albums") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Albums of All Time</h1>
<?php   } ?>
<?php if ($filter === "hot") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music & News of All Time</h1>
<?php } ?>
<!--Whats hot end -->
<!--Latest begin -->
<?php if ($filter === "latest") { ?>
<h1 class="headline" style="font-size:30px;">New <?php single_cat_title(); ?> Music & News</h1>
<?php } ?>
<?php if ($filter === "videol") { ?>
<h1 class="headline" style="font-size:30px;">Newest <?php single_cat_title(); ?> Music Videos</h1>
<?php } ?>
<?php if ($filter === "audiol") { ?>
<h1 class="headline" style="font-size:30px;">Newest <?php single_cat_title(); ?> Music</h1>
<?php } ?> 
<?php if ($filter === "albumsl") { ?>
<h1 class="headline" style="font-size:30px;">Newest <?php single_cat_title(); ?> Albums</h1>
<?php } ?>
<!--Latest end -->
<!--BEST OF MONTH begin -->
<?php if ($filter === "bestofmonth") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music & News of the Month</h1>
<?php } ?>
<?php if ($filter === "videob") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music Videos of the Month</h1>
<?php } ?>
<?php if ($filter === "audiob") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music of the Month</h1>
<?php } ?> 
<?php if ($filter === "albumsb") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Albums of the Month</h1>
<?php } ?>
<!--BEST OF MONTH end -->
<!--BEST OF YEAR begin -->
<?php if ($filter === "bestofyear") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music & News of the Year</h1>
<?php } ?>
<?php if ($filter === "videoby") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music Videos of the Year</h1>
<?php } ?>
<?php if ($filter === "audioby") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Music of the Year</h1>
<?php } ?> 
<?php if ($filter === "albumsby") { ?>
<h1 class="headline" style="font-size:30px;">Best <?php single_cat_title(); ?> Albums of the Year</h1>
<?php } ?>
<!--BEST OF YEAR end -->
<h1 class="headline-mobile"><?php single_cat_title(); ?></h1> 
<div class="mobile-border"></div>
</div><br>
<?php 
// gets the current URI, remove the left / and then everything after the / on the right
$directory = explode('/',ltrim($_SERVER['REQUEST_URI'],'/'));
//echo 'DIRECTORY IS '.$directory[0].'<br>';
// foreach ($directory as $d) {
//     echo 'incl '.$d.'<br>';
// }
// loop through each directory, check against the known directories, and add class   
$directories = array("?show=hot",      "?show=latest",   "?show=bestofmonth", "?show=bestofyear",
                     "?show=video",    "?show=audio",    "?show=albums",      "?show=videol", 
                     "?show=audiol",   "?show=albumsl",  "?show=videob",      "?show=audiob",
                     "?show=albumsb",  "?show=videoby",  "?show=audioby",     "?show=albumsby",
                     "?show=allpost",  "?show=allpostl", "?show=allpostb",    "?show=allpostby",
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
            <a id="latest" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=latest">Latest</a>
            <ul class="nav1" >
               <li class="<?php echo $active['?show=videol']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=videol">Videos</a></li>
               <li class="<?php echo $active['?show=audiol']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audiol">Singles</a></li>
               <li class="<?php echo $active['?show=albumsl']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albumsl">Albums</a></li>
               <li id="li_all" class="<?php echo $active['?show=latest']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=latest">All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=bestofmonth']?>">
            <a id="bestofmonth" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofmonth">Best Of Month</a>
            <ul class="nav1">
                   <li class="<?php echo $active['?show=videob']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=videob">Videos</a></li>
                   <li class="<?php echo $active['?show=audiob']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audiob">Singles</a></li>
                   <li class="<?php echo $active['?show=albumsb']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albumsb">Albums</a></li>
                   <li id="all_b" class="<?php echo $active['?show=bestofmonth']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofmonth" >All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=bestofyear']?>">
            <a id="bestofyear" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofyear">Best Of Year</a>
             <ul class="nav1">
                   <li class="<?php echo $active['?show=videoby']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=videoby">Videos</a></li>
                   <li class="<?php echo $active['?show=audioby']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audioby">Singles</a></li>
                   <li class="<?php echo $active['?show=albumsby']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albumsby" class="<?php echo $active['?show=albumsby']?>">Albums</a></li>
                   <li id="all_by" class="<?php echo $active['?show=bestofyear']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=bestofyear">All Posts</a></li> 
            </ul>
        </li> 
        <li class="<?php echo $active['?show=hot']?>">
            <a  id="hot" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=hot">All TIme</a>
            <ul class="nav1">
               <li id="li_video" class="<?php echo $active['?show=video']?>"><a id="a_video" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=video">Videos</a></li>
               <li id="li_audio" class="<?php echo $active['?show=audio']?>"><a id="a_audio" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=audio" >Singles</a></li>
               <li id="li_albums" class="<?php echo $active['?show=albums']?>"><a id="a_albums" href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=albums">Albums</a></li>
               <li id="hot" class="<?php echo $active['?show=hot']?>"><a href="/music-genres/<?php echo str_replace(' ', '-', $newVariable); ?>/?show=hot">All Posts</a></li> 
            </ul>
        </li>
      </ul>  
</div>
  <br>
  <br>

<script>
main_links = ["video", "audio", "albums", "allpost", "hot"];
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
        $("#latest").css({
                    // "z-index":"2",
                    // "margin":"3px 0 0",
                    // "height":"43px",
                    // "color":"#404040",
                    "background":"#525252,#5E5E5E",
                     //"box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
                });
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
                $("#latest").attr("href", base_link + "?show=" + q + "l");
                $("#bestofmonth").attr("href", base_link + "?show=" + q + "b");
                $("#bestofyear").attr("href", base_link + "?show=" + q + "by"); 
                
                $("#a_"+q).attr("href", href);
                console.log(q + " href is now " + href);

                //Updating subcategory hrefs as well as parent CSS
                if (href.search(/l$/) > -1) { //latest
                    console.log("latest");
                    $("#latest").css({
                                // "z-index":"2",
                                // "margin":"3px 0 0",
                                // "height":"43px",
                                // "color":"#404040",
                          "background":"#525252,#5E5E5E",
                                //"box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
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
                            sib.href = sib.href + "l"
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
                                 //"box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
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
                    $("#hot").css("background", "#525252,#5E5E5");

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
                                //"box-shadow": "inset 0px 1px 5px rgba(0,0,0,.3)"
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


<!-- ||========================================FIlter ALLtime/WHATS HOT============================================= VIII.V.MMXIV|| -->
<?php
$filter = $_GET['show'];

switch ( $filter ) {
        case 'audio':
                $args[ 'date_query' ] = array( array('after' => '5 years ago'));
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'audio-single',
                                                        )
                                                );              
        break;
        case 'video':
                $args[ 'date_query' ] = array( array('after' => '5 years ago'));
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'video',
                                                        )
                                                );    
        break;
        case 'albums':
                $args[ 'date_query' ] = array( array('after' => '5 years ago'));
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'full-album-stream',
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
$filter = $_GET['show'];

switch ( $filter ) {
        case 'audiol':
               
                $orderby = 'post_date DESC';           
                $args[ 'orderby' ] = 'post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'audio-single',
                                                        )
                                                );       
        break;
        case 'videol':

                $orderby = 'post_date DESC';           
                $args[ 'orderby' ] = 'post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'video',
                                                        )
                                                );        
        break;
        case 'albumsl':

                $orderby = 'post_date DESC';           
                $args[ 'orderby' ] = 'post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'full-album-stream',
                                                        )
                                                );         
        break;
        case 'allpostl':

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
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'audio-single',
                                                        )
                                                );       
        break;
        case 'videob':

                $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'video',
                                                        )
                                                );           
        break;
        case 'albumsb':

                $args[ 'date_query' ] = array( array('after' => '30 days ago'));//change to 30 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'    => 'id',
                                                        'terms'    => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field'    => 'slug',
                                                        'terms'    =>  'full-album-stream',
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
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'   => 'id',
                                                        'terms' => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field' => 'slug',
                                                        'terms' =>  'audio-single',
                                                        )
                                                );       
        break;
        case 'videoby':

                $args[ 'date_query' ] = array( array('after' => '365 days ago'));//change to 365 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'   => 'id',
                                                        'terms' => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field' => 'slug',
                                                        'terms' =>  'video',
                                                        )
                                                );           
        break;
        case 'albumsby':

                $args[ 'date_query' ] = array( array('after' => '365 days ago'));//change to 365 days
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array( 
                                        'relation' => 'AND',
                                                array(
                                                        'taxonomy' => 'music-genres',
                                                        'field'   => 'id',
                                                        'terms' => array( $term_id )
                                                        ),
                                                array(
                                                        'taxonomy' => 'media-type',
                                                        'field' => 'slug',
                                                        'terms' =>  'full-album-stream',
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
                            
                        </div><br><br>
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
                         

                        

                    </section>

                    <footer class="article-footer">

                    </footer>

                </article>

                <?php endwhile; ?>

                        <?php if ( function_exists( 'bones_page_navi' ) ) { ?>
                            <?php wp_reset_query(); ?>
                            <?php bones_page_navi(); ?>
                        <?php } else { ?>
                            <nav class="wp-prev-next">
                                <ul class="clearfix">
                                    <li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
                                    <li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
                                </ul>
                            </nav>
                        <?php } ?>

                <?php else : ?>

                        <article id="post-not-found" class="hentry clearfix">
                            <header class="article-header">
                                <h1><?php _e( 'No Posts in this genre', 'bonestheme' ); ?></h1>
                            </header>
                            <section class="entry-content">
                                <p><?php _e( 'Stay tuned!', 'bonestheme' ); ?></p>
                            </section>
                            <footer class="article-footer">
                                    <p><?php _e( 'Zumic ENTERTAINMENT, Inc', 'bonestheme' ); ?></p>
                            </footer>
                        </article>

                <?php endif; ?>



    </div>
      <div class="zumic-a clearfix" style="width:100%; padding-left:12px;">
      <?php echo get_responsive_adsense( get_the_ID(), '4683217536' ); ?>
  </div>
</div>


<!-- |||||||||||||||||-->
<div class="sidebar grid-4 last clearfix" role="complementary">
                                        <div class="sidecenter">
                                           
                                        </div>
                                        
                                            <!-- <div class="zumic-a clearfix">
                                                <?php //echo get_adsense( get_the_ID(), '6947609136', '336x280' ); ?>
                                            </div> -->
                                            <div class="new-ad">
                                                   <script>
/* 300x250 New Sidebar */
cf_page_artist = "Insert artist variable here";
cf_page_song = "Insert song variable here";
cf_adunit_id = "39384323";
</script>
<script src="//srv.clickfuse.com/showads/showad.js"></script>
                                 
                                            </div><br><br>

<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--||||||||||||||||||||||||||||||GEO-LOCATION|||||||||||||||||||||-->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<div class="concertsb6" style="margin-top:-25px;">
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

           <div class="folded" ><h2><strong><a style="text-transform:lowercase;"><?php single_cat_title(); ?> shows near you</a></strong></h2></div>
                
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
                    'posts_per_page' => 350, 
                    'order' => 'ASC',
                    'ignore_sticky_posts' => true,
                     'tax_query' => array(
                                        array(
                                            'taxonomy' => 'music-genres',
                                            'field' => 'id',
                                            'terms' => array( $term_id ),
                                        )
                                    )
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
        <?php 
        $perma = get_the_permalink();
        ?>
        <a href="<?php echo $perma . "?sidebar-home"; ?>" title="<?php the_title_attribute(); ?>">
           <table class="hoverTable">
              <tr>
                <td style="width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;width:100%;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;margin-left: -2px;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-18px;width:100%; ">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;margin-left:-25px;">
                        <strong>
                            <?php // THE TITLE //
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                                
                               //echo substr($titlesub, 0, strrpos($titlesub, 'ON') - 1);

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
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;padding-bottom:5px;">
                        <strong>
                            <?php the_title(); ?>
                        </strong>
                        <br>
                    </div> 
                   
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
                    <div class="single-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" ><h3 style="color:#ddd!important;"><?php the_title(); ?></h3></a></div>
                </div>                     
    <?php  endwhile;
    wp_reset_postdata(); ?>
            </div>  
    <?php } ?>
   <div class="zumic-a clearfix">
        <h3>Powered By</h3>
        <a href="https://www.superstartickets.com/Concerts" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:200px;!important" src="http://zumic.com/wp-content/uploads/2015/03/SUPERSTAR_LOGOv2-03-11.jpg" >   
        </a>
    </div> 
</div>
<br>
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<div class="concertsb6" style="margin-left:11px;">
                        <div class="block-top-artists">
                                   
                            <h2 class="title-headline">HOT <?php single_cat_title(); ?> Artists</h2>

                                
                                   <?php
                                      
                                            $queried_object = get_queried_object();
                                            $term_id = $queried_object->term_id;
                                           
                                            $args = array(
                                                'post_type' => 'artists',
                                                'orderby'  => 'menu_order post_date',
                                                'taxonomy'  => 'music-genres',
                                                'posts_per_page' => 5,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'music-genres',
                                                        'field' => 'id',
                                                        'terms' => array( $term_id ),
                                                    )
                                                )
                                               

                                            
                             
                                            );
                                            $my_query = new WP_Query($args);
                                            if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                                                $my_query->the_post();
                                              
                                                ?>
                            <div class="related-posts-item clearfix">
                                     <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
                                        </a>
                                        <br><br>
                                        <div class="single-title">
                                            <a href="<?php the_permalink() ?>"><h3><?php the_title(); ?><h3></a>
                                        </div>
                                        <br>
                             </div>

                                          
                                        <?php endwhile;  ?>
                                            
                            <?php endif; ?>

                        </div>

                        <h2 class="title-headline">RELATED GENRES</h2>
                                      
                              <nav id="dropdown-button">
                                <ul>
                                 <!--  <li><a href="#">Sub-Genre<img src="<?php bloginfo('template_url'); ?>/images/dropdown_arrow.png" class="arrow" /></a> -->
                                    <ul>    
                                    <h4>
                                      <?php
                                        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                                        if ($term->parent == 0) { 
                                          wp_list_categories('taxonomy=music-genres&depth=1&show_count=0&title_li=&child_of=' . $term->term_id);
                                        } else {
                                          wp_list_categories('taxonomy=music-genres&show_count=0&title_li=&child_of=' . $term->parent); 
                                        }
                                        ?>
                                    </h4>
                                    </ul>
                                  <!-- </li> -->
                                </ul>
                              </nav>

                                     
                                        <?php get_sidebar(); ?>
                                        <br>
                                <div class="new-ad">
                                    <script>
                                    /* sidebar-ad */
                                    cf_page_artist = "";
                                    cf_page_song = "";
                                    cf_adunit_id = "39383911";
                                    </script>
                                    <script src="//srv.clickfuse.com/showads/showad.js"></script>
                                 </div>                              
  </div>
            </div>
            <!-- |||||||||||||||||||||||||| -->
    </div>

</div>

<script>
    // as the page loads, call these scripts
    jQuery(document).ready(function($) {
        // $url = '<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>';
        // $('.music-genres a[href$="' + $url + '"]').closest('.collapsible-wrapper').removeClass('closed');
        $title = '<?php echo single_cat_title(); ?>';
        $('.music-genres a').filter(function() {
            return $(this).text() === $title;
        }).closest('.collapsible-wrapper').removeClass('closed');
    }); /* end of as page load scripts */
</script>

<?php get_footer(); ?>
