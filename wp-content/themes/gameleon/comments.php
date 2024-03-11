<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	COMMENTS TEMPLATE - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/

?>
<?php
// remove comments on posts
if ( is_page() ) {
	$td_comments_disabled = get_theme_mod( 'gameleon_disable_comments_page' );
}

if ( is_single() ) {
$td_comments_disabled = get_theme_mod( 'gameleon_single_comments' );
}

if( $td_comments_disabled == 1 ) { ?>

<?php if( post_password_required() ) { ?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'gameleon' ); ?></p>
	<?php return;
} ?>

<?php if( comments_open() and have_comments() ) : ?>

	<div class="clearfix"></div>

	<div class="td-content-inner-single">
	<div class="widget-title">
		<h3 id="comments">
			<?php
			printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'gameleon' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h3>
		</div>
<div class="td-wrap-content">
	<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">

			<div class="previous"><?php previous_comments_link( __( 'Older comments', 'gameleon' ) ); ?>
			</div><?php // end of .previous / ?>

			<div class="next"><?php next_comments_link( __( 'Newer comments', 'gameleon', 0 ) ); ?>
			</div><?php // end of .next  / ?>

		</div><?php // end of.navigation / ?>

	<?php endif; ?>

	<ol class="commentlist">
		<?php wp_list_comments( 'avatar_size=50&type=comment' ); ?>
	</ol>

	<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="previous"><?php previous_comments_link( __( 'Older comments', 'gameleon' ) ); ?>
			</div><?php // end of .previous / ?>

			<div class="next"><?php next_comments_link( __( 'Newer comments', 'gameleon', 0 ) ); ?>
			</div><?php // end of .next  / ?>

		</div><?php // end of.navigation / ?>

	<?php endif; ?>
</div>
</div>
<?php elseif ( comments_open() and get_comments_number() == 0 ) : ?>

<div class="clearfix"></div>
<div class="td-content-inner-no-comm">
<div class="widget-title">
		<h3 id="comments">
			<?php _e( 'No comments', 'gameleon' ); ?>
			</h3>
		</div>
</div>
<?php else: ?>
<?php // nothing to show / ?>

<?php endif; ?>

<?php
if( !empty( $comments_by_type['pings'] ) ) : // let's seperate pings/trackbacks from comments
	$count = count( $comments_by_type['pings'] );
	( $count !== 1 ) ? $txt = __( 'Pings&#47;Trackbacks', 'gameleon' ) : $txt = __( 'Pings&#47;Trackbacks', 'gameleon' );
	?>

	<h6 id="pings"><?php printf( __( '%1$d %2$s for "%3$s"', 'gameleon' ), $count, $txt, get_the_title() ) ?></h6>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=pings&max_depth=<em>' ); ?>
	</ol>

<?php endif; ?>

<?php if( comments_open() ) : ?>
	<div class="td-content-inner-single">
<div class="td-wrap-content">
	<?php
	$fields = array(
		'author' => '<p class="comment-form-author">' . ( $req ? '' : '' ) .
		'<input id="author" name="author" type="text" placeholder="' . __('Name:', 'gameleon' ) . '"  value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',

		'email'  => '<p class="comment-form-email">' . ( $req ? '' : '' ) .
		'<input id="email" name="email" type="text" placeholder="' . __('E-mail:', 'gameleon' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" /></p>',

		'url'    => '<p class="comment-form-url">' .
		'<input id="url" name="url" type="text" placeholder="' . __('Website:', 'gameleon' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',

	);

	$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', $fields ) );
	$defaults['comment_field'] = '<p><textarea class="" placeholder="' . __( 'Comment:', 'gameleon' ) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '';

	comment_form( $defaults );
	?>
</div>
</div>
<?php endif; ?>
<?php } // end remove comments on all posts