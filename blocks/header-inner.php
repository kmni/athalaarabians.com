<?php
define(SERVER_URL, 'http://'.$_SERVER['HTTP_HOST']);
// We include the header and footer only if X_REQUESTED_WITH header isn't set
// Note i am using the alternative if (...):  ...  endif; syntax for a better-looking code :)
if ( !$_SERVER['HTTP_X_REQUESTED_WITH'] ):
?><!doctype html>
	<!--          .   oooo                  oooo            
	            .o8   `888                  `888            
	 .oooo.   .o888oo  888 .oo.    .oooo.    888   .oooo.   
	`P  )88b    888    888P"Y88b  `P  )88b   888  `P  )88b  
	 .oP"888    888    888   888   .oP"888   888   .oP"888  
	d8(  888    888 .  888   888  d8(  888   888  d8(  888  
	`Y888""8o   "888" o888o o888o `Y888""8o o888o `Y888""8o                                                       

	                              .o8        o8o                                 
	                             "888        `"'                                 
	 .oooo.   oooo d8b  .oooo.    888oooo.  oooo   .oooo.   ooo. .oo.    .oooo.o 
	`P  )88b  `888""8P `P  )88b   d88' `88b `888  `P  )88b  `888P"Y88b  d88(  "8 
	 .oP"888   888      .oP"888   888   888  888   .oP"888   888   888  `"Y88b.  
	d8(  888   888     d8(  888   888   888  888  d8(  888   888   888  o.  )88b 
	`Y888""8o d888b    `Y888""8o  `Y8bod8P' o888o `Y888""8o o888o o888o 8""888P' 
	                                    copyright and licensing in /humans.txt -->
	<head>
	<meta charset="UTF-8">
	
	<title>Athala Arabians, A Straight Egyptian Arabian Horse Farm In North Scottsdale, Arizona</title>
	<meta name="description" content="Athala Arabians is an arabian horse farm located in North Scottsdale, Arizona that breeds champion straight egyptian arabian horses. The farm is run by singer-songwriter Athala King.">
	<meta name="keywords" content="arabian stallions, horse for sale, equestrian, arab horses, egyptian arabian horses, arabian horse farms in arizona, horse farm Scottsdale">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/plain" rel="author" href="/humans.txt" />
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="screen.css">
	<link rel="stylesheet" href="screen.css">
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" /> 

  <!--[if IE 7]><link rel="stylesheet" href="css/ie7.css"><link rel="stylesheet" href="../css/ie7.css"><link rel="stylesheet" href="../../ie7.css"><![endif]-->
  <!--[if IE 6]><link rel="stylesheet" href="css/ie6.css"><link rel="stylesheet" href="../css/ie6.css"><link rel="stylesheet" href="../../ie6.css"><![endif]-->
  <link rel="stylesheet" href="social/css/social.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/ajaxer.min.js"></script>
	<script src="js/jquery.galleriffic.js"></script>
	<script src="js/jquery.autolink.js"></script>
	<script src="js/jquery.timeago.js"></script>
	<script src="js/jquery.tmpl.js"></script>
	<script src="js/twitter-text.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/jquery.imagesloaded.min.js"></script>
	<script src="js/social.js"></script>
	<script src="js/jquery.jplayer.min.js"></script>
	<script src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script src="js/jquery.easing-1.3.pack.js"></script>
	<script src="js/3lancers.js"></script>
	<script>
	$(document).ready(function(){ // function called when DOM is ready
		$('#nav').RegisterAjaxer($('#inner-content'), true);
		
		// Bind to the AjaxerBeforeReload and animate collapsing
		$('#inner-content').bind('AjaxerBeforeReload', function(){
			// Collapse the container
			$('#inner-content').animate({height: 'toggle'}, 400);
			// Show the loading bar
			$('#loading').show();
		});
		
		// Bind to the AjaxerReload and animate expanding
		$('#inner-content').bind("AjaxerReload", function(){
			// Expand the container
			$('#inner-content').animate({height: 'toggle'}, 400);			
			// Hide the loading bar
			$('#loading').hide();
		});
		
		// We tell Ajaxer to reload every container with ID matching a container from the response
		$('[id]').RegisterContainer();
	});
</script>
<script>
//<![CDATA[
$(document).ready(function(){

	var Playlist = function(instance, playlist, options) {
		var self = this;

		this.instance = instance; // String: To associate specific HTML with this playlist
		this.playlist = playlist; // Array of Objects: The playlist
		this.options = options; // Object: The jPlayer constructor options for this playlist

		this.current = 0;

		this.cssId = {
			jPlayer: "jquery_jplayer_",
			interface: "jp_interface_",
			playlist: "jp_playlist_"
		};
		this.cssSelector = {};

		$.each(this.cssId, function(entity, id) {
			self.cssSelector[entity] = "#" + id + self.instance;
		});

		if(!this.options.cssSelectorAncestor) {
			this.options.cssSelectorAncestor = this.cssSelector.interface;
		}

		$(this.cssSelector.jPlayer).jPlayer(this.options);

		$(this.cssSelector.interface + " .jp-previous").click(function() {
			self.playlistPrev();
			$(this).blur();
			return false;
		});

		$(this.cssSelector.interface + " .jp-next").click(function() {
			self.playlistNext();
			$(this).blur();
			return false;
		});
	};

	Playlist.prototype = {
		displayPlaylist: function() {
			var self = this;
			$(this.cssSelector.playlist + " ul").empty();
			for (i=0; i < this.playlist.length; i++) {
				var listItem = (i === this.playlist.length-1) ? "<li class='jp-playlist-last'>" : "<li>";
				listItem += "<a href='#' id='" + this.cssId.playlist + this.instance + "_item_" + i +"' tabindex='1'>"+ this.playlist[i].name +"</a>";

				// Create links to free media
				if(this.playlist[i].free) {
					var first = true;
					listItem += "<div class='jp-free-media'>(";
					$.each(this.playlist[i], function(property,value) {
						if($.jPlayer.prototype.format[property]) { // Check property is a media format.
							if(first) {
								first = false;
							} else {
								listItem += " | ";
							}
							listItem += "<a id='" + self.cssId.playlist + self.instance + "_item_" + i + "_" + property + "' href='" + value + "' tabindex='1'>" + property + "</a>";
						}
					});
					listItem += ")</span>";
				}

				listItem += "</li>";

				// Associate playlist items with their media
				$(this.cssSelector.playlist + " ul").append(listItem);
				$(this.cssSelector.playlist + "_item_" + i).data("index", i).click(function() {
					var index = $(this).data("index");
					if(self.current !== index) {
						self.playlistChange(index);
					} else {
						$(self.cssSelector.jPlayer).jPlayer("play");
					}
					$(this).blur();
					return false;
				});

				// Disable free media links to force access via right click
				if(this.playlist[i].free) {
					$.each(this.playlist[i], function(property,value) {
						if($.jPlayer.prototype.format[property]) { // Check property is a media format.
							$(self.cssSelector.playlist + "_item_" + i + "_" + property).data("index", i).click(function() {
								var index = $(this).data("index");
								$(self.cssSelector.playlist + "_item_" + index).click();
								$(this).blur();
								return false;
							});
						}
					});
				}
			}
		},
		playlistInit: function(autoplay) {
			if(autoplay) {
				this.playlistChange(this.current);
			} else {
				this.playlistConfig(this.current);
			}
		},
		playlistConfig: function(index) {
			$(this.cssSelector.playlist + "_item_" + this.current).removeClass("jp-playlist-current").parent().removeClass("jp-playlist-current");
			$(this.cssSelector.playlist + "_item_" + index).addClass("jp-playlist-current").parent().addClass("jp-playlist-current");
			this.current = index;
			$(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);
		},
		playlistChange: function(index) {
			this.playlistConfig(index);
			$(this.cssSelector.jPlayer).jPlayer("play");
		},
		playlistNext: function() {
			var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
			this.playlistChange(index);
		},
		playlistPrev: function() {
			var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;
			this.playlistChange(index);
		}
	};

	var audioPlaylist = new Playlist("1", [
		{
			name:"Athala King - AHA Presentation",
			mp3:"/mp3/ahapresentation.mp3"
		},
		{
			name:"Athala King - Catty Simple Thing",
			m4a:"/mp3/cattysimplething.m4a"
		},
		{
			name:"Athala King - Cane1",
			mp3:"/mp3/cane1.mp3"
		},
		{
			name:"Athala King - Martini Party",
			m4a:"/mp3/martiniparty.m4a"
		},
		{
			name:"Athala King - State of Mind",
			m4a:"/mp3/stateofmind.m4a"
		},
		{
			name:"Athala King - Watch As I Listen",
			m4a: "/mp3/watchasilisten.m4a"
		},
	], {
		ready: function() {
			audioPlaylist.displayPlaylist();
			audioPlaylist.playlistInit(false); // Parameter is a boolean for autoplay.
		},
		ended: function() {
			audioPlaylist.playlistNext();
		},
		play: function() {
			$(this).jPlayer("pauseOthers");
		},
		swfPath: "js",
		supplied: "mp3,m4a"
	});
});
//]]>
</script>

  <!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->


</head>
<body id="news">
	<div id="header">
		<div id="header-box">
			<a id="logo" href="index.php"></a>
			<ul id="nav">
				<li><a id="menu-links" href="links.php">Links</a></li>
				<li><a id="menu-contact" href="contact.php">Contact</a></li>
	<!--			<li><a id="menu-news" href="news.php">News</a></li> -->
				<li><a id="menu-news" href="social.php">Social Media</a></li>
				<li><a id="menu-sales" href="sales.php">Sales</a></li>
				<li><a id="menu-mares-fillies" href="mares-fillies.php">Mares/Fillies</a></li>
				<li><a id="menu-stallions-colts" href="stallions-colts.php">Stallions/Colts</a></li>
				<li><a id="menu-home" href="index.php">Home</a></li>
			</ul>
			<div id="music">
			</div>
		</div>
	</div>
	<div id="sub-header">
		<div id="sub-header-line-left"></div>
		<div id="sub-header-line-right"></div>
		<div id="player-holder">
			<div id="jquery_jplayer_1" class="jp-player"></div> 
			<div class="jp-audio">
			    <div class="jp-type-playlist">

			        <div id="jp_interface_1" class="jp-interface">
			            <ul class="jp-controls">
			                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
			                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
			                <li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
			                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
			                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>

			                <li><a href="#" class="jp-previous" tabindex="1">previous</a></li>
			                <li><a href="#" class="jp-next" tabindex="1">next</a></li>
			            </ul>
			            <div class="jp-progress">
			                <div class="jp-seek-bar">
			                    <div class="jp-play-bar"></div>
			                </div>
			            </div>

			            <div class="jp-volume-bar">
			                <div class="jp-volume-bar-value"></div>
			            </div>
			            <div class="jp-current-time"></div>
			            <div class="jp-duration"></div>
			        </div>
			        <div id="jp_playlist_1" class="jp-playlist">
			            <ul>
			                <!-- The method Playlist.displayPlaylist() uses this unordered list -->

			                <li></li>
			            </ul>
			        </div>
			    </div>
			</div>
		</div><!--// #player-holder -->
		<h1><a href="" class="basic" title="<?php echo $page_title; ?>"><?php echo $page_title; ?></h1></a><!-- Insert H1 here -->
	</div> <!--// #sub-header -->
    <div id="content">
		<!-- The loading bar we will show. In css we set it initially to invisible -->
		<div id="loading"><img src="images/ajax-loader.gif" />LOADING...</div>
		<div id="inner-content">
<?php
// For the example we want to reload this container, too
// so we exclude it from the IF statement
endif;
?>