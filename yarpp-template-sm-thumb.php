<?php
/*
YARPP Template: Small Thumbnails
Description: Shows related posts with small thumbnails
Author: Bo4A
*/ ?>
<?php if (have_posts()):?>
<ul class="related-posts">
  <?php while (have_posts()) : the_post(); ?>
    <?php if (has_post_thumbnail()):?>
    <li class="related-posts-item clearfix">
      <div class="img-wrapper">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
          <?php the_post_thumbnail( 'related-small-thumb' ); ?>
        </a>
      </div>
      <div class="title-wrapper">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </div>
      <div class="post-date"><?php echo get_the_time('M j, Y'); ?></div>
    </li>
    <?php endif; ?>
  <?php endwhile; ?>
</ul>

<?php else: ?>
<p>No related articles.</p>
<?php endif; ?>
