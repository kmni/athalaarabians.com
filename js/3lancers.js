var hju	= {
	gallery:	function(selector){
		if ($(selector).length)
		{
			$(selector).each(function(){
				var gallery	= $(this),
					id		= gallery.attr('id'),
					delay	= gallery.attr('data-delay') ? parseInt(gallery.attr('data-delay')) : 6000,
					auto	= gallery.attr('data-auto') ? gallery.attr('data-auto') : 'true';
				gallery.galleriffic({
					imageContainerSel:      '#slideshow-'+id,
					controlsContainerSel:   '#controls-'+id,
					delay:                  delay,
					autoStart:              auto == 'true' ? true : false,
				});
			});
		}
	},
	fancy:	function(selector){
		if ($(selector).length)
		{
			$(selector).fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600, 
				'speedOut'		:	200,
				'titleShow'		:	false
			});
		}
	},
};