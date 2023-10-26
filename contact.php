<?php 
/*
Template Name:contact

*/
get_header(); 

$front=get_field('cn');
?>

<section class="home-banner">
  <div class="home-banner-img-wraper">
    <img src="<?php echo $front['img'];?>" alt="">

  </div>
  <div class="banner-text-wraper">
    <div class="container">
      <h1><?php echo $front['head'];?></h1>
      <p><?php echo $front['txt'];?></p>
      <!-- <a href="#" class="btn btn-white">SHOP NOW</a> -->
    </div>

  </div>

</section>

<section class="contact-form common-padd">
    <div class="container">
        <div class="contact-form-wrap">
           
            <?php echo do_shortcode('[contact-form-7 id="27ff298" title="form"]');?>

        </div>

    </div>

</section>







<?php get_footer(); ?>
