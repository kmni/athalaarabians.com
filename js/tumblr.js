	var tumblrURL = "http://demo.tumblr.com/api/read/json?callback=?";
	var numPostsToDisplay = 20;
	var postCount = 0;
	// Make -1 to turn off jquery.expander
	var postMaxDescriptionLength = 100;
	var imagePath = 'http://chris-tran.com/images/tumblr/';	
	var tumblr_api_read = null;
		
	$(document).ready(function() {	
 		reloadTumblr();
  });		
  
  function reloadTumblr(){  	
  	$("#tumblrFeed").empty();
  	$("#tumblrFeed").append("<div class='body'>loading Tumblr <img class='icon' src='" + imagePath + "small_red.gif'/></div>");
  
  	$.ajax({
		  url: tumblrURL,
		  dataType: 'script',
		  timeout: 10000,
      success:function(){ 
      	$("#tumblrFeed").empty();
      	if ((tumblr_api_read == undefined) || (tumblr_api_read == null)) {
      		$("#tumblrFeed").append("<div class='title' href='#'>unable to load Tumblr</div>");
      		$("#tumblrFeed").append("<div class='body'><a href=\"#\" onclick=\"javascript:reloadTumblr();\">[retry]</a></div>");    			
    		} else {
    			$("#tumblrFeed").append("<div class='body'><a href=\"#\" style=\"float:right\" onclick=\"javascript:reloadTumblr();\">[refresh]</a></div>");
    			postCount = 0;
	        $.each(tumblr_api_read.posts.slice(0, 10), function(i,post){
						if (postCount >= numPostsToDisplay) {
							return;
						}    			
	    			parseTumblrJSON(post);
	    			postCount++;
	  			});
	
	    		// Apply Expander
	    		if (postMaxDescriptionLength > -1) {
					  $('div.expandable').expander({
					    slicePoint:       postMaxDescriptionLength,  // default is 100
					    expandText:         '[more]',
					    userCollapseText: '[^]'
					  });					    			
	    		}
    		}
      },
      error:function (xhr, statusTxt, errorTxt){
      		$("#tumblrFeed").append("<a class='title' href='#'>Tumblr Parse Error</a>");
      		$("#tumblrFeed").append("<div class='body'>" + errorTxt + "<br/>" + xhr.responseText + "</div>");
      } 					      
		});  	
  }
	
	function formatDate(d) {
		/*
Format  Description                                                                  Example
------  ---------------------------------------------------------------------------  -----------------------
 s      The seconds of the minute between 0-59.                                      "0" to "59"
 ss     The seconds of the minute with leading zero if required.                     "00" to "59"
 
 m      The minute of the hour between 0-59.                                         "0"  or "59"
 mm     The minute of the hour with leading zero if required.                        "00" or "59"
 
 h      The hour of the day between 1-12.                                            "1"  to "12"
 hh     The hour of the day with leading zero if required.                           "01" to "12"
 
 H      The hour of the day between 0-23.                                            "0"  to "23"
 HH     The hour of the day with leading zero if required.                           "00" to "23"
 
 d      The day of the month between 1 and 31.                                       "1"  to "31"
 dd     The day of the month with leading zero if required.                          "01" to "31"
 ddd    Abbreviated day name. Date.CultureInfo.abbreviatedDayNames.                  "Mon" to "Sun" 
 dddd   The full day name. Date.CultureInfo.dayNames.                                "Monday" to "Sunday"
 
 M      The month of the year between 1-12.                                          "1" to "12"
 MM     The month of the year with leading zero if required.                         "01" to "12"
 MMM    Abbreviated month name. Date.CultureInfo.abbreviatedMonthNames.              "Jan" to "Dec"
 MMMM   The full month name. Date.CultureInfo.monthNames.                            "January" to "December"

 yy     The year as a two-digit number.                                              "99" or "08"
 yyyy   The full four digit year.                                                    "1999" or "2008"
 
 t      Displays the first character of the A.M./P.M. designator.                    "A" or "P"
        $C.amDesignator or Date.CultureInfo.pmDesignator
 tt     Displays the A.M./P.M. designator.                                           "AM" or "PM"
        $C.amDesignator or Date.CultureInfo.pmDesignator
 
 S      The ordinal suffix ("st, "nd", "rd" or "th") of the current day.            "st, "nd", "rd" or "th"
 	*/
 		return d.toString('dd-MMM-yyyy @ hh:mm tt')
	}
	
	function parseTumblrJSON(post) {
		//alert(post.type);
		var d = Date.parse(post["date-gmt"]);
		var dateFmt = formatDate(d);
		
    switch(post.type)
    {		    	
    	case "regular":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "regular.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
    		
    		$("#tumblrFeed").append("<a class='title' href='" + post.url + "' target='_blank'>" + post["regular-title"] + "</a>");
    		$("#tumblrFeed").append("<div class='body expandable'>" + post["regular-body"] + "</div>");
    		break;
    	}
    	case "link":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "link.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
    		
    		$("#tumblrFeed").append("<a class='title' href='" + post["link-url"] + "' target='_blank'>" + post["link-text"] + "</a>");
    		$("#tumblrFeed").append("<div class='body expandable'>" + post["link-description"] + "</div>");
    		break;
    	}		    	
    	case "quote":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "quote.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
    		
    		$("#tumblrFeed").append("<div class='body'>" + 
    			"<div class='quote expandable'>" + post["quote-text"] + "</div>" +
    			"<div class='quotesrc'>" + post["quote-source"] + "</div>" +
    			"</div>");
    		break;
    	}		    	
    	case "photo":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "photo.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
    		// valid values are: photo-url-[75, 100, 250, 400, 500, 1280]
    		$("#tumblrFeed").append("<div class='body'>" + 
    			"<a class='title' href='" + post.url + "'>" +
    			"<img src='" + post["photo-url-100"] + "'/></a><br/>" + 
    			post["photo-caption"] + 
    			"</div>");
    		break;
    	}
    	case "conversation":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "conversation.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
					    		
    		var html = '';
    		$("#tumblrFeed").append("<a class='title' href='" + post.url + "' target='_blank'>" + post["conversation-title"] + "</a>");

				for(var i = 0; i < post["conversation"].length; i++) {
					var conv = post["conversation"][i];						
					html += "<div class='convlabel'>" + conv.label + "</div>";
					html += "<div class='convtext expandable'>" + conv.phrase + "</div>";
				}

				/*    		
				$(this).find("line").each(function(){
					html += "<div class='convlabel'>" + $(this).attr("label") + "</div>";
					html += "<div class='convtext'>" + $(this).text() + "</div>";
				});*/
    				    		
    		$("#tumblrFeed").append("<div class='body'>" + html + "</div>");
    		break;
    	}
    	case "audio":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "audio.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
    		
    		$("#tumblrFeed").append("<a class='title' href='" + post.url + "' target='_blank'>" + post["audio-caption"] + "</a>");
    		$("#tumblrFeed").append("<div class='body'>" + post["audio-player"] + "</div>");
    		break;
    	}
    	case "video":
    	{
				$("#tumblrFeed").append(
					"<table style='width: 100%;'><tr><td width='18px'>" +
					"<a href='" + post.url + "' target='_blank'>" +
					"<img class='icon' src='" + imagePath + "video.gif'/></a></td><td><div class='date'>" + dateFmt + "</div></td></table>");						
    		
    		$("#tumblrFeed").append("<a class='title' href='" + post.url + "' target='_blank'>" + post["video-caption"] + "</a>");
    		$("#tumblrFeed").append("<div class='body'>" + 
    			post["video-player"] + 
    		"</div>");
    		break;
    	}		    	
    	default:
    		break;
    }
    $("#tumblrFeed").append("<div class='clear'>&nbsp;</div>");
	}	
	
	function parseTumblrXml(xml) {
		var postCount = 0;
		$(xml).find("post").each(function(){
			if (postCount >= numPostsToDisplay){
				return;
			}
						
	    switch($(this).attr("type"))
	    {		    	
	    	case "regular":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "regular.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
	    		
	    		$("#tumblrFeed").append("<a class='title' href='" + $(this).attr("url") + "' target='_blank'>" + $(this).find("regular-title").text() + "</a>");
	    		$("#tumblrFeed").append("<div class='body'>" + $(this).find("regular-body").text() + "</div>");
	    		break;
	    	}
	    	case "link":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "link.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
	    		
	    		$("#tumblrFeed").append("<a class='title' href='" + $(this).find("link-url") + "' target='_blank'>" + $(this).find("link-text").text() + "</a>");
	    		$("#tumblrFeed").append("<div class='body'>" + $(this).find("link-description").text() + "</div>");
	    		break;
	    	}		    	
	    	case "quote":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "quote.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
	    		
	    		$("#tumblrFeed").append("<div class='body'>" + 
	    			"<div class='quote'>" + $(this).find("quote-text").text() + "</div>" +
	    			"<div class='quotesrc'>" + $(this).find("quote-source").text() + "</div>" +
	    			"</div>");
	    		break;
	    	}		    	
	    	case "photo":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "photo.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
	    		
	    		$("#tumblrFeed").append("<div class='body'>" + 
	    			"<a class='title' href='" + $(this).attr("url") + "'>" +
	    			"<img src='" + $(this).find("photo-url[max-width=100]").text() + "'/></a><br/>" + 
	    			$(this).find("photo-caption").text() + 
	    			"</div>");
	    		break;
	    	}
	    	case "conversation":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "conversation.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
						    		
	    		var html = '';
	    		$("#tumblrFeed").append("<a class='title' href='" + $(this).attr("url") + "' target='_blank'>" + $(this).find("conversation-title").text() + "</a>");
	    		
					$(this).find("line").each(function(){
						html += "<div class='convlabel'>" + $(this).attr("label") + "</div>";
						html += "<div class='convtext'>" + $(this).text() + "</div>";
					});
	    				    		
	    		$("#tumblrFeed").append("<div class='body'>" + html + "</div>");
	    		break;
	    	}
	    	case "audio":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "audio.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
	    		
	    		$("#tumblrFeed").append("<a class='title' href='" + $(this).attr("url") + "' target='_blank'>" + $(this).find("audio-caption").text() + "</a>");
	    		$("#tumblrFeed").append("<div class='body'>" + $(this).find("audio-player").text() + "</div>");
	    		break;
	    	}
	    	case "video":
	    	{
					$("#tumblrFeed").append(
						"<table style='width: 100%;'><tr><td width='18px'>" +
						"<a href='" + $(this).attr("url") + "' target='_blank'>" +
						"<img class='icon' src='" + imagePath + "video.gif'/></a></td><td><div class='date'>" + $(this).attr("date") + "</div></td></table>");						
	    		
	    		$("#tumblrFeed").append("<a class='title' href='" + $(this).attr("url") + "' target='_blank'>" + $(this).find("video-caption").text() + "</a>");
	    		$("#tumblrFeed").append("<div class='body'>" + 
	    			"<div class='videosrc'>" + $(this).find("video-source").text() + "</div>" +
	    			$(this).find("video-player").text() + 
	    		"</div>");
	    		break;
	    	}		    	
	    	default:
	    		break;
	    }
	    $("#tumblrFeed").append("<div class='clear'>&nbsp;</div>");
	    postCount++;
	  });

	}