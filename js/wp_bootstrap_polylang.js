/*
*
*   Polylang Create Bootstrap Dropdown - WordPress
*   Github: https://github.com/icetee/wp-bootstrap-polylang
*
*   I used (Fork):
*   https://gist.github.com/icetee/5f44c321de44b13b903e
*
*   @since 1.2
*
*/

(function wp_bootstrap_polylang($) {
        
    var $lang = $('html').attr('lang');
    var $navbar = $('.navbar-nav');
    var $navitem = 'li.lang-item';
    var pageId = pllVars.postID;
    var $changelang = "";
    var lang = {};
    
    console.log($navitem);

    if ( !$navbar.find($navitem).hasClass( "pll-lang" ) ) {

        $lang = $lang.split('-')[0];

        $navbar.find($navitem).find('a').each(function() {
            lang[ $(this).attr('hreflang') ] = $( this ).attr('title');
        });

        $changelang += '<li class="menu-item lang-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown pll-lang">';
        $changelang += '<a aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" title="' + lang[$lang] + '">';
        $changelang += lang[$lang];
        $changelang += ' <span class="caret"></span></a>';
        $changelang += '<ul class="dropdown-menu" role="menu">';

        $.each( lang, function( key, value ) {
            $changelang += '<li class="lang-item"><a target="_self" href="//' + window.location.host + '/' + key + '/' + pageId[key] + '" title="' + value + '">' + value + '</a></li>';
        });

        $changelang += '</ul></li>';

        $navbar.find($navitem).remove();
        $navbar.append($changelang);
    }

})(jQuery);