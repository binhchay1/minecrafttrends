<?php

/**
 * Ninety_Login_widget class.
 *
 * @extends WP_Widget
 */
class Ninety_Login_widget extends WP_Widget {

    /**
     * Ninety_Login_widget function.
     *
     * @access public
     * @return void
     */

function __construct() {
  parent::__construct(
      'ninety_login_widget', // Base Widget ID
      __( '[G] Log in Box', 'gameleon' ), // Widget Name
      array( 'description' => __( 'Ajax powered Login &amp; Register widget.', 'gameleon' ), ) // Widget Args
      );
}

    /**
     * Test to see if the current theme is Gameleon
     *
     * @return bool
     */
    public static function is_gameleon() {
        $theme = wp_get_theme();

        if( $theme->Name == 'Gameleon' || $theme->Template == 'gameleon' ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * widget function.
     *
     * @access public
     * @param mixed $args
     * @param mixed $instance
     * @return void
     */
    function widget( $args, $instance ) {
        if( $this->is_gameleon() ) {
            $GLOBALS['Ninety_Login']->widget( $args );
        }

    }
}