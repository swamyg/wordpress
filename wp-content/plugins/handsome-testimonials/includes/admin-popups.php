<?php
/**
 * Template Name: Pointer to Collect Email
 *
 * Displays various alerts and communications for plugin in the backend
 *
 * @package     handsometestimonials
 * @copyright   Copyright (c) 2014, Kevin Marshall
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 *
 */

//Support Function and JS for Pointer

function hntst_email_pointer_content() {

    $pointer_content  = '<h3>' . __( 'Get Customers Testimonials Easy', 'hndtst_loc' ) . '</h3>';
    $pointer_content .= '<p>' . __( 'Learn how to get your customers to write you better testimonials:', 'hndtst_loc') . '</p>';
    $pointer_content .= '<p>' . __('<a href="/wp-admin/edit.php?post_type=testimonial&page=htst_getting_started">Get Our Testimonial Request Template</a>', 'hndtst_loc' ) . '</p>';

    ?>
    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready( function($) {
            $('#wpadminbar').pointer({
                content: '<?php echo $pointer_content; ?>',
                position: {
                    edge: 'top',
                    align: 'center'
                },
                close: function() {
                    close_time= <?php echo(time()); ?>;

                    setUserSetting( 'hndtst_email_pointer', '1' );
                    setUserSetting( 'hndtst_email_pointer_close_time', close_time );
                }
            }).pointer('open');
        });
        //]]>
    </script>
<?php
}

function hntst_popup_survey_pointer() {

    $hndtst_wp_link='https://wordpress.org/support/view/plugin-reviews/handsome-testimonials?filter=5';

    $pointer_content =	'<div id="hntst_survey_intro">'
        .'<h3>' . __( 'What Do You Think So Far?', 'hndtst_loc' ) . '</h3>'
        .'<p>' . __( 'Help us improve Handsome Testimonials by letting us know what you think of the plugin so far:', 'hndtst_loc') . '</p>'
        .'<div id="hntst_survey_rating">'
        .'<span data-rating="1"></span>'
        .'<span data-rating="2"></span>'
        .'<span data-rating="3"></span>'
        .'<span data-rating="4"></span>'
        .'<span data-rating="5"></span>'
        .'</div>'
        .'</div>';
    //5 stars div
    $pointer_content .=	'<div id="hntst_survey_5stars" style="display:none;">'
        .'<h3>' . __( 'Thank you!', 'hndtst_loc' ) . '</h3>'
        .'<p>Thank you for your feedback! Would you consider sharing your experience with Handsome Testimonials by leaving a review on the Wordpress Directory?</p>'
        .'<p><a href="'.$hndtst_wp_link.'" target="_blank">Leave a Review for Handsome Testimonials</a></p>'
        .'<p><i>Good reviews helps encourage others to try Handsome Testimonials and the more people who use it, the more can keep adding features to make it better!</i></p>'
        .'</div>';
    //4 stars or below div
    $pointer_content .=	'<div id="hntst_survey_feedback" style="display:none;">'
        .'<h3>' . __( 'Thank you for your feedback!', 'hndtst_loc' ) . '</h3>'
        .'<p>We’re working hard to improve our plugin and make it the best possible experience for you. Would you mind helping us out by letting us know exactly what we could do better?</p>'
        .'<p>'
        .'<textarea name="hntst_feedback_text" id="hntst_survey_feedback_text" rows="4" placeholder="Your feedback here..." style="width: 100%;"></textarea>'
        .'</p>'
        .'<p><span id="hntst_survey_send" class="button-primary">Send feedback</span></p>'
        .'</div>';


    ?>
    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready( function($) {

            $('#wpadminbar').pointer({
                content: '<?php echo $pointer_content; ?>',
                position: {
                    edge: 'top',
                    align: 'center'
                },
                close: function() {
                    close_time = <?php echo(time()); ?>;

                    setUserSetting( 'hndtst_survey_pointer', '1' );
                    setUserSetting( 'hndtst_survey_pointer_close_time', close_time );
                },
                show:function(){
                    jQuery("#hntst_survey_rating [data-rating]").mouseenter(function(){
                        star_rated=jQuery(this).data("rating");

                        for (var i =1 ; i < star_rated+1; i++) {
                            //style
                            jQuery("#hntst_survey_rating [data-rating='"+i+"']").css('background-image','url(<?php echo plugins_url( '../assets/images/yellowstar.png', __FILE__ ); ?>)')
                        }
                    });
                    jQuery("#hntst_survey_rating [data-rating]").mouseleave(function(){
                        jQuery("#hntst_survey_rating [data-rating]").css('background-image','url(<?php echo plugins_url( '../assets/images/greystar.png', __FILE__ ); ?>)')
                    });

                    jQuery("#hntst_survey_rating [data-rating]").click(function(){
                        star_rated=jQuery(this).data("rating");
                        setUserSetting( 'hndtst_survey_pointer_rate', star_rated );

                        switch(star_rated){
                            case 5:
                                //5 stars
                                jQuery('#hntst_survey_intro').hide();
                                jQuery('#hntst_survey_5stars').show();
                                break;
                            default:
                                //4 stars or below
                                jQuery('#hntst_survey_intro').hide();
                                jQuery('#hntst_survey_feedback').show();

                                /* mail content to send */

                                jQuery('#hntst_survey_send').click(function(){
                                    /***update options***/
                                    jQuery.ajax({
                                        type:   'POST',
                                        url:    '<?php echo(bloginfo("url")); ?>/wp-admin/admin-ajax.php',
                                        data:   {
                                            action    : 'hntst_send_feedback',
                                            hntst_feedback_text : "Rating : "+star_rated+"\n\n<br />"
                                            +"Feedback : \n"+jQuery('#hntst_survey_feedback_text').val(),
                                        },
                                        dataType: 'json'
                                    }).done(function( json ) {
                                        if( json.success ) {
                                            alert( "Thank you for your feedback." );
                                            jQuery('.wp-pointer').hide();

                                        } else if( !json.success ) {
                                            alert( "Please try again !" );
                                        }
                                    }).fail(function() {
                                        //Ajax error
                                        console.log( "The Ajax call itself failed." );
                                    }).always(function() {
                                        //message to show either sent or not
                                    });
                                });
                        }

                        //clicked
                        setUserSetting( 'hndtst_survey_pointer', '1' );
                    });
                }
            }).pointer('open');

        });
        //]]>
    </script>
<?php

}

function hndtst_fb_enqueue_wp_pointer( $hook_suffix ) {
    // Don't run on WP < 3.3
    if ( get_bloginfo( 'version' ) < '3.3' )
        return;

    //Define Variables
    $screen = get_current_screen();
    $screen_id = $screen->id;
    $enqueue = FALSE;
    $admin_bar = get_user_setting( 'hndtst_email_pointer', 0 ); // check settings on user
    $survey_hidden = get_user_setting( 'hndtst_survey_pointer', 0 );

    $now=time();
    $email_pointer_close_time=get_user_setting("hndtst_email_pointer_close_time",0);

    $one_hour=60*60;
//die;
    // check if admin bar is active and default filter for wp pointer is true
    if (apply_filters( 'show_wp_pointer_admin_bar', TRUE ) && $screen_id == 'testimonial' ) {
        $enqueue = TRUE;
        if(!$admin_bar){
            //email pointer
            add_action( 'admin_print_footer_scripts', 'hntst_email_pointer_content' );

        }elseif((($now-$email_pointer_close_time) > $one_hour*24) && !$survey_hidden){ //if after 3 days
            //popup survey pointer
            add_action( 'admin_print_footer_scripts', 'hntst_popup_survey_pointer' );
        }
    }

    // in true, include the scripts
    if ( $enqueue ) {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
        wp_enqueue_script( 'utils' ); // for user settings
    }
}
add_action( 'admin_enqueue_scripts', 'hndtst_fb_enqueue_wp_pointer' );

/* send feedback with js */
add_action( 'wp_ajax_hntst_send_feedback', 'hntst_send_my_feedback' );
add_action( 'wp_ajax_nopriv_hntst_send_feedback', 'hntst_send_my_feedback' );

function hntst_send_my_feedback() {
    $hntst_feedback_text = $_POST['hntst_feedback_text'];

    wp_mail( "feedback@handsomeapps.io", "Handsome Testimonial Feedback", $hntst_feedback_text);
    die(
    json_encode(
        array(
            'success' => true,
            'message' => 'Feedback sent ...'
        )
    )
    );
}
?>