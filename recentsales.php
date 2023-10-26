<?php
/*
  Template name:sales

*/
get_header();

?>

<section class="home-banner inner-banner">
  <div class="home-banner-img-wraper">
    <img src="<?php bloginfo('template_url'); ?>/assets/images/home-banner.jpg" alt="">

  </div>
  <div class="banner-text-wraper">
    <div class="container">
      <p>cutting boards and more</p>
      <h1>recent Sales</h1>

    </div>

  </div>

</section>

<section class="sales-gallery-sec common-padd">
  <div class="container">
    <div class="row justify-content-center">

      <?php


      $args= array(
        'post_type' => 'pdf',
        'post_status' => 'publish',
        // 'posts_per_page' => 5,


      );
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
          // print_r($img);
          $pdf_url = get_post_meta(get_the_ID(), 'pdf_url', true);
          // print_r($pdf_url);die;
          ?>

        <div class="col-lg-4 col-md-6">
          <div class="sales-gallery-col-wrap">
            <div class="sales-gallery-img-wraper">
              <!-- <img src="images/images4.jpg" alt=""> -->
              <img src="<?php echo $img[0]; ?>" alt="">
             
            </div>
            <div class="sales-gallery-content">
              <h3> <?php the_title(); ?></h3>
              <p><?php the_excerpt();?></p>
              <div class="button-flex">
                <a href="<?php echo site_url('contact-us');?>" class="btn btn-org">Contact Us</a>
               
                 <!-- <a href="#" class="btn btn-black" download>Download PDF</a> -->
               <a href="<?php echo $pdf_url;?>" class="btn btn-black" download >Download PDF</a>
              
              </div>
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