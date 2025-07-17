(function($) {

	"use strict";

	jQuery(document).ready(function() {
	    
    	    // MASSONRY
    $(window).load(function(){
    	$('#masonry-loop').masonry({
      // options
    itemSelector: '.masonry-post, .one-column, .two-column'
    	});	    
    });
    	    //masonry end
	});

})(jQuery);