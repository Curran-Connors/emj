$(function(){
	/************************************************************
	SET UP THE BASICS:
	************************************************************/
	// Load PrettyPhoto (Lightbox)
	//$("a[rel^='prettyPhoto']").prettyPhoto();
	
	
	// For ie10 Selection
	var b = document.documentElement;
	b.setAttribute('data-useragent',  navigator.userAgent);
	b.setAttribute('data-platform', navigator.platform );
	
	/************************************************************
	CUSTOM CODING:
	************************************************************/
	/* Language Nav */
	$(document.body).on('click', '.dropdown-menu li', function (event) {

       var $target = $(event.currentTarget);
       if ($target.is('.dropdown-submenu')) return false;

       $target.closest('.btn-group')
           .find('[data-bind="label"]').html($target.html())
           .end()
           .children('.dropdown-toggle').dropdown('toggle');

       return false;

   });
	
	/* Location Page */
	
	// set counter & add id's to nav links
	var counter = 1;
	$('nav.locationNav a').each(function(i,e){
		$(e).attr('id', counter);
		
		counter++;
	});
	
	// reset counter & add id's to location divs
	counter = 1;
	$('div.location').each(function(i,e){
		$(e).attr('id', counter);
		counter++;
	});
	
	$('nav.locationNav a').on({ 
		click: function(){
			// remove class from nav li and add to selected trigger li
			$('nav.locationNav li').removeClass('selected');
			$(this).parent('li').addClass('selected');
			
			// set up selector variables
			var trigger = $(this).attr('id');
			var div = $('div.location');
			
			// and then...
			div.animate({ opacity:0 }, function(){
				// remove class
				div.removeClass('selected')
				
				// loop & match em up
				div.each(function(i,e){
					
					if($(e).attr('id') == trigger) {
						$(e).addClass('selected');
					}
				}).animate({ opacity:1 });
				
			})
			
			return false;
		}
	});
	
	/* Contact Page */
	$('div.contact.formWrap input.submitButton').on({
		click: function(){
			
			var error = false;
			
			// reset
			$('div.contact.formWrap .req').removeClass('error');
			$('div.contact.formWrap div').remove('.errorWrap');
			
			// check for errrs
			$('div.contact.formWrap .req').each(function(i,e){
				
				if($(e).val() == '') {
					
					$(e).addClass('error');
					$(e).parent('div').append('<div class="errorWrap"><div class="errorText"><span></span><p>This is a required field</p></div><!-- END .errorText --></div><!-- END .errorWrap -->');
					
					error = true;
				}
				
			})
			
			if(error == true) {
				return false;
			} else {
				return true;
			}
			
		}
	});
	
	
	
	/* PRODUCTS NAV */
	
	/* Family */
	$('li.family ul.dropDown a').click( function() {
		
		var id 		= $(this).parent('li').attr('id');
		var name	= $('li.family a:first').text($(this).text());
		
		$('li.family form input[name=family]').val(id);
		$('li.family form input[name=submit_1]').val(1);
		
		$('li.family ul.dropDown').hide().animate({ opacity:1 }, function(){
			$('li.family ul.dropDown').attr('style', '');
		});
		
		$('#familyForm').submit();
		
		return false;
	});
	
	/* Material */
	$('li.material ul.dropDown a').click( function() {
		
		var id 			= $(this).parent('li').attr('id');
		var name		= $('li.material a:first').text($(this).text());
		
		$('li.material form input[name=material]').val(id);
		$('li.material form input[name=submit_2]').val(1);
		
		$('li.material ul.dropDown').hide().animate({ opacity:1 }, function(){
			$('li.material ul.dropDown').attr('style', '');
		});
		
		$('#materialForm').submit();
		
		return false;
	});
	
	/* Shape */
	$('li.shape ul.dropDown a').click( function() {
		
		var id 			= $(this).parent('li').attr('id');
		var name		= $('li.shape a:first').text($(this).text());
		
		$('li.shape form input[name=shape]').val(id);
		$('li.shape form input[name=submit_3]').val(1);
		
		$('li.shape ul.dropDown').hide().animate({ opacity:1 }, function(){
			$('li.shape ul.dropDown').attr('style', '');
		});
		
		$('#shapeForm').submit();
		
		return false;
	});
	
	/************************************************************
	REPSONSIVE (if needed)
	************************************************************/
	if($(window).width() == '768') { // ipad
			
	} else {
							 
	}
	
	// OR? - haven't tested this yet...
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	function isiPhone(){
		return (
			//Detect iPhone
			(navigator.platform.indexOf("iPhone") != -1) ||
			//Detect iPod
			(navigator.platform.indexOf("iPod") != -1)
		);
	}
});