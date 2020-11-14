$(function () {
    skinChanger();
    CustomScrollbar();    
});

//Skin changer
function skinChanger() {
    $('.right-sidebar .choose-skin li').on('click', function () {
        var $body = $('body');
        var $this = $(this);

        var existTheme = $('.right-sidebar .choose-skin li.active').data('theme');
        $('.right-sidebar .choose-skin li').removeClass('active');
        $body.removeClass('theme-' + existTheme);
        $this.addClass('active');

        $body.addClass('theme-' + $this.data('theme'));
    });
}
//Activate notification and task dropdown on top right menu
function CustomScrollbar() {
    $('.sidebar .menu .list').slimscroll({
        height:'calc(100vh - 80px)',
        color: 'rgba(0,0,0,0.2)',
        size: '3px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });
    
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.2)',
        size: '3px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });
    $('.chat-widget').slimscroll({
        height: '300px',
        color: 'rgba(0,0,0,0.4)',
        size: '2px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '2px'
    });

    $('.right-sidebar .slim_scroll').slimscroll({
        height: 'calc(100vh - 55px)',
        color: 'rgba(0,0,0,0.4)',
        size: '2px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });	

    $('.chat-app .people-list .chat-list').slimscroll({
        height: 'calc(100vh - 107px)',
        color: 'rgba(0,0,0,0.4)',
        size: '2px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });	
}

