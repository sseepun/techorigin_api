var menuContainer = $('#menu-container');
var menu = [
    {
        name: 'Installation',
        children: [
            { name: 'Server Requirements' },
            { name: 'Environment Setup' },
            { name: 'Installing' },
            { name: 'Postman' },
        ]
    },
    {
        name: 'Authentication API',
        children: [
            { name: 'Sign In' },
            { name: 'Sign Up' },
            { name: 'Forget Password' },
            { name: 'Reset Password Exists' },
            { name: 'Reset Password' },
            { name: 'Traffic Create' },
            { name: 'Sign In with Facebook Account' },
            { name: 'Sign In with Google Account' },
        ]
    },
    {
        name: 'User API',
        children: [
            { name: 'User Type List' },
            { name: 'User Type Read' },
            { name: 'Read' },
            { name: 'Update' },
            { name: 'Update Detail' },
            { name: 'Update Password' },
            { name: 'User List' },
            { name: 'User Read' },
            { name: 'Module Permissions' },
            { name: 'Sign Out' },
            { name: 'Traffic Create' },
        ]
    },
    {
        name: 'Admin API',
        children: [
            { name: 'User Type List' },
            { name: 'User Type Read' },
            { name: 'User List' },
            { name: 'User Create' },
            { name: 'User Read' },
            { name: 'User Update' },
            { name: 'User Update Detail' },
            { name: 'User Update Password' },
            { name: 'User Delete' },
            { name: 'Traffic Report' },
            { name: 'Action Report' },
        ]
    },
    {
        name: 'Super Admin API',
        children: [
            { name: 'User Type Create' },
            { name: 'User Type Update' },
            { name: 'User Type Delete' },
            { name: 'User Role List' },
            { name: 'User Role Create' },
            { name: 'User Role Read' },
            { name: 'User Role Update' },
            { name: 'User Role Delete' },
            { name: 'User Custom Column List' },
            { name: 'User Custom Column Create' },
            { name: 'User Custom Column Read' },
            { name: 'User Custom Column Update' },
            { name: 'Module Create' },
            { name: 'Module Read' },
            { name: 'Module Update' },
            { name: 'Module Delete' },
            { name: 'User Role Permissions Read' },
            { name: 'User Role Permissions Update' },
            { name: 'User Integration IDs' },
        ]
    },
    {
        name: 'Postman API Collection',
        href: 'assets/data/TechOriginAPI.postman_collection.json',
        target: '_blank',
        attr: 'download'
    },
];
var pageIFrame = $('.page-iframe');

if(menuContainer.length && pageIFrame.length){
    var hash = window.location.hash.substring(1),
        paths = hash.split('#');

    var html = '';
    menu.forEach(function(d, i){
        var url = cleanName(d.name)+'.html',
            classer = '';
        if(d.href===undefined){
            if(paths[0] && paths[0]==url) classer = 'active';
            else if(!paths[0] && i==0) classer = 'active';
            html += '<li>'
                +'<a class="sidebar-link '+classer+'" href="#" data-page="'+url+'">'
                    +d.name
                +'</a>';
            if(d.children && d.children.length){
                html += '<ul class="sidebar-sub-headers '+classer+'">';
                d.children.forEach(function(c){
                    html += '<li class="sidebar-sub-header">'
                            +'<a class="sidebar-link" href="#" data-page="'+url+'#'+cleanName(c.name)+'">'
                                +c.name
                            +'</a>'
                        +'</li>';
                });
                html += '</ul>';
            }
            html += '</li>';
        }else{
            html += '<li>'
                +'<a class="sidebar-link" href="'+d.href+'" target="'+d.target+'" '+d.attr+'>'
                    +d.name
                +'</a>'
            +'</li>';
        }

        if(classer=='active'){
            if(hash) changePage(hash, true);
            else changePage(url, true);
        }
    });
    menuContainer.html(html);

    var submenu = menuContainer.find('> li > a');
    menuContainer.find('a').click(function(e){
        var self = $(this),
            page = self.data('page');
        if(page!==undefined){
            e.preventDefault();
            if(page) changePage(page, false);
            if(!page.includes('#')){
                submenu.removeClass('active');
                submenu.find('+ *').stop().slideUp();
                self.addClass('active');
                self.find('+ *').stop().slideDown();
            }
            window.location.hash = page;
        }
    });
}else{
    $('a[data-page]').click(function(e){
        e.preventDefault();
        window.parent.changePage($(this).data('page'), true);
    });
}

function cleanName(str){
    return str.toLowerCase().replace(/ /g, '-');
}
function changePage(page, action){
    pageIFrame.attr('src', 'page/'+page);
    if(action){
        var temp = menuContainer.find('> li > a'),
            target = temp.filter('[data-page="'+page+'"]');
        temp.removeClass('active');
        temp.find('+ *').stop().slideUp();
        target.addClass('active');
        target.find('+ *').stop().slideDown();
    }
}
