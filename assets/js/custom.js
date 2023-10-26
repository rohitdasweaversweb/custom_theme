function menu_open() {
    jQuery(".main-menu").css({"transform":"translateX(0)"}) 
}
function menu_close() { 
    jQuery(".main-menu").css({"transform":"translateX(320px)"})
}

jQuery(window).scroll(function(){
  if (jQuery(window).scrollTop() >= 100) {
    jQuery('header').addClass('fixed');
   }
   else {
    jQuery('header').removeClass('fixed');
   }
});

jQuery(document).ready(function(){
  jQuery(".srch-tgl, .srch-close").click(function(){
    jQuery(".srch-pop").toggle();
  });
});

jQuery(document).ready(function(){
    jQuery('.btm-testimonials').owlCarousel({
    loop:true,
    autoplay:true,
    margin:0,
    nav:false,
    //navText: ["<img src='images/lt-arw.svg'>","<img src='images/rt-arw.svg'>"],
    dots:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:1,
        },
        1000:{
            items:2,
        }
    }
});
});



jQuery(document).ready(function(){
jQuery('.main-menu li a').click(function() {
    //alert("ssss");
       if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = jQuery(this.hash);
          target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            jQuery('html, body').animate({
              scrollTop: (target.offset().top - 64)
            }, 1000 );
            return false;
          }
        }
      });
    });

    jQuery(document).ready(function(){
    var photoTh = jQuery('.picture'),
    overlay = jQuery('.overlay');

photoTh.on('click', function() {    
    var dataPhoto = jQuery(this).attr('src'),
        dataTitle = jQuery(this).data('title');
  
    overlay.show();
    
    jQuery('.picture-big').attr("src", dataPhoto);
    jQuery('.photo-title').text(dataTitle);
  }
);

overlay.on('click', function() {
  jQuery(this).hide();
});

});



// =============================Search=======================

jQuery(document).ready(function($) {
  $('#searchform').submit(function(event) {
   console.log('yess');
      event.preventDefault();  // Prevent the default form submission behavior

      var searchQuery = $('#product_name').val();

      // AJAX request to retrieve products based on the search query
      $.ajax({
          url:ajax_object.ajax_url,
          type: 'POST',
          data: {
              'action': 'product_search_callback',
              'search_query': searchQuery
          },
          success: function(response) {
            console.log(response);
              // Update the product display with the response
              $('#search-results').html(response);
          }
      });
  });
});


