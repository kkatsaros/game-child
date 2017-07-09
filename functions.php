<?php
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function rand_posts() { 

$args = array(
	'post_type' => 'post',
	'orderby'	=> 'rand',
	'posts_per_page' => 5, 
	);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {

$string .= '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$string .= '<li><a href="'. get_permalink() .'">'. get_the_title() .'</a></li>';
	}
	$string .= '</ul>';
	/* Restore original Post Data */
	wp_reset_postdata();
} else {

$string .= 'no posts found';
}

return $string; 
} 

add_shortcode('random-posts','rand_posts');
add_filter('widget_text', 'do_shortcode'); 
?>

