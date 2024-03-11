<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	SEARCH FORM TEMPLATE
-----------------------------------------------------------------------------------------------------------*/
?>
<form role="search" class="td-search-form" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div>
		<label class="screen-reader-text" for="s"><?php esc_attr_e( 'Search for:', 'gameleon' ) ?></label>
		<input type="text" class="td-widget-search-input" name="s" id="s" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>" />
 		<button type="submit" id="td-searchsubmit">
    		<i class="fa fa-search"></i>
  		</button>
	</div>
</form>