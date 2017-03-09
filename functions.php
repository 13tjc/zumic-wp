<?php
// error_reporting(E_ERROR);
ini_set('display_errors', '0');

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt
  - custom google+ integration
  - adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break

/**
 * Custom post types
 */
require_once( 'library/custom-post-type-music-videos.php' );
require_once( 'library/custom-post-type-artists.php' );
require_once( 'library/custom-post-type-venue.php' );
require_once( 'library/custom-post-type-events.php' );

/**
 * Custom taxonomies
 */
require_once( 'library/custom-taxonomy-mood.php' );
require_once( 'library/custom-taxonomy-music-genres.php' );
require_once( 'library/custom-taxonomy-media-type.php' );
require_once( 'library/custom-taxonomy-local-music.php' );

add_action( 'local-music_add_form_fields', 'zumic_taxonomy_add_meta_field', 10, 2 );
add_action( 'local-music_edit_form_fields', 'zumic_taxonomy_edit_meta_field', 10, 2 );
add_action( 'edited_local-music', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_local-music', 'save_taxonomy_custom_meta', 10, 2 );

// Add new taxonomy entry
function zumic_taxonomy_add_meta_field() {
  printf('<div class="form-field">
      <label for="term_meta[location_term_meta]">%s</label>
      <input type="text" name="term_meta[location_term_meta]" id="term_meta[location_term_meta]" value="">
      <p class="description">%s</p>
    </div>',
    __( 'Location', 'bonestheme' ),
    __( 'Enter a longitude and tatitude( 40.6700,73.9400 )','bonestheme' )
  );
}

// Edit taxonomy entry
function zumic_taxonomy_edit_meta_field( $term ) {
  // put the term ID into a variable
  $t_id = $term->term_id;
 
  // retrieve the existing value(s) for this meta field. This returns an array
  $term_meta = get_option( "taxonomy_$t_id" );

  $value = esc_attr( $term_meta['location_term_meta'] ) ? esc_attr( $term_meta['location_term_meta'] ) : '';

  printf('<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[location_term_meta]">%s</label></th>
      <td>
        <input type="text" name="term_meta[location_term_meta]" id="term_meta[location_term_meta]" value="%s">
        <p class="description">%s</p>
      </td>
    </tr>',
    __( 'Location', 'bonestheme' ),
    $value,
    __( 'Enter a longitude and tatitude( 40.6700,73.9400 )', 'bonestheme' ) 
  );
}

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {
    $t_id = $term_id;
    $term_meta = get_option( "taxonomy_$t_id" );
    $cat_keys = array_keys( $_POST['term_meta'] );
    foreach ( $cat_keys as $key ) {
      if ( isset ( $_POST['term_meta'][$key] ) ) {
        $term_meta[$key] = $_POST['term_meta'][$key];
      }
    }
    // Save the option array.
    update_option( "taxonomy_$t_id", $term_meta );
  }
}

/*
3. library/admin.php
  - removing some default WordPress dashboard widgets
  - an example custom dashboard widget
  - adding custom login css
  - changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
  - adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/******** Admin Bar for Administrators Only ********/
add_action( 'after_setup_theme', 'hide_admin_bar' );

function hide_admin_bar() {
  if ( !current_user_can( 'edit_posts' ) ) {
    add_filter( 'show_admin_bar', '__return_false' );
  }
}

/************* THUMBNAIL SIZE OPTIONS *************/
add_action( 'after_setup_theme', 'theme_thumbnail_setup' );

function theme_thumbnail_setup() {
  // Thumbnail sizes
  add_image_size( '270x270c', 270, 270, true );
  add_image_size( '370x265c', 370, 265, true );
  add_image_size( '570x315c', 570, 315, true );
  add_image_size( 'related-thumb', 330 );
  add_image_size( 'related-thumb-c', 330, 193, true );
  add_image_size( 'post-thumb', 92, 92, true );
  add_image_size( 'related-small-thumb', 163, 92 );
  add_image_size( 'post-full', 750 );
  add_image_size( 'search-thumb', 90, 90, true );
  add_image_size( 'post-img', 750 );
  add_image_size( 'post-img-h', 480 );
  add_image_size( 'post-img-s', 400 );
  add_image_size( 'post-img-m', 500 );
  add_image_size( 'post-img-l', 600 );
  add_image_size( 'post-img-thumb', 534, 175 );
  add_image_size( 'col-4-img-thumb', 361 );
  add_image_size( 'col-4-img-thumb-x', 361, 203 );
  add_image_size( 'col-4-img-thumb-c', 361, 241, true );
  add_image_size( 'col-4-square-c', 361, 361, true );
  add_image_size( 'col-3-img-thumb-c', 263, 175, true );
  add_image_size( 'power-thumb', 340, 190 );
  add_image_size( 'news-img', 361, 259 );
  add_image_size( 'event-img', auto, 300 );
}

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Sidebar 1', 'bonestheme' ),
    'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  /*
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call
  your new sidebar just use the following code:

  Just change the name to whatever your new
  sidebar's id is, for example:

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Sidebar 2', 'bonestheme' ),
    'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php

  */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="clearfix">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
        <?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content clearfix">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
  $search_term = $_GET['term'] ? $_GET['term'] : '';

  $form = '<div role="search" class="search-box-wrapper">
      <form class="form-search js-search-form" action="/zsearch" id="global-nav-search">
        <label class="visuallyhidden" for="search-query">Search query</label>
        <input class="search-input" value="' . esc_attr__( $search_term ) . '" type="text" id="term" placeholder="' . esc_attr__( 'Search Zumic...', 'bonestheme' ) . '" name="term" autocomplete="off" spellcheck="false" dir="ltr">
        <span class="icon-search-wrapper js-search-action">
          <button type="submit" class="icon icon-search nav-search" tabindex="0">
            <span class="visuallyhidden">' . esc_attr__( 'Search' ) .'</span>
          </button>
        </span>
      </form>
    </div>';
  return $form;
} 


/**
 * Allow sort by multiple
 */
function order_by_multiple( $orderby ) {
  return 'menu_order DESC, post_date DESC';
}

//Tim- functions/////////////////////////////////////////////////////////////////////////////
///////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function order_by_latest( $orderby ) { 
  return 'post_date DESC'; 
}
/**
 * Adds support for page-attributes in Posts
 */
add_action('init', 'page_attributes_init');
function page_attributes_init() {
  add_post_type_support( 'post', 'page-attributes' );
}

/**
 * Changes img hmtl to [short code] when using Add Media button
 */
add_filter( 'image_send_to_editor', 'zumic_img_editor_shortcode', 10, 8 ); 
function zumic_img_editor_shortcode( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
  $html = "[mla_gallery ids='" . $id . "' size='post-img' mla_markup='image'";
  if($url) {
    $html .= " caption_link='" . $url . "'";
  } else {
    // $html .= " caption_link='#'";
  }
  $html .= "]";
  return $html;
}

/**
 * Related posts
 *
 * @param array $post_types
 * @param integer $limit
 */
function show_related_posts( $post_types, $limit, $tpl, $common_tags = 0, $title = '', $term = '' ) {
  $title = sprintf( '<h2 class="title-headline">%s</h2>', $title );

  $term_taxonomy_ids = $term ? get_term_taxonomy_ids_by_term( $term ) : [];

  $args = array(
    // Pool options: these determine the "pool" of entities which are considered
    'post_type' => $post_types,
    'show_pass_post' => false, // show password-protected posts
    'past_only' => false, // show only posts which were published before the reference post
    'exclude' => $term_taxonomy_ids, // a list of term_taxonomy_ids. entities with any of these terms will be excluded from consideration.
    'recent' => false, // to limit to entries published recently, set to something like '15 day', '20 week', or '12 month'.

    // Relatedness options: these determine how "relatedness" is computed
    // Weights are used to construct the "match score" between candidates and the reference post
    'weight' => array(
        'body' => 1,
        'title' => 2, // larger weights mean this criteria will be weighted more heavily
        'tax' => array(
            'post_tag' => 1 // put any taxonomies you want to consider here with their weights
        )
    ),
    // Specify taxonomies and a number here to require that a certain number be shared:
    'require_tax' => array(
        'post_tag' => $common_tags // for example, this requires all results to have at least one 'post_tag' in common.
    ),
    // The threshold which must be met by the "match score"
    'threshold' => 0.001,

    // Display options:
    'template' => 'yarpp-template-' . $tpl . '.php', // either the name of a file in your active theme or the boolean false to use the builtin template
    'limit' => $limit, // maximum number of results
    'order' => 'score DESC'
  );

  $related_exist = yarpp_related_exist( $args, $reference_ID );

  $html = yarpp_related(
    $args,
    $reference_ID, // second argument: (optional) the post ID. If not included, it will use the current post.
    false
   ); // third argument: (optional) true to echo the HTML block; false to return it

  $html = $related_exist ? $title . $html : '';

  return $html;
}

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
function zumic_excerpt_by_id($post, $length = 35, $tags = '<a><em><strong>', $extra = '...') {
 
  if(is_int($post)) {
    // get the post object of the passed ID
    $post = get_post($post);
  } elseif(!is_object($post)) {
    return false;
  }
 
  if(has_excerpt($post->ID)) {
    $the_excerpt = $post->post_excerpt;
    return apply_filters('the_content', $the_excerpt);
  } else {
    $the_excerpt = $post->post_content;
  }
 
  $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
  $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
  $excerpt_waste = array_pop($the_excerpt);
  $the_excerpt = implode($the_excerpt);
  $the_excerpt .= $extra;
 
  return apply_filters('the_content', $the_excerpt);
}


/**
 * Custom search URL
 */
function custom_search_base() {
    $GLOBALS['wp_rewrite']->search_base = 'zsearch';
}

add_action( 'init', 'custom_search_base' );


/**
 * Get term meta field
 */
function get_tax_meta( $term_id, $key ) {
  $t_id = ( is_object( $term_id ) ) ? $term_id->term_id : $term_id;
  $term_data = get_option( 'taxonomy_' . $term_id );
  if ( isset( $term_data[$key] ) ){
    return $term_data[$key];
  } else {
    return '';
  }
}

/**
 * Recursively sort an array of taxonomy terms hierarchically. Child categories will be
 * placed under a 'children' member of their parent term.
 * @param Array   $cats     taxonomy term objects to sort
 * @param Array   $into     result array to put them in
 * @param integer $parentId the current parent ID to put them in
 */
function sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0) {
  foreach( $cats as $i => $cat ) {
    if( $cat->parent == $parentId ) {
      $into[ $cat->term_id ] = $cat;
      unset( $cats[$i] );
    }
  }

  foreach( $into as $topCat ) {
    $topCat->children = array();
    sort_terms_hierarchicaly( $cats, $topCat->children, $topCat->term_id );
  }
}

/**
 * Returns N popular taxonomy terms mentioned in author posts
 * 
 * @param integer $author_id  author id
 * @param string  $term       taxonomy term object to search
 * @param integer $limit      number of items to return
 */
function get_author_popular_topics( $author_id, $term, $limit = 5 ) {
  global $wpdb;

  $sql = " 
    SELECT count(terms.term_id) as count, terms.term_id, terms.name, terms.slug as link, tt.taxonomy as taxonomy
    FROM {$wpdb->terms} AS terms, {$wpdb->posts} AS posts, {$wpdb->term_taxonomy} as tt, {$wpdb->term_relationships} as tr 
    WHERE posts.post_author = {$author_id} 
      AND terms.term_id = tt.term_id 
      AND posts.ID = tr.object_id 
      AND tr.term_taxonomy_id = tt.term_taxonomy_id 
      AND tt.taxonomy = '{$term}' 
    GROUP BY terms.name 
    ORDER BY count DESC 
    LIMIT {$limit}
  ";

  $sql_result = $wpdb->get_results( $sql, OBJECT );

  return $sql_result;
}


/**
 * Generates a tag cloud (heatmap) from provided data.
 *
 * The text size is set by the 'smallest' and 'largest' arguments, which will
 * use the 'unit' argument value for the CSS text size unit. The 'format'
 * argument can be 'flat' (default), 'list', or 'array'. The flat value for the
 * 'format' argument will separate tags with spaces. The list value for the
 * 'format' argument will format the tags in a UL HTML list. The array value for
 * the 'format' argument will return in PHP array type format.
 *
 * The 'tag_cloud_sort' filter allows you to override the sorting.
 * Passed to the filter: $tags array and $args array, has to return the $tags array
 * after sorting it.
 *
 * The 'orderby' argument will accept 'name' or 'count' and defaults to 'name'.
 * The 'order' is the direction to sort, defaults to 'ASC' and can be 'DESC' or
 * 'RAND'.
 *
 * The 'number' argument is how many tags to return. By default, the limit will
 * be to return the entire tag cloud list.
 *
 * The 'topic_count_text' argument is a nooped plural from _n_noop() to generate the
 * text for the tooltip of the tag link.
 *
 * The 'topic_count_text_callback' argument is a function, which given the count
 * of the posts with that tag returns a text for the tooltip of the tag link.
 *
 * @todo Complete functionality.
 * @since 2.3.0
 *
 * @param array $tags List of tags.
 * @param string|array $args Optional, override default arguments.
 * @return string
 */
function wp_generate_tag_cloud_custom( $tags, $args = '' ) {
  $defaults = array(
    'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 0,
    'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
    'topic_count_text' => null, 'topic_count_text_callback' => null,
    'topic_count_scale_callback' => 'default_topic_count_scale', 'filter' => 1,
  );

  $args = wp_parse_args( $args, $defaults );
  extract( $args, EXTR_SKIP );

  if ( empty( $tags ) )
    return;

  // Juggle topic count tooltips:
  if ( isset( $args['topic_count_text'] ) ) {
    // First look for nooped plural support via topic_count_text.
    $translate_nooped_plural = $args['topic_count_text'];
  } elseif ( ! empty( $args['topic_count_text_callback'] ) ) {
    // Look for the alternative callback style. Ignore the previous default.
    if ( $args['topic_count_text_callback'] === 'default_topic_count_text' ) {
      $translate_nooped_plural = _n_noop( '%s topic', '%s topics' );
    } else {
      $translate_nooped_plural = false;
    }
  } elseif ( isset( $args['single_text'] ) && isset( $args['multiple_text'] ) ) {
    // If no callback exists, look for the old-style single_text and multiple_text arguments.
    $translate_nooped_plural = _n_noop( $args['single_text'], $args['multiple_text'] );
  } else {
    // This is the default for when no callback, plural, or argument is passed in.
    $translate_nooped_plural = _n_noop( '%s topic', '%s topics' );
  }

  $tags_sorted = apply_filters( 'tag_cloud_sort', $tags, $args );
  if ( $tags_sorted != $tags  ) { // the tags have been sorted by a plugin
    $tags = $tags_sorted;
    unset($tags_sorted);
  } else {
    if ( 'RAND' == $order ) {
      shuffle($tags);
    } else {
      // SQL cannot save you; this is a second (potentially different) sort on a subset of data.
      if ( 'name' == $orderby )
        uasort( $tags, '_wp_object_name_sort_cb' );
      else
        uasort( $tags, '_wp_object_count_sort_cb' );

      if ( 'DESC' == $order )
        $tags = array_reverse( $tags, true );
    }
  }

  if ( $number > 0 )
    $tags = array_slice($tags, 0, $number);

  $counts = array();
  $real_counts = array(); // For the alt tag
  foreach ( (array) $tags as $key => $tag ) {
    $real_counts[ $key ] = $tag->count;
    $counts[ $key ] = $topic_count_scale_callback($tag->count);
  }

  $min_count = min( $counts );
  $spread = max( $counts ) - $min_count;
  if ( $spread <= 0 )
    $spread = 1;
  $font_spread = $largest - $smallest;
  if ( $font_spread < 0 )
    $font_spread = 1;
  $font_step = $font_spread / $spread;

  $a = array();

  foreach ( $tags as $key => $tag ) {
    $count = $counts[ $key ];
    $real_count = $real_counts[ $key ];
    $tag_link = '#' != $tag->link ? $tag->link : '#';
    $tag_id = isset($tags[ $key ]->id) ? $tags[ $key ]->id : $key;
    $tag_name = $tags[ $key ]->name;

    if( $tag->taxonomy == 'post_tag' ) {
      $tag_taxonomy = 'artists';
    } else {
      $tag_taxonomy = $tag->taxonomy ? $tag->taxonomy : '';
    }


    if ( $translate_nooped_plural ) {
      $title_attribute = sprintf( translate_nooped_plural( $translate_nooped_plural, $real_count ), number_format_i18n( $real_count ) );
    } else {
      $title_attribute = call_user_func( $topic_count_text_callback, $real_count, $tag, $args );
    }

    $a[] = "<a href='/$tag_taxonomy/$tag_link' class='tag-link-$tag_id' title='" . esc_attr( $title_attribute ) . "' style='font-size: " .
      str_replace( ',', '.', ( $smallest + ( ( $count - $min_count ) * $font_step ) ) )
      . "$unit;' >$tag_name</a>";
  }

  switch ( $format ) :
  case 'array' :
    $return =& $a;
    break;
  case 'list' :
    $return = "<ul class='wp-tag-cloud'>\n\t<li>";
    $return .= join( "</li>\n\t<li>", $a );
    $return .= "</li>\n</ul>\n";
    break;
  default :
    $return = join( $separator, $a );
    break;
  endswitch;

  if ( $filter )
    return apply_filters( 'wp_generate_tag_cloud_custom', $return, $tags, $args );
  else
    return $return;
}

/**
 * Google adsense
 */
function get_adsense( $page_id, $slot = '', $ad_size = '' ) {
  $ad_sizes = [ 
    '300x250' => [ 
      'size' => [ 
        'width' => 300,
        'height' => 250
      ] 
    ], 
    '300x600' => [ 
      'size' => [ 
        'width' => 300,
        'height' => 600
      ] 
    ], 
    '336x280' => [ 
      'size' => [ 
        'width' => 336,
        'height' => 280
      ] 
    ], 
    '728x90' => [
      'size' => [ 
        'width' => 728,
        'height' => 90
      ] 
    ]
  ];
  $blocked_pages = [];

  if( in_array( $page_id, $blocked_pages ) 
    || !array_key_exists( $ad_size, $ad_sizes )
    || !$slot 
    || !$ad_size 
  ) return false;


  $ad = sprintf( 
    '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
      style="display:inline-block;width:%spx;height:%spx"
      data-ad-client="ca-pub-1452859824302620"
      data-ad-slot="%s"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>', 
    $ad_sizes[$ad_size]['size']['width'], 
    $ad_sizes[$ad_size]['size']['height'], 
    $slot 
  );

  return $ad;
}

/**
 * Google responsive adsense
 */
function get_responsive_adsense( $page_id, $slot = '' ) {
  $blocked_pages = [];

  if( in_array( $page_id, $blocked_pages ) || !$slot ) return false;

  $ad = sprintf( 
    '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-1452859824302620"
           data-ad-slot="%s"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>', 
    $slot 
  );

  return $ad;
}


/**
 * Select posts where menu_order >= 300
 */
function posts_menu_order_gt_300( $where ) {
  $where .= " AND menu_order >= 300 ";
  return $where;
}


/**
 * Returns substring from requested position
 * 
 * @param string  $str      string to search
 * @param integer $pos      position to return
 */
function get_substr_from_parsed( $str, $pos ) {
  $parts = explode( '|', $str );
  return isset( $parts[$pos] ) ? $parts[$pos] : false;
}

/**
 * Parses date and returns date in this format: "Y-m-d H:i:s"
 */
function get_date_parsed( $date_str ) {
  return $date = date( "Y-m-d H:i:s", strtotime( $date_str . '0' ) );
}

/**
 * Returns genres array
 * 
 * @param string  $str      string to search
 */
function get_genres_parsed( $str ) {
  $genres = explode( ' and ', $str );
  return implode( '/', $genres );
}

/**
 * Get artists by slug
 * 
 * @param array $slugs  array of slugs to check
 */
function get_artists_by_slug( $slugs ) {
  global $wpdb;

  $qry_str = implode( "','", $slugs );

  $sql = " 
    SELECT posts.ID, posts.post_title, posts.post_name 
    FROM {$wpdb->posts} AS posts 
    WHERE posts.post_type = 'artists' 
      AND posts.post_name IN ('{$qry_str}')
  ";

  $sql_result = $wpdb->get_results( $sql, OBJECT );

  return $sql_result;
}

/**
 * Get related artists by tags
 * 
 * @param integer $post_id  current post id to be excluded
 * @param array   $tags     array of tags to check
 */
function get_related_artists_by_tags( $type, $post_id, $tags ) {
  global $wpdb;

  $args = array(
    'post_type' => $type,
    'post_status' => 'publish', 
    'posts_per_page' => 4,
    'post__not_in' => [$post_id],
    'tax_query' => array(
      array(
        'taxonomy' => 'post_tag',
        'field' => 'id',
        'terms' => $tags,
        'operator' => 'IN'
      )
    )
  );
  $the_query = new WP_Query( $args );

  return $the_query;
}

/**
 * Flatten the array
 */
function flatten( array $array ) {
  $return = array();
  array_walk_recursive( $array, function($a) use (&$return) { $return[] = $a; } );
  return $return;
}


/**
 * Get term_taxonomy_ids by root taxonomy
 * 
 * @param integer $term_id
 */
function get_term_taxonomy_ids_by_term( $term ) {
  global $wpdb;

  $taxonomy = 'media-type';
  $terms_array[] = $term;
  $terms_array = get_term_children( $term, $taxonomy );
  $term_ids = implode( ',', $terms_array );

  $sql = "
    SELECT tt.term_taxonomy_id
    FROM wp_terms AS t
      INNER JOIN wp_term_taxonomy AS tt
        ON t.term_id = tt.term_id
    WHERE tt.taxonomy = 'media-type'
      AND tt.term_id IN ({$term_ids})
  ";

  $sql_result = $wpdb->get_results( $sql, ARRAY_N );
  $term_taxonomy_ids = flatten( $sql_result );

  return $term_taxonomy_ids;
}

function be_add_blog_rewrite_endpoint() {
  add_rewrite_endpoint( 'filter', EP_ALL );
}
add_action( 'init', 'be_add_blog_rewrite_endpoint' );


////////////////||||||||||||||||||TIM's Functions|||||||||||||||||\\\\\\\\\\\\\\\\\\\
////////////////|||||||||||||||||||||||||||||||||||||||||||||||||///////////////////
function the_slug($pageID) { // Is there any other way to get the parent page slug?

  $post_data = get_post($pageID, ARRAY_A);
  $slug = $post_data['post_name'];
  return $slug;
}

function child_page_template(){
  global $post;
  $parent_page_slug = the_slug($post->post_parent);
  $page_template = 'single-'. $parent_page_slug . '-child.php'; //name it on your own
  $parents = get_post_ancestors($post->ID); // if is child
  if($parents){update_post_meta($post->ID,'_wp_page_template',$page_template);}

}

add_action('save_post','child_page_template');


function zumic_shortcode($atts, $content=null) {


extract(shortcode_atts( array('artist' => ''), $atts));


ob_start();
?>
  <h3 class="tagstitle" style="text-transform: uppercase;"><?php echo $artist; ?> TOUR DATES & TICKETS</h3> 
  <div class="bod">
  <table class="zumic-table tdate"  border="1" cellpadding="3">
  <tbody>
  <th><div class="tourdate">Date</div></th>
  <th><div class="tourcv">City/Venue</div></th>
  <th><div class="tourtic">Tickets</div></th>
  </tbody>
  </table>
  <?php
    $timecutoff = date("Y-m-d");
      $args = array(
        'post_type'    => 'events',
        'orderby'      => 'meta_value',
        'meta_key'     => 'event_date',
        'meta_compare' => '>=',
        'tag_slug__and'   => $artist,
        'meta_value'   => $timecutoff,
        'showposts'    => -1,
        'order'        => 'ASC'
        );
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()) : while ($my_query->have_posts()) :
    $my_query->the_post();
    $eventdate = get_post_meta($post->ID, "eventdate", true);
  ?>
  <a href="<?php the_permalink() ?>"  style="color:black!important;">
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
        <a href="<?php the_permalink() ?>" style="color:black!important;">
            <?php // THE TITLE //
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                                
                               //echo substr($titlesub, 0, strrpos($titlesub, 'ON') - 1);

                            ?>
          </b>
        </a>
      </div>
      </td>
      <td>
      <div class="eventtic">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Tickets</a>
      </div>
      </td>
      </tr>
    </tbody>
 </table>
</a>
  <?php endwhile; else: ?>
  <?php
      $posttags = get_the_tags();
      $count=0;
      if ($posttags) {
        foreach($posttags as $tag) {
          $count++;
          if (1 == $count) {
            echo "<h5 ><a href='http://zumic.com/artists/$tag->name' style='color:#78c0eb!important;'>" . $tag->name. " ";
          }
        }
      }
?>
HAS NO TOUR DATES SCHEDULED AT THIS TIME</a></h5>
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
<?php return ob_get_clean();


}
add_shortcode('tourdates', 'zumic_shortcode');




function distance_haversine($lat1, $lon1, $lat2, $lon2) {
  global $earth_radius;
  global $delta_lat;
  global $delta_lon;
  $alpha    = $delta_lat/2;
  $beta     = $delta_lon/2;
  $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin(deg2rad($beta)) * sin(deg2rad($beta)) ;
  $c        = asin(min(1, sqrt($a)));
  $distance = 2*$earth_radius * $c;
  $distance = round($distance, 4);
 
  return $distance;

}








  function custom_login_logo() {
  echo '<style type="text/css">
  h1 a { 
    background-image: url(http://zumic.com/wp-content/uploads/2014/11/zumiclog.jpg) !important; 
  }
  .login h1 {
  background-color: white;
  }

  </style>';
}
add_action('login_head', 'custom_login_logo');

 //Venues tax-----////////////////////
function my_custom_taxonomies() {
   

    $labels = array(
        'name'                       => 'Venue Name',
        'singular_name'              => 'Venue Name',
        'search_items'               => 'Search Venue Names',
        'popular_items'              => 'Popular Venue Names',
        'all_items'                  => 'All Venue Names',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Venue Name',
        'update_item'                => 'Update Venue Name',
        'add_new_item'               => 'Add New Venue Name',
        'new_item_name'              => 'New Venue Name',
        'separate_items_with_commas' => 'Separate venue names with commas',
        'add_or_remove_items'        => 'Add or remove Venue Names',
        'choose_from_most_used'      => 'Choose from the most used Venue Names',
        'not_found'                  => 'No Venue Names found.',
        'menu_name'                  => 'Venue Names',
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'venue-name' ),
    );

    register_taxonomy( 'venue-name', array( 'venues', 'events' ), $args );
}

add_action( 'init', 'my_custom_taxonomies' );


//The_excerpt length///////////////
function custom_excerpt_length( $length ) {
  return 12;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );






// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0 View';
    }
    return $count.' Views';
}
 
// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
 
// Add it to a column in WP-Admin - (Optional)
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}



function wpseo_cdn_filter( $uri ) {
  return str_replace( 'http://zumic.com', 'http://cdn.zumic.com', $uri );

}

add_filter( 'wpseo_xml_sitemap_img_src', 'wpseo_cdn_filter' );




add_action( 'init', 'my_deregister_heartbeat', 1 );
function my_deregister_heartbeat() {
  global $pagenow;

  if ( 'post.php' != $pagenow && 'post-new.php' != $pagenow )
    wp_deregister_script('heartbeat');
}


function getLnt($zip){
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=
".urlencode($zip)."&sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
$result1[]=$result['results'][0];
$result2[]=$result1[0]['geometry'];
$result3[]=$result2[0]['location'];
return $result3[0];
}


/*
 * David's functions to add to functions.php
 *
 */

// Automatically updating ticketfiller via cron job
if (!wp_next_scheduled('webticketfiller_update')) {
    wp_schedule_event(time(), 'daily', 'webticketfiller_update');
}

remove_all_actions('webticketfiller_update');
add_action('webticketfiller_update', 'trigger_automatic_ticketfiller');

function trigger_automatic_ticketfiller() {
    $endpoint = 'http://zumic.com/web-ticketfiller-runner';
    $payload = array(
        'artist'=>'Zum!cMus1c2015',
        'aw_update'=>'y',
        'ss_update'=>'y',
        'featuredimage_name'=>'',
        'body_content'=>'',
        'auto'=>'auto'
    );

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $resp = curl_exec($ch);
    echo $resp;

    curl_close($ch);
}



function find_tag_in_title( $title, $posttags ) {

  foreach( $posttags as $tag ){
    if( strpos( strtolower($title), strtolower($tag->name) ) !== false ) return $tag->name;
  }

return false;    
}
