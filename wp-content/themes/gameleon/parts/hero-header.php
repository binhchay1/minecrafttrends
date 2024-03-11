<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	HERO HEADER
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
$td_hero_header_img 			= get_theme_mod( 'td_hero_header_img' );
$td_hero_header_shape_img 		= get_theme_mod( 'td_hero_header_shape_img' );
$td_hero_header_title 			= get_theme_mod( 'td_hero_header_title' );
$td_hero_header_text 			= get_theme_mod( 'td_hero_header_text' );
$td_hero_header_btn_text 		= get_theme_mod( 'td_hero_header_button_text' );
$td_hero_header_button_link 	= get_theme_mod( 'td_hero_header_button_link' );
$td_hero_header_divider_img 	= get_theme_mod( 'td_hero_header_divider_img' );
?>


<section id="td-hero-header" class="clearfix" <?php if( $td_hero_header_img ) :?> style="background-image: url('<?php echo esc_url( $td_hero_header_img ); ?>');"<?php endif; ?>>

	<div class="td-hero-wrap">

	<?php if( $td_hero_header_title ) : ?>
	<h1 class="ml3 td-hero-title"><?php echo esc_html( $td_hero_header_title ); ?></h1>
	<?php endif; ?>

	<?php if( $td_hero_header_divider_img ) :?>
		<div class="td-hero-divider">
			<img src="<?php echo esc_url( $td_hero_header_divider_img ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a>
		</div>
	<?php endif; ?>	


	<?php if( $td_hero_header_text ) : ?>
	<p class="td-hero-text"><?php echo  esc_html( $td_hero_header_text ); ?></p>
	<?php endif; ?>

	<?php if( $td_hero_header_btn_text ) : ?>
	<div class="td-hero-cta">
	<a href="<?php if( $td_hero_header_button_link ) :?><?php echo esc_url( $td_hero_header_button_link ); ?><?php else: ?>#wrapper-content<?php endif; ?>">
		<button class="td-hero-btn"><span><?php echo esc_html( $td_hero_header_btn_text ); ?></span></button>
	</a>
	<?php endif; ?>
	</div>
	
	</div>

	<?php if( $td_hero_header_shape_img ) :?>
	<img class="td-hero-footer-img" src="<?php echo esc_url( $td_hero_header_shape_img ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>">
 
	<?php endif; ?>

</section>
 