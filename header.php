<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
echo('<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>'); ?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<!-- ***Website Design and Custom Theme by Christian Mackler of Focus 4-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="icon" type="image/x-icon" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="header-wrapper" class="wrapper clearfix">
		<div class="container clearfix">
			<div id="header" class="clearfix">
				<div class="logo clearfix">
					<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo" width="" height="" /></a>
					<p><?php wp_title(); ?></p>
				</div>
				<div class="right-header clearfix">
					<div id="nav" class="clearfix">
						<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="nav-rd" class="clearfix">
			<div class="menu-panel">					
				<div class="menu-button">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
    		</div>
			<div class="rd-menu clearfix">
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
			</div>
		</div>
	</div>

		
	