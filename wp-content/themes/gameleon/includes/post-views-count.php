<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
    POST VIEWS COUNT
-----------------------------------------------------------------------------------------------------------*/

function get_gameleon_post_views( $postID ) {
    $td_count_key = 'post_views_count';
    $td_count = get_post_meta( $postID, $td_count_key, true );
    if( $td_count == '' ){
        delete_post_meta( $postID, $td_count_key );
        add_post_meta( $postID, $td_count_key, '0' );
        return "0";
    }
    return $td_count;
}


/*----------------------------------------------------------------------------------------------------------
    DETECT POST VIEWS COUNT AND STORE IT AS A CUSTOM FIELD FOR EACH POST.
-----------------------------------------------------------------------------------------------------------*/

function set_gameleon_post_views( $postID ) {
    $td_count_key = 'post_views_count';
    $td_count = get_post_meta( $postID, $td_count_key, true );
    if( $td_count == '' ){
        $td_count = 0;
        delete_post_meta( $postID, $td_count_key );
        add_post_meta( $postID, $td_count_key, '0' );
    }else{
        $td_count++;
        update_post_meta( $postID, $td_count_key, $td_count );
    }
}


/*----------------------------------------------------------------------------------------------------------
    ADD THE POST VIEWS TRACKER IN THE HEADER BY USING WP_HEAD HOOK.
-----------------------------------------------------------------------------------------------------------*/

function track_gameleon_post_views( $post_id ) {
    if ( !is_single() ) return;

    if ( empty ( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    }

    set_gameleon_post_views( $post_id );
}

add_action( 'wp_head', 'track_gameleon_post_views' );


/*----------------------------------------------------------------------------------------------------------
    ADD "VIEWS" COLUMN IN WP-ADMIN.
-----------------------------------------------------------------------------------------------------------*/

function gameleon_posts_columns( $defaults ) {
    $defaults['gameleon-post-views'] = '<div class="dashicons dashicons-visibility"></div>';
    return $defaults;
}

function gameleon_posts_custom_column( $column_name, $id ) {
    if( $column_name === 'gameleon-post-views' ){
        echo get_gameleon_post_views( get_the_ID() );
    }
}


/*----------------------------------------------------------------------------------------------------------
    OUTPUT A BIT CSS TO DECREASE THE WIDTH OF VIEWS COLUMN
-----------------------------------------------------------------------------------------------------------*/

function gameleon_views_css() {
    ?>
    <style type="text/css">
    #gameleon-post-views { width: 4em; }
    #views { width: 7em; }
    </style>
    <?php
}


/*----------------------------------------------------------------------------------------------------------
     ACTIONS AND FILTERS FOR TABLES AND CSS OUTPUT
-----------------------------------------------------------------------------------------------------------*/

function gameleon_views_add() {

    add_action( 'admin_head', 'gameleon_views_css' );

    if ( !function_exists( 'the_views' ) ) {
        add_filter( 'manage_posts_columns', 'gameleon_posts_columns' );
        add_action( 'manage_posts_custom_column', 'gameleon_posts_custom_column', 5, 2 );
    }

}

add_action( 'admin_init', 'gameleon_views_add' );