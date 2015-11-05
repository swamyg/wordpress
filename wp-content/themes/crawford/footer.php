<footer>
	<?php get_sidebar() ?>
	<div id="footer-meta" class="container">
		<div class="row disclaimer">
		Swamy G. is not a licensed physician/mental health clinician. The advice and counseling services provided by Swamy are not licensed by the state of California nor are they a substitute for licensed medical treatment.
	  </div>
		<div class="row">
			<p>&copy; <?php echo date("Y"); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &bull; <a href="<?php echo esc_url(__('http://www.wpmultiverse.com/themes/crawford/', 'crawford')); ?>" title="Crawford WordPress Theme" target="_blank">Crawford Theme</a>
				<a href="http://twitter.com/coachcalledlife" class="social-icon icon-twitter" rel="me" target="_blank">Twitter</a>
				<a href="http://www.facebook.com/acoachcalledlife" class="social-icon icon-facebook" rel="me" target="_blank">Facebook</a>
				<a href="https://plus.google.com/u/0/106064074895967401044/posts" class="social-icon icon-google-plus" rel="me author" target="_blank">Google+</a>
				<a href="<?php echo home_url('/'); ?>feed" class="social-icon icon-rss" rel="me" target="_blank">RSS</a>
			</p>
			<nav><?php wp_nav_menu(array('theme_location' => 'footer','container' => false,'depth' => 1,'fallback_cb' => false)); ?></nav>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>   
</body>
</html>