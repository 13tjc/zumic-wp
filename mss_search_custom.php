<?php
/**
  * Template Name: Search
  */


function spanOrder( $sort, $order, $thisSpan ) {
  if ( $sort.$order == $thisSpan ) {
    return '<span/>';
  }
  return '';
}

function isSelected( $sort, $order, $this_order ) {
  if ( $sort.$order == $this_order ) {
    return 'selected';
  }
  return '';
}
?>

<?php get_header(); ?>
<style type="text/css">
#container {
  overflow: hidden;
  background: radial-gradient(black 15%, transparent 16%) 0 0, radial-gradient(black 15%, transparent 16%) 8px 8px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
  background-color: #282828;
  background-size: 16px 16px;}
.body-border2 {color: white;background-color: #191919;border: 1px solid;border-color: black black black;
  width: 100%;max-width: 750px;padding: 2.6041667%;float: left;border-left: 1px solid black;
  border-right:1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;border-radius: 5px;
  margin-bottom:10px;padding-right:8px;padding-left: 12px;background-image: none;}
.body-border2 h2 a{color: white;}
.body-border2 h2 a:hover{color: black;}
.body-border2:hover{color: black;}
.search-results-item.clearfix:hover{background-color: #191919!important;}
.title-headline { border-bottom: 4px solid #979797; }
.body-border2 h2 a:hover {color: white; }
p:hover{color: white;}
.body-border2:hover {color: white;}
.collapsible-body a {color: white;}
form#global-nav-search {
margin-top: -23px;
}

</style>
<?php
$results = mss_search_results();
// var_dump($results);
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'score';
$order = (isset($_GET['order'])) ? $_GET['order'] : 'desc';
?>

<div id="content">

  <div id="inner-content" class="wrap clearfix">

    <div class="grid-3 first clearfix" role="complementary">

      <?php // get_search_form(); ?>

      <div class="search-filters">
        <?php 
        if ($results['facets']['selected']) {
          foreach( $results['facets']['selected'] as $selectedfacet ) {
            printf("<a href='%s'><span class='search-filters-remove'>x</span> %s</a>", $selectedfacet['removelink'], $selectedfacet['name']);
            }
        } 
        ?>
      </div>

      <?php 
        if ($results['facets']['output']) {
      ?>
        <div class="facets-wrapper">
          <ul class="facets">      
            <?php 
              foreach($results['facets'] as $facet) :
                if (isset($facet['name'])) :
            ?>
<div class="body-border2" style="margin-top:-13px"><!-- <div class="concertsb6"> -->
              <div class="collapsible-wrapper">
                <div class="collapsible-handlediv" title="Click to toggle"></div>
                <?php printf("<h3 class='collapsible-hndle'>%s</h3>", $facet['name']); ?>
                <div class="collapsible-body">
                  <?php 
                    foreach ($facet["items"] as $item) {
                      printf( __("<a href=\"%s\">%s <span class='resultCount'>(%s)</span></a>"), $item["link"], $item["name"], $item["count"] );
                    }
                  ?>
                </div>
              </div>
</div>
            <?php
                endif;
              endforeach;
            ?>

          </ul>
        </div>
      <?php } ?>

      <?php get_sidebar(); ?>

    </div>

    <div id="main" class="grid-9 last clearfix search-results" role="main">
<div class="body-border2">
      <div class="titlebar">

        <h1 class="title-headline">Zumic Search</h1>
        <div class="titlebar__filters">
          <select onchange="window.location = this.options[this.selectedIndex].value;">
            <option value="<?php echo $results['sorting']['scoredesc'] ?>">Relevance</option>
            <option value="<?php echo $results['sorting']['datedesc'] ?>" <?= isSelected( $sort, $order, 'datedesc' ); ?>>Newest</option>
            <option value="<?php echo $results['sorting']['dateasc'] ?>" <?= isSelected( $sort, $order, 'dateasc' ); ?>>Oldest</option>
            <option value="<?php echo $results['sorting']['commentsdesc'] ?>" <?= isSelected( $sort, $order, 'numcommentsdesc' ); ?>>Most Comments</option>
            <option value="<?php echo $results['sorting']['commentsasc'] ?>" <?= isSelected( $sort, $order, 'numcommentsasc' ); ?>>Least Comments</option>
          </select>
        </div>

      </div>

      <div class="search-results-help clearfix">
        <?php if ( $results['hits'] && $results['qtime'] ) {
          $hits = sprintf( _n( '1 result', '%s results', $results['hits'], 'zumic' ), $results['hits'] );
          $qtime = sprintf( _n( '1 second', '%s seconds', $results['qtime'], 'zumic' ), $results['qtime'] );
          printf( "<div class='result-stats'>%s found in<nobr>  (%s)</nobr></div>", $hits, $qtime );
        } ?>
      </div>

      <div class="search-results-content">
        <?php // printf("<pre>%s</pre>", print_r($results)); ?>
        <?php
        if ($results['hits'] === '0') {
          printf("<div class='solr_noresult'>
            <h2>Sorry, no results were found.</h2>
            <h3>Suggestions:</h3>
            <p>- Make sure all words are spelled correctly.</p>
            <p>- Try different keywords.</p>
            <p>- Try more general keywords.</p>
            </div>");
        } else {
          foreach($results['results'] as $result) {

            printf("<div class='search-results-item clearfix' onclick=\"window.location='%s'\">", $result['permalink']);

             if (has_post_thumbnail( $result['id'])){
               printf( "%s", get_the_post_thumbnail( $result['id'], 'search-thumb' ) );
            } else {
              echo "<img style='width:90px;' src='wp-content/uploads/2014/09/venuedefault.jpg'>";
            }

            printf("<h2><a href='%s'>%s</a></h2>", $result['permalink'], $result['title']);

            if ( $result['type'] == 'artists' ) { // do not print author and excerpt for artist page
              printf( "<p>Zumic Artist page</p>" );
            } else {
              printf( "<p>%s</p><div class='clearfix'></div>", $result['teaser'] );

              printf("<label class='result-stats'> By <a href='%s'>%s</a> in %s %s - <a href='%s'>%s comments</a></label>",
                $result['authorlink'], 
                $result['author'], 
                get_the_category_list( ', ', '', $result['id']), 
                date('m/d/Y', strtotime($result['date'])), 
                $result['comment_link'], 
                $result['numcomments']
              );
            }

            printf("</div>");
          }
        } ?>

        <?php
        if ( $results['pager'] && count( $results['pager'] ) > 1 ) {
          $itemlinks = [];
          $pagecnt = 0;
          $pagemax = 10;
          $next = '';
          $prev = '';
          $found = false;

          $pager_sort = $sort ? '&sort=' . $sort : '';
          $pager_order = $order ? '&order=' . $order : '';
          $pager_sorting = $pager_sort . $pager_order;

          foreach ( $results['pager'] as $item ) {
            if ( $item['link'] ) {
              if ($found && $next === '') {
                $next = $item['link'] . $pager_sorting;
              } else if ( $found == false ) {
                $prev = $item['link'] . $pager_sorting;
              }
              $itemlinks[] = sprintf( "<li><a class='page-numbers' href='%s'>%s</a></li>", $item['link'] . $pager_sorting, $item['page'] );
            } else {
              $found = true;
              $itemlinks[] = sprintf( "<li><span class='page-numbers current'>%s</span></li>", $item['page'] );
            }

            $pagecnt++;
            if ( $pagecnt === $pagemax ) {
              break;
            }
          }

          printf("<nav class='pagination'><ul class='page-numbers'>");

            if ( $prev !== '' ) {
              printf( "<li><a class='prev page-numbers' href='%s'>←</a></li>", $prev );
            }
            
            foreach ( $itemlinks as $itemlink ) {
              echo $itemlink;
            }
            
            if ( $next !== '' ) {
              printf( "<li><a class='next page-numbers' href='%s'>→</a></li>", $next );
            }

          printf("</ul></nav>");
        } ?>
      </div>

    </div>
</div>
  </div>

</div>

<?php get_footer(); ?>
