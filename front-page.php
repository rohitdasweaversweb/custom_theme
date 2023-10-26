<?php 
/*
Template Name:Homepage

*/
get_header(); 

$front=get_field('front_page');
?>

<section class="home-banner">
  <div class="home-banner-img-wraper">
    <img src="<?php echo $front['img'];?>" alt="">

  </div>
  <div class="banner-text-wraper">
    <div class="container">
      <h1><?php echo $front['head'];?></h1>
      <p><?php echo $front['txt'];?></p>
      <a href="#" class="btn btn-white">SHOP NOW</a>
    </div>

  </div>

</section>

<section class="our-story common-padd">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12">
        <?php
        $args = array(
          'post_type' => 'post',
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
            <div class="our-story-content">
              <h2>
                <?php the_title(); ?>
              </h2>
              <p>
                <?php the_excerpt() ?>
              </p>
              <a href="<?php the_permalink(); ?>" class="btn btn-black">Learn More</a>

            </div>

          </div>
          <div class="col-lg-6 col-md-12">
            <div class="our-story-img-wraper">
              <div class="our-story-second-img">
                <img src="<?php echo $img[0]; ?>" alt="">
              </div>
            <?php
          }
        }
        ?>
          <div class="our-story-logo">
            <img src="<?php echo $front['img2'];?>" alt="">

          </div>

        </div>
      </div>

    </div>

  </div>

</section>

<section class="Charities-sec common-padd">
  <div class="container">
    <div class="section-heading text-center">
      <h2>Our Charities</h2>
      <p>You can choose which local San Diego Charity your profits go to. We have selected charities focused on
        addressing food insecurity and the helping homeless</p>

    </div>
    <div class="row">
      <?php
      $args = array(
        'post_type' => 'blogs',
        'post_status' => 'publish',
        'order' => 'ASC',
        'posts_per_page' => 3,
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

 <section class="Shop-Donate-sec padding-bottom">
    <div class="container">
      <div class="section-heading text-center">
        <h2>Shop and Donate</h2>
        <p>All profits will go to the charity of your choice!</p>
      </div>
      <div class="row">
        <?php 
      

	$args1 = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_visibility',
				'field' => 'name',
				'terms' => 'featured',
			),
		),
		'posts_per_page' =>4,
		
	
	);

	$FeaProduct_query = new WP_Query($args1);
	while ($FeaProduct_query->have_posts()):
		$FeaProduct_query->the_post();
		global $product; ?>
        <div class="col-lg-3 col-md-6">
          <div class="shop-donate-col-wrap">
            <div class="shop-donate-img-wraper">
            <?php 
	if ( has_post_thumbnail( $products->post->ID ) ) 
	echo get_the_post_thumbnail( $products->post->ID, 'shop_catalog' ); 
	else 
	echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />'; 
	?>
              <div class="shop-price"><?php echo $product->get_price_html(); ?></div>
            </div>
            <div class="shop-content">
              <h3><?php the_title();?></h3>
              <p><?php echo $product->get_description(); ?></p>

            </div>
            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn btn-org">Add to Cart</a>
          </div>

        </div>
        <?php
	endwhile;
	wp_reset_query(); ?>
           
          </div>

        </div>

    

  </section>

<section class="sales-sec common-bg common-padd"
  style="background-image: url('<?php bloginfo('template_directory'); ?>/assets/images/sales-bg-img.jpg');">
  <div class="container">
    <div class="sales-content">
      <h2>Recent Sales</h2>
      <p>Please contact us directly for boards for your auctions or to gift to your donors. We can provide you
        with
        pictures and item descriptions and deliver the boards directly to recipients.</p>
      <a href="#" class="btn btn-black">Contact Us</a>
    </div>

  </div>

</section>


<?php get_footer(); ?>











