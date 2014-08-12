/************************************************************************************************
* Listblock Plugin JS
* Description: ListBox
* Author: Thomas Dintrone
* Designer: Melissa Banks
* Version 1.0
************************************************************************************************/
function listblock(div, settings){
	// settings
    var config = {
        //'dollarPosition': [0, 0, 0, 0, 0],
        'width': '984px',
		'height': '694px',
		'share': false,
		//'title' : 'Gallery'
		//'row': [],
    };
    if ( settings ){$.extend(config, settings);}
	
	/************************ 
	* SET THE BASICS
	*************************/
	$(div).addClass('group');
	$(div).parent('article.subContent').addClass('noPad');
	$('div.listContent').css({ opacity: 0 });	
	
	// Set the max height
	var navHeight = $(div + ' div.nav').height();
	navHeight = navHeight - 3; // because of the bottom border
	
	// If Mobile
	if($(window).width() >= '768') {
		$(div).css({ 'max-height':navHeight });
	}
	
	// Set the counters
	var counter = 1;
	
	// Counter # of elements
	var elements = $(div + ' div.nav a').length;
	
	// Set up the nav
	$(div + ' div.nav li').each(function(i, e){
		var navItem = $(e);
		var navLink = navItem.find('a');
		
		if(counter == 1) {  
			// make the first element te default selected
			navItem.addClass('selected');
		}
		if(counter == elements) {  
			// add "last" class to last element
			navItem.addClass('last');
		}
		
		navLink.append('<span class="arrow"></span>').attr('rel', counter);
		counter ++;
	});
	
	// Reset counter
	counter = 1;
	
	// Set up the divs
	$(div + ' div.listContent').each(function(i, e){
		var listItem = $(e);
		
		if(counter == 1) {  
			// make the first element te default selected
			listItem.addClass('selected');
		}
		
		listItem.attr('id', counter)
		
		counter++;
	});
	
	// Animate the first default div
	$('div.listContent.selected').animate({ opacity: 1 });
	
	// if mobile
	if($(window).width() < '768') {
		$('div.nav li').removeClass('selected');
		$(div + ' div.nav li').append('<div></div>');
		$(div + ' div.nav li').find('div').html('');
	}
	
	// ANIMATION
	$(div + ' div.nav a').on({  
		click: function(){
			var nav		 		= $(div + ' div.nav a').parent('li');
			var selectedNav 	= $(this).attr('rel');
			var selectedLink	= $(this);
			
			// Nav animation
			nav.removeClass('selected')
			nav.find('a').remove('span.arrow');
			$(this).parent('li').addClass('selected')
			$(div + ' div.nav li').find('div').html('');
			$(this).append('<span class="arrow"></span>');
			
			// Div animation
			$('div.listContent').removeClass('selected').animate({ opacity:0 }, 'fast', function(){
				$('div.listContent').hide();
				$('div.listContent').each(function(i,e){
					var selectedDiv = $(e).attr('id');
					
					if(selectedNav == selectedDiv) {
						$(e).addClass('selected').show().animate({ opacity:1 }, 'fast');
						
						// If Mobile
						if($(window).width() < '768') {
							selectedLink.parent('li').find('div').html($(e).html());
						}
						
					}
						
				});
			});
			
			return false;
		}
	});
	
}