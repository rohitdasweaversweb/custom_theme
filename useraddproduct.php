<?php
/*
Template Name:useradd

*/
get_header();

?>

<style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 150px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type="file"] {
            padding: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        / Additional styles for product category dropdown /
        select[name="product-category"] {
            background: url("dropdown-arrow.png") no-repeat right center;
            background-color: #fff;
        }

    </style>

<section class="contact-form common-padd">
        <div class="container">
            <div class="contact-form-wrap">
             
                    <form method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-title">Product Title:</label>
                                <input type="text" name="product-title" id="product-title" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-description">Product Description:</label>
                                <textarea name="product-description" id="product-description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-price">Product Price:</label>
                                <input type="text" name="product-price" id="product-price" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-Sku">Product Sku:</label>
                                <input type="text" name="product-sku" placeholder="Product sku" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-category">Product Category:</label>
                                <select name="product-category" id="product-category">
                                    <option value="0">Select a category</option>
                                    <?php
                                    // Fetch product categories
                                    $categories = get_terms('product_cat', array('hide_empty' => false));
                                    foreach ($categories as $category) {
                                        echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-image">Product Image:</label>
                                <input type="file" name="product-image" id="product-image" required>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label for="product-image">Product Image Gallery:</label>
                                <input type="file" name="product-gallery-images[]" multiple="multiple">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <input type="submit" name="create-product" value="Create Product">
                            </div>
                        </div>
                        </div>
                    </form>
               
            </div>
        </div>
    </section>


<?php
if (isset($_POST['create-product'])) {
    // Include WooCommerce functions
    // include_once WC_ABSPATH() . 'includes/wc-product-functions.php';

    // Sanitize and retrieve user inputs
    $product_title = sanitize_text_field($_POST['product-title']);
    $product_description = sanitize_textarea_field($_POST['product-description']);
    $product_price = sanitize_text_field($_POST['product-price']);
    $sales_price = sanitize_text_field($_POST['sales-price']);
    $product_sku= sanitize_title($_POST['product-sku']); // Sanitize and create a sku
    $product_category_id = intval($_POST['product-category']); // Ensure it's an integer

    // print_r("yessssss");die;

    // Create a new product using WooCommerce
    $product = new WC_Product_Simple();
    $product->set_name($product_title);
    $product->set_regular_price($product_price);
    $product->set_sale_price($sales_price);
    $product->set_sku($product_sku);
    $product->set_category_ids(array($product_category_id));
    $product->set_description($product_description);
    $product->set_status('publish');

    // Save the product
    $product->save();

            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
          
            // Get the product ID
            $product_id = $product->get_id();
           
           
            // Set the image as the product thumbnail
            $attachment_id = media_handle_upload('product-image', $product_id);
            set_post_thumbnail($product_id, $attachment_id);

            if ( ! empty( $_FILES['product-gallery-images'] )  ) {
                $files = $_FILES['product-gallery-images'];
                foreach ($files['name'] as $key => $value){
                    if ($files['name'][$key]){
                        $file = array(
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                        );
                    }
                    $_FILES = array("my_file_upload" => $file);
                    // echo"<pre>";
                    // print_r($_FILES);
                    $i=1;
                        foreach ($_FILES as $file => $array) {
                              if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) __return_false();
                                $attachment_id = media_handle_upload($file, $product_id);
                                $vv .= $attachment_id . ",";
                                $i++;
                        }

                        update_post_meta($product_id, '_product_image_gallery',  $vv);
                    }
                }
}
?> 







<?php get_footer(); ?>