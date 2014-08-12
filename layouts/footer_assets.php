<!-- JAVASCRIPT -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script type="text/javascript" src="{site_url}bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{site_url}js/functions.js"></script>
<script type="text/javascript" src="{site_url}js/animations.js"></script>
<script> 
(function($){
	$(function(){

	/* active states */
		var windowURL = location.href;
		$('a[href]').each(function(){
			var url = $(this).attr('href');
			var parent = $(this).parent();

			if(windowURL.indexOf(url) >-1)
			{
				if( url != '{site_url}'
					&& url != '{path="about"}')
					$(this).addClass('active');
				else if( url == windowURL)
					$(this).addClass('active');
			}
			
		});

	});
})(jQuery);
</script>
<!-- SELECTIVZR -->
<!-- Allows for CSS3 pseudo selectors || Reference: http://selectivizr.com -->
<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="js/selectivizr/selectivizr-min.js"></script>
  <noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
<![endif]--> 

<!-- PLUGINS JS -->
<?php $plugins->load_plugin_js(); ?>
<script>
(function($){
	$(function(){
 		$('.selected-lan').html('<img src="{site_url}img/icon-flag-<?php echo $language;?>.png" /> <?php echo $language;?>');
	});
})(jQuery);


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-32729126-1', 'auto');
  ga('send', 'pageview');
 
</script>

