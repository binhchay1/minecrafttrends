<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	BOXED: FULL SLIDER - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
$td_wide_slider = get_theme_mod( 'td_wide_slider_shortcode' );
?>

<section id="boxed-slider-wrap" class="clearfix">
<?php
if ( !empty( $td_wide_slider ) ) :
echo do_shortcode( $td_wide_slider );
endif;
?>

</section>
<div class="clearfix"></div>