<?php get_header(); ?>

<section class="common-pg-sec common-padd">
    <div class="container">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>  
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php endwhile; else: ?>
    <h1><?php _e('Not Found')?></h1>
    <p><?php _e('Sorry,no posts matched your criteria.'); ?></p>
    <?php endif; ?>
    </div>
</section>



<?php get_footer(); ?>