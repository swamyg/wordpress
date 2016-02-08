jQuery(document).ready(function() {

    jQuery.validate({
        form: "#sola_t_submit_testimonial"}
    );

    jQuery(".sola_t_image").imgLiquid({
        fill: true,
        horizontalAlign: "center",
        verticalAlign: "top"
    });

    jQuery('.sola_t_layout_1_container .sola_t_container, .sola_t_layout_2_container .sola_t_container, .sola_t_layout_3_container .sola_t_container, .sola_t_layout_4_container .sola_t_container').matchHeight();

    jQuery('body').on('click', '.sola_t_page', function(){

    	console.log('clicked');

    	var page_number = jQuery(this).attr('pnum');

    	var per_page = jQuery(this).attr('pp');

    	var data = {
    		action: 'change_testimonial_page',
    		security: sola_t_ajaxurl, 
    		per_page: per_page,
    		page_num: page_number
    	}

    	console.log(sola_t_ajaxurl);

	    jQuery.ajax({
        	url: sola_t_ajaxurl,
        	data: data,
        	type: "POST",
        	success: function(response) {

        		console.log(response);

        		jQuery(".sola_t_container_parent").html(response);

        	}
        });

    	console.log(page_number);

    });

});