(function($){
	$(function(){
			
		$('.search').blur(
			function(){
				// on blur - submit form.
				if( $(this).val() != '' )
					$('#search-keyword').submit();
			}
		);
		
		
		
	});
	
})(jQuery);


(function($){
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
		/* Mobile Menu */
		$('.mobileWrap').css({ opacity:0 });
		
		$('#openMobile').on({  
			click: function(){
				
				var mobileNav = $('.mobileWrap');
				
				mobileNav.toggleClass('showMobile');
				
				if(mobileNav.hasClass('showMobile')) {
					mobileNav.css({ 'visibility':'visible', height:'auto' }).animate({ opacity:1 }, 'fast');
				} else {
					mobileNav.animate({ opacity:0 }, 'fast', function(){
						mobileNav.css({ 'visibility':'hidden', height:0 })
					});
				}
				
			
				return false;
			}
		});
		
		$('nav li.hasValues').on({ 
			click: function(){
				
				//$(this).find('ul.dropDown').css({ 'display' : 'block' })
				
			} 
		})
		var clicked = false;
		$('nav.mobileNav #head a:first').on({
			click: function(e){
				if(clicked)
					return false;
				
				clicked = true;
				var dropDown 	= $(this).parent('li').find('ul.dropDown');
				var windowWidth	= $(window).width();
				
				dropDown.css({ left:windowWidth }).show();
				$('nav.mobileNav').animate({ left: '-=' + windowWidth },function(){
					clicked=false;	
				});
			//	$('nav.mobileNav').css('overflow','visible');

			}
		});
		var clicked1 = false;
		$('nav.mobileNav li.back a').on({
			click: function(e){
				if(clicked1)
					return false;
				clicked1 = true;
				var dropDown 	= $(this).parent('li').find('ul.dropDown');
				var windowWidth	= $(window).width();
				
				dropDown.css({ left:windowWidth }).show();
				$('nav.mobileNav').animate({ left: '+=' + windowWidth },function(){
					clicked1=false;
			//		$('nav.mobileNav').css('overflow','hidden');
				});
			}
		});
		
		/* Language Nav */
		$(document.body).on('click', '.dropdown-menu li', function (event) {
	
		   var $target = $(event.currentTarget);
//		   console.log($target);
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
		$('div.contact.formWrap input.req, div.contact.formWrap select.req').parent('div').addClass('validate');
		$('#formFiller input.req').parent('div').removeClass('validate'); // yesss i know... it's cause my brain hurts
		
		$('div.contact.formWrap input.submitButton').on({
			click: function(){
				
				var error = false;
				
				// reset
				$('div.contact.formWrap .req').removeClass('error');
				$('div.contact.formWrap div').remove('.errorWrap');
				
				// check for errrs
				$('div.contact.formWrap .validate .req').each(function(i,e){
					
							
							if($(e).val() == '') {
								
								$(e).addClass('error');
								$(e).parent('div').append('<div class="errorWrap"><div class="errorText"><span></span><p>This is a required field</p></div><!-- END .errorText --></div><!-- END .errorWrap -->');
								
								error = true;
							}
						
				});
					
					if(error == true) {
						return false;
					} else {
						return true;
					}
				
			}
		});
		
		$('div.contact.formWrap input.req, div.contact.formWrap select.req').focus(function(){
				
				var parent = $(this).parent('div');
				
				parent.find('div.errorWrap').remove('.errorWrap');
				
		});
		
		$('a.contactButton').on({
			click: function(){
				$('a.contactButton').each(function(i,e){
					$(e).removeClass('selected').addClass('deselected');
					$('#formFiller').addClass('hidden');
					$('#formFiller div').each(function(i,e){
						$(e).removeClass('validate');
					});
					$('.canBeHidden').html('<input type="text" class="input" name="zipcode" placeholder="Zip Code">');
				});
				
				$(this).removeClass('deselected').addClass('selected');
				
				if($(this).is('#requestBlueBook')) {
					
					$('#formFiller').removeClass('hidden');
					$('#formFiller div').each(function(i,e){
						$(e).find('input').parent('div').addClass('validate');
					});
					$('.canBeHidden').html('&nbsp;');
					
				}
				
				return false;
			}
			
		});
		
		/*$('[placeholder]').focus(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
		}
		}).blur(function() {
		var input = $(this);
		if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
		}
		}).blur().parents('form').submit(function() {
		$(this).find('[placeholder]').each(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		input.val('');
		}
		})
		});*/
		
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
		
		// Products List for Family
		$('.product.family a').click( function() {
			
			var id 		= $(this).attr('id');
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
		
		/* About Pages for mobile*/
		if($(window).width() < '768') { // iphone
				
			if($('div.pageTitle').hasClass('group')) {
				
				$('article.content div.pageTitle h1').css({ 'white-space':'nowrap' })
			}
				
		}
		
		/* Slider */
		$('#slideshow-1').on({
			click: function(){
				
				var buttons = $(this).attr('rel');
				buttons 	= buttons.split('|'); 
				
				$('#slideshow-2 a.ticketLink').attr('id', 'ticketNext').find('span').text(buttons[0]);
				$('#slideshow-3 a.ticketLink').attr('id', 'ticketNext').find('span').text(buttons[1]);
			}
		});
		
		$('#slideshow-2').on({
			click: function(){
				
				var buttons = $(this).attr('rel');
				buttons 	= buttons.split('|'); 
				
				$('#slideshow-2 a.ticketLink').attr('id', 'ticketPrev').find('span').text(buttons[0]);
				$('#slideshow-3 a.ticketLink').attr('id', 'ticketNext').find('span').text(buttons[1]);
			}
		});
		
		$('#slideshow-3').on({
			click: function(){
				
				var buttons = $(this).attr('rel');
				buttons 	= buttons.split('|'); 
				
				$('#slideshow-2 a.ticketLink').attr('id', 'ticketPrev').find('span').text(buttons[0]);
				$('#slideshow-3 a.ticketLink').attr('id', 'ticketPrev').find('span').text(buttons[1]);
			}
		});
		
		$(window).load(function(){
			var windowHeight 	= $('#slideshow-wrapper').height();
			navPos = (windowHeight - 40) / 2;	  
			$('a.ticketLink').animate({ top:navPos });
			
			$('.ticketSlider .content').each(function(i,e){
				
				var divPos = (windowHeight - $(e).height()) / 2;
				
				$(e).animate({ top:divPos });
			});
		});
		
		var waitForFinalEvent = (function () {
		  var timers = {};
		  return function (callback, ms, uniqueId) {
			if (!uniqueId) {
			  uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
			  clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		  };
		})();
		$(window).resize(function () {
			waitForFinalEvent(function(){
			  var windowHeight 	= $('#slideshow-wrapper').height();
			  //var navHeight 	= $('section.slide1 article');
			  
			  navPos = (windowHeight - 40) / 2;
			  
			  $('a.ticketLink').animate({ top:navPos });
			  
			}, 500, "some unique string");
		});
		
		
		// For Blue Book PDF Preview:
		$('a#preview').hover(function(){
			var pdfUrl = $(this).attr('href');

			//$(this).html('preview<div id="previewWrap"><object data="'+pdfUrl+'" type="application/pdf" width="550" height="688"></object></div>');
			$(this).find('.previewWindow').html('<div id="previewWrap"><iframe width="400" height="690" src="'+pdfUrl+'"></iframe></div>');

			var windowHeight = $(window).height();
			previewPosition = (windowHeight - $('#previewWrap').height()) / 2;
			
			$('#previewWrap').css({ top:previewPosition });
			
		}, function(){
			
			$(this).find('.previewWindow').html('');
			
		});
		
		$('a#tofContents').hover(function(){
			var pdfUrl = $(this).attr('href');

			//$(this).html('preview<div id="previewWrap"><object data="'+pdfUrl+'" type="application/pdf" width="550" height="688"></object></div>');
			$(this).find('.previewWindow').html('<div id="previewWrap"><iframe width="400" height="690" src="'+pdfUrl+'#page=2"></iframe></div>');

			var windowHeight = $(window).height();
			previewPosition = (windowHeight - $('#previewWrap').height()) / 2;
			
			$('#previewWrap').css({ top:previewPosition });
			
		}, function(){
			
			$(this).find('.previewWindow').html('');
			
		});
		
		/* Quality */
		$('a.qualityCheck').on({
			click: function(){
				
				var input = $(this).parent('td').parent('tr').find('input');
				var value = $(this).attr('rel');
				
				$(this).parent('td').parent('tr').find('a').removeClass('checked');
				$(this).addClass('checked');
				
				input.val(value);
				
				return false;
				
			}
		});
		
		/* Mobile Menu */
		$('.dropdown-menu a').on({
			click: function(){
				var $href = $(this).attr('href');

				if($(this).attr('target') == "_blank")
					window.open($href,"_blank");
				else
					window.location = $href;
				return true;
			}
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
})(jQuery);