<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	SOCIAL ACCOUNTS
-----------------------------------------------------------------------------------------------------------*/

?>
<?php if ( get_theme_mod( 'gameleon_social_facebook' ) ) : ?><li class="icon facebook"><a class="social-item" href="<?php echo esc_url( 'http://facebook.com/' . rawurlencode( get_theme_mod( 'gameleon_social_facebook' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_twitter' ) ) : ?><li class="icon twitter"><a class="social-item" href="<?php echo esc_url( 'http://twitter.com/' . rawurlencode( get_theme_mod( 'gameleon_social_twitter' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_instagram' ) ) : ?><li class="icon instagram"><a class="social-item" href="<?php echo esc_url( 'http://instagram.com/' . rawurlencode( get_theme_mod( 'gameleon_social_instagram' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_pinterest' ) ) : ?><li class="icon pinterest"><a class="social-item" href="<?php echo esc_url( 'http://pinterest.com/' . rawurlencode( get_theme_mod( 'gameleon_social_pinterest' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-pinterest"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_googleplus' ) ) : ?><li class="icon google-plus"><a class="social-item" href="<?php echo esc_url( 'http://plus.google.com/+' . rawurlencode( get_theme_mod( 'gameleon_social_googleplus' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-google-plus"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_youtube' ) ) : ?><li class="icon youtube"><a class="social-item" href="<?php echo esc_url( 'http://youtube.com/' . rawurlencode( get_theme_mod( 'gameleon_social_youtube' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_tumblr' ) ) : ?><li class="icon tumblr"><a class="social-item" href="http://<?php echo esc_html( get_theme_mod( 'gameleon_social_tumblr' ) ); ?>.tumblr.com" target="_blank" rel="noopener"><i class="fab fa-tumblr-square"></i></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_flickr' ) ) : ?><li class="icon flickr"><a class="social-item" href="<?php echo esc_url( 'http://flickr.com/people/' . rawurlencode( get_theme_mod( 'gameleon_social_flickr' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-flickr"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_linkedin' ) ) : ?><li class="icon linkedin"><a class="social-item" href="<?php echo esc_url( 'http://linkedin.com/in/' . rawurlencode( get_theme_mod( 'gameleon_social_linkedin' ) ) ); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin"></i></a></li><?php endif; ?>
<?php if ( get_theme_mod( 'gameleon_social_rss' ) ) : ?><li class="icon rss"><a class="social-item" href="<?php echo esc_url( get_theme_mod( 'gameleon_social_rss' ) ); ?>" target="_blank" rel="noopener"><i class="fas fa-rss"></i></a></li><?php endif; ?>
