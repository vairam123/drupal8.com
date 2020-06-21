(function ($, Drupal) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
    	$(function() {
  			$.stellar();
		});

		jQuery(window).scroll(function(){
		    var scroll = $(window).scrollTop();
		    if (scroll >= 100) {
		        $("#fh5co-header").addClass("sticky");
		    } else {
		        $("#fh5co-header").removeClass("sticky");
		    }
		});

		// iPad and iPod detection	
		var isiPad = function(){
			return (navigator.platform.indexOf("iPad") != -1);
		};

		var isiPhone = function(){
		    return (
				(navigator.platform.indexOf("iPhone") != -1) || 
				(navigator.platform.indexOf("iPod") != -1)
		    );
		};

		var parallax = function() {
			$(window).stellar({
				horizontalScrolling: false,
				hideDistantElements: false, 
				responsive: true

			});
		};

		// Document on load.
		$(function(){
			parallax();
		});


	}
  };
})(jQuery, Drupal);