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
	$('div.listContent.selected').animate({ opacity: 1 });
	
}