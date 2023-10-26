<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>  
<h4><?php the_title(); ?></h4>
<p><?php the_content(); ?></p>
<?php endwhile;

previous_posts_link();
next_posts_link();


else: ?>
<h1><?php _e('Not Found')?></h1>
<p><?php _e('Sorry,no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
