(function pll_change_language_nav() {
        
    var $lang = $('html').attr('lang');
    var $navbar = $('.navbar-nav');
    var $navitem = 'li.lang-item';
    var pageId = pllVars.postID;
    var $changelang = "";
    var lang = {};

    if ( !$navbar.find($navitem).hasClass( "pll-lang" ) ) {

        $lang = $lang.split('-')[0];

        $navbar.find($navitem).find('a').each(function() {
            lang[ $(this).attr('hreflang') ] = $( this ).attr('title');
        });

        $changelang += '<li class="menu-item lang-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown pll-lang">';
        $changelang += '<a aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" title="'+ lang[$lang] +'">';
        $changelang += lang[$lang];
        $changelang += ' <span class="caret"></span></a>';
        $changelang += '<ul class="dropdown-menu" role="menu">';

        $.each( lang, function( key, value ) {
            $changelang += '<li class="lang-item"><a target="_self" href="//'+ window.location.host +'/'+ key +'/'+ pageId[key] +'" title="'+ value +'">'+ value +'</a></li>';
        });

        $changelang += '</ul></li>';

        $navbar.find($navitem).remove();
        $navbar.append($changelang);
    }
    
})(jQuery);