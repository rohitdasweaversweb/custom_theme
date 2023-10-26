<?php
/*
    Template name:allsearch

*/
get_header();

?>
<section class="search-page common-padd">
    <div class="container">
        <div class="search-wraper">
            <form id="searchform">
                <div class="search-flex">
                    <input type="text" value="" name="product_name" id="product_name" placeholder="Search for products"
                        class="form-control">
                    <input type="submit" class="btn btn-org" id="searchsubmit" value="Submit">
                </div>
            </form>

        </div>

    </div>
</section>

<section class="search-card common-padd">
    <div class="container">

        <div class="row" id="search-results">
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
                            <p>Price :
                                <?php echo $product->get_price_html(); ?>
                            </p>
                        </div>
                    </div>

                </div>
                <?php
            endwhile;
            wp_reset_query(); ?>
        </div>

    </div>
    </div>
</section>
<?php get_footer(); ?>