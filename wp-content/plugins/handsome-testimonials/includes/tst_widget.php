<?php
/**
 * Template Name: Widget
 *
 * Widget Class for testimonial display in the widget.
 *
 * @package     handsometestimonials
 * @copyright   Copyright (c) 2014, Kevin Marshall
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 *
 */
class wp_hndtst_widget extends WP_Widget {

function __construct() {
	parent::__construct(
	// Base ID of widget
	'hndtst_widget', 

	// Widget name will appear in UI
	__('Handsome Testimonials Widget', 'wp_hsdtst_widget_loc'), 

	// Widget description
	array( 'description' => __( 'Handsome Testimonials Widget to show testimonial in sidebars', 'wp_hsdtst_widget_loc' ), ) 
	);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
        $shortcode_name = $this->get_shortcode($instance['shortcode_name'] );
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
        
	if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

	echo '<div id="hndtst" class="hndtst-widget">';
	// This is where you run the code and display the output
	echo __( $shortcode_name, 'wp_hsdtst_widget_loc' );

	echo '</div>';
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
    
    global $wpdb;
    
    $table = $wpdb->prefix . 'hndtst_saved';
    
    $shortcode_names = $wpdb->get_results( 
	"
	SELECT id, name
	FROM $table
	ORDER BY id 
	"
    );


    if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
    }
    else {
        $title = __( 'New title', 'wp_hsdtst_widget_loc' );
    }
    
    if ( isset( $instance[ 'shortcode_name' ] ) ) {
        $instance_shortcode_name = $instance[ 'shortcode_name' ];
    }
    else {
        $instance_shortcode_name = '';
    }
    
// Widget admin form
        
        
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            <p>

                <label for="<?php echo $this->get_field_id( 'shortcode_name' ); ?>"><?php _e( 'Widget Instance:' ); ?></label>
                    <select id="tst-shortcode-instance-name<?php //echo $this->get_field_id( 'shortcode_name' ); ?>" name="<?php echo $this->get_field_name( 'shortcode_name' ); ?>" >
                        <option value=""> -- Select -- </option>
                        <?php foreach ( $shortcode_names as $shortcode_name) {
                                $sel = '';

                                if ($shortcode_name->name == $instance_shortcode_name) {
                                    $sel = 'selected="selected"';
                                }
        //var_dump( $shortcode_name);
                        ?>

                            <option data-instance_id="<?php echo $shortcode_name->id?>" <?php echo $sel; ?> value="<?php echo $shortcode_name->name; ?>"><?php echo $shortcode_name->name; ?></option>
                        <?php } ?>
                    </select>
                    <input type="button" id="delete_instance_options_name" value="Delete" name="delete" class="button-primary">

            </p>

</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['shortcode_name'] = ( ! empty( $new_instance['shortcode_name'] ) ) ? strip_tags( $new_instance['shortcode_name'] ) : '';
	return $instance;
	}

public function get_shortcode( $shortcode_name ) {
 
    /**
     * Perform some kind of search and replace here on $sidebar_output.
     * Regular Expressions will likely be required in order to restrict your
     * modifications to only the widgets you wish to modify, since $sidebar_output
     * contains the output of the entire sidebar, including all widgets.
     */
    
    global $wpdb;
    
    $table = $wpdb->prefix . 'hndtst_saved';
    
    $row = $wpdb->get_row( 
	"
	SELECT shortcode 
	FROM $table
	WHERE name = '" . $shortcode_name . "'"
    ); 

    //Check first that there is a testimonial selected in the widget before outputting
    if ($row) {
        return do_shortcode(stripslashes($row->shortcode));
    }
 
}
        
} // Class wpb_widget ends here

// Register and load the widget
function wp_load_hndtst_widget() {
	register_widget( 'wp_hndtst_widget' );
        

}

add_action( 'widgets_init', 'wp_load_hndtst_widget' );