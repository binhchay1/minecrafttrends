<div id="widgets" class="grid col-340 fit">

	<?php
	if( is_active_sidebar( 'main-sidebar' ) ){
		dynamic_sidebar( 'main-sidebar' );
	} 
	if( is_active_sidebar( 'sticky-sidebar' ) ){
		echo '<div class="td-sidebar-sticky">';
		dynamic_sidebar( 'sticky-sidebar' );
		echo '</div>';
	}
	?>

</div>