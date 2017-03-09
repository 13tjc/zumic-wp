<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> -->
<style>
div.concertsb6 img{  /*width: auto!important;*/}
div.concertsb2 {margin-top: -23px;}
.mobile-border {margin-top: 80px!important;}
.post .kk-star-ratings.lft{display: none;}
.post .authorstars p {display: none;}
.authorstars p {float: left;margin-top: 4px!important;padding-right: 10px;}
@media only screen and (max-device-width: 480px) { 
#page-wrap{display:none!important;}
.mobile-border { margin-top: -5px!important;}
div#example1 {display: none;}
div.folded2 h1 {position:relative!important;margin-left:-111px!important;}
div.widget.clicky-popular-posts-widget .single-title
 {font-size: 8px;float: right;width: 130%!important;margin-top: -10px;margin-right: -205px!important;}
}
</style>
<?php get_header(); ?>

<div id="content" ng-app="zumicApp">
<div id="content">
<div class="block-trending block-singles clearfix">
<div id="inner-content" class="wrap clearfix">                             
<div id="main" class="grid-8 first clearfix" role="main">   
<div class="body-border2">
</head>
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
        
        $(function(){;
            $("#page-wrap").show();
            $("#main-photo-slider").codaSlider();       
            $navthumb = $(".nav-thumb");
            $crosslink = $(".cross-link");

            // $myimg = (".my-img");
            $navthumb
            .hover( function() {
                var $this = $(this);
                theInterval($this.parent().attr('id').slice(1) - 1);
                return false;
            }, 1);

            theInterval();
        });
    </script>
<br>
<div id="page-wrap" style="display:none;">                                
    <div class="slider-wrap">
        <div id="main-photo-slider" class="csw" >
            <div class="panelContainer">
                <?php $args = array('post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby' => 'menu_order post_date','date_query' => array( array(
                        'after' => '5 days ago' ) ));
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
                 <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
           <!-- /||||||||||||||||||||||||||||||||||| -->
                <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 1,'date_query' => array( array(
                        'after' => '5 days ago') ));
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
                        'after' => '5 days ago') ));
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
                          'date_query' => array( array('after' => '5 days ago') ));
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
                          'date_query' => array( array('after' => '5 days ago' ) ) );
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
                          'date_query' => array( array('after' => '5 days ago') ) );
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
                                'after' => '5 days ago' ) ));
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
                                'after' => '5 days ago' ) ));
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
                                'after' => '5 days ago' ) ));
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
                                'after' => '5 days ago' ) ));
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
                                'after' => '5 days ago' ) ));
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
                                'after' => '5 days ago' ) ));
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
<br><br>
<br><br>
<br><br><br>


<?php
        $filter = $_GET['show'];
        $args = array(
                'post_type' => array( 'post', 'music-videos' ),  
                'post_status' => 'publish',
                'paged' => get_query_var('paged'),
                'posts_per_page' => 16,
                'date_query' => array( array(
                        'after' => '7 days ago'
                ) )
        );
        switch ( $filter ) {
                case 'latest':
                              $args[ 'date_query' ] = array( array('after' => '700 day ago'));
                        $args[ 'orderby' ] = 'menu_order post_date';
                break;
                case 'popular':
                        $args[ 'meta_key' ] = 'post_views_count';
                        $args[ 'orderby' ] = 'meta_value_num';
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
                          $orderby = 'post_date DESC';           
                          $args[ 'orderby' ] = 'post_date';
                          $args[ 'date_query' ] = array( array('after' => '10 day ago'));
                break;
        }
        query_posts( $args );
?>
<div class="folded2">
<div style="float:left;">
<!-- What's Hot start -->
<?php if ($filter === "videol") { ?>
    <h1 class="headline">Hot New Music Videos</h1>
<?php } ?>
<?php if ($filter === "audiol") { ?>
    <h1 class="headline">Hot New Music</h1>
<?php } ?> 
<?php if ($filter === "albumsl") { ?>
    <h1 class="headline">Hot New Albums</h1>
<?php   } ?>
<?php if ($filter === "latest") { ?>
    <h1 class="headline">Hot New Music & News</h1>
 <?php } ?>
<!-- Whats Hot end -->
<!-- Latest Start -->
 <?php if ($filter === "") { ?>
        <h1 class="headline">New Music & News</h1>
 <?php } ?>
  <?php if ($filter === "video") { ?>
        <h1 class="headline">Newest Music Videos</h1>
 <?php } ?>
 <?php if ($filter === "audio") { ?>
    <h1 class="headline">Newest Music</h1>
<?php } ?> 
<?php if ($filter === "albums") { ?>
    <h1 class="headline">Newest Albums</h1>
<?php } ?>
<!-- Latest end -->
<!-- Best of Month start -->
 <?php if ($filter === "bestofmonth") { ?>
    <h1 class="headline">Best Music & News of the Month</h1>
 <?php } ?>
  <?php if ($filter === "videob") { ?>
    <h1 class="headline">Best Music Videos of the Month</h1>
 <?php } ?>
 <?php if ($filter === "audiob") { ?>
    <h1 class="headline">Best Music of the Month</h1>
<?php } ?> 
<?php if ($filter === "albumsb") { ?>
    <h1 class="headline">Best Albums of the Month</h1>
<?php } ?>
<!-- Best of Month end -->
<!-- Best of Year start-->
 <?php if ($filter === "bestofyear") { ?>
    <h1 class="headline">Best Music & News of the Year</h1>
 <?php } ?>
  <?php if ($filter === "videoby") { ?>
    <h1 class="headline">Best Music Videos of the Year</h1>
 <?php } ?>
 <?php if ($filter === "audioby") { ?>
    <h1 class="headline">Best Music of the Year</h1>
<?php } ?> 
<?php if ($filter === "albumsby") { ?>
    <h1 class="headline">Best Albums of the Year</h1>
<?php } ?>
<!-- Best of Year end -->
</div>

<h3 class="zumtime" style="float:right;margin-top:20px;font-size:18px;margin-right:43px;">
    <?php echo date("l, F j, Y ", current_time('timestamp')); ?>
    <span id="Hour" style="color:black;font-size:;"></span>
    <span id="Minut" style="color:black;margin-left:-5px;"></span>
</h3>
</div>
<div class="mobile-border"></div>
<?php 
$directory = explode('/',ltrim($_SERVER['REQUEST_URI'],'/'));  
$directories = array("/", "?show=", "?show=latest", "?show=bestofmonth", "?show=bestofyear",
                     "?show=video", "?show=audio", "?show=albums", "?show=videol", 
                     "?show=audiol", "?show=albumsl", "?show=videob", "?show=audiob",
                     "?show=albumsb", "?show=videoby", "?show=audioby", "?show=albumsby",
                     "?show=allpost", "?show=allpostl", "?show=allpostb", "?show=allpostby" ); // set home as 'index', but can be changed based of the home uri
foreach ($directories as $folder){
    $active[$folder] = (in_array($folder, $directory))? "active":"noactive";
}
?>
 <div id="topnav" class="container1">
      <ul class="nav1">
        <li class="<?php echo $active['?show=']?>">
            <a  id="hot"  href="?show=">Latest</a>
            <ul class="nav1">
               <li id="li_video" class="<?php echo $active['?show=video']?>"><a id="a_video" href="?show=video">Videos</a></li>
               <li id="li_audio" class="<?php echo $active['?show=audio']?>"><a id="a_audio" href="?show=audio" >Singles</a></li>
               <li id="li_albums" class="<?php echo $active['?show=albums']?>"><a id="a_albums" href="?show=albums">Albums</a></li>
               <li id="li_all" class="<?php echo $active['?show=']?>"><a href="?show=">All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=latest']?>">
            <a id="latest" href="?show=latest">What's Hot</a>
            <ul class="nav1" >
               <li class="<?php echo $active['?show=videol']?>"><a href="?show=videol">Videos</a></li>
               <li class="<?php echo $active['?show=audiol']?>"><a href="?show=audiol">Singles</a></li>
               <li class="<?php echo $active['?show=albumsl']?>"><a href="?show=albumsl">Albums</a></li>
               <li id="all_l" class="<?php echo $active['?show=latest']?>"><a href="?show=latest">All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=bestofmonth']?>">
            <a id="bestofmonth" href="?show=bestofmonth">Best Of Month</a>
            <ul class="nav1">
                   <li class="<?php echo $active['?show=videob']?>"><a href="?show=videob">Videos</a></li>
                   <li class="<?php echo $active['?show=audiob']?>"><a href="?show=audiob">Singles</a></li>
                   <li class="<?php echo $active['?show=albumsb']?>"><a href="?show=albumsb">Albums</a></li>
                   <li id="all_b" class="<?php echo $active['?show=bestofmonth']?>"><a href="?show=bestofmonth" >All Posts</a></li> 
            </ul>
        </li>
        <li class="<?php echo $active['?show=bestofyear']?>">
            <a id="bestofyear" href="?show=bestofyear">Best Of Year</a>
             <ul class="nav1">
                   <li class="<?php echo $active['?show=videoby']?>"><a href="?show=videoby">Videos</a></li>
                   <li class="<?php echo $active['?show=audioby']?>"><a href="?show=audioby">Singles</a></li>
                   <li class="<?php echo $active['?show=albumsby']?>"><a href="?show=albumsby" class="<?php echo $active['?show=albumsby']?>">Albums</a></li>
                   <li id="all_by" class="<?php echo $active['?show=bestofyear']?>"><a href="?show=bestofyear">All Posts</a></li> 
            </ul>
        </li> 
      </ul>  
  </div>
  <br>
<script>
main_links = ["video", "audio", "albums"];
category_links = ["hot", "latest", "bestofmonth", "bestofyear"];
allposts_links = [
    "li_all",
    "all_l",
    "all_b",
    "all_by"];
$(document).ready(function() {
    active_links = $("li.active>a");
    for (lk in active_links) {
        link = active_links[lk];
        href = link.href;
        for (qi in main_links) {
            q = main_links[qi];
            if (href.indexOf(q) > -1) {
                $("#li_"+q).addClass("active"); //highlight
                $("#li_"+q).removeClass("noactive");
                $("#hot").attr("href", "?show=" + q);
                console.log($("#hot").attr("href"));
                $("#latest").attr("href", "?show=" + q + "l");
                $("#bestofmonth").attr("href", "?show=" + q + "b");
                $("#bestofyear").attr("href", "?show=" + q + "by"); 
                $("#a_"+q).attr("href", href);
                console.log(q + " href is now " + href);
                //updating hrefs
                if (href.search(/l$/) > -1) { //latest
                    console.log("latest");
                    $("#latest").css({ 
                                "background":"#525252,#5E5E5E"
                            });
                    $("#latest").parent().removeClass("noactive");
                    $("#latest").parent().addClass("active");
                    //siblings
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
                                "background":"#525252,#5E5E5E"
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
                                "background":"#525252,#5E5E5E"
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
                             "background":"#525252,#5E5E5E"
                            });

                    $("#hot").parent().removeClass("noactive");
                    $("#hot").parent().addClass("active");
                }
                break;
            } //end q
        }
    }
});
</script>
<!-- ||============================Filter WHATS HOT============================ VIII.V.MMXIV|| -->
<?php
$filter = $_GET['show'];
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
                $args[ 'date_query' ] = array( array('after' => '1000 days ago'));//change to 30 days
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

                 $args[ 'orderby' ] = 'menu_order post_date';   
        break;
        default:               
        break;
}
query_posts( $args );
?>
<!-- ||======================================== ||||||||||||============================================= VIII.V.MMXIV|| --> 
<!-- ||========================================Filter LATEST============================================= VIII.V.MMXIV|| -->   
<?php

// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// query_posts("showposts=2&amp;paged=$paged");

$filter = $_GET['show'];
switch ( $filter ) {
        case 'audiol':
                $args[ 'orderby' ] = 'menu_order post_date';
                $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'audio-single'
                            )
                    );
        break;
        case 'videol':
             $args[ 'orderby' ] = 'menu_order post_date';
             $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'video'
                            )
                    );     
        break;
        case 'albumsl':
                 $args[ 'orderby' ] = 'menu_order post_date';
                 $args[ 'tax_query' ] = array(
                        array( 
                            'taxonomy' => 'media-type',
                            'field'  =>'slug',
                            'terms'  => 'full-album-stream'
                            )
                    );    
        break;
        case 'allpostl':
               $args[ 'orderby' ] = 'menu_order post_date';           
        break;
        default:           
        break;
}
query_posts( $args );
?>
<!-- ||========================================|||||||||||====================================================== VIII.V.MMXIV|| -->
<!-- ||========================================Filter BEST OF MONTH============================================= VIII.V.MMXIV|| -->   
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
<!-- ||========================================Filter BEST OF YEAR============================================= VIII.V.MMXIV|| -->   
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
                        printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
                    ?></p>
                </header>
                <section class="entry-content clearfix">
                   <div class="centerimg">      
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail( 'related-thumb' ); ?>
                        </a>
                    </div> 
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                   
                        <p class="tags"><?php echo get_the_term_list( get_the_ID(), 'music-genres', '<span class="tags-title">' . __( 'Genres:', 'bonestheme' ) . '</span> ', ', ' ) ?>
                        <br>
                        <br>
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
                        
                        </p> 
                    </div>
                </section>
                <hr> 
            </article>
                <?php endwhile; ?>
                <?php else : ?>
                        <article id="post-not-found" class="hentry clearfix">
                            <header class="article-header">
                                <h1><?php _e( 'No Post In Current Filter.', 'bonestheme' ); ?></h1>
                            </header>
                            <section class="entry-content">
                                <p><strong> Latest Albums:</strong></p>
                            </section>
                            <hr>
                            <hr>
                            <ul>
                            <?php
                                $args = array(
                                    'post_type' => array( 'post', 'music-videos' ),
                                    'showposts' => 15,
                                    'orderby' => 'post_date DESC',
                                    'date_query' => array( array(
                                                 'after' => '360 days ago')),
                                    'tax_query'  => array(
                                        array( 
                                            'taxonomy' => 'media-type',
                                            'field'  =>'slug',
                                            'terms'  => 'full-album-stream'
                                            )
                                        )
                                    );
                            ?>
                    <?php $the_query = new WP_Query($args); ?>
                    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">
                    <header class="article-header">
                        <h2 style="color:#ddd;"><a style="color:#ddd;" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <p class="byline vcard"><?php
                            printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
                        ?>
                    </p>
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
                         <p class="tags"><?php echo get_the_term_list( get_the_ID(), 'music-genres', '<span class="tags-title">' . __( 'Genres:', 'bonestheme' ) . '</span> ', ', ' ) ?>
                        <br>
                        <br>
                    
                        </p>                   
                        <div class="social-share clearfix"> 
                            <div class="clearfix"></div>
                        </div>
                    </section>
                    <footer class="article-footer">
                                </footer>
                            </article>
                         <?php endwhile;
                            wp_reset_postdata();
                         ?>
                             </ul>
                    </article>
                <?php endif; ?>
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

    <div class="explore">
            <h1><a href="http://zumic.com/explore/">Explore</a></h1>
    </div>
 
    
 
 </div>

</div>
<!--SideBARAIIB -->
<div class="sidebar grid-4 last clearfix" role="complementary">                              
            <?php 
                $post_tags = wp_get_post_terms( 
                    get_the_ID(), 
                    'post_tag', 
                    ['fields' => 'slugs'] 
                );
                $related_artists = get_artists_by_slug( $post_tags );
                if( $related_artists ):
            ?>
           <?php endif; ?>
       <!--  <div class="sidecenter">
            <div class="block-newsletter-signup clearfix">
                <?php //include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
            </div>
        </div> -->
     <!--    <div class="new-ad">
            <script>
            /* sidebar-ad */
            cf_page_artist = "";
            cf_page_song = "";
            cf_adunit_id = "39383911";
            </script>
<script src="//srv.clickfuse.com/showads/showad.js"></script>
        </div> -->
        <?php wp_reset_query(); ?>
        <br>
        <!--SideBARAIIB -->
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

           <div class="folded" ><h2><strong><a href="http://zumic.com/local-concert-listings/">shows near you</a></strong></h2></div>
                
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
        <h3>Powered By</h3>
        <a href="https://www.superstartickets.com/Concerts" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:200px;!important" src="http://zumic.com/wp-content/uploads/2015/03/SUPERSTAR_LOGOv2-03-11.jpg" >   
        </a>
    </div> 
</div>
<br>
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->
<div class="concertsb6">
            
                <?php 
                    echo '<h2 class="title-headline">POPULAR TODAY</h2>';
                    include( TEMPLATEPATH . "/parts/latest-news-sm.php" );
                ?>

                <div class="tweet-no-show">
                    <div class="zumic-a clearfix">
                        <?php include( TEMPLATEPATH . "/parts/tw-widget.php" ); ?>
                    </div> 
                </div>
            <br>

            <div class="zumic-a">
                <?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
            </div> 
      
        <div id='TiqiqWidget' class=''><script type="text/javascript" src='http://www.tiqiq.com/jscripts/widget.aspx'></script></div>
           <br> 
           <div class="sidecenter">
                 <div class="block-newsletter-signup clearfix">
                     <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
                 </div>
            </div>
        </div>
    </div>  
                    </div>
            </div>
        </div>
</div>
<?php get_footer(); ?>
