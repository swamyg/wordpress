<?php
/**
 * Template Name: Shortcode Generator
 *
 * this file contains the contents of the popup window
 *
 * @package     handsometestimonials
 * @copyright   Copyright (c) 2014, Kevin Marshall
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 *
 */

//Enqueu Admin Scripts for Popup and ColorPicker
add_action( 'admin_enqueue_scripts', 'hndtst_mw_enqueue_color_picker' );

function hndtst_mw_enqueue_color_picker( $hook_suffix ) {
global $pagenow;
  //Test to make sure we're on an add/edit post/page/post-type screen
  if( !in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php', 'widgets.php' ) ) )
    return;

  //Enqueue Script for Ajax Search function inside of Insert Testimonial Popup
  wp_enqueue_script( 'hndtst_tst_popup', plugins_url( 'includes/js/admin-scripts.js' , dirname(__FILE__) ), array( 'wp-color-picker' ), false, true );
  wp_localize_script('hndtst_tst_popup', 'hndtst_tst_vars', array ('hndtst_tst_nonce' => wp_create_nonce('hndtst_tst_nonce')));

  wp_enqueue_style( 'wp-color-picker' );
}

//Display Media Button
add_action('media_buttons_context', 'hndtst_shortcode_btn');

function hndtst_shortcode_btn ($context) {

  global $pagenow;
  //Test to make sure we're on an add/edit post/page/post-type screen
  if( !in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) )
    return;

  // Button Text & Image
  $img = '<span class="dashicons dashicons-testimonial custom-dashicon"></span> Insert Testimonial';

  $container_id = 'hndtst-dialog';

  //title of the popup window
  $title = 'Handsome Testimonial Shortcode Generator';

  $context .= "<a class='button thickbox' title='{$title}'href='#TB_inline?width=800&inlineId={$container_id}'>{$img}</a>";

  return $context;

} 

//Add Insert Testimonial Popup Content Function
add_action('admin_footer', 'hndtst_popup_content');

function hndtst_popup_content() {
  global $pagenow;
  //Test to make sure we're on an add/edit post/page/post-type screen
  if( !in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) )
    return;
?>
    <!--Popup Form HTML -->
    <div id="hndtst-dialog" style="display:none;">

        <div class="hndtst-dialog_wrapper">

            <!-- Column 1 -->
            <div class="hndtst-dialog_Col_1">
                <form action="/" method="get" accept-charset="utf-8" name="htst_shortcode">
                    <input type="hidden" name="tst-tst_id" value="" id="tst-tst_id" style="display:none;"/>

                    <!-- Single testimonials selectbox - KKAIS -->
                    <div id="tst_single_wrap" style="margin-top: 10px; margin-bottom: 5px;">
                        <select name="tst_single" id="tst_single" size="1">
                            <option value="" selected="selected">--Select a Testimonial--</option>
                            <?php
                            //Loop to obtain testimonials - KKAIS
                            $tst_args = array(
                                'post_type' => 'testimonial',
                            );

                            // Show all the posts on one page - KKAIS
                            $tst_args['posts_per_page'] = -1;

                            //Start Loop to display testimonial(s)
                            $tst_query = new WP_Query($tst_args);

                            // If there are posts then - KKAIS
                            if ($tst_query->have_posts()) {

                                // Loop through the posts - KKAIS
                                while ($tst_query->have_posts()) {

                                    // Pull the post out for the current iteration - KKAIS
                                    $tst_query->the_post();

                                    // Update the variables with the current post values - KKAIS
                                    $tstid = $tst_query->post->ID;
                                    $tst_title = get_the_title($tstid);
                                    ?>
                                    <option value="<?php echo $tstid; ?>"><?php echo $tst_title; ?></option>
                                <?php
                                }

                            }

                            ?>
                        </select>
                    </div>

                    <h3>General Style Settings</h3>

                    <div style="margin-top: -13px;">
                        <label for="tst-img_size">Select Design</label><br/>
                        <select name="tst-template" id="tst-template" size="1">
                            <option value="1" selected="selected">Design 1</option>
                            <option value="2">Design 2</option>
                        </select>
                    </div>
                    <div style="margin-top: 5px;">
                        <label for="tst-bg_color">Background Color</label><br/>
                        <input type="text" name="tst-bg_color[color]" value="" id="tst-bg_color" class="tst_colorpicker"/>
                    </div>
                    <div style="margin-top: 7px;">
                        <label for="tst-round_corners">Round Corners</label>
                        <input type="checkbox" name="tst-round_corners" id="tst-round_corners" value="" checked/>
                    </div>
                    <div style="margin-top: 7px;">
                        <label for="tst-border">Border</label>
                        <input type="checkbox" name="tst-border" id="tst-border" checked/>
                    </div>


                    <i><h3 id="clickadvanced">Advanced Options</h3></i>
                      <span id="advancedsettings">
                        <h4>Image Settings</h4>
                      <div style="margin-top: 5px;">
                          <label for="tst-img_shadow">Image Shadow</label><br/>
                          <input type="radio" name="tst-img_shadow" id="tst-img_shadow" value="yes"> Yes &nbsp;&nbsp;
                          <input type="radio" name="tst-img_shadow" id="tst-img_shadow" value="no"> No &nbsp;&nbsp;
                      </div>
                      <div style="margin-top: 5px;">
                          <label for="tst-img_round">Round Image</label><br/>
                          <input type="radio" name="tst-img_round" id="tst-img_round" value="yes"> Yes &nbsp;&nbsp;
                          <input type="radio" name="tst-img_round" id="tst-img_round" value="no"> No &nbsp;&nbsp;
                      </div>

                      <div style="margin-top: 5px;">
                          <label for="tst-img_size">Image Size</label><br/>
                          <select name="tst-img_size" id="tst-img_size" size="1">
                              <option value="" selected="selected">--select--</option>
                              <option value="small">small</option>
                              <option value="medium">medium</option>
                              <option value="large">large</option>
                              <option value="specify">specify (advanced)</option>
                          </select>
                      </div>
                      <h4>Text Settings</h4>
                        <div>
                            <label for="txt-align">Text Alignment</label><br/>
                            <select name="txt-align" id="txt-align" size="1">
                                <option value="" selected="selected">--select--</option>
                                <option value="left">left</option>
                                <option value="center">center</option>
                                <option value="right">right</option>
                            </select>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-title_size">Title Font Size</label><br/>
                            <input type="text" name="tst-title_size" value="" id="tst-title_size" placeholder="px / em"/>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-title_color">Title Color</label><br/>
                            <input type="text" name="tst-title_color[color]" value="" id="tst-title_color" class="tst_colorpicker"/>
                        </div>
                        <div>
                            <label for="tst-subtitle_size">Subtitle Size</label><br/>
                            <input type="text" name="tst-subtitle_size" value="" id="tst-subtitle_size" placeholder="px / em"/>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-subtitle_color">Subtitle Color</label><br/>
                            <input type="text" name="tst-subtitle_color[color]" value="" id="tst-subtitle_color"
                                   class="tst_colorpicker"/>
                        </div>
                        <p>
                            <label for="tst-subtitle_italic">Subtitle Italics</label>
                            <input type="checkbox" name="tst-subtitle_italic" id="tst-subtitle_italic" checked/>
                            <br/>
                        </p>
                        <div>
                            <label for="tst_size">Testimonial Font Size</label><br/>
                            <input type="text" name="tst_size" value="" id="tst_size" placeholder="px / em"/>
                        </div>
                        <br/>
                        <div>
                            <label for="tst_color">Testimonial Font Color</label><br/>
                            <input type="text" name="tst_color[color]" value="" id="tst_color" class="tst_colorpicker"/>
                        </div>

                      <h4>Display Settings</h4>
                        <div style="margin-top: 10px;">
                            <label for="tst-orientation">Orientation</label><br/>
                            <input type="radio" name="tst-orientation" id="tst-orientation" value="portrait"> Portrait &nbsp;&nbsp;
                            <input type="radio" name="tst-orientation" id="tst-orientation" value="landscape"> Landscape &nbsp;&nbsp;
                        </div>
                        <div style="margin-top: 10px;" id="tst-img_loc">
                            <label for="tst-img_loc">Image Location</label><br/>
                            <input type="radio" name="tst-img_loc" id="tst-img_loc" value="before"><label for="tst-img_loc"> Before
                                Text &nbsp;&nbsp;</label>
                            <input type="radio" name="tst-img_loc" id="tst-img_loc" value="after"><label for="tst-img_loc"> After
                                Text &nbsp;&nbsp;</label>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-img_align">Image Alignment</label><br/>
                            <select name="tst-img_align" id="tst-img_align" size="1">
                                <option value="" selected="selected">--select--</option>
                                <option value="left">left</option>
                                <option value="center">center</option>
                                <option value="right">right</option>
                            </select>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-img_size_px">Image Width</label><br/>
                            <input type="text" name="tst-img_size_px" value="" id="tst-img_size_px" placeholder="px"/>
                            <br/><span style="font-size: 8px; color: darkgrey; font-style: italic">Select "Specify" in Image Size above</span>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-width">Testimonial Width</label><br/>
                            <input type="text" name="tst-width" value="" id="tst-width" placeholder="px / %"/>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-height">Testimonial Height</label><br/>
                            <input type="text" name="tst-height" value="" id="tst-height" placeholder="px / %"/>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-align">Testimonial Alignment</label><br/>
                            <select name="tst-align" id="tst-align" size="1">
                                <option value="" selected="selected">none</option>
                                <option value="left">left</option>
                                <option value="center">center</option>
                                <option value="right">right</option>
                            </select>
                            <br/><span style="font-size: 8px; color: darkgrey; font-style: italic">Doesn't affect preview</span>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-border_width">Border Width</label><br/>
                            <input type="text" name="tst-border_width" value="" id="tst-border_width" placeholder="px / em"/>
                        </div>
                        <br/>
                        <div>
                            <label for="tst-border_color">Border Color</label><br/>
                            <input type="text" name="tst-border_color[color]" value="" id="tst-border_color"
                                   class="tst_colorpicker"/>
                        </div>
                      </span>
                </form>
                <div style="padding:15px 15px 0 0; float: none; margin-top: 20px;">
                    <input type="button" class="button-primary" value="Generate ShortCode"
                           onclick="window.send_to_editor(getHndtst_Code());">
                </div>
            </div> <!-- End 'hndtst-dialog_Col_1' -->

            <!-- Column 2 -->
            <div class="hndtst-dialog_Col_2">
                <div id="hndtst_preview">
                    <?php echo do_shortcode('[testimonial_preview]'); ?>
                </div>
                <div id="tst_widget_instance_block">
                    <!-- Save Widget Instance Dialogue Box -->
                    <div id="tst_widget_instance_save">
                        <?php _e('Save Widget Instance ', 'hndtst_loc'); ?><br />
                        <input type="text" id="saved_instance_title" size="15" value=""/>
                        <input type="button" id="save_instance_options" value="Save" class="button-primary">
                        <div id="design_options"></div>
                    </div>

                    <div id="tst_widget_instance_retrieve">
                        <?php _e('Retrieve Saved Widget Instance ', 'hndtst_loc'); ?><br />
                        <?php
                        global $wpdb;

                        $table = $wpdb->prefix . 'hndtst_saved';

                        $shortcode_names = $wpdb->get_results(
                            "
                                    SELECT id, name
                                    FROM $table
                                    ORDER BY id
                                    "
                        );
                        ?>
                        <div>
                            <input type="button" id="delete_instance_options" value="Delete" class="button-primary">
                        </div>
                        <select name="tst-shortcode-instance" id="tst-shortcode-instance" size="1">
                            <option value="0" selected="selected">Shortcode Instance</option>
                            <?php foreach ($shortcode_names as $shortcode_name) { ?>
                                <option
                                    value="<?php echo $shortcode_name->id; ?>"><?php echo $shortcode_name->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div> <!-- End 'hndtst-dialog_Col_2' -->
            
            <div class="hndtst-dialog_ad">
                <div style="margin-left:auto; margin-right: auto; width: 400px; border: 2px dotted #953E0C">
                    <?php echo '<a href="http://handsomeapps.io/handsome-testimonials-pro/" target="blank"><img src="' . TSTMT_PLUGIN_URL . '/assets/images/upgrade-hndtst-pro-side-horiz.png"/></a>'; ?>
                </div>
            </div>

        </div> <!--End 'hndtst_dialog_wrapper' -->

    </div> <!--End 'hndtst_dialog' -->
      <?php

} //End 'hndtst_popup_content'


//Retrieve Live Preview from Javascript Generated Shortcode

add_action( 'wp_ajax_hndtst_previewShortcode', 'hndtst_action_callback' );

function hndtst_action_callback() {

  $hndtst_preview = ( $_POST['hndtst_previewShortcode'] );
  echo do_shortcode(str_replace('handsometestimonial', 'testimonial_preview', stripslashes($hndtst_preview)));
  wp_die();
  
}

//Retrieve Live Preview from Shortcode Instance
add_action( 'wp_ajax_hndtst_previewShortcodeInstance', 'hndtst_action_instance_callback' );

/**
  * Function to update popup to add/edit post/page/post-type screen
  * 
  * @access public 
  * @return void
  * @author 
  */
function hndtst_action_instance_callback() {
    global $wpdb;
    $hndtst_previewShortcodeInstanceId = ( $_POST['hndtst_previewShortcodeInstanceId'] );
    $table = $wpdb->prefix . 'hndtst_saved';

    $row = $wpdb->get_row( 
	"
	SELECT shortcode 
	FROM $table
	WHERE id = " . $hndtst_previewShortcodeInstanceId
    ); 
  
    if ($row) {
        $search_arr = array('handsometestimonial', 'testimonial_single');
        $hndtst_shortcode = stripslashes($row->shortcode);
        echo do_shortcode(str_replace($search_arr, 'testimonial_preview', $hndtst_shortcode)); //. $hndtst_shortcode;
    }

    wp_die();

}

//Retrieve ShortCode as Design Options

add_action( 'wp_ajax_hndtst_design_options', 'hndtst_action_design_options_callback' );

/**
  * Function to update popup to add/edit post/page/post-type screen
  * 
  * @access public 
  * @return void
  * @author KKAIS
  */


function hndtst_action_design_options_callback() {
  
  global $wpdb;
  
  $hndtst_design_options = ( $_POST['hndtst_design_options'] );
  $hndtst_design_options_name = ( $_POST['hndtst_design_options_name'] );

  if ($hndtst_design_options_name == '') {
      echo '<span style="color:red;">Widget Instance Title is required.</span>';
      wp_die();
  }

    $sql = "SELECT * FROM `wp_hndtst_saved` WHERE `name`='".$_POST['hndtst_design_options_name']."'";
    $res = $wpdb->get_results($sql);

    // $sql = "DELETE FROM `wp_hndtst_saved` WHERE `name`='".$_POST['hndtst_design_options_name']."'";

    if(!empty($res)) {
        echo json_encode(array('error'=> true, 'message' => '<span style="color:red;">Widget Instance already created.</span>'));
        wp_die();
    }

  $table = $wpdb->prefix . 'hndtst_saved';
  $data = array('time' => date('Y-m-d H:i:s'),
      'name' => $hndtst_design_options_name,
      'shortcode' => $hndtst_design_options);
  $format = array('%s','%s','%s');
  
  $wpdb->insert( $table, $data, $format );

  if ($wpdb->insert_id){
      echo json_encode(array('error' => false,'message' => '<span style="color:green;">Instance is successfully saved <br /><a href="'.get_site_url().'/wp-admin/widgets.php" target="blank"><i>Retreive in Widgets</i></a></span> ', 'id'=>$wpdb->insert_id, 'name' =>$hndtst_design_options_name));
  }else {
      echo json_encode(array('error'=> true, 'message' => '<span style="color:red;">Failed to save instance</span>'));
  }
  
  wp_die();
  
}


add_action( 'wp_ajax_delete_instance', 'delete_instance' );

function delete_instance() {
    global $wpdb; // this is how you get access to the database

    $sql = "DELETE FROM `wp_hndtst_saved` WHERE `id`='".$_POST['instance_id']."'";
    $res = $wpdb->get_results($sql);
    echo 'Instance removed';

    wp_die(); // this is required to terminate immediately and return a proper response
}


add_action( 'wp_ajax_delete_instance_name', 'delete_instance_name' );

function delete_instance_name() {
    global $wpdb; // this is how you get access to the database

    $sql = "DELETE FROM `wp_hndtst_saved` WHERE `id`='".$_POST['instance_name']."'";
    $res = $wpdb->get_results($sql);
    echo 'Instance removed';

    wp_die(); // this is required to terminate immediately and return a proper response
}
?>
