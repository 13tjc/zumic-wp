<?php
/**
 * Login page template
 **/
?>

<?php get_header(); ?>

      <div id="content">

        <div id="inner-content" class="wrap clearfix">

            <div id="main" class="first clearfix" role="main">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

                <header class="page-header">
                  <h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
                </header>

                <div class="row clearfix">
                  <section class="grid-6 users-new entry-content clearfix">
                    <h2>New Users</h2>
                    <p>By creating an account with us you can get...</p>
                  </section>

                  <section class="grid-6 last users-registered entry-content clearfix">
                    <h2>Registered Users</h2>
                    <p>If you have an account with us, please log in.</p>

                    <div class="social-login">
                      <?php do_action('oa_social_login'); ?>
                    </div>

                    <?php the_content(); ?>
                  </section>
                </div>

                <div class="row clearfix">

                  <div class="buttons-set grid-6">
                    <button type="button" title="Create an Account" class="button" onclick="window.location='http://dev.zumic.com/register/';"><span>Create an Account</span></button>
                  </div>

                  <div class="buttons-set grid-6 last">
                    <button type="button" title="Create an Account" class="button" onclick="window.location='http://dev.zumic.com/register/';"><span>Login</span></button>
                  </div>

                </div>
                
                <?php // comments_template(); ?>

              </article>

              <?php endwhile; ?>

              <?php else : ?>

              <?php endif; ?>

            </div>

            <?php get_sidebar(); ?>

        </div>

      </div>

<?php get_footer(); ?>
