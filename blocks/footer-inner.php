<?php
// we dont show these when page is loaded with Ajax because we didnt include their beginning tags
if ( !$_SERVER['HTTP_X_REQUESTED_WITH'] ):
?>
        </div><? /* end div#inner-content */ ?>
        </div><? /* end div#content */ ?>
				<div id="footer">
					<div>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="stallions-colts.php">Stallions/Colts</a></li>
							<li><a href="mares-fillies.php">Mares/Fillies</a></li>
							<li><a href="sales.php">Sales</a></li>
<!--							<li><a href="news.php">News</a></li> -->
							<li><a href="contact.php">Contact</a></li>
							<li><a href="http://www.athalaking.com">Music</a></li>
						</ul>
						<p id="madeby">
							website by <a href="http://www.arabhorse.com">arabhorse</a>
						</p>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50d4c0e17ad775d7"></script>
<!-- AddThis Button END -->
	</div>
</div>
<div id="flower">
	<a href="index.html"></a>
</div>
<script> 
jQuery(document).ready(function () {
  $("#jquery_jplayer_1").jPlayer("play");
});
</script>
<script> 
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-15359704-55']);
_gaq.push(['_setAllowLinker', true]);
_gaq.push(['_setAllowHash', false]);
_gaq.push(['_trackPageview']);
(function() { 
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; 
	var s = document.getElementsByTagName('script')[0]; 
	s.parentNode.insertBefore(ga, s);
})(); 
</script> 
</body>
</html>
<?php
endif;
?>