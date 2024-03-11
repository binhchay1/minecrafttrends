<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST META-DATA SMALL TEMPLATE-PART FILE
-----------------------------------------------------------------------------------------------------------*/
?>
<div class="block-meta">
<?php gameleon_review_final_score(); ?>
<?php the_time('M j, Y'); ?><span class="td-gray"><?php echo'-';?></span>
<?php if( !post_password_required() and comments_open() ) : ?>
<?php comments_popup_link(); ?>
<?php endif; ?>
</div>