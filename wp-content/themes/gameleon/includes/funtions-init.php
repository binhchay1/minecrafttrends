<?php
/*----------------------------------------------------------------------------------------------------------
	* GAMELEON INITIALIZATION
	* Please do not make any changes to this file.
	* All modifications should be made in a child theme to avoid losing them on updating the theme.
-----------------------------------------------------------------------------------------------------------*/


// If this file is called directly, busted!
if ( ! defined( 'WPINC' ) ) {
	die;
}


$template_directory_uri = get_template_directory();


/*----------------------------------------------------
	CORE CLASS UTILITIES
-----------------------------------------------------*/
require $template_directory . '/includes/td_core.php';
