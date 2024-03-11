<?php

/*
Plugin Name: Gameleon - Widgets
Plugin URI: http://tiguandesign.com/
Description: Widgets of Gameleon theme
Version: 1.3
Author: Tiguan
Author URI: http://tiguandesign.com/
Text Domain: gameleon
*/


$theme = wp_get_theme(); // gets the current theme
if ( 'Gameleon' == $theme->name || 'Gameleon' == $theme->parent_theme ) {

class Gameleon_Feedburner extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_feedburner', // Base Widget ID
      __( '[G] Subscribe', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that allows users to subscribe via email to your Feedburner feed.', 'gameleon' ), ) // Widget Args
      );
}

/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $buffer         = $before_widget;
        //$title          = apply_filters( 'widget_title', $instance['title'] );
        $feed           = empty( $instance['feed']) ? false : $instance['feed'];
        $text_before    = empty( $instance['text_before'] ) ? false : $instance['text_before'];
        $button_text    = empty( $instance['button_text'] ) ? 'Subscribe' : $instance['button_text'];
        $user           = str_replace( 'http://feeds.feedburner.com/', '', $feed);

        // if (!empty( $title ) ) {
        //  $buffer .= $before_title . trim($title) . $after_title;
        // }


/*----------------------------------------------------------------------------------------------------------
  Widget Content
-----------------------------------------------------------------------------------------------------------*/

        $buffer .= '<div class="td-feedburner-wrap">';
        if (strlen($text_before) > 0) {
            $buffer .= '<div id="td-feedburner-afterform">' . trim($text_before) . '</div>';
        }

        $buffer .= '<form id="gameleon_feedburner" action="http://feedburner.google.com/fb/a/mailverify" method="post" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=' . $user . '\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\' )" target="popupwindow">';
        $placeholder = esc_attr__( 'Enter your email', 'gameleon' );
        $buffer .= '<input id="gameleon_feedburner_email" class="feedburner-email" placeholder="' . trim( $placeholder ) .'" type="text" name="email" />';
        $buffer .= '<input type="hidden" value="' . $user . '" name="uri"/>';
        $buffer .= '<input type="hidden" name="loc" value="en_US"/>';
        $buffer .= '<input id="gameleon_feedburner_submit" class="feedburner-subscribe" type="submit" value="' . trim($button_text) . '" />';
        $buffer .= '</form>';
        $buffer .= '</div>';
        $buffer .= $after_widget;

        echo $buffer;
    }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

function form ( $instance ) {

    $instance = wp_parse_args((array) $instance, array(
        //'title'       => '',
        'feed'          => '',
        'text_before'   => '',
        'button_text'   => ''
        ));

        //$title            = esc_attr( $instance['title'] );
        $feed           = esc_attr( $instance['feed'] );
        $text_before    = esc_attr( $instance['text_before'] );
        $button_text    = empty( $instance['button_text'] ) ? 'Subscribe' : esc_attr( $instance['button_text'] );
?>


<?php

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/

?>

    <p><?php _e( 'You need a Feedburner account and email subscriptions to be turned on.', 'gameleon' ); ?></p>


    <p>
        <label for="<?php echo $this->get_field_id( 'feed' ); ?>"><?php _e( 'Feedburner feed User:','gameleon' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'feed' ); ?>" name="<?php echo $this->get_field_name( 'feed' ); ?>" type="text" value="<?php echo $instance['feed']; ?>" />
        <small><em><?php echo '(http://feeds.feedburner.com/USER)'; ?></em></small>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Submit button text:','gameleon' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr($instance['button_text']); ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'text_before' ); ?>"><?php _e( 'Text before the form:','gameleon' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id( 'text_before' ); ?>" name="<?php echo $this->get_field_name( 'text_before' ); ?>" rows="10"><?php echo esc_attr($instance['text_before']); ?></textarea>
    </p>

<?php

    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Feedburner widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_feedburner_init(){
register_widget( 'Gameleon_Feedburner' );
}

add_action( 'widgets_init', 'gameleon_feedburner_init' );


/*----------------------------------------------------------------------------------------------------------
    Gameleon_Flickr_Widget Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Flickr_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
    parent::__construct(
        'gameleon_flickr_widget',
        __( '[G] Flickr Photos', 'gameleon' ),  // Widget Name
        array( 'description' => __( 'Displays photos from Flickr', 'gameleon' ), ) // Widget Args
        );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
    extract( $args );

    $query_args = array();

    $title      = apply_filters( 'widget_title', $instance['title'] );
    $query_args['count'] = !empty( $instance['count'] ) ? $instance['count'] : '';
    $query_args['display'] = !empty( $instance['display'] ) ? $instance['display'] : 'latest';
    $query_args['layout'] = !empty( $instance['layout'] ) ? $instance['layout'] : 'x';
    $query_args['size'] = !empty( $instance['size'] ) ? $instance['size'] : 'm';
    $query_args['source'] = !empty( $instance['source'] ) ? $instance['source'] : 'user';
    if( !empty( $instance['tag'] ) ) {
        if( $instance['source'] == 'user' )
            $query_args['source'] = 'user_tag';
        elseif( $instance['source'] == 'group' )
            $query_args['source'] = 'group_tag';
        elseif( $instance['source'] == 'all' )
            $query_args['source'] = 'all_tag';
    }
    if($instance['source'] == 'user')
        $query_args['user'] = $instance['id'];
    elseif( $instance['source'] == 'user_set' )
        $query_args['set'] = $instance['id'];
    elseif( $instance['source'] == 'group' )
        $query_args['group'] = $instance['id'];

    echo $before_widget;

    ?>

    <?php if ( $title ) : // widget title ?>
    <div class="widget-title">
    <h3>
    <?php echo $title; ?>
    </h3>
    </div>
    <?php endif; ?>


    <?php
    echo '<div class="flickr-badges">';
    echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?'.http_build_query($query_args).'"></script>';
    echo '</div>';
    ?>


    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
    return $new_instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
    $defaults = array(
            'title'     => 'Photos on Flickr',
            'source'    => 'user',
            'id'        => '',
            'count'     => '9',
            'display'   => 'latest',
            'tag'       => ''
        );

    $instance = wp_parse_args( (array) $instance, $defaults );

    $display = array( 'latest' => __( 'Latest', 'gameleon' ), 'random' => __( 'Random', 'gameleon' ) );
    $source = array( 'user' => __( 'User', 'gameleon' ), 'group' => __( 'Group', 'gameleon' ), 'user_set' => __( 'Set', 'gameleon' ), 'all' => __( 'Public', 'gameleon' ) );
    $count = array(1,2,3,4,5,6,7,8,9,10);

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'source' ); ?>"><?php _e( 'Source:', 'gameleon' ); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>">
<?php foreach ( $source as $option_value => $option_label ) { ?>
<option value="<?php echo $option_value; ?>" <?php selected( $instance['source'], $option_value ); ?>><?php echo $option_label; ?></option>
<?php } ?>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e( 'Flickr ID (<a target="_blank" href="http://www.idgettr.com">idGettr</a>):', 'gameleon' ); ?></label>
<input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo esc_attr( $instance['id'] ); ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php _e( 'Tags:', 'gameleon' ); ?> <span class="description"><?php _e( 'Separate tag with commas', 'gameleon' ); ?></span></label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" value="<?php echo esc_attr( $instance['tag'] ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images to show:', 'gameleon' ); ?></label>
<select class="smallfat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>">
<?php foreach ( $count as $option_value ) { ?>
<option value="<?php echo $option_value; ?>" <?php selected( $instance['count'], $option_value ); ?>><?php echo $option_value; ?></option>
<?php } ?>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e( 'Sorting:', 'gameleon' ); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
<?php foreach ( $display as $option_value => $option_label ) { ?>
<option value="<?php echo $option_value; ?>" <?php selected( $instance['display'], $option_value ); ?>><?php echo $option_label; ?></option>
<?php } ?>
</select>
</p>

<?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Flickr_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_flickr_widget_init(){
    register_widget( 'Gameleon_Flickr_Widget' );
}

add_action( 'widgets_init', 'gameleon_flickr_widget_init' );


/*----------------------------------------------------------------------------------------------------------
  Gameleon_Home_Carousel widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Home_Carousel extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_home_carousel', // Base Widget ID
      __( '[G] Home Carousel', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that displays a slider showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
      );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                 = apply_filters( 'widget_title', $instance['title'] );
$orderby               = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$post_type             = 'all';
$posts                 = $instance['posts'];
$categories            = $instance['categories'];

echo $before_widget;
?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>


<?php // =============================== MAIN BLOCK =============================== ?>

<?php if ( $title ) : ?>
<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>
<?php endif; ?>


<?php
// ----------- SLIDER CONTENT
// ---------------------------------------------------------------------------
?>

<div id="owl-home-carousel" class="owl-carousel owl-theme-3">

<?php
// ----------- QUERY
// ---------------------------------------------------------------------------
?>

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
<div class="td-wide-owl" >


<?php get_template_part( 'post-img-owl-carousel' ); ?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
  <?php echo get_the_title(); ?>
</a>
</h2>
<div class="dark-cover"></div>
</div><?php // end of .td-fly-in ?>
<?php endwhile; ?>

</div><?php // end of #owl-home ?>


<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                                     = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['post_type']              = 'all';
$instance['posts']                  = $new_instance['posts'];
$instance['categories']             = $new_instance['categories'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'orderby'             => 'date',
'bigexcerpt'                => '20',
'post_type'             => 'all',
'posts'                       => 5,
'categories'                => 'all'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Slider Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to slide (min.4) :', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>"  class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Home_Carousel widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_home_carousel_init(){
register_widget( 'Gameleon_Home_Carousel' );
}

add_action( 'widgets_init', 'gameleon_home_carousel_init' );

/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_1 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_1 extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'tigu_home_module_1',
__( '[G] Home Block 1', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays a block with two modules in line, one category for each block, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                  = apply_filters( 'widget_title', $instance['title'] );
$title_2                = apply_filters( 'widget_title', $instance['title_2'] );
$orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$orderby_2              = apply_filters ( 'orderby_2', isset ( $instance ['orderby_2'] ) ? $instance ['orderby_2'] : '' );
$readmore               = $instance['readmore'];
$readmore_2             = $instance['readmore_2'];
$bigexcerpt             = $instance['bigexcerpt'];
$post_type              = 'all';
$post_type_2            = 'all';
$posts                  = $instance['posts'];
$posts_2                = $instance['posts_2'];
$categories             = $instance['categories'];
$categories_2           = $instance['categories_2'];
$show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';
$show_footer_box        = ! empty( $instance['show_footer_box'] ) ? '1' : '0';

echo $before_widget;

?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>

<?php // =============================== LEFT BLOCK =============================== ?>

<div class="grid col-340">
<div class="td-content-inner">

<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>

<div class="td-wrap-content">

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php $counter = 1; ?>
<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>

<?php if( $counter == 1 ): ?>

<div class="td-fly-in">

<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h2 class="td-big-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- big date and comments
// ---------------------------------------------------------------------------
?>
<?php if( $show_post_meta == 1 ): ?>
<?php get_template_part( 'post-meta-small' ); // date and comments ?>
<?php endif; ?>


<?php if ( $bigexcerpt ) { ?>
<p>
<?php echo td_global_excerpt( $bigexcerpt ); ?>
</p>
<?php } ?>

</div><?php // end of td-fly-in ?>

<?php else: // elseif( $counter !== 1 ?>

<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<div class="td-small-module">
<div class="td-fly-in" >

<div class="show-tha-border"></div>

<div class="td-post-details"><?php // td-post-details ?>

<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img' ); ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- small excerpt
// ---------------------------------------------------------------------------
?>

<?php if( $show_post_meta == 1 ): ?>
  <div class="block-meta"><?php // block-meta ?>

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
<?php endif; ?>

</div><?php // end of td-post-details ?>


<?php
// -----------  meta
// ---------------------------------------------------------------------------
?>
<div class="clearfix"></div>



</div><?php // end of .td-fly-in ?>
</div><?php // end of .td-small-module ?>

<?php endif; // end of if counter = 1 ?>

<?php $counter++; endwhile; ?>

</div><?php // end of td-wrap-content ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts->found_posts; ?>
</div>

<?php if ( 'all' !== $instance['categories']):?>  
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="moregames-link">
<?php echo $readmore; ?><i class="fas fa-angle-right"></i>
</div>
</a>
<?php endif; ?>

</div>

<?php endif; ?>

</div><?php // end of td-content-inner ?>
</div><?php // end of grid col-340 ?>

<?php // =============================== RIGHT BLOCK =============================== ?>

<?php
$post_types = get_post_types();
unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);

if( $post_type_2 == 'all' ) {
$post_type_2_array = $post_types;
} else {
$post_type_2_array = $post_type;
}
?>

<div class="grid col-340 fit">
<div class="td-content-inner">

<div class="widget-title">
<h3>
    <a href="<?php echo esc_url( get_category_link( $categories_2 ) ); ?>"><?php echo $title_2; ?></a>
</h3>
</div>

<div class="td-wrap-content">

<?php
global $wp_query, $paged;
$metakey_2 = 'post_views_count';
$recent_posts_2 = new WP_Query( array( 'cat' => $categories_2, 'orderby' => $orderby_2, 'meta_key' => $metakey_2, 'posts_per_page' => $posts_2 ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts_2;
?>

<?php $counter = 1; ?>
<?php while( $recent_posts_2->have_posts() ): $recent_posts_2->the_post(); ?>

<?php if( $counter == 1 ): ?>

<div class="td-fly-in">

<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h2 class="td-big-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- big date and comments
// ---------------------------------------------------------------------------
?>

<?php if( $show_post_meta == 1 ): ?>
<?php get_template_part( 'post-meta-small' ); // date and comments ?>
<?php endif; ?>
<?php
// ----------- big excerpt
// ---------------------------------------------------------------------------
?>

<?php if ( $bigexcerpt ) { ?>
<p>
<?php echo td_global_excerpt( $bigexcerpt ); ?>
</p>
<?php } ?>

</div><?php // end of td-fly-in ?>

<?php else: // elseif( $counter !== 1 ?>

<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<div class="td-small-module">
<div class="td-fly-in" >

<div class="show-tha-border"></div>

<div class="td-post-details"><?php // td-post-details ?>
<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img' ); ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- small excerpt
// ---------------------------------------------------------------------------
?>

<?php if( $show_post_meta == 1 ): ?>

<div class="block-meta"><?php // block-meta ?>

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

<?php endif; ?>

</div><?php // end of td-post-details ?>


<?php
// -----------  meta
// ---------------------------------------------------------------------------
?>
<div class="clearfix"></div>

</div><?php // end of .td-fly-in ?>
</div><?php // end of .td-small-module ?>

<?php endif; ?><?php // end of $counter == 1 ?>

<?php $counter++; endwhile; ?>

</div><?php // end of td-wrap-content ?>


<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts_2->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts_2->found_posts; ?>
</div>
<a href="<?php echo esc_url( get_category_link( $categories_2 ) ); ?>">
<div class="moregames-link">
<?php echo $readmore_2; ?><i class="fas fa-angle-right"></i>
</div>
</a>
</div>

<?php endif; ?>

</div><?php // end of td-content-inner ?>
</div><?php // end of col-340 ?>

<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                           = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['title_2']                = strip_tags( $new_instance['title_2'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['orderby_2']              = strip_tags( $new_instance['orderby_2'] );
$instance['readmore']               = $new_instance['readmore'];
$instance['readmore_2']             = $new_instance['readmore_2'];
$instance['bigexcerpt']             = $new_instance['bigexcerpt'];
$instance['post_type']              = 'all';
$instance['post_type_2']            = 'all';
$instance['posts']                  = $new_instance['posts'];
$instance['posts_2']                = $new_instance['posts_2'];
$instance['categories']             = $new_instance['categories'];
$instance['categories_2']           = $new_instance['categories_2'];
$instance['show_post_meta']         = $new_instance['show_post_meta'];
$instance['show_footer_box']        = $new_instance['show_footer_box'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'title_2'               => 'Recent Posts',
'readmore'              => 'Read More',
'readmore_2'            => 'Read More',
'orderby'               => 'date',
'orderby_2'             => 'date',
'bigexcerpt'            => '20',
'post_type'             => 'all',
'post_type_2'           => 'all',
'posts'                 => 3,
'posts_2'               => 3,
'categories'            => 'all',
'categories_2'          => 'all',
'show_post_meta'        => 'on',
'show_footer_box'       => 'on'
);

$orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';
$orderby_2  = isset ( $instance ['orderby_2'] ) ? $instance ['orderby_2'] : '';
$instance   = wp_parse_args( (array) $instance, $defaults );

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignright" style="padding-right:5px"></div><?php _e( 'Left Module Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Left Module Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Right Module Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title_2' ); ?>"><?php _e( 'Right Module Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title_2' ); ?>" name="<?php echo $this->get_field_name( 'title_2' ); ?>" value="<?php echo $instance['title_2']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories_2' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories_2' ); ?>" name="<?php echo $this->get_field_name( 'categories_2' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories_2'] ) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories_2'] ) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby_2' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby_2' ); ?>" name="<?php echo $this->get_field_name( 'orderby_2' ); ?>" class="widefat">
<option value="date"<?php if( $orderby_2=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby_2=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby_2=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby_2=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby_2=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts_2' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts_2'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'posts_2' ); ?>" value="<?php echo $instance['posts_2']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'readmore_2' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore_2' ); ?>" name="<?php echo $this->get_field_name( 'readmore_2' ); ?>" value="<?php echo $instance['readmore_2']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>


<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>"><?php _e( 'Excerpt length in words of the first post. Leave empty for no excerpt.', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'bigexcerpt' ); ?>" value="<?php echo $instance['bigexcerpt']; ?>" />
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Home_Module_1 widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_home_module_1_init(){
register_widget( 'Tigu_Home_Module_1' );
}

add_action( 'widgets_init', 'tigu_home_module_1_init' );

/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_2 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_2 extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'tigu_home_module_2',
__( '[G] Home Block 2', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays a single module with a big image on the left, showing 4 posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                  = apply_filters( 'widget_title', $instance['title'] );
$orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$readmore               = $instance['readmore'];
$bigexcerpt             = $instance['bigexcerpt'];
$td_trim_title_small    = $instance['td_trim_title_small'];
$post_type              = 'all';
$categories             = $instance['categories'];
$show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';
$show_footer_box        = ! empty( $instance['show_footer_box'] ) ? '1' : '0';

echo $before_widget;

?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>

<?php // =============================== LEFT BLOCK =============================== ?>

<div class="td-content-inner">

<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>

<div class="td-wrap-content">

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => 4 ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php $counter = 1; ?>
<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>

<?php if( $counter == 1 ): ?>

<div class="grid col-340">
<div class="td-fly-in">
<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h2 class="td-big-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- big date and comments
// ---------------------------------------------------------------------------
?>
<?php if( $show_post_meta == 1 ): ?>
  <?php get_template_part( 'post-meta' ); // date, views, likes comments?>
<?php endif; ?>
<?php
// ----------- big excerpt
// ---------------------------------------------------------------------------
?>

<?php if ( $bigexcerpt ) { ?>
<p>
<?php echo td_global_excerpt( $bigexcerpt ); ?>
</p>
<?php } ?>


</div><?php // end of fly-in ?>
</div><?php // end of grid col-340 ?>

<?php else: // elseif( $counter !== 1 ?>

<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<div class="td-small-module grid col-340 fit">
<div class="td-fly-in">

<div class="td-post-details-2"><?php // td-post-details ?>

<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img' ); ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- small excerpt
// ---------------------------------------------------------------------------
?>
<?php if( $show_post_meta == 1 ): ?>
  <div class="block-meta"><?php // block-meta ?>

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
<?php endif; ?>
<div class="clearfix"></div>

</div><?php // end of td-post-details ?>


<?php
// -----------  meta
// ---------------------------------------------------------------------------
?>
</div><?php // end of fly-in?>
</div><?php // end of grid col-340 ?>


<?php endif; // end of if counter = 1 ?>

<?php $counter++; endwhile; ?>


</div><?php // end of td-wrap-content ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts->found_posts; ?>
</div>

<?php if ( 'all' !== $instance['categories']):?>
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="moregames-link">
<?php echo $readmore; ?><i class="fas fa-angle-right"></i>
</div>
</a>
<?php endif; ?>
</div>

<?php endif; ?>

</div><?php // end of td-content-inner ?>

<?php echo $after_widget;

}

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                           = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['readmore']               = $new_instance['readmore'];
$instance['bigexcerpt']             = $new_instance['bigexcerpt'];
$instance['post_type']              = 'all';
$instance['categories']             = $new_instance['categories'];
$instance['show_post_meta']         = $new_instance['show_post_meta'];
$instance['show_footer_box']        = $new_instance['show_footer_box'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'readmore'              => 'Read More',
'orderby'               => 'date',
'bigexcerpt'            => '20',
'post_type'             => 'all',
'categories'            => 'all',
'show_post_meta'        => 'on',
'show_footer_box'       => 'on'
);

$orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance   = wp_parse_args( (array) $instance, $defaults );

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>


<p>
<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>


<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>"><?php _e( 'Excerpt length in words of the first post. Leave empty for no excerpt.', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'bigexcerpt' ); ?>" value="<?php echo $instance['bigexcerpt']; ?>" />
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Home_Module_2 widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_home_module_2_init(){
register_widget( 'Tigu_Home_Module_2' );
}

add_action( 'widgets_init', 'tigu_home_module_2_init' );

/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_3 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_3 extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'tigu_home_module_3',
__( '[G] Home Block 3', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays two modules with a big images, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                  = apply_filters( 'widget_title', $instance['title'] );
$orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$readmore               = $instance['readmore'];
$view_all               = $instance['view_all'];
$posts                  = $instance['posts'];
$post_type              = 'all';
$categories             = $instance['categories'];
$show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';
$show_footer_box        = ! empty( $instance['show_footer_box'] ) ? '1' : '0';
$show_excerpt           = ! empty( $instance['show_excerpt'] ) ? '1' : '0';

echo $before_widget;

?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>

<?php // =============================== LEFT BLOCK =============================== ?>




<div class="td-content-inner td-module-3">

<div class="widget-title">
<h2>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h2>

<?php if ( 'all' !== $instance['categories']):?>
<?php if ( $view_all ) :?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="td-view-all">
  <?php echo $view_all; ?>
</div>
</a>
<?php else: ?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
  <div class="td-view-all">
  <?php echo _e( 'view all', 'gameleon' ); ?>
</div>
</a>
<?php endif; ?>
<?php endif; ?>

</div>

<div class="td-wrap-content">
<div class="td-fly-in">
<?php
global $wp_query, $paged;
$metakey = 'home_block_3_widget';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );

$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<div class="grid col-340">
<div class="td-post-details-3">
<?php $i = 0; ?>
<?php while($recent_posts->have_posts()) : $i++; if(($i % 2) == 0) : $wp_query->next_post(); else : $recent_posts->the_post(); ?>

<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h3 class="td-big-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h3>

<?php
// ----------- big date and comments
// ---------------------------------------------------------------------------
?>
<?php if( $show_post_meta == 1 ): ?>
<?php get_template_part( 'post-meta-small' ); // date and comments ?>
<?php endif; ?>
<?php
// ----------- big excerpt
// ---------------------------------------------------------------------------
?>

<?php if ( $show_excerpt == 1 ) { ?>
<p class="module-excerpt">
<?php echo td_global_excerpt( '20' ); ?>
</p>
<?php } ?>

<?php endif; endwhile; ?>
</div><?php // end of td-post-details-3 ?>
</div><?php // end of grid col-340 ?>

<div class="grid col-340 fit">
<div class="td-post-details-3">
<?php $i = 0; rewind_posts(); ?>
<?php while($recent_posts->have_posts()) : $i++; if(($i % 2) !== 0) : $wp_query->next_post(); else : $recent_posts->the_post(); ?>


<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h3 class="td-big-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h3>

<?php
// ----------- big date and comments
// ---------------------------------------------------------------------------
?>
<?php if( $show_post_meta == 1 ): ?>
<?php get_template_part( 'post-meta-small' ); // date and comments ?>
<?php endif; ?>
<?php
// ----------- big excerpt
// ---------------------------------------------------------------------------
?>

<?php if ( $show_excerpt == 1 ) { ?>
<p class="module-excerpt">
<?php echo td_global_excerpt( '20' ); ?>
</p>
<?php } ?>

<?php endif; endwhile; ?>
</div><?php // end of td-post-details-3 ?>
</div><?php // end of grid col-340 ?>

</div><?php // end of fly-in ?>
</div><?php // end of td-wrap-content ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts->found_posts; ?>
</div>

<?php if ( 'all' !== $instance['categories']):?>
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="moregames-link">
<?php echo $readmore; ?><i class="fas fa-angle-right"></i>
</div>
</a>
<?php endif; ?>

</div>

<?php endif; ?>

</div><?php // end of td-content-inner ?>

<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                           = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['readmore']               = $new_instance['readmore'];
$instance['view_all']               = $new_instance['view_all'];
$instance['posts']                  = $new_instance['posts'];
$instance['post_type']              = 'all';
$instance['categories']             = $new_instance['categories'];
$instance['show_post_meta']         = $new_instance['show_post_meta'];
$instance['show_footer_box']        = $new_instance['show_footer_box'];
$instance['show_excerpt']        = $new_instance['show_excerpt'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'readmore'              => 'Read More',
'view_all'              => 'view all',
'orderby'               => 'date',
'posts'                 => 4,
'post_type'             => 'all',
'categories'            => 'all',
'show_post_meta'        => 'on',
'show_footer_box'       => 'on',
'show_excerpt'          => 'on'
);

$orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance   = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'view_all' ); ?>"><?php _e( 'View All text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'view_all' ); ?>" name="<?php echo $this->get_field_name( 'view_all' ); ?>" value="<?php echo $instance['view_all']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>



<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>"><?php _e( 'Excerpt length in words. Leave empty for no excerpt.', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'bigexcerpt' ); ?>" value="<?php echo $instance['bigexcerpt']; ?>" />
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_excerpt'], 'on' ); ?> id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e( 'Show excerpt', 'gameleon' ); ?></label>
</p>


<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Home_Module_3 widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_home_module_3_init(){
register_widget( 'Tigu_Home_Module_3' );
}

add_action( 'widgets_init', 'tigu_home_module_3_init' );

/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_4 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_4 extends WP_Widget {


  /*----------------------------------------------------------------------------------------------------------
      Register widget with WordPress
  -----------------------------------------------------------------------------------------------------------*/
  
  public function __construct() {
  
  parent::__construct(
  'tigu_home_module_4',
  __( '[G] Home Block 4', 'gameleon' ), // Widget Name
  array( 'description' => __( 'Displays your posts in a grid layout ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
  );
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
      Front-end display of widget
  -----------------------------------------------------------------------------------------------------------*/
  
  public function widget( $args, $instance ) {
  extract( $args );
  
  $title                  = apply_filters( 'widget_title', $instance['title'] );
  $subtitle               = $instance['subtitle'];
  $view_all               = $instance['view_all'];
  $orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
  $readmore               = $instance['readmore'];
  $posts                  = $instance['posts'];
  $post_type              = 'all';
  $categories             = $instance['categories'];
  $show_footer_box        = ! empty( $instance['show_footer_box'] ) ? '1' : '0';
  
  echo $before_widget;
  
  ?>
  
  <?php
  $post_types = get_post_types();
  unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
  if( $post_type == 'all' ) {
  $post_type_array = $post_types;
  } else {
  $post_type_array = $post_type;
  }
  ?>
  
  <?php // =============================== LEFT BLOCK =============================== ?>
  
  
  <div class="td-content-inner">
  
  <div class="widget-title">
  <h3>

  <?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>

  <?php if ( $subtitle ) :?>
    <span class="td-subtitle"><?php echo $subtitle; ?></span>
  <?php endif; ?>
  </h3>

<?php if ( 'all' !== $instance['categories']):?>
<?php if ( $view_all ) :?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="td-view-all">
  <?php echo $view_all; ?>
</div>
</a>
<?php else: ?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
  <div class="td-view-all">
  <?php echo _e( 'view all', 'gameleon' ); ?>
</div>
</a>
<?php endif; ?>
<?php endif; ?>

  </div>
  
  <div class="td-wrap-content">
  <div class="td-fly-in">
  
  <?php
  global $wp_query, $paged;
  $metakey = 'post_views_count';
  $recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
  $temp_query = $wp_query;
  $wp_query = null;
  $wp_query = $recent_posts;
  ?>
  
  
  <?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
  <?php get_template_part( 'post-img-friv' ); ?>
  <?php endwhile; ?>
  
  
  </div><?php // end of fly-in ?>
  </div><?php // end of td-wrap-content ?>
  
  <?php
  // ----------- footer box
  // ---------------------------------------------------------------------------
  ?>
  
  <?php if( $show_footer_box == 1 ): ?>
  
  <div class="moregames">
  <div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
  <?php echo $recent_posts->found_posts; ?>
  </div>

  <?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
  <div class="moregames-link">
  <?php echo $readmore; ?><i class="fas fa-angle-right"></i>
  </div>
  </a>
  <?php endif; ?>

  </div>
  
  <?php endif; ?>
  
  </div><?php // end of td-content-inner ?>
  
  <?php echo $after_widget;
  
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Sanitize widget form values as they are saved
  -----------------------------------------------------------------------------------------------------------*/
  
  public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                           = $old_instance;
  $instance['title']                  = strip_tags( $new_instance['title'] );
  $instance['subtitle']               = $new_instance['subtitle'];
  $instance['view_all']               = $new_instance['view_all'];
  $instance['orderby']                = strip_tags( $new_instance['orderby'] );
  $instance['readmore']               = $new_instance['readmore'];
  $instance['posts']                  = $new_instance['posts'];
  $instance['post_type']              = 'all';
  $instance['categories']             = $new_instance['categories'];
  $instance['show_footer_box']        = $new_instance['show_footer_box'];
  
  return $instance;
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Back-end widget form
  -----------------------------------------------------------------------------------------------------------*/
  
  public function form( $instance ) {
  $defaults = array(
  'title'                 => 'Recent Posts',
  'subtitle'              => 'top',
  'view_all'              => 'view all',
  'orderby'               => 'date',
  'posts'                 => 14,
  'post_type'             => 'all',
  'categories'            => 'all',
  'show_footer_box'       => 'on',
  'readmore'             => 'Read More'
  );
  
  
  
  $orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';
  
  $instance   = wp_parse_args( (array) $instance, $defaults );
  
  
  
  /*----------------------------------------------------------------------------------------------------------
    Widget Options
  -----------------------------------------------------------------------------------------------------------*/
  ?>
  
  <h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
  </p>
  
  <p>
    <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:', 'gameleon' ); ?></label>
    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
  </p>
  

  <p>
    <label for="<?php echo $this->get_field_id( 'view_all' ); ?>"><?php _e( 'View All:', 'gameleon' ); ?></label>
    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'view_all' ); ?>" name="<?php echo $this->get_field_name( 'view_all' ); ?>" value="<?php echo $instance['view_all']; ?>" />
  </p>


  <p>
  <label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
  <input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
  <option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
  <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
  <?php foreach( $categories as $category ) { ?>
  <option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
  <?php } ?>
  </select>
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
  <option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
  <option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
  <option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
  <option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
  <option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
  </select>
  </p>
  

  <p>
  <label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
  </p>
  <p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>
  

  <p>
  <input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
  <label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
  </p>
  
  
  <?php
  }
  
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Register Tigu_Home_Module_4 widget
  -----------------------------------------------------------------------------------------------------------*/
  
  function tigu_home_module_4_init(){
  register_widget( 'Tigu_Home_Module_4' );
  }
  
  add_action( 'widgets_init', 'tigu_home_module_4_init' );

  
/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_5 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_5 extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'tigu_home_module_5',
__( '[G] Home Block 5', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays a single module with a big image on the top and other small posts, ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                  = apply_filters( 'widget_title', $instance['title'] );
$orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$smallexcerpt           = $instance['smallexcerpt'];
$post_type              = 'all';
$categories             = $instance['categories'];
$show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';

echo $before_widget;

?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>

<?php // =============================== LEFT BLOCK =============================== ?>


<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>

<div class="td-wrap-content mod-5">

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => 5 ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php $counter = 1; ?>
<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>

<?php if( $counter == 1 ): ?>

<div class="td-module-5 grid col-610">

<div class="td-fly-in">
    <div class="overlay-shadow-bottom"></div>
<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-blog' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h2 class="td-big-title">
<a href="<?php echo get_permalink(); ?>">
    <?php echo get_the_title(); ?>
</a>


</h2>


</div><?php // end of fly-in ?>
</div><?php // end of grid col-340 ?>

<?php else: // elseif( $counter !== 1 ?>

<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<div class="td-small-module grid col-340">

<div class="td-fly-in">

<div class="td-post-details-5"><?php // td-post-details ?>

<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img' ); ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>">
  <?php echo ( get_the_title() ); ?>
</a>
</h2>

<?php
// ----------- small excerpt
// ---------------------------------------------------------------------------
?>
<?php if ( $smallexcerpt ) { ?>
<p>
<?php echo td_global_excerpt( $smallexcerpt ); ?>
</p>
<?php } ?>

<div class="clearfix"></div>
<?php if( $show_post_meta == 1 ): ?>
<?php get_template_part( 'post-meta' ); // date, views, likes comments?>
<?php endif; ?>

</div><?php // end of td-post-details ?>


<?php
// -----------  meta
// ---------------------------------------------------------------------------
?>
</div><?php // end of fly-in?>
</div><?php // end of grid col-340 ?>


<?php endif; // end of if counter = 1 ?>

<?php $counter++; endwhile; ?>


</div><?php // end of td-wrap-content ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>


<?php echo $after_widget;

}

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                           = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['smallexcerpt']           = $new_instance['smallexcerpt'];
$instance['post_type']              = 'all';
$instance['categories']             = $new_instance['categories'];
$instance['show_post_meta']         = $new_instance['show_post_meta'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'orderby'               => 'date',
'smallexcerpt'          => '10',
'post_type'             => 'all',
'categories'            => 'all',
'show_post_meta'        => 'on'
);

$orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance   = wp_parse_args( (array) $instance, $defaults );

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>


<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>


<p>
<label for="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>"><?php _e( 'Excerpt length in words near thumbnails. Leave empty for no excerpt.', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'smallexcerpt' ); ?>" value="<?php echo $instance['smallexcerpt']; ?>" />
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
</p>



<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Home_Module_5 widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_home_module_5_init(){
register_widget( 'Tigu_Home_Module_5' );
}

add_action( 'widgets_init', 'tigu_home_module_5_init' );


/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_6 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_6 extends WP_Widget {


  /*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
  -----------------------------------------------------------------------------------------------------------*/
  
  public function __construct() {
  parent::__construct(
  'tigu_home_module_6',
  __( '[G] Home Block 6', 'gameleon' ), // Widget Name
  array( 'description' => __( 'Beta version suitable for Home Wide sidebar only. Displays one module with a big images inline, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
  );
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
  -----------------------------------------------------------------------------------------------------------*/
  
  public function widget( $args, $instance ) {
  extract( $args );
  
  $title                  = apply_filters( 'widget_title', $instance['title'] );
  $subtitle               = $instance['subtitle'];
  $view_all               = $instance['view_all'];
  $orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
  $posts                  = $instance['posts'];
  $post_type              = 'all';
  $categories             = $instance['categories'];
  $show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';
  
  echo $before_widget;
  
  ?>
  
  <?php
  $post_types = get_post_types();
  unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
  if( $post_type == 'all' ) {
  $post_type_array = $post_types;
  } else {
  $post_type_array = $post_type;
  }
  ?>
  
  
<div class="td-content-inner td-module-6">

<div class="widget-title">
<h2>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
<?php if ( $subtitle ) :?>
  <span class="td-subtitle"><?php echo $subtitle; ?></span>
<?php endif; ?>
  </h2>

<?php if ( 'all' !== $instance['categories']):?>
<?php if ( $view_all ) :?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="td-view-all">
  <?php echo $view_all; ?>
</div>
</a>
<?php else: ?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
  <div class="td-view-all">
  <?php echo _e( 'view all', 'gameleon' ); ?>
</div>
</a>
<?php endif; ?>
<?php endif; ?>

  </div>
  
  <div class="td-wrap-content">
  <div class="td-fly-in">
  <?php
  global $wp_query, $paged;
  $metakey = 'home_block_6_widget';
  $recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
  $temp_query = $wp_query;
  $wp_query = null;
  $wp_query = $recent_posts;
  ?>
  

<?php $counter = 1 ?>
<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>

<div class="grid col-340 <?php if ($counter % 3 == 1){echo 'td-no-fit';}else if ($counter % 3 == 0){echo 'fit';} ?>">
  <div class="td-post-details-3">

  <?php
  // ----------- big featured image
  // ---------------------------------------------------------------------------
  ?>
  
  <?php get_template_part( 'post-img-home-modules' ); // big featured image ?>
  
  <?php
  // ----------- big image title
  // ---------------------------------------------------------------------------
  ?>
  
  <h4 class="td-big-title">
  <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
      <?php echo ( get_the_title() ); ?>
  </a>
  </h4>
  
  <?php
  // ----------- big date and comments
  // ---------------------------------------------------------------------------
  ?>
  <?php if( $show_post_meta == 1 ): ?>
  <?php get_template_part( 'post-meta-small' ); // date and comments ?>
  <?php endif; ?>

  </div><?php // end of td-post-details-3 ?>
  </div><?php // end of grid col-340 ?>

  <?php
    $counter++ ; 
  ?>
  <?php endwhile; ?>

  

  
  </div><?php // end of fly-in ?>
  </div><?php // end of td-wrap-content ?>
  
  <?php
  // ----------- footer box
  // ---------------------------------------------------------------------------
  ?>

  </div><?php // end of td-content-inner ?>
  
  <?php echo $after_widget;
  
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Sanitize widget form values as they are saved
  -----------------------------------------------------------------------------------------------------------*/
  
  public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                           = $old_instance;
  $instance['title']                  = strip_tags( $new_instance['title'] );
  $instance['subtitle']               = $new_instance['subtitle'];
  $instance['view_all']               = $new_instance['view_all'];
  $instance['orderby']                = strip_tags( $new_instance['orderby'] );
  $instance['posts']                  = $new_instance['posts'];
  $instance['post_type']              = 'all';
  $instance['categories']             = $new_instance['categories'];
  $instance['show_post_meta']         = $new_instance['show_post_meta'];
  
  return $instance;
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Back-end widget form
  -----------------------------------------------------------------------------------------------------------*/
  
  public function form( $instance ) {
  $defaults = array(
  'title'                 => 'Recent Posts',
  'orderby'               => 'date',
  'subtitle'              => 'top',
  'view_all'              => 'view all',
  'posts'                 => 4,
  'post_type'             => 'all',
  'categories'            => 'all',
  'show_post_meta'        => 'on'
  );
  
  $orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';
  
  $instance   = wp_parse_args( (array) $instance, $defaults );
  
  
  
  /*----------------------------------------------------------------------------------------------------------
    Widget Options
  -----------------------------------------------------------------------------------------------------------*/
  ?>
  
  <h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'view_all' ); ?>"><?php _e( 'View All text:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'view_all' ); ?>" name="<?php echo $this->get_field_name( 'view_all' ); ?>" value="<?php echo $instance['view_all']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
  <input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
  <option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
  <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
  <?php foreach( $categories as $category ) { ?>
  <option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
  <?php } ?>
  </select>
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
  <option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
  <option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
  <option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
  <option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
  <option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
  </select>
  </p>

  <p>
  <input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
  <label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
  </p>

  
  <?php
  }
  
  }
  
  /*----------------------------------------------------------------------------------------------------------
    Register Tigu_Home_Module_6 widget
  -----------------------------------------------------------------------------------------------------------*/
  
  function tigu_home_module_6_init(){
  register_widget( 'Tigu_Home_Module_6' );
  }
  
  add_action( 'widgets_init', 'tigu_home_module_6_init' );
  
  
/*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_8 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_8 extends WP_Widget {


  /*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
  -----------------------------------------------------------------------------------------------------------*/
  
  public function __construct() {
  parent::__construct(
  'tigu_home_module_8',
  __( '[G] Home Block 8', 'gameleon' ), // Widget Name
  array( 'description' => __( 'Beta version suitable for Home Wide sidebar only. Displays big images in a grid style, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
  );
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
  -----------------------------------------------------------------------------------------------------------*/
  
  public function widget( $args, $instance ) {
  extract( $args );
  
  $title                  = apply_filters( 'widget_title', $instance['title'] );
  $subtitle               = $instance['subtitle'];
  $view_all               = $instance['view_all'];
  $play_button            = $instance['play_button'];
  $orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
  $posts                  = $instance['posts'];
  $post_type              = 'all';
  $categories             = $instance['categories'];
  
  echo $before_widget;
  
  ?>
  
  <?php
  $post_types = get_post_types();
  unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
  if( $post_type == 'all' ) {
  $post_type_array = $post_types;
  } else {
  $post_type_array = $post_type;
  }
  ?>
  
 
<div class="td-content-inner td-module-8">

<div class="widget-title">

<h2>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>

<?php if ( $subtitle ) :?>
  <span class="td-subtitle"><?php echo $subtitle; ?></span>
<?php endif; ?>
  </h2>

<?php if ( 'all' !== $instance['categories']):?>
<?php if ( $view_all ) :?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="td-view-all">
  <?php echo $view_all; ?>
</div>
</a>
<?php else: ?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
  <div class="td-view-all">
  <?php echo _e( 'view all', 'gameleon' ); ?>
</div>
</a>
<?php endif; ?>
<?php endif; ?>

  </div>


  
  <div class="td-wrap-content">
  <div class="td-fly-in">
  <?php
  global $wp_query, $paged;
  $metakey = 'home_block_8_widget';
  $recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
  $temp_query = $wp_query;
  $wp_query = null;
  $wp_query = $recent_posts;
  ?>
  

<?php $counter = 1 ?>
<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>

<div class="grid col-520 <?php if ($counter % 2 == 1){echo 'td-no-fit';}else if ($counter % 2 == 0){echo 'fit';} ?>">
  
<div class="td-post-details-8">
  <?php get_template_part( 'post-img-mod-8' ); // big featured image ?>


<div class="triangle-shape"></div>
<div class="triangle-shape-last"></div>
<div class="td-table">
<div class="module-8-cat">
<?php the_category(', '); ?>
</div>

  <h3 class="td-big-title">
  <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
      <?php echo ( get_the_title() ); ?>
  </a>
  </h3>
</div>

<div class="cell">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
  <span class="mod-8-btn">
    <span class="label">

    <?php if ( $play_button ) :?>
      <?php echo $play_button; ?>
      <?php else: ?>
      <?php _e( 'Play', 'gameleon' ); ?>
      <?php endif;?>
  
  </span>
    <span class="icon"><i class="fas fa-chevron-right"></i></span>
    </span>
    </a>
</div>

  </div><?php // end of td-post-details-3 ?>
  
  </div><?php // end of grid col-520 ?>

  <?php
    $counter++ ; 
  ?>
  <?php endwhile; ?>
  
  </div><?php // end of fly-in ?>
  </div><?php // end of td-wrap-content ?>
  

  </div><?php // end of td-content-inner ?>
  
  <?php echo $after_widget;
  
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Sanitize widget form values as they are saved
  -----------------------------------------------------------------------------------------------------------*/
  
  public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                           = $old_instance;
  $instance['title']                  = strip_tags( $new_instance['title'] );
  $instance['subtitle']               = $new_instance['subtitle'];
  $instance['view_all']               = $new_instance['view_all'];
  $instance['play_button']            = $new_instance['play_button'];
  $instance['orderby']                = strip_tags( $new_instance['orderby'] );
  $instance['posts']                  = $new_instance['posts'];
  $instance['post_type']              = 'all';
  $instance['categories']             = $new_instance['categories'];
  
  return $instance;
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Back-end widget form
  -----------------------------------------------------------------------------------------------------------*/
  
  public function form( $instance ) {
  $defaults = array(
  'title'                 => 'Recent Posts',
  'orderby'               => 'date',
  'subtitle'              => 'top',
  'play_button'           => 'Play',
  'view_all'              => 'view all',
  'posts'                 => 4,
  'post_type'             => 'all',
  'categories'            => 'all',
  );
  
  $orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';
  
  $instance   = wp_parse_args( (array) $instance, $defaults );
  
  
  
  /*----------------------------------------------------------------------------------------------------------
    Widget Options
  -----------------------------------------------------------------------------------------------------------*/
  ?>
  
  <h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'play_button' ); ?>"><?php _e( 'Play Button Text:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'play_button' ); ?>" name="<?php echo $this->get_field_name( 'play_button' ); ?>" value="<?php echo $instance['play_button']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'view_all' ); ?>"><?php _e( 'View All text:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'view_all' ); ?>" name="<?php echo $this->get_field_name( 'view_all' ); ?>" value="<?php echo $instance['view_all']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
  <input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
  <option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
  <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
  <?php foreach( $categories as $category ) { ?>
  <option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
  <?php } ?>
  </select>
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
  <option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
  <option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
  <option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
  <option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
  <option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
  </select>
  </p>

  <?php
  }
  
  }
  
  /*----------------------------------------------------------------------------------------------------------
    Register Tigu_Home_Module_8 widget
  -----------------------------------------------------------------------------------------------------------*/
  
  function tigu_home_module_8_init(){
  register_widget( 'Tigu_Home_Module_8' );
  }
  
  add_action( 'widgets_init', 'tigu_home_module_8_init' );


  /*----------------------------------------------------------------------------------------------------------
    Tigu_Home_Module_7 Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Home_Module_7 extends WP_Widget {


  /*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
  -----------------------------------------------------------------------------------------------------------*/
  
  public function __construct() {
  parent::__construct(
  'tigu_home_module_7',
  __( '[G] Home Block 7', 'gameleon' ), // Widget Name
  array( 'description' => __( 'Displays one module with a big images on the left and title & metas on the right, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
  );
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
  -----------------------------------------------------------------------------------------------------------*/
  
  public function widget( $args, $instance ) {
  extract( $args );
  
  $title                  = apply_filters( 'widget_title', $instance['title'] );
  $subtitle               = $instance['subtitle'];
  $view_all               = $instance['view_all'];
  $orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
  $posts                  = $instance['posts'];
  $post_type              = 'all';
  $categories             = $instance['categories'];
  $show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';
  
  echo $before_widget;
  
  ?>
  
  <?php
  $post_types = get_post_types();
  unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
  if( $post_type == 'all' ) {
  $post_type_array = $post_types;
  } else {
  $post_type_array = $post_type;
  }
  ?>
  
  <?php // =============================== LEFT BLOCK =============================== ?>
  

  
  <div class="td-module-7">
  
  <div class="widget-title">
  <h3>
  <?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>

<?php if ( $subtitle ) :?>
  <span class="td-subtitle"><?php echo $subtitle; ?></span>
<?php endif; ?>
  </h3>

  <?php if ( 'all' !== $instance['categories']):?>
<?php if ( $view_all ) :?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="td-view-all">
  <?php echo $view_all; ?>
</div>
</a>
<?php else: ?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
  <div class="td-view-all">
  <?php echo _e( 'view all', 'gameleon' ); ?>
</div>
</a>
<?php endif; ?>
<?php endif; ?>

  </div>
  

  <div class="td-fly-in">
  <?php
  global $wp_query, $paged;
  $metakey = 'post_views_count';
  $recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
  $temp_query = $wp_query;
  $wp_query = null;
  $wp_query = $recent_posts;
  ?>
  
<?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>

<div class="grid col-340">
  <div class="td-post-details-7">

  <?php // ----------- big featured image // ?>
<div class="td-module-7-img">
  <?php get_template_part( 'post-img-square' ); // big featured image ?>
</div><?php // end of td-module-7-img ?>

</div><?php // end of td-post-details-7 ?>
</div><?php // end of grid col-340 ?>

<div class="grid col-340 fit">
<div class="td-post-content">
<div class="td-module-7-title">

  <?php // ----------- title ?>
  
  <h2 class="td-big-title">
  <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
      <?php echo ( get_the_title() ); ?>
  </a>
  </h2>
  
  <?php // ----------- big date and comments 
  ?>
  <?php if( $show_post_meta == 1 ): ?>
  <?php get_template_part( 'post-meta' ); // date and comments ?>
  <?php endif; ?>
  </div><?php // end of td-module-7-title ?>

  </div><?php // end of td-post-content ?>
</div><?php // end of grid col-340 fit?>


  <?php endwhile; ?>
  
  </div><?php // end of fly-in ?>

  </div><?php // end of td-module-6 ?>
  
  <?php echo $after_widget;
  
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Sanitize widget form values as they are saved
  -----------------------------------------------------------------------------------------------------------*/
  
  public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                           = $old_instance;
  $instance['title']                  = strip_tags( $new_instance['title'] );
  $instance['subtitle']               = $new_instance['subtitle'];
  $instance['view_all']               = $new_instance['view_all'];
  $instance['orderby']                = strip_tags( $new_instance['orderby'] );
  $instance['posts']                  = $new_instance['posts'];
  $instance['post_type']              = 'all';
  $instance['categories']             = $new_instance['categories'];
  $instance['show_post_meta']         = $new_instance['show_post_meta'];
  
  return $instance;
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
    Back-end widget form
  -----------------------------------------------------------------------------------------------------------*/
  
  public function form( $instance ) {
  $defaults = array(
  'title'                 => 'Recent Posts',
  'orderby'               => 'date',
  'subtitle'              =>'top',
  'view_all'              =>'view all',
  'posts'                 => 4,
  'post_type'             => 'all',
  'categories'            => 'all',
  'show_post_meta'        => 'on'
  );
  
  $orderby    = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';
  
  $instance   = wp_parse_args( (array) $instance, $defaults );
  
  
  
  /*----------------------------------------------------------------------------------------------------------
    Widget Options
  -----------------------------------------------------------------------------------------------------------*/
  ?>
  
  <h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'view_all' ); ?>"><?php _e( 'View All text:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'view_all' ); ?>" name="<?php echo $this->get_field_name( 'view_all' ); ?>" value="<?php echo $instance['view_all']; ?>" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
  <input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
  <option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
  <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
  <?php foreach( $categories as $category ) { ?>
  <option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
  <?php } ?>
  </select>
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
  <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
  <option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
  <option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
  <option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
  <option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
  <option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
  </select>
  </p>

  <p>
  <input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
  <label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
  </p>

  
  <?php
  }
  
  }
  
  /*----------------------------------------------------------------------------------------------------------
    Register Tigu_Home_Module_7 widget
  -----------------------------------------------------------------------------------------------------------*/
  
  function tigu_home_module_7_init(){
  register_widget( 'Tigu_Home_Module_7' );
  }
  
  add_action( 'widgets_init', 'tigu_home_module_7_init' );



/*----------------------------------------------------------------------------------------------------------
  Tigu_Tabs_Widget Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Tabs_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

    public function __construct() {
        parent::__construct(
            'tigu_tabs_widget',
            __( '[G] Home Tabs', 'gameleon' ), // Widget Name
            array( 'description' => __( 'A widget that displays the tabs of recent posts, most popular posts, most viewed/played posts and random posts on your home page.', 'gameleon' ), ) // Widget Args
            );
    }


/*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
  extract( $args );
  $posts                = $instance['posts'];
  //$td_trim_title_tabs   = $instance['td_trim_title_tabs'];
  $exclude_cat          = !empty( $instance['exclude_cat'] ) ? $instance['exclude_cat'] : NULL;
  $exclude_cat_pop      = !empty( $instance['exclude_cat_pop'] ) ? $instance['exclude_cat_pop'] : NULL;
  $exclude_cat_most     = !empty( $instance['exclude_cat_most'] ) ? $instance['exclude_cat_most'] : NULL;
  $exclude_cat_rand     = !empty( $instance['exclude_cat_rand'] ) ? $instance['exclude_cat_rand'] : NULL;
  $show_recent_posts    = ! empty( $instance['show_recent_posts'] ) ? '1' : '0';
  $show_popular_posts   = ! empty( $instance['show_popular_posts'] ) ? '1' : '0';
  $show_most_played     = ! empty( $instance['show_most_played'] ) ? '1' : '0';
  $show_random_posts    = ! empty( $instance['show_random_posts'] ) ? '1' : '0';
  ?>

<?php echo $before_widget; ?>

<div id="td-home-tabs">

<div class="tabs-wrapper">

<?php
// ----------- TABS TITLES
// ---------------------------------------------------------------------------
?>

<div class="tabs">
<ul class="tab-links">
<?php if( $show_recent_posts  == 1 ): ?>
<li class="active">
<a href="#tab1">
<?php if( defined( 'MYARCADE_VERSION') ) : ?><?php _e( 'Latest Games', 'gameleon' ); ?><?php else: ?><?php _e( 'Latest Articles', 'gameleon' ); ?><?php endif; ?>
</a>
</li>
<?php endif; ?>

<?php
// ----------- TAB TITLE 2
// ---------------------------------------------------------------------------
?>

<?php if( $show_popular_posts == 1 ): ?>
<li>
<a href="#tab2">
<?php _e( 'Most Popular', 'gameleon' ); ?>
</a>
</li>
<?php endif; ?>

<?php
// ----------- TAB TITLE 3
// ---------------------------------------------------------------------------
?>

<?php if( $show_most_played   == 1 ): ?>
<li>
<a href="#tab3">
<?php if( defined( 'MYARCADE_VERSION') ) : ?><?php _e( 'Most Played', 'gameleon' ); ?><?php else: ?><?php _e( 'Most Viewed', 'gameleon' ); ?><?php endif; ?>
</a>
</li>
<?php endif; ?>

<?php
// ----------- TAB TITLE 4
// ---------------------------------------------------------------------------
?>

<?php if( $show_random_posts  == 1 ): ?>
<li>
<a href="#tab4">
<?php if( defined( 'MYARCADE_VERSION') ) : ?><?php _e( 'Random Games', 'gameleon' ); ?><?php else: ?><?php _e( 'Random Articles', 'gameleon' ); ?><?php endif; ?>
</a>
</li>
<?php endif; ?>
</ul>


<div class="tab-content">
<div class="td-fly-in">
<?php
// ----------- TAB CONTENT 1
// ---------------------------------------------------------------------------
?>

<?php if( $show_recent_posts  == 1 ): ?>
<div id="tab1" class="tab active">

<?php
$exclude_recent_posts = $exclude_cat;
$exclude_recent_posts = explode(',',$exclude_recent_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$recent_posts = new WP_Query( array( 'category__not_in' => $exclude_recent_posts, 'orderby' => 'date', 'posts_per_page' => 4, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>
<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab1 ?>
<?php endif; ?>


<?php
// ----------- TAB CONTENT 2
// ---------------------------------------------------------------------------
?>

<?php if( $show_popular_posts == 1 ): ?>
<div id="tab2" class="tab">

<?php
$exclude_popular_posts = $exclude_cat;
$exclude_popular_posts = explode(',',$exclude_popular_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$popular_posts = new WP_Query( array( 'category__not_in' => $exclude_popular_posts, 'orderby' => 'comment_count', 'posts_per_page' => 4, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $popular_posts;
?>
<?php while( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab2 ?>
<?php endif; ?>

<?php
// ----------- TAB CONTENT 3
// ---------------------------------------------------------------------------
?>

<?php if( $show_most_played   == 1 ): ?>
<div id="tab3" class="tab">

<?php
$td_metakey = 'post_views_count';
$exclude_most_viewed_posts = $exclude_cat;
$exclude_most_viewed_posts = explode(',',$exclude_most_viewed_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$most_viewed = new WP_Query( array( 'category__not_in' => $exclude_most_viewed_posts, 'orderby' => 'meta_value_num', 'posts_per_page' => 4, 'meta_key' => $td_metakey, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $most_viewed;
?>
<?php while( $most_viewed->have_posts() ) : $most_viewed->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab3 ?>
<?php endif; ?>

<?php
// ----------- TAB CONTENT 4
// ---------------------------------------------------------------------------
?>

<?php if( $show_random_posts  == 1 ): ?>
<div id="tab4" class="tab">

<?php
$exclude_random_posts = $exclude_cat;
$exclude_random_posts = explode(',',$exclude_random_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$random_posts = new WP_Query( array( 'category__not_in' => $exclude_random_posts, 'orderby' => 'rand', 'posts_per_page' => 4, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $random_posts;
?>
<?php while( $random_posts->have_posts() ) : $random_posts->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab4 ?>
<?php endif; ?>
</div><?php // end of tab-content ?>
</div><?php // end of tab-content ?>
</div><?php // end of tabs ?>
</div><?php // end of tabs-wrapper ?>
</div><?php // end of #td-home-tabs ?>

<?php echo $after_widget;
}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
  $instance = array();

      $instance = $old_instance;
      $instance['posts']              = $new_instance['posts'];
      $instance['exclude_cat']        = esc_attr( $new_instance['exclude_cat'] );
      $instance['exclude_cat_pop']    = esc_attr( $new_instance['exclude_cat_pop'] );
      $instance['exclude_cat_most']   = esc_attr( $new_instance['exclude_cat_most'] );
      $instance['exclude_cat_rand']   = esc_attr( $new_instance['exclude_cat_rand'] );
      $instance['show_recent_posts']  = $new_instance['show_recent_posts'];
      $instance['show_popular_posts'] = $new_instance['show_popular_posts'];
      $instance['show_most_played']   = $new_instance['show_most_played'];
      $instance['show_random_posts']  = $new_instance['show_random_posts'];
      //$instance['td_trim_title_tabs'] = $new_instance['td_trim_title_tabs'];

      return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
  $defaults = array(
    'exclude_cat'         => '',
    'exclude_cat_pop'     => '',
    'exclude_cat_most'    => '',
    'exclude_cat_rand'    => '',
    //'td_trim_title_tabs'  => '2',
    'show_popular_posts'  => 'on',
    'show_recent_posts'   => 'on',
    'show_most_played'    => 'on',
    'show_random_posts'   => 'on'
    );

  $instance = wp_parse_args((array) $instance, $defaults );
      ?>


<!-- START ADMIN WIDGETS AREA -->

<p>
  <input class="checkbox" type="checkbox" <?php checked( $instance['show_recent_posts'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_recent_posts' ); ?>" name="<?php echo $this->get_field_name( 'show_recent_posts' ); ?>" />
  <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>"><?php _e( 'Show Recent Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat'); ?>">Exclude categories from Recent Posts:</label>
  <input class="widefat" type="text"  id="<?php echo $this->get_field_id('exclude_cat'); ?>" name="<?php echo $this->get_field_name('exclude_cat'); ?>" value="<?php echo $instance['exclude_cat']; ?>" />
</p>


<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" />
  <label for="<?php echo $this->get_field_id('show_popular_posts'); ?>"><?php _e( 'Show Most Popular Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat_pop'); ?>">Exclude categories from Popular Posts:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('exclude_cat_pop'); ?>" name="<?php echo $this->get_field_name('exclude_cat_pop'); ?>" value="<?php echo $instance['exclude_cat_pop']; ?>" />
</p>


<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_most_played'], 'on'); ?> id="<?php echo $this->get_field_id('show_most_played'); ?>" name="<?php echo $this->get_field_name('show_most_played'); ?>" />
  <label for="<?php echo $this->get_field_id('show_most_played'); ?>"><?php _e( 'Show Most Viewed Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat_most'); ?>">Exclude categories from Most Viewed Posts:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('exclude_cat_most'); ?>" name="<?php echo $this->get_field_name('exclude_cat_most'); ?>" value="<?php echo $instance['exclude_cat_most']; ?>" />
</p>

<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_random_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_random_posts'); ?>" name="<?php echo $this->get_field_name('show_random_posts'); ?>" />
  <label for="<?php echo $this->get_field_id('show_random_posts'); ?>"><?php _e( 'Show Random Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat_rand'); ?>">Exclude categories from Random Posts:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('exclude_cat_rand'); ?>" name="<?php echo $this->get_field_name('exclude_cat_rand'); ?>" value="<?php echo $instance['exclude_cat_rand']; ?>" />
</p>
<p class="description">You can exclude certain categories by typing their IDs, separated by comma and no spaces. Example: 3,4,21,68,9,11</p>

<!-- END ADMIN WIDGETS AREA -->

        <?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Tabs_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_tabs_widget_init(){
    register_widget( 'Tigu_Tabs_Widget' );
}

add_action( 'widgets_init', 'tigu_tabs_widget_init' );

/*----------------------------------------------------------------------------------------------------------
    Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Minibanners extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'gameleon_minibanners',
__( '[G] Minibanners', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays 4 custom banners of 125x125, suitable for sidebar.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

        $title  = apply_filters( 'widget_title', $instance['title'] );
        $link1  = $instance['link1'];
        $image1 = $instance['image1'];
        $code1  = $instance['code1'];

        $link2  = $instance['link2'];
        $image2 = $instance['image2'];
        $code2  = $instance['code2'];

        $link3  = $instance['link3'];
        $image3 = $instance['image3'];
        $code3  = $instance['code3'];

        $link4  = $instance['link4'];
        $image4 = $instance['image4'];
        $code4  = $instance['code4'];

        $alt1   = $instance['alt1'];
        $alt2   = $instance['alt2'];
        $alt3   = $instance['alt3'];
        $alt4   = $instance['alt4'];

        echo $before_widget;

        ?>

        <?php if ( $title ) : ?>
        <div class="widget-title">
        <h3>
        <?php echo $title; ?>
        </h3>
        </div>
        <?php endif; ?>

        <div class="td-minibanners ">
        <?php
        if( $link1 || $image1 || $code1 ) {
        if( $image1 ) {
        ?>
            <div class="td-banner125"><a href="<?php echo $link1; ?>"><img src="<?php echo $image1; ?>" alt="<?php echo $alt1; ?>" /></a></div>
        <?php
        }
        else {
        ?>
            <div class="td-banner125"><?php echo stripslashes( $code1 ); ?></div>
        <?php }
        } ?>


        <?php
        if( $link2 || $image2 || $code2 ) {
        if( $image2 ) {
        ?>
            <div class="td-banner125 right"><a href="<?php echo $link2; ?>"><img src="<?php echo $image2; ?>" alt="<?php echo $alt2; ?>" /></a></div>
        <?php
        }
        else {
        ?>
            <div class="td-banner125 right"><?php echo stripslashes( $code2 ); ?></div>
        <?php }
        } ?>

        <?php
        if( $link3 || $image3 || $code3 ){
        if( $image3 ) {
        ?>
            <div class="td-banner125"><a href="<?php echo $link3; ?>"><img src="<?php echo $image3; ?>" alt="<?php echo $alt3; ?>" /></a></div>
        <?php
        }
        else {
        ?>
            <div class="td-banner125"><?php echo stripslashes( $code3 ); ?></div>
        <?php }
        } ?>

        <?php
        if( $link4 || $image4 || $code4 ){
        if( $image4 ) {
        ?>
            <div class="td-banner125 right"><a href="<?php echo $link4; ?>"><img src="<?php echo $image4; ?>" alt="<?php echo $alt4; ?>" /></a></div>
        <?php
        }
        else {
        ?>
            <div class="td-banner125 right"><?php echo stripslashes( $code4 ); ?></div>
        <?php }
        } ?>

        </div>

        <?php
        echo $after_widget;
    }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance                   = $old_instance;
    $instance['title']          = strip_tags( $new_instance['title'] );
    $instance['link1']          = $new_instance['link1'];
    $instance['image1']         = $new_instance['image1'];
    $instance['code1']          = $new_instance['code1'];

    $instance['link2']          = $new_instance['link2'];
    $instance['image2']         = $new_instance['image2'];
    $instance['code2']          = $new_instance['code2'];

    $instance['link3']          = $new_instance['link3'];
    $instance['image3']         = $new_instance['image3'];
    $instance['code3']          = $new_instance['code3'];

    $instance['link4']          = $new_instance['link4'];
    $instance['image4']         = $new_instance['image4'];
    $instance['code4']          = $new_instance['code4'];

    $instance['alt1']           = $new_instance['alt1'];
    $instance['alt2']           = $new_instance['alt2'];
    $instance['alt3']           = $new_instance['alt3'];
    $instance['alt4']           = $new_instance['alt4'];

    return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
        'title'     => 'Ads',
        'link1'     => '',
        'link2'     => '',
        'link3'     => '',
        'link4'     => '',
        'code1'     => '',
        'code2'     => '',
        'code3'     => '',
        'code4'     => '',
        'image1'    => '',
        'image2'    => '',
        'image3'    => '',
        'image4'    => '',
        'alt1'      => 'banner',
        'alt2'      => 'banner',
        'alt3'      => 'banner',
        'alt4'      => 'banner'
);
$instance = wp_parse_args( (array) $instance, $defaults );


/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<h3><?php _e( 'Banner ad 1', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'image1' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image1' ); ?>" name="<?php echo $this->get_field_name( 'image1' ); ?>" value="<?php echo $instance['image1']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt1' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt1' ); ?>" name="<?php echo $this->get_field_name( 'alt1' ); ?>" value="<?php echo $instance['alt1']; ?>" />
</p>
<p class="description"><?php _e( 'An imagine element must have an <em>alt</em> attribute, useful for markup validation.', 'gameleon' ); ?>.</p>


<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code1' ); ?>" name="<?php echo $this->get_field_name( 'code1' ); ?>"><?php echo $instance['code1']; ?></textarea>
</p>

<h3><?php _e( 'Banner ad 2', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>
<p>
<label for="<?php echo $this->get_field_id( 'image2' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text"  id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" value="<?php echo $instance['image2']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt2' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt2' ); ?>" name="<?php echo $this->get_field_name( 'alt2' ); ?>" value="<?php echo $instance['alt2']; ?>" />
</p>


<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code2' ); ?>" name="<?php echo $this->get_field_name( 'code2' ); ?>"><?php echo $instance['code2']; ?></textarea>
</p>

<h3><?php _e( 'Banner ad 3', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>
<p>
<label for="<?php echo $this->get_field_id( 'image3' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image3' ); ?>" name="<?php echo $this->get_field_name( 'image3' ); ?>" value="<?php echo $instance['image3']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt3' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt3' ); ?>" name="<?php echo $this->get_field_name( 'alt3' ); ?>" value="<?php echo $instance['alt3']; ?>" />
</p>

<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code3' ); ?>" name="<?php echo $this->get_field_name( 'code3' ); ?>"><?php echo $instance['code3']; ?></textarea>
</p>

<h3><?php _e( 'Banner ad 4', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>
<p>
<label for="<?php echo $this->get_field_id( 'image4' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image4' ); ?>" name="<?php echo $this->get_field_name( 'image4' ); ?>" value="<?php echo $instance['image4']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'alt4' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt4' ); ?>" name="<?php echo $this->get_field_name( 'alt4' ); ?>" value="<?php echo $instance['alt4']; ?>" />
</p>

<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code4' ); ?>" name="<?php echo $this->get_field_name( 'code4' ); ?>"><?php echo $instance['code4']; ?></textarea>
</p>


<?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Minibanners widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_minibanners_init(){
register_widget( 'Gameleon_Minibanners' );
}

add_action( 'widgets_init', 'gameleon_minibanners_init' );

/*----------------------------------------------------------------------------------------------------------
  Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Tag_Cloud extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
  parent::__construct(
    'gameleon_tag_cloud',
            __( '[G] Tag Cloud', 'gameleon' ), // Widget Name
            array( 'description' => __( 'A SEO optimized cloud of your most popular tags.', 'gameleon' ), ) // Widget Args
            );
}


/*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
    extract( $args );
    $title          = apply_filters( 'widget_title', $instance['title'] );
    $tags_count     = $instance['td_tags_number'];
    $tags_taxonomy  = $instance['td_taxonomy'];

    $td_tag_colored = ! empty( $instance['td_tag_colored'] ) ? '1' : '0';
    $td_tag_display = ! empty( $instance['td_tag_display'] ) ? '1' : '0';

    if ( $td_tag_colored ) {
            $td_colored_tag = 'td-tag-colored';
        }
        else {
            $td_colored_tag = '';
        }
        if ( $td_tag_display ) {
            $td_tag_inline = 'td-tag-cloud-full-length';
        }
        else {
            $td_tag_inline = 'td-tag-cloud-inline';
        }

        echo $before_widget;
        if ( $instance['title'] ) {
            echo $before_title . $title . $after_title;
        }
        ?>

    <div class="td-tag-cloud-widget <?php echo $td_colored_tag; ?> <?php echo $td_tag_inline; ?>">
        <?php
        $tags = wp_tag_cloud( array(
            'number'                    => $tags_count,
            'taxonomy'                  => $tags_taxonomy,
            'orderby'                   => 'count',
            'order'                     => 'RAND',
            'topic_count_text_callback' => 'gameleon_change_tag_cloud_tooltip',
            ) );

        echo $tags;
        ?>

    </div>

    <?php
    echo $after_widget;

    }


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['td_tags_number'] = esc_attr( $new_instance['td_tags_number'] );
        $instance['td_tag_colored'] = !empty($new_instance['td_tag_colored']) ? 1 : 0;
        $instance['td_tag_display'] = !empty($new_instance['td_tag_display']) ? 1 : 0;
        $instance['td_taxonomy']    = esc_attr( $new_instance['td_taxonomy'] );
        return $instance;
    }


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Tag Cloud', 'gameleon' );
        }

        if ( isset( $instance[ 'td_tags_number' ] ) ) {
            $tags_count = $instance[ 'td_tags_number' ];
        }
        else {
            $tags_count = 8;
        }
        if ( isset( $instance[ 'td_taxonomy' ] ) ) {
            $tags_taxonomy = $instance[ 'td_taxonomy' ];
        }
        else {
            $tags_taxonomy = 'post_tag';
        }
        $td_tag_colored = isset( $instance['td_tag_colored'] ) ? (bool) $instance['td_tag_colored'] : false;
        $td_tag_display = isset( $instance['td_tag_display'] ) ? (bool) $instance['td_tag_display'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'td_tags_number' ); ?>"><?php _e( 'Number of Tags to show:', 'gameleon' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'td_tags_number' ); ?>" name="<?php echo $this->get_field_name( 'td_tags_number' ); ?>" type="text" value="<?php echo esc_attr( $tags_count ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'td_taxonomy' ); ?>"><?php _e( 'Taxonomy:', 'gameleon' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'td_taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'td_taxonomy' ); ?>" class="widefat">
            <option value="post_tag"<?php if( $tags_taxonomy == "post_tag" ) echo ' selected="selected"';?>><?php _e( 'Tags', 'gameleon' );?></option>
            <option value="category"<?php if( $tags_taxonomy == "category" ) echo ' selected="selected"';?>><?php _e( 'Categories', 'gameleon' );?></option>
          </select>
        </p>

        <p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('td_tag_colored'); ?>" name="<?php echo $this->get_field_name('td_tag_colored'); ?>"<?php checked( $td_tag_colored ); ?> />
        <label for="<?php echo $this->get_field_id('td_tag_colored'); ?>"><?php _e( 'Colored Tags', 'gameleon' ); ?></label>
        </p>


        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('td_tag_display'); ?>" name="<?php echo $this->get_field_name('td_tag_display'); ?>"<?php checked( $td_tag_display ); ?> />
        <label for="<?php echo $this->get_field_id('td_tag_display'); ?>"><?php _e( 'Display tags one per line', 'gameleon' ); ?></label>
        </p>

        <?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Tag_Cloud widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_tag_cloud_init(){
    register_widget( 'Gameleon_Tag_Cloud' );
}

add_action( 'widgets_init', 'gameleon_tag_cloud_init' );


/*----------------------------------------------------------------------------------------------------------
  Gameleon_Home_Slider widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Home_Slider extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_home_slider', // Base Widget ID
      __( '[G] Home Slider', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that displays a slider showing small image posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
      );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                   = apply_filters( 'widget_title', $instance['title'] );
$orderby               = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$post_type               = 'all';
$posts                         = $instance['posts'];
$categories                  = $instance['categories'];

echo $before_widget;
?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>


<?php // =============================== MAIN BLOCK =============================== ?>

<?php if ( $title ) : ?>
<div class="widget-title">
<h3>
  <?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>
<?php endif; ?>


<?php
// ----------- SLIDER CONTENT
// ---------------------------------------------------------------------------
?>

<div id="owl-home" class="owl-carousel owl-theme-2">

<?php
// ----------- QUERY
// ---------------------------------------------------------------------------
?>

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
<div class="td-fly-in" >
<div class="td-small-module">


<?php get_template_part( 'post-img-owl-home' ); ?>


</div><?php // end of .td-small-module ?>
</div><?php // end of .td-fly-in ?>
<?php endwhile; ?>
</div><?php // end of #owl-home ?>


<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                                     = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['post_type']              = 'all';
$instance['posts']                  = $new_instance['posts'];
$instance['categories']             = $new_instance['categories'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'orderby'             => 'date',
'bigexcerpt'                => '20',
'post_type'             => 'all',
'posts'                       => 10,
'categories'                => 'all'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Slider Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to slide (min.8) :', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>"  class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Home_Slider widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_home_slider_init(){
register_widget( 'Gameleon_Home_Slider' );
}

add_action( 'widgets_init', 'gameleon_home_slider_init' );

/*----------------------------------------------------------------------------------------------------------
  Gameleon_Post_Slider widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Post_Slider extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_post_slider', // Base Widget ID
      __( '[G] Sidebar Slider', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that displays a slider showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
      );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                   = apply_filters( 'widget_title', $instance['title'] );
$orderby               = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$post_type               = 'all';
$posts                         = $instance['posts'];
$categories                  = $instance['categories'];
$show_date               = ! empty( $instance['show_date'] ) ? '1' : '0';

echo $before_widget;
?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>


<?php // =============================== MAIN BLOCK =============================== ?>

<?php if ( $title ) : ?>
<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>
<?php endif; ?>

<div class="td-wrap-content-sidebar">


<?php
// ----------- SLIDER CONTENT
// ---------------------------------------------------------------------------
?>

<div id="owl-sidebar" class="owl-carousel owl-theme">

<?php
// ----------- QUERY
// ---------------------------------------------------------------------------
?>

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
<div class="td-fly-in" >
<div class="td-small-module">


<?php get_template_part( 'post-img-owl' ); ?>

<div class="td-owl-title">

<?php if( $show_date ): ?>
<div class="td-owl-date">
<div class="block-meta">
<?php the_time('F j, Y') ?>
</div>
</div>
<?php endif; ?>
<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
  <?php echo get_the_title(); ?>
</a>
</h2>
</div>

</div><?php // end of .td-small-module ?>
</div><?php // end of .td-fly-in ?>
<?php endwhile; ?>
</div><?php // end of #owl-sidebar ?>



</div><?php // end of td-wrap-content-sidebar ?>


<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                                     = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['post_type']              = 'all';
$instance['posts']                  = $new_instance['posts'];
$instance['categories']             = $new_instance['categories'];
$instance['show_date']                = $new_instance['show_date'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'orderby'             => 'date',
'bigexcerpt'                => '20',
'post_type'             => 'all',
'posts'                       => 4,
'categories'                => 'all',
'show_date'               => 'on'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Slider Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to slide:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>"  class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show Date', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Post_Slider widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_post_slider_init(){
register_widget( 'Gameleon_Post_Slider' );
}

add_action( 'widgets_init', 'gameleon_post_slider_init' );

/*----------------------------------------------------------------------------------------------------------
  Gameleon_Ads_Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Ads_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
  'gameleon_ads_widget', // Base Widget ID
  __( '[G] Responsive Ads', 'gameleon' ), // Widget Name
  array( 'description' => __( 'A widget that displays a responsive Ad on Home Page or Sidebar.', 'gameleon' ), ) // Widget Args
  );
}


/*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {

  $td_ad_slot = $instance['td_ad_slot'];

  switch( $td_ad_slot ) {

    case 'sidebar':
    $td_adslot = get_theme_mod( 'gameleon_sidebar_ad' );
    break;

    case 'custom_ad_1':
    $td_adslot = get_theme_mod( 'gameleon_custom_ad_1' );
    break;

    case 'custom_ad_2':
    $td_adslot = get_theme_mod( 'gameleon_custom_ad_2' );
    break;

    case 'custom_ad_3':
    $td_adslot = get_theme_mod( 'gameleon_custom_ad_3' );
    break;

    default:
    $td_adslot = '';
  }



  $buffer = '';
  $buffer .= do_shortcode( stripslashes( $td_adslot ) );

  if( $td_adslot ) {

    echo $args['before_widget'];
    echo '<div class="sidebar-ad">'. $buffer .'</div>';
    echo $args['after_widget'];

  } else {

    return;
  }

}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
  if( $instance) {
    $td_ad_slot = esc_attr( $instance['td_ad_slot'] );
  } else {
    $td_ad_slot = '';
  }
  ?>

  <p>
    <label for="<?php echo $this->get_field_id( 'td_ad_slot' ); ?>"><?php _e( 'Select the ad slot you want to display:', 'gameleon' ); ?></label>
    <select id="<?php echo $this->get_field_id( 'td_ad_slot' ); ?>" name="<?php echo $this->get_field_name( 'td_ad_slot' ); ?>" class="widefat">
      <option value="sidebar"<?php if( $td_ad_slot=="sidebar" ) echo ' selected="selected"';?>><?php _e( 'Responsive Sidebar Ad', 'gameleon' );?></option>
      <option value="custom_ad_1"<?php if( $td_ad_slot=="custom_ad_1" ) echo ' selected="selected"';?>><?php _e( 'Responsive Custom Ad 1', 'gameleon' );?></option>
      <option value="custom_ad_2"<?php if( $td_ad_slot=="custom_ad_2" ) echo ' selected="selected"';?>><?php _e( 'Responsive Custom Ad 2', 'gameleon' );?></option>
      <option value="custom_ad_3"<?php if( $td_ad_slot=="custom_ad_3" ) echo ' selected="selected"';?>><?php _e( 'Responsive Custom Ad 3', 'gameleon' );?></option>
    </select>
  </p>

  <?php
}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
  $instance = array();

  $instance['td_ad_slot'] = strip_tags($new_instance['td_ad_slot']);
  return $instance;
}

} // end Gameleon_Ads_Widget class


/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Ads_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function register_gameleon_ads_widget() {
  register_widget( 'Gameleon_Ads_Widget' );
}

add_action( 'widgets_init', 'register_gameleon_ads_widget' );


/*----------------------------------------------------------------------------------------------------------
SEO Block Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Seo_Block extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
    parent::__construct(
        'gameleon_seo_block',
        __( '[G] SEO Text Block', 'gameleon' ),  // Widget Name
        array( 'description' => __( 'Display a SEO text block on your home page or sidebar', 'gameleon' ), ) // Widget Args
        );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
    extract( $args );

    $title  = apply_filters( 'widget_title', $instance['title'] );
    $code   = $instance['code'];

    echo $before_widget;

    ?>

    <?php if ( $title ) : // widget title ?>
    <div class="widget-title">
    <h3>
    <?php echo $title; ?>
    </h3>
    </div>
    <?php endif; ?>


    <div class="td-fly-in">
    <div id="td-seo-block" class="seo-block">
    <p>
    <?php echo stripslashes($code); ?>
    </p>
    </div>
    </div>


    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance                   = $old_instance;
    $instance['title']          = strip_tags( $new_instance['title'] );
    $instance['code']       = $new_instance['code'];

    return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
    $defaults = array(
        'title'     => 'Seo Block',
        'code'  => ''
        );

    $instance = wp_parse_args( (array) $instance, $defaults );


/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('code'); ?>"><?php _e( 'SEO Text:', 'gameleon' ); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>"><?php echo $instance['code']; ?></textarea>
</p>


<?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Seo_Block widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_seo_block_init(){
    register_widget( 'Gameleon_Seo_Block' );
}

add_action( 'widgets_init', 'gameleon_seo_block_init' );









/*----------------------------------------------------------------------------------------------------------
FANTASY Title Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Fantasy_Title extends WP_Widget {


  /*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
  -----------------------------------------------------------------------------------------------------------*/
  
  public function __construct() {
      parent::__construct(
          'gameleon_fantasy_title',
          __( '[G] Fantasy Title', 'gameleon' ),  // Widget Name
          array( 'description' => __( 'Centered title for Fantasy Demo', 'gameleon' ), ) // Widget Args
          );
  }
  
  
  /*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
  -----------------------------------------------------------------------------------------------------------*/
  
  public function widget( $args, $instance ) {
      extract( $args );
  
      $sub_title      = $instance['sub_title'];
      $title          = apply_filters( 'widget_title', $instance['title'] );
      $fantasy_text   = $instance['fantasy_text'];
  
      echo $before_widget;
  
      ?>
  
<!-- Subtitle -->
    <div class="fantasy-title-wrap">
    <?php if ( $sub_title ) : // widget title ?>
      <div class="fantasy-sub-title">
      <h5>
      <?php echo $sub_title; ?>
      </h5>
      </div>
      <?php endif; ?>

<!-- Title -->
      <?php if ( $title ) : // widget title ?>
      <div class="fantasy-title">
      <h2>
      <?php echo $title; ?>
      </h2>
      </div>
      <?php endif; ?>
  
<!-- Text -->
      <div class="td-fly-in">
      <div class="fantasy-text">
      <h5>
      <?php echo stripslashes($fantasy_text); ?>
      </h5>
      </div>
      </div>

      </div>
  
      <?php
      echo $after_widget;
   }
  
  /*----------------------------------------------------------------------------------------------------------
    Sanitize widget form values as they are saved
  -----------------------------------------------------------------------------------------------------------*/
  
  public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance                     = $old_instance;
      $instance['title']            = strip_tags( $new_instance['title'] );
      $instance['sub_title']        = strip_tags( $new_instance['sub_title'] );
      $instance['fantasy_text']     = $new_instance['fantasy_text'];
  
      return $instance;
  }
  
  /*----------------------------------------------------------------------------------------------------------
    Back-end widget form
  -----------------------------------------------------------------------------------------------------------*/
  
  public function form( $instance ) {
      $defaults = array(
          'title'     => '',
          'sub_title'     => '',
          'fantasy_text'  => ''
          );
  
      $instance = wp_parse_args( (array) $instance, $defaults );
  
  
  /*----------------------------------------------------------------------------------------------------------
    Widget Options
  -----------------------------------------------------------------------------------------------------------*/
  ?>
  
  <p>
  <label for="<?php echo $this->get_field_id( 'sub_title' ); ?>"><?php _e( 'Sub Title:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'sub_title' ); ?>" name="<?php echo $this->get_field_name( 'sub_title' ); ?>" value="<?php echo $instance['sub_title']; ?>" />
  </p>
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
  </p>
  
  <p>
  <label for="<?php echo $this->get_field_id('fantasy_text'); ?>"><?php _e( 'Fantasy Text', 'gameleon' ); ?></label>
  <textarea class="widefat" id="<?php echo $this->get_field_id('fantasy_text'); ?>" name="<?php echo $this->get_field_name('fantasy_text'); ?>"><?php echo $instance['fantasy_text']; ?></textarea>
  </p>
  
  
  <?php
      }
  
  }
  
  /*----------------------------------------------------------------------------------------------------------
    Register Gameleon_Fantasy_Title widget
  -----------------------------------------------------------------------------------------------------------*/
  
  function gameleon_fantasy_title_init(){
      register_widget( 'Gameleon_Fantasy_Title' );
  }
  
  add_action( 'widgets_init', 'gameleon_fantasy_title_init' );
  
  

/*----------------------------------------------------------------------------------------------------------
Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Sidebar_Module_1 extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'tigu_sidebar_module_1',
__( '[G] Sidebar Block 1', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays a block showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                  = apply_filters( 'widget_title', $instance['title'] );
$orderby                = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$readmore               = $instance['readmore'];
$bigexcerpt             = $instance['bigexcerpt'];
$post_type              = 'all';
$posts                  = $instance['posts'];
$categories             = $instance['categories'];
$show_post_meta         = ! empty( $instance['show_post_meta'] ) ? '1' : '0';
$show_footer_box        = ! empty( $instance['show_footer_box'] ) ? '1' : '0';

echo $before_widget;
?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>

<?php // =============================== MAIN BLOCK =============================== ?>

<?php if ( $title ) : ?>
<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>
<?php endif; ?>

<div class="td-wrap-content-sidebar">

<?php
// ----------- QUERY
// ---------------------------------------------------------------------------
?>

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php $counter = 1; ?>
<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>

<?php if( $counter == 1 ): ?>

<div class="td-fly-in">

<?php
// ----------- big featured image
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>

<?php
// ----------- big image title
// ---------------------------------------------------------------------------
?>

<h2 class="td-big-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php
// ----------- big date and comments
// ---------------------------------------------------------------------------
?>

<?php if( $show_post_meta == 1 ): ?>
<?php get_template_part( 'post-meta-small' ); // date and comments ?>
<?php endif; ?>

<?php
// ----------- big excerpt
// ---------------------------------------------------------------------------
?>

<?php if ( $bigexcerpt ) { ?>
<p>
<?php echo td_global_excerpt( $bigexcerpt ); ?>
</p>
<?php } ?>

</div><?php // end of td-fly-in ?>

<?php else: // elseif( $counter !== 1 ?>

<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<div class="td-small-module">
<div class="td-fly-in" >

<div class="show-tha-border"></div>

<div class="td-post-details"><?php // td-post-details ?>

<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'post-img' ); ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>

<?php if( $show_post_meta == 1 ): ?>
  <div class="block-meta"><?php // block-meta ?>

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
<?php endif; ?>

</div><?php // end of td-post-details ?>
<div class="clearfix"></div>

</div><?php // end of .td-fly-in ?>
</div><?php // end of .td-small-module ?>

<?php endif; // end of if counter = 1 ?>

<?php $counter++; endwhile; ?>

</div><?php // end of td-wrap-content-sidebar ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts->found_posts; ?>
</div>

<?php if ( 'all' !== $instance['categories']):?>  
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="moregames-link">
<?php echo $readmore; ?><i class="fas fa-angle-right"></i>
</div>
</a>
<?php endif; ?>

</div><?php // end of moregames ?>

<?php endif; ?>

<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                           = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['readmore']               = $new_instance['readmore'];
$instance['bigexcerpt']             = $new_instance['bigexcerpt'];
$instance['post_type']              = 'all';
$instance['posts']                  = $new_instance['posts'];
$instance['categories']             = $new_instance['categories'];
$instance['show_post_meta']         = $new_instance['show_post_meta'];
$instance['show_footer_box']        = $new_instance['show_footer_box'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'orderby'               => 'date',
'readmore'              => 'Read More',
'bigexcerpt'            => '20',
'post_type'             => 'all',
'posts'                 => 3,
'categories'            => 'all',
'show_post_meta'        => 'on',
'show_footer_box'       => 'on'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>"><?php _e( 'Excerpt length in words of the first post. Leave empty for no excerpt.', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'bigexcerpt' ); ?>" value="<?php echo $instance['bigexcerpt']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>


<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Sidebar_Module_1 widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_sidebar_module_1_init(){
register_widget( 'Tigu_Sidebar_Module_1' );
}

add_action( 'widgets_init', 'tigu_sidebar_module_1_init' );

/*----------------------------------------------------------------------------------------------------------
  Gameleon_Vertical_Scroller widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Vertical_Scroller extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_vertical_scroller', // Base Widget ID
      __( '[G] Carousel Post', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that displays posts in a vertical ticker, ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
      );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title                   = apply_filters( 'widget_title', $instance['title'] );
$orderby               = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$readmore              = $instance['readmore'];
$post_type               = 'all';
$posts                         = $instance['posts'];
$categories                  = $instance['categories'];
$disable_thumb             = ! empty( $instance['disable_thumb'] ) ? '1' : '0';
$show_footer_box           = ! empty( $instance['show_footer_box'] ) ? '1' : '0';

echo $before_widget;
?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>


<?php // =============================== MAIN BLOCK =============================== ?>

<div class="widget-title">
<h3>
<?php if ( 'all' !== $instance['categories']):?>
  <a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>
  <?php else: ?>
  <?php echo $title; ?>
  <?php endif; ?>
</h3>
</div>

<div class="td-wrap-content-sidebar">


<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<ul id="vertical-ticker">
    <div class="td-fly-in" >
<?php
// ----------- QUERY
// ---------------------------------------------------------------------------
?>

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>


<li>
<div class="td-small-module">

<div class="td-post-details"><?php // td-post-details ?>

<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php if( $disable_thumb == 0 ): ?>
<?php get_template_part( 'post-img' ); ?>
<?php endif; ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
    <?php echo get_the_title(); ?>
</a>
</h2>
<div class="block-meta"><?php // block-meta ?>
<div class="scroller-pad">
<span class="td-post-date">
<?php the_time('M j, Y'); ?>
</span>
</div>
<?php if ( defined( 'MYARCADE_VERSION') and is_game() ): ?>
<span class="td-plays">
<?php echo gameleon_post_views(); ?>
</span>

<?php else: ?>

<span class="td-views">
<?php echo gameleon_post_views(); ?>
</span>

<?php endif; ?>

</div>

</div><?php // end of td-post-details ?>


<div class="clearfix"></div>


</div><?php // end of .td-small-module ?>
<div class="clearfix"></div>
</li>
<?php endwhile; ?>
</div><?php // end of .td-fly-in ?>
</ul>

</div><?php // end of td-wrap-content-sidebar ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts->found_posts; ?>
</div>

<?php if ( 'all' !== $instance['categories']):?>
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="moregames-link">
<?php echo $readmore; ?><i class="fas fa-angle-right"></i>
</div>
</a>
<?php endif; ?>
</div><?php // end of moregames ?>

<?php endif; ?>

<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance                                     = $old_instance;
$instance['title']                  = strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['readmore']               = $new_instance['readmore'];
$instance['post_type']              = 'all';
$instance['posts']                  = $new_instance['posts'];
$instance['categories']             = $new_instance['categories'];
$instance['disable_thumb']            = $new_instance['disable_thumb'];
$instance['show_footer_box']        = $new_instance['show_footer_box'];
$instance['show_statistics']        = $new_instance['show_statistics'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'                 => 'Recent Posts',
'readmore'          => 'Read More',
'orderby'             => 'date',
'post_type'             => 'all',
'posts'                       => 4,
'categories'                => 'all',
'disable_thumb'           => 'off',
'show_footer_box'       => 'on',
'show_statistics'       => 'on'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Carousel Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to scroll:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>"  class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>



<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['disable_thumb'], 'on' ); ?> id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name( 'disable_thumb' ); ?>" />
<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail', 'gameleon' ); ?></label>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Vertical_Scroller widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_vertical_scroller_init(){
register_widget( 'Gameleon_Vertical_Scroller' );
}

add_action( 'widgets_init', 'gameleon_vertical_scroller_init' );

/*----------------------------------------------------------------------------------------------------------
  Gameleon_Video_Widget widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Video_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_video_widget', // Base Widget ID
      __( '[G] Video Module', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that plays responsive videos from any video provider allowed by WordPress.', 'gameleon' ), ) // Widget Args
      );
}



/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
  extract( $args );

  $title              = apply_filters( 'widget_title', $instance['title'] );
  $embed_url          = $instance['embed_url'];
  $post_url           = $instance['post_url'];
  $embed_width        = $instance['embed_width'];
  $embed_description  = $instance['embed_description'];

  echo $before_widget;

  ?>

  <?php if ( $title ) : // widget title ?>
  <div class="widget-title">
  <h3>
  <?php echo $title; ?>
  </h3>
  </div>
  <?php endif; ?>

  <div class="td-video-wrapp">
    <div class="td-fly-in">

      <?php

        $buffer = '';
        $buffer_post_url = '';

        if( !empty( $post_url ) ) {  // Check if post URL is entered
        $buffer_post_url .= '<a href="' . $post_url . '">';
        $buffer_post_url .= $embed_description;
        $buffer_post_url .= '</a>';
        } else {
        $buffer_post_url .= $embed_description;
        }

        if( !empty( $embed_url ) ) { // Check if embed URL is entered
        $buffer.= '<div class="td-widget-video">';
        if( !empty( $embed_width ) && $embed_width > 0 ) { // Check if user entered embed width
        $buffer.= wp_oembed_get( $embed_url, array( 'width' => $embed_width ) );
        } else {
        $buffer.= wp_oembed_get( $embed_url );
        }

        $buffer.= '</div>';
        } // end if embed URL

        if( !empty( $embed_description ) ) {   // Check if embed description is entered
        $buffer.= '<div class="td-embed-description">';
        $buffer.= '<h4 class="video-post-title">';
        $buffer.= '<span><i class="fab fa-youtube"></i></span>';
        $buffer.= $buffer_post_url;
        $buffer.= '</h4>';
        $buffer.= '</div>';
        }

        echo $buffer;

      ?>

    </div>
  </div>

    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                       = $old_instance;
  $instance['title']              = strip_tags( $new_instance['title'] );
  $instance['embed_url']          = $new_instance['embed_url'];
  $instance['post_url']           = $new_instance['post_url'];
  $instance['embed_width']        = $new_instance['embed_width'];
  $instance['embed_description']  = $new_instance['embed_description'];

  return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
  $defaults = array(
    'title'             => 'Video of the day',
    'embed_url'         => '',
    'post_url'          => '',
    'embed_width'       => '300',
    'embed_description' => ''
    );

  $instance = wp_parse_args( (array) $instance, $defaults );


/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'embed_url' ); ?>"><?php _e( 'Video URL:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'embed_url' ); ?>" name="<?php echo $this->get_field_name( 'embed_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['embed_url'] ) ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'embed_width' ); ?>"><?php _e( 'Video width (optional):', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'embed_width' ); ?>" name="<?php echo $this->get_field_name( 'embed_width' ); ?>" type="text" value="<?php echo esc_attr( $instance['embed_width'] ) ?>"/>
</p>
<p class="description"><?php _e( 'Suitable widths are 300 for sidebar and 700 for Homepage.', 'gameleon' ); ?></p>
<p>
<label for="<?php echo $this->get_field_id( 'embed_description' ); ?>"><?php _e( 'Video Description:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'embed_description' ); ?>" name="<?php echo $this->get_field_name( 'embed_description' ); ?>" type="text" value="<?php echo esc_attr( $instance['embed_description'] ) ?>"/>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'post_url' ); ?>"><?php _e( 'Article URL:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'post_url' ); ?>" name="<?php echo $this->get_field_name( 'post_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['post_url'] ) ?>" />
</p>
<p class="description"><?php _e( 'Enter a post URL for video description.', 'gameleon' ); ?></p>

<?php
  }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Video_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_video_widget_init(){
  register_widget( 'Gameleon_Video_Widget' );
}

add_action( 'widgets_init', 'gameleon_video_widget_init' );

}