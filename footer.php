<footer class="main-footer common-padd">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-6">
          <div class="footer-info">
            <img src="<?php echo get_theme_value('bc_footer_logo'); ?>" alt="">
            <p><?php echo get_theme_value('bc_footer_desc'); ?></p>
            <ul>
              <li><a href="<?php echo get_theme_value('driverite_instagram_link'); ?>" target="blank"><i class="fab fa-instagram"></i></a></li>
            </ul>

          </div>

        </div>
        <div class="col-lg-4 col-md-6">
          <div class="footer-info">
            <h4><?php echo get_theme_value('bc_footer_menu_title'); ?></h4>
            <ul>
              <li> <?php wp_nav_menu(array('theme_location'=>'secondary') );?></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <h4><?php echo get_theme_value('bc_footer_getin_title'); ?></h4>
            <ul>
              <li> <?php wp_nav_menu(array('theme_location'=>'other') );?></li>

            </ul>
          </div>
        </div>
      </div>
<div class="copy-right text-center">
  <p><?php echo get_theme_value('driverite_copyright_text'); ?></p>

</div>
    </div>

  </footer>

  <script>
jQuery(document).ready(function($){
    var timeoutMinus;
  jQuery('body').on('click', '.minus', function (e) {
    var $input = jQuery(this).parent().find('input.qty');
    var val = parseInt($input.val());
    var step = $input.attr('step');
    step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
    if (val > 1) {
        $input.val(val - step).change();
    }

   if( timeoutMinus != undefined ) {
            clearTimeout(timeoutMinus)
        }
        timeoutMinus = setTimeout(function(){
            $('[name="update_cart"]').trigger('click');
        }, ); 
});
var timeoutPlus;
jQuery('body').one().on('click', '.plus', function (e) {
    var $input = jQuery(this).parent().find('input.qty');
    var val = parseInt($input.val());
    var step = $input.attr('step');
    step = 'undefined' !== typeof(step) ? parseInt(step) : 1;
    $input.val(val + step).change();

    if( timeoutPlus != undefined ) {
            clearTimeout(timeoutPlus)
        }
        timeoutPlus = setTimeout(function(){
          jQuery('[name="update_cart"]').trigger('click');
        }, ); 
});

var timeoutInput;
    jQuery('div.woocommerce').on('change', 'input.qty', function(){
        if( timeoutInput != undefined ) {
            clearTimeout(timeoutInput)
        }
        timeoutInput = setTimeout(function(){
          jQuery('[name="update_cart"]').trigger('click');
        }, );
    });

});
</script>

<!-- <script src="js/function.js"></script> -->

<?php wp_footer(); ?>

</body>

</html>