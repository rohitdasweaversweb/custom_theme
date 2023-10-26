<?php 
/*
Template Name:charity

*/
get_header(); 

$front=get_field('charity');
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

<section class="Charities-sec common-padd">
    <div class="container">

        <div class="row justify-content-center">
        <?php
        $args = array(
          'post_type' => 'blogs',
          'post_status' => 'publish'
        );
        $query = new WP_Query($args);
        // print_r($query);die();
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
                        <h3> <?php the_title(); ?></h3>
                        <p> <?php the_excerpt() ?></p>

                        <a href="<?php the_permalink(); ?>" class="learn-more">Visit Us</a>
                    </div>

                </div>

            </div>

            <?php
          }
        }
        ?>

        </div>

</section>




<?php get_footer(); ?>