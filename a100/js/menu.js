// Menu Active Script
$(document).ready(function() {
    $('.sidebar-menu li a').each(function() {
        var e=$(this).attr('href');
		var c=location.pathname.split('/');
        c = c[c.length-1];
		if(e==c){$(this).parent().addClass('active');}
    });
});
