<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST META-DATA TEMPLATE-PART FILE - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE SIZE OF THE PAGE.
-----------------------------------------------------------------------------------------------------------*/
?>

<div class="block-meta"><?php // block-meta ?>

<?php gameleon_review_final_score(); ?>

<span class="td-post-date">
<?php the_time('M j, Y'); ?>
</span>

<span class="td-likes"><?php gameleon_likes(); ?></span>

<?php if ( defined( 'MYARCADE_VERSION') and is_game() ): ?>
<span class="td-plays">
<?php echo gameleon_post_views(); ?>
</span>

<?php else: ?>

<span class="td-views">
<?php echo gameleon_post_views(); ?>
</span>

<?php endif; ?>

</div><?php // end of block-meta ?>