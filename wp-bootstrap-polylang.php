<?php
/*
*
*   Polylang Create Bootstrap Dropdown - WordPress
*   Github: https://github.com/icetee/wp-bootstrap-polylang
*
*   @since 1.1
*
*/

function wp-bootstrap-polylang() {
    
    if ( function_exists('pll_languages_list') ) {
        
        global $wp_query;
        $postID = $wp_query->post->ID;
        $postType = get_post_type($postID);
        $lang_list = array();
        
        $postTypes = array("page", "post");
        
        foreach ( pll_languages_list() as $code) {
            
            if ( in_array($postType, $postTypes) ) {
                $lang_list[$code] = get_post(pll_get_post($postID, $code))->post_name;
            } else {
                $lang_list[$code] = $postType . '/' . get_post(pll_get_post($postID, $code))->post_name;
            }
        }
        
        wp_enqueue_script('pll_nav', plugin_dir_url( __FILE__ ) . 'js/wp-bootstrap-polylang.js');
        wp_localize_script('pll_nav', 'pllVars', array(
                'postID' => $lang_list
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'wp-bootstrap-polylang');
?>