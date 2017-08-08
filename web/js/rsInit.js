jQuery(document).ready(function($) {
        $(".royalSlider").royalSlider({
            // options go here
            // as an example, enable keyboard arrows nav
            keyboardNavEnabled: true,
            imageScaleMode: 'fill',
            controlNavigation: 'none',
            autoPlay: {
	    		// autoplay options go gere
	    		enabled: true,
	    		pauseOnHover: true
	    	}
        });
        
//         $(".navbar").hide();

		// fade in .navbar
	    $(function () {
	        $(window).scroll(function () {
	
	                 // set distance user needs to scroll before we start fadeIn
	            if ($(this).scrollTop() > 150) {
	                $('#nav_contact').fadeIn();
	            } else {
	                $('#nav_contact').fadeOut();
	            }
	        });
	    });  
    });

$( document ).ready(function() {
// 	record_visit_to_db(0, 'visit');
// hide .navbar first
    
});