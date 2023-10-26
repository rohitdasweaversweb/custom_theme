<?php 
/*
Template Name:productad

*/
get_header(); 

?>



<style>
  / Style for the form /
  form {
    max-width: 400px;
    margin: 0 auto;
  }

  label {
    display: block;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="file"],
  textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  input[type="file"] {
    display: block; / Display each file input on a new line /
  }

  input[type="submit"] {
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  input[type="submit"]:hover {
    background-color: #0056b3;
  }
</style>

<?php 
if (isset($_POST['create-product'])) {
    // Retrieve and sanitize user inputs
    $product_title = sanitize_text_field($_POST['product-title']);
    $product_description = sanitize_textarea_field($_POST['product-description']);
    $product_price = sanitize_text_field($_POST['product-price']);
    $sales_price = sanitize_text_field($_POST['sales-price']);
    
    // Create a new product post
    $new_product = array(
        'post_title'    => $product_title,
        'post_content'  => $product_description,
        'post_status'   => 'publish',
        'post_type'     => 'product',
    );

    $product_id = wp_insert_post($new_product);

    // Set the product prices
    update_post_meta($product_id, '_regular_price', $product_price);
    update_post_meta($product_id, '_price', $product_price);

    // Set sale price
    update_post_meta($product_id, '_sale_price', $sales_price);

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php'); 

    // Handle product image upload and set as the product's featured image
    if (!empty($_FILES['product-image']['name'])) {
        $uploaded_image = media_handle_upload('product-image', $product_id);

        if (is_wp_error($uploaded_image)) {
            echo 'Error uploading image: ' . $uploaded_image->get_error_message();
        } else {
            set_post_thumbnail($product_id, $uploaded_image);
        }
    }

    // Handle product gallery images upload
    // print($_FILES['product-gallery-images']['name'][0]);die();
    if (!empty($_FILES['product-gallery-images']['name'][0])) {
        $gallery_images = array();
        $files = $_FILES['product-gallery-images'];

        foreach ($files['name'] as $key => $value) {
          // print_r($values);
            if ($files['error'][$key] === 0) {
              // print_r('yessss');die();
                $uploaded_image = media_handle_upload(array('name' => $files['name'][$key], 'tmp_name' => $files['tmp_name'][$key]), $product_id);
                // print_r($uploaded_image );die();
                if (is_wp_error($uploaded_image)) {
                  // print_r('yessss');die();
                    echo 'Error uploading gallery image: ' . $uploaded_image->get_error_message();
                } else {
                 
                    $gallery_images[] = $uploaded_image;
                    print($gallery_images);
                    // die();
                }
            }
        }
        print_r($gallery_images);die();
// die();
        // Set the uploaded images as the product's gallery images
        if (!empty($gallery_images)) {
            update_post_meta($product_id, '_product_image_gallery', implode(',', $gallery_images));
        }
    }

    // Redirect to the product page or wherever you want
    wp_redirect(get_permalink($product_id));
    exit;
}
?>

<form method="post" action="" enctype="multipart/form-data">
  <label for="product-title">Product Title:</label>
  <input type="text" name="product-title" id="product-title" required>

  <label for="product-description">Product Description:</label>
  <textarea name="product-description" id="product-description" required></textarea>

  <label for="product-price">Product Price:</label>
  <input type="text" name="product-price" id="product-price" required>

  <label for="sales-price">Sale Price:</label>
  <input type="text" name="sales-price" id="sales-price" required>

  <label for="product-image">Product Image:</label>
  <input type="file" name="product-image" id="product-image" accept="image/*" required>

  <label for="product-gallery-images">Product Gallery Images:</label>
  <input type="file" name="product-gallery-images[]" id="product-gallery-images" accept="image/*" multiple>

  <input type="submit" name="create-product" value="Create Product">
</form>



<?php get_footer(); ?>
