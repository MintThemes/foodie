<?php

/**

 * Custom header integration

 *

 *

 * @package Foodie

 * @since Foodie 1.0

 */



/**

 * Shiv for get_custom_header().

 *

 * get_custom_header() was introduced to WordPress

 * in version 3.4. To provide backward compatibility

 * with previous versions, we will define our own version

 * of this function.

 *

 * @return stdClass All properties represent attributes of the curent header image.

 *

 * @package Foodie

 * @since Foodie 1.1

 */



if ( ! function_exists( 'get_custom_header' ) ) {

	function get_custom_header() {

		return (object) array(

			'url'           => get_header_image(),

			'thumbnail_url' => get_header_image(),

			'width'         => HEADER_IMAGE_WIDTH,

			'height'        => HEADER_IMAGE_HEIGHT,

		);

	}

}



if ( ! function_exists( 'foodie_header_style' ) ) :

/**

 * Styles the header image and text displayed on the blog

 *

 * @see foodie_custom_header_setup().

 *

 * @since Foodie 1.0

 */

function foodie_header_style() {

	?>

	<style type="text/css">

	<?php if ( 'blank' == get_header_textcolor() ) : ?>

		.header-text {

			display: none;

		}

	<?php else : ?>

		.site-title a {

			color: #<?php echo get_header_textcolor(); ?> !important;

		}

		

		<?php $header_image = get_header_image();

		if ( ! empty( $header_image ) ) : ?>

			.header-text {

				position: absolute;

				bottom: 20px;

			}

		<?php else : ?>

			.site-header #searchform {

				bottom: 20px;

			}

		<?php endif; ?>

	<?php endif; ?>

	

	<?php $header_image = get_header_image();

	if ( ! empty( $header_image ) ) : ?>

		.site-header {

			padding: 0;

		}

	<?php endif; ?>

	</style>

	<?php

}

endif; // foodie_header_style



if ( ! function_exists( 'foodie_admin_header_style' ) ) :

/**

 * Styles the header image displayed on the Appearance > Header admin panel.

 *

 * @see foodie_custom_header_setup().

 *

 * @since Foodie 1.0

 */

function foodie_admin_header_style() {

	if ( 'on' == foodie_get_theme_option( 'use_webfonts' ) )

		wp_enqueue_style( 'webfonts-header', 'http://fonts.googleapis.com/css?family=Oldenburg' );

?>

	<style type="text/css">

	.appearance_page_custom-header #headimg {

		border: none;

	}

	#headimg hgroup {

		float: left;

		position: relative;

	}



	#headimg hgroup h1 {

		font: 50px/normal Oldenburg, Georgia, Cambria, Times, serif;

		text-transform: uppercase;

		color: #196374;

		margin: 0;

		padding: 0;

		float:left;

	}



	#headimg hgroup h1 a {

		color: #196374;

		text-decoration: none;

	}



	#headimg hgroup h2 {

		font: normal 11px/normal Arvo, Georgia, Cambria, Times, serif;

		color: #c7c7c7;

		text-transform: uppercase;

		margin: 15px 0 0 20px;

		float: left;

		clear: none;

	}

	

	<?php 

		$header_image = get_header_image();

		if ( ! empty( $header_image ) ) : 

	?>

	#headimg .header-text {

		position: absolute;

		bottom: 20px;

	}

	<?php endif; ?>

	</style>

<?php

}

endif; // foodie_admin_header_style



if ( ! function_exists( 'foodie_admin_header_image' ) ) :

/**

 * Custom header image markup displayed on the Appearance > Header admin panel.

 *

 * @see foodie_custom_header_setup().

 *

 * @since Foodie 1.0

 */

function foodie_admin_header_image() {

	if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) ) {

		$style = $tag_style = ' style="display:none;"';

	}

	else

		$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';

?>



	<div id="headimg">

		<hgroup>

			<?php 

				$header_image = get_header_image();

				if ( ! empty( $header_image ) ) : 

			?>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />

				</a>

			<?php endif; ?>

			<div class="header-text">

				<h1 class="site-title"><a <?php echo $style; ?> onclick="return false;" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

				<h2 class="site-description" <?php echo $tag_style; ?>>&mdash;<?php bloginfo( 'description' ); ?></h2>

			</div>

		</hgroup>

	</div>

<?php }

endif; // foodie_admin_header_image