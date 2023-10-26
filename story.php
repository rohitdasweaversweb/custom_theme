<?php 
/*
Template Name:story

*/
$st=get_field('story');
get_header(); ?>



<section class="home-banner inner-banner">
    <div class="home-banner-img-wraper">
      <img src="<?php echo $st['story_img'];?>" alt="">

    </div>
    <div class="banner-text-wraper">
      <div class="container">
        <p><?php echo $st['txt'];?></p>
        <h1><?php echo $st['head'];?></h1>
   
      </div>

    </div>

  </section>

  <section class="our-story common-padd our-story-main">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12">
            <div class="our-story-img-wraper">
              <div class="our-story-second-img w-100">
                <img src="<?php echo $st['image2'];?>" alt="">
              </div>
             
  
            </div>
          </div>
        <div class="col-lg-6 col-md-12">
          <div class="our-story-content">
            <h2><?php echo $st['head1'];?></h2>
            <p><?php echo $st['txt1'];?></p>
          

          </div>
        </div>
       

      </div>

    </div>

  </section>

  <section class="Charities-sec common-padd">
    <div class="container">
      <div class="section-heading text-center">
        <h2></h2>
        <p>You can choose which local San Diego Charity your profits go to. We have selected charities focused on
          addressing food insecurity and the helping homeless</p>

      </div>
      <div class="row">
      <?php
      $args = array(
        'post_type' => 'blogs',
        'post_status' => 'publish',
        // 'posts_per_page' => 3,
        'order' => 'ASC'
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

      <div class="view-all-btn">
        <a href="<?php the_permalink(68); ?>" class="btn btn-org">View All</a>
      </div>

    </div>

  </section>












<?php get_footer(); ?>