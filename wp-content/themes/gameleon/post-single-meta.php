<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST META-DATA SINGLE TEMPLATE-PART FILE - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE SIZE OF THE PAGE.
-----------------------------------------------------------------------------------------------------------*/
?>

<div class="post-meta">
	<?php

	if( !is_page() && !is_search() ) {
		?>

		<span class="cat-links"><?php the_category(' '); ?></span>

<?php
}

?>
<?php
	gameleon_posted_on();

	echo '<div class="td-entry-count-views">';

	gameleon_likes();

	gameleon_comments_link();

	gameleon_post_views();

	echo '</div>';
	?>
</div><?php // end post-meta/ ?>