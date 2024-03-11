<form action="<?php echo esc_url( $current_url ); ?>" method="post" class="nd_form nd_login_form"><div class="nd_form_inner">


<?php
if ( ! empty( $errors ) && $errors->get_error_code() ) {
	echo '<ul class="errors">';
	foreach ( $errors->errors as $error ) {
		echo '<li>' . esc_html( $error[0] ) . '</li>';
		break;
	}
	echo '</ul>';
}
?>


<p><label for="nd_username"><?php _e('Username','ninety-login'); ?>:</label> <input type="text" class="text" name="log" id="nd_username" placeholder="<?php _e('Username', 'ninety-login'); ?>" /></p>
<p><label for="nd_password"><?php _e('Password','ninety-login'); ?>:</label> <input type="password" class="text" name="pwd" id="nd_password" placeholder="<?php _e('Password','ninety-login'); ?>" /></p>
<p>


<a class="forgotten" href="#nd_lost_password_form"><?php _e('You can\'t login?','ninety-login'); ?></a> <input type="submit" class="button" value="<?php _e( 'Log in &rarr; ', 'ninety-login' ); ?>" />


<input name="nd_login" type="hidden" value="true"  />
<input name="rememberme" type="hidden" id="rememberme" value="forever"  />
<input name="redirect_to" type="hidden" id="redirect_to" value="<?php echo esc_url( $current_url ); ?>"  />
</p>
</div>



</form>

<?php if ( class_exists( 'UserOnline_Core') ) : ?>

<div class="nd_logged_in nd_online_users_off" style="display:none;">
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