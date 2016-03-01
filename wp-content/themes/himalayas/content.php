<?php
/**
 * The template used for displaying post content.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php do_action( 'himalayas_before_post_content' );

   the_title( sprintf( '<h2 class="entry-title"><a href="%s" title="%s">', esc_url( get_permalink() ), the_title_attribute('echo=0') ), '</a></h2>' );

   himalayas_entry_meta();

   // Post thumbnail.
   ?>
</article>