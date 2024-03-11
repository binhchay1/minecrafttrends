<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	COLOPHONE
-----------------------------------------------------------------------------------------------------------*/

?>

<?php

$td_colophone_txt1      = get_theme_mod( 'gameleon_colophon_text' );
$td_colophone_bnt_txt   = get_theme_mod( 'gameleon_colophon_button_text' );
$td_colophone_btn_link  = get_theme_mod( 'gameleon_colophon_button_link' );
$td_colophone_bg        = get_theme_mod( 'td_colophone_bg' );
?>

<?php if( $td_colophone_txt1 ) : ?>

<div class="colophon-module" <?php if( $td_colophone_bg ) :?> style="background-image: url( '<?php echo esc_url( $td_colophone_bg ); ?>' );"<?php endif; ?>>

<div class="grid col-700">
<h3>
<?php if( $td_colophone_txt1 ) : ?><?php echo  esc_html( $td_colophone_txt1 ); ?><?php endif; ?>
</h3>

</div><?php // end of grid col-728 / ?>

<div class="grid col-250 fit">
<div class="call-to-action">
<?php if( $td_colophone_bnt_txt ) : ?>
<a href="<?php echo esc_url( $td_colophone_btn_link ); ?>" class="button"><?php echo esc_html( $td_colophone_bnt_txt ); ?></a>
<?php endif; ?>
</div>
</div><?php // end of grid col-340 fit / ?>

</div><?php // end of colophon-module / ?>
<?php endif; ?>