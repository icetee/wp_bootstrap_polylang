function pll_change_language_nav() {
    
    if ( function_exists('pll_languages_list') ) {
        
        global $wp_query;
        $postID = $wp_query->post->ID;
        $lang_list = array();
        
        foreach ( pll_languages_list() as $code) {
            $lang_list[$code] = get_post(pll_get_post($postID, $code))->post_name;
        }

        wp_enqueue_script('pll_nav', plugin_dir_url( __FILE__ ) . 'js/pll_change_language_nav.js');
        wp_localize_script('pll_nav', 'pllVars', array(
                'postID' => $lang_list
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'pll_change_language_nav');