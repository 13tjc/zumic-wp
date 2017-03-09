<?php
/**
 * YARPP Template: Related Artists
 * Description: Shows related artists with thumbnails
 * Author: Bo4A
 */
?>

<?php if (have_posts()):?>
  <?php $i = 1; while (have_posts()) : the_post(); ?>
    <?php if (has_post_thumbnail()):?>
    <div class="related-posts-item entry-content clearfix grid-3<?php if($i % 4 == 0) echo ' last'; ?>">
      <div class="img-wrapper">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
          <?php the_post_thumbnail( 'related-thumb' ); ?>
        </a>
      </div>
      <div class="title-wrapper">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </div>
    </div>
    <?php $i++; endif; ?>
  <?php endwhile; ?>

<?php else: ?>
<?php endif; ?>
