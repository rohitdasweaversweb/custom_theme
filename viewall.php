<?php 
/*
Template Name:allpost

*/
get_header(); 


?>

<section class="home-banner">
  <div class="home-banner-img-wraper">
    <img src="<?php bloginfo('template_directory'); ?>/assets/images/home-banner.jpg" alt="">

  </div>

  <div class="banner-text-wraper">
    <div class="container">
      <h1><?php echo"<h1>viewall</h1>"?></h1>
     
    </div>

  </div>
  </section>

  <section class="Charities-sec common-padd">
  <div class="container">
    <div class="section-heading text-center">
      <h2>All Post</h2>
      <p>You can choose which local San Diego Charity your profits go to. We have selected charities focused on
        addressing food insecurity and the helping homeless</p>

    </div>
    <div class="row">
      <?php
      $args = array(
        'post_type' => 'blogs',
        'post_status' => 'publish',
        'order' => 'ASC',
        //'posts_per_page' => 3,
      );
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
          // print_r($img);
          ?>

          <div class="col-lg-4 col-md-6">
            <div class="cha-col-sec">
              <div class="cha-img-wraper">
                <img src="<?php echo $img[0]; ?>" alt="">

              </div>
              <div class="cha-col-content">
                <h3>
                  <?php the_title(); ?>
                </h3>
                <p>
                  <?php the_excerpt() ?>
                </p>

                <a href="<?php echo the_permalink().'?type=blogs'; ?>" class="learn-more">Learn More</a>
              </div>

            </div>

          </div>

        <?php
        }
      }
      ?>

    </div>

    
  </div>

</section>

<?php get_footer(); ?>
