<div class="nd_logged_in nd_user">

<div>

<?php if(function_exists('bp_is_active') ): ?>
<a href="<?php echo bp_loggedin_user_domain(); ?>"><?php bp_loggedin_user_avatar( 'type=thumb&width=70&height=70' ); ?></a>
<?php else: ?>
<a href="<?php echo get_author_posts_url( get_the_author_meta( $current_user->ID, 'ID' ) ); ?><?php echo $current_user->display_name; ?>"><?php echo get_avatar( $current_user->ID, '70' ); ?></a>
<?php endif; ?>
</div>

<div class="td-welcome-login"><p><?php _e('Welcome','ninety-login'); ?> <?php echo $current_user->display_name; ?>!</p></div>

<?php if ( defined( 'MYARCADE_VERSION') ) : ?>

<?php
if ($last_login = (int) get_user_meta($current_user->ID, 'nd_login_time', true)) echo '<p>'.__('You last logged in on ','ninety-login').date_i18n(__('l \t\h\e jS \of F, Y \a\t h:ia','ninety-login'), $last_login).'.</p>';
$posts = wp_count_posts('post')->publish - (int) get_user_meta($current_user->ID, 'nd_num_posts', true);
$comments = wp_count_comments()->approved - (int) get_user_meta($current_user->ID, 'nd_num_comments', true);

echo '<p>';
echo _n('Since last logging in there has been ', 'Since last logging in there have been ', $posts, 'ninety-login');
echo '<span class="count">'.$posts.'</span>';
echo _n('new game and ', 'new games and ', $posts, 'ninety-login');
echo '<span class="count">'.$comments.'</span>';
echo _n('new comment', 'new comments', $comments, 'ninety-login');
echo '</p>';
?>

<?php else: ?>

<?php
if ($last_login = (int) get_user_meta($current_user->ID, 'nd_login_time', true)) echo '<p>'.__('You last logged in on ','ninety-login').date_i18n(__('l \t\h\e jS \of F, Y \a\t h:ia','ninety-login'), $last_login).'.</p>';
$posts = wp_count_posts('post')->publish - (int) get_user_meta($current_user->ID, 'nd_num_posts', true);
$comments = wp_count_comments()->approved - (int) get_user_meta($current_user->ID, 'nd_num_comments', true);

echo '<p class="clearfix">';
echo _n('Since last logging in there has been ', 'Since last logging in there have been ', $posts, 'ninety-login');
echo '<span class="count">'.$posts.'</span>';
echo _n('new post and ', 'new posts and ', $posts, 'ninety-login');
echo '<span class="count">'.$comments.'</span>';
echo _n('new comment', 'new comments', $comments, 'ninety-login');
echo '</p>';
?>

<?php endif; ?>

<div class="td-admin-links">
<ul class="links">

<?php if ( current_user_can( 'manage_options' ) ) :?>
<li><a href="<?php echo site_url('/wp-admin/'); ?>"><?php _e( 'Dashboard', 'ninety-login' ); ?></a></li>
<?php endif; ?>


<?php if( function_exists( 'bp_is_active' ) ): ?>
<li><a href="<?php bp_loggedin_user_link() ?>settings/"><?php _e( 'Edit Profile', 'ninety-login' ); ?></a></li>
<?php else: ?>
<li><a href="<?php echo site_url('/wp-admin/profile.php'); ?>"><?php _e( 'Edit Profile', 'ninety-login' ); ?></a></li>
<?php endif; ?>

<li><a href="<?php echo wp_logout_url( $current_url ); ?>"><?php _e( 'Log out', 'ninety-login' ); ?></a></li>
</ul>
</div>
</div>

<?php // Activity tab start ?>

<div class="nd_logged_in nd_recently_viewed" style="display:none;">

<?php if ( defined( 'MYARCADE_VERSION') ): ?>
<div class="td-welcome-minitabs"><?php _e('Recently played games:','ninety-login'); ?></div>
<?php else: ?>
<div class="td-welcome-minitabs"><?php _e('Recently viewed articles:','ninety-login'); ?></div>
<?php endif; ?>

<?php $viewed_posts = get_user_meta($current_user->ID, 'nd_viewed_posts', true);
if (is_array($viewed_posts) && sizeof($viewed_posts)>0) :
echo '<ul class="links">';
$viewed_posts = array_reverse($viewed_posts);
foreach ($viewed_posts as $viewed) :
$viewed_post = get_post($viewed);
if ($viewed_post) echo '<li><a href="'.get_permalink($viewed).'">'.$viewed_post->post_title.'</a></li>';
endforeach;
echo '</ul>';
else :
echo '<p>';

if ( defined( 'MYARCADE_VERSION') ):
_e('You have not played any games recently.', 'ninety-login' );
else :
	_e('You have not viewed any articles recently.', 'ninety-login' );
endif;

echo '</p>';
endif;
?>

<div class="td-welcome-minitabs-2"><?php _e( 'My Recent Comments:','ninety-login' ); ?></div>
<?php
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, user_id, comment_approved, comment_date_gmt,
comment_type, SUBSTRING(comment_content,1,30) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = '' AND user_id = '".$current_user->ID."'
ORDER BY comment_date_gmt DESC LIMIT 5";
$comments = $wpdb->get_results($sql);
if ($comments) :
echo '<ul class="links" style="margin-bottom: 12px">';
foreach ($comments as $comment) :
echo '<li><a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'">&ldquo;'.strip_tags($comment->com_excerpt).'&hellip;&rdquo;</a></li>';
endforeach;
echo '</ul>';
else :
echo '<p>';
_e('You have not made any comments.', 'ninety-login');
echo '</p>';
endif;
?>

</div>

<?php // Activity tab end ?>

<?php //-- Online users tab -- ?>

<?php if ( class_exists( 'UserOnline_Core') ) : ?>

<div class="nd_logged_in nd_online_users" style="display:none;">
<div class="online-users-login">


<?php if ( function_exists( 'get_users_browsing_site' ) ):  // users browsing site ?>
<div class="td-online-users">
<?php _e( 'Users online:', 'ninety-login' ); ?>
</div>

<div class="online-users-content">
<?php echo get_users_browsing_site(); ?>
</div>
<?php endif; ?>


<?php if ( function_exists( 'get_users_browsing_page' ) ): // users browsing page ?>
<div class="td-online-users-browsing-page">
<?php _e( 'Users browsing this page:', 'ninety-login' ); ?>
</div>

<div class="online-users-content">
<?php echo get_users_browsing_page(); ?>
</div>
<?php endif; ?>

<?php if ( function_exists( 'get_most_users_online' ) ): // most users ever seen online ?>
<div class="td-online-ever-seen">
<?php _e( 'Most users ever seen online:', 'ninety-login' ); ?>
</div>

<div class="online-users-content-2">
<?php echo get_most_users_online(); ?> <?php _e( 'on', 'ninety-login' ); ?> <?php echo get_most_users_online_date(); ?>
</div>
<?php endif; ?>

</div>
</div>
<?php endif; ?>