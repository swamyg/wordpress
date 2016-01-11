<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>              
    <link rel="profile" href="http://gmpg.org/xfn/11" />        
		<link href='https://fonts.googleapis.com/css?family=Denk+One' rel='stylesheet' type='text/css'>
		<link href='https://https.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Denk+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Merriweather:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Work+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noticia+Text:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Arvo:400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
    <?php wp_head(); ?>
</head>
<body <?php page_bodyclass(); ?>>
	<div id="top-background">
		<div id="banner">
			<div id="logo-tagline" class="col-md-12">				
				<?php if (get_theme_mod('crawford_logo_setting')): ?>
			        <a id="logo" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_theme_mod('crawford_logo_setting')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
			    <?php else: ?>
			        <a id="site-name" href="<?php echo esc_url(home_url('/')); ?>">A Coach Called <span class='life'>LiFE</span></a>
			    <?php endif; ?>			   
			    <?php if ('yes' === get_theme_mod('crawford_tagline_setting')): ?>
					<p id="tagline"><?php bloginfo('description'); ?></p>
				<?php endif; ?>	
			</div>
		</div>
	</div>
	<header>
		<div class="container">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="row">
				<nav class="col-md-12" role="navigation">				
					<div class="collapse navbar-collapse"><?php wp_nav_menu(array('theme_location' => 'primary','depth' => 2,'container' => false,'fallback_cb' => false)); ?></div>
				</nav>				
			</div>
		</div>
	</header>
	<!-- Begin MailChimp Signup Form -->
	<!-- -->
	<div id="optinforms-form5-container" style="width: 70%; float: none; margin: auto; margin-top: -50px">
	    <form method="post"
	          action="//acoachcalledlife.us12.list-manage.com/subscribe/post?u=8a646080df7192fc8656d9b04&amp;id=187fe6406b">
	        <div id="optinforms-form5" style="background:#3E3E3E;">
	            <div id="optinforms-form5-container-left">
	                <div id="optinforms-form5-title"
	                     style="font-family:News Cycle; font-size:24px; line-height:24px; color:#fff">Is Anxiety Holding You Hostage?
	                </div>
	                <!--optinforms-form5-title--><input type="text" id="optinforms-form5-name-field" name="FNAME"
	                                                    placeholder="Enter Your Name"
	                                                    style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000"><input
	                    type="text" id="optinforms-form5-email-field" name="EMAIL" placeholder="Enter Your Email"
	                    style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000"><input type="submit"
	                                                                                                           name="submit"
	                                                                                                           id="optinforms-form5-button"
	                                                                                                           value="SUBSCRIBE FOR FREE"
	                                                                                                           style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; background-color:#fb6a13">
	            </div>
	            <!--optinforms-form5-container-left-->
	            <div id="optinforms-form5-container-right">
	                <div id="optinforms-form5-subtitle" style="font-family: 'Lora', serif; font-size:16px; color:#fff">Get
	                    articles on managing anxiety, dating and relationship stratergies and improving your overall
	                    physical and mental well-being delivered direct to your inbox every week.
	                </div>
	                <!--optinforms-form5-subtitle-->
	                <div id="optinforms-form5-disclaimer"
	                     style="font-family: 'Lora', serif; font-size:14px; color:#aaa">We hate
	                    spam. Your email address will not be sold or shared with anyone else.
	                </div>
	                <!--optinforms-form5-disclaimer--></div>
	            <!--optinforms-form5-container-right-->
	            <div class="clear"></div>
	        </div>
				</form>
	</div>
	<!-- -->
	<!--End mc_embed_signup-->