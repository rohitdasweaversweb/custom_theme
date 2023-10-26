<?php
/*
Template Name:donate

*/
get_header();

$shop = get_field('shop');
?>

<section class="home-banner">
    <div class="home-banner-img-wraper">
        <img src="<?php echo $shop['img']; ?>" alt="">

    </div>
    <div class="banner-text-wraper">
        <div class="container">
            <p>
                <?php echo $shop['txt']; ?>
            </p>
            <h1>
                <?php echo $shop['head']; ?>
            </h1>

        </div>

    </div>

</section>

<section class="shop-gallery common-padd">
    <div class="container">
        <div class="row">
            <?php


            $args1 = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => 5,


            );
            $FeaProduct_query = new WP_Query($args1);
            while ($FeaProduct_query->have_posts()):
                $FeaProduct_query->the_post();
                global $product; ?>

                <div class="col-lg-4 col-md-6">
                    <div class="shop-gallery-col">
                        <div class="shop-gallery-img-wrap">
                            <!-- <img src="images/images4.jpg" alt=""> -->
                            <?php
                            if (has_post_thumbnail($products->post->ID))
                                echo get_the_post_thumbnail($products->post->ID, 'shop_catalog');
                            else
                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                            ?>
                        </div>
                        <div class="shop-gallery-content">
                            <h4><a href="#">
                                    <?php the_title(); ?>
                                </a></h4>
                            <p>Price :<?php echo $product->get_price_html(); ?></p>
                            <?php
                            echo '<a href="?add-to-cart=' . get_the_ID() . '" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="' . get_the_ID() . '" data-product_sku="" aria-label="Add to cart" rel="nofollow">Add to Cart</a>';?>
                        </div>
                    </div>

                </div>
                <?php
            endwhile;
            wp_reset_query(); ?>
        </div>

    </div>

</section>

<?php get_footer(); ?>