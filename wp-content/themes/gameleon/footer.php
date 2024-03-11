</div><?php // end of #wrapper-content ?>

<div id="td-sticky-stopper"></div><?php // sticky sidebar stopper / ?>
<?php $td_colophone           = get_theme_mod( 'gameleon_colophon_enable' ); ?>
<?php $td_scroll_buttons      = get_theme_mod( 'gameleon_scroll_buttons' ); ?>

<div id="footer" class="clearfix">

<?php if( $td_colophone ) : ?>
<?php get_template_part( 'parts/colophone' ); ?>
<?php endif; ?>



<?php if( is_active_sidebar( 'footer-one' ) ) :?>

<div class="wrapper-footer">
<div class="td-fly-in">

<div class="grid col-340">
<?php
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Footer Widget 1' )):
endif;
?>
</div>


<div class="grid col-340">
<?php
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Footer Widget 2' )):
endif;
?>
</div>


<div class="grid col-340 fit">
<?php
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Footer Widget 3' )):
endif;
?>
</div>

</div><?php // end of fly-in ?>
</div><?php // end of #wrapper-footer ?>

<?php endif; ?>





<?php if ( $td_scroll_buttons ) : ?>
<div class="scrollpage">
<div class="scroll-up" id="scroll_up"><i class="fas fa-chevron-up"></i></div>
<div class="scroll-down" id="scroll_down"><i class="fas fa-chevron-down"></i></div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>

</div><?php // end of #footer ?>
<div class="td-sub-footer">

<div class="copyright">
    <p>
        <?php if( get_theme_mod( 'gameleon_footer_copyright' ) ) :
            $copy = get_theme_mod( 'gameleon_footer_copyright' );
            echo do_shortcode( stripslashes( $copy ));
            endif; ?>
    </p>
</div>

<div id="top-social">
<?php if ( get_theme_mod( 'gameleon_top_bar_mobile_menu_show_social' ) ) : ?>
    <ul class="social-icons">
        <?php get_template_part( 'parts/social-media-accounts' ); ?>
    </ul>
<?php endif; ?>
</div>

</div><?php // end of td-sub-footer/ ?>


</div><?php // end of #container ?>
</body>
</html>