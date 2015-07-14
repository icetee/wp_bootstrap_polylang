<?php
/*
*
*   Polylang Create Bootstrap Dropdown - WordPress
*   Github: https://github.com/icetee/wp-bootstrap-polylang
*
*   @since 1.2.3
*
*/

function wp_bootstrap_polylang() {
    
    if ( function_exists('pll_languages_list') ) {
        
        global $wp_query;
        $postID = $wp_query->post->ID;
        $postType = get_post_type($postID);
        $lang_list = array();
        
        $postTypes = array("page", "post");
        
        foreach ( pll_languages_list() as $code) {
            if ( !is_front_page() ) {
                if ( in_array($postType, $postTypes) ) {
                    if ( !is_tag() ) {
                        $lang_list[$code] = get_post(pll_get_post($postID, $code))->post_name;
                    } else {
                        //PHP <5.6 fix
                        $term_lang = pll_set_term_language($postID, $code);
                        $get_tags = get_the_tags($term_lang);
                        $term_id = pll_get_term($get_tags[1]->term_id, $code);
                        
                        $lang_list[$code] = "tag/" . get_term_by('id', $term_id, 'post_tag')->slug;
                    }
                    
                } else {
                    $lang_list[$code] = $postType . '/' . get_post(pll_get_post($postID, $code))->post_name;
                }
            } else {
                $lang_list[$code] = "";
            }
        }

        wp_enqueue_script('pll_nav', get_template_directory_uri() . '/js/wp_bootstrap_polylang.js', array(), '1.2.1', true);
        wp_localize_script('pll_nav', 'pllVars', array(
                'postID' => $lang_list
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'wp_bootstrap_polylang');

?>