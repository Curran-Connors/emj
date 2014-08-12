<?php 
/*************************************************************************
REQUIREMENTS
*************************************************************************/
require_once('core_paths.php');
require_once('functions.php');
require_once('plugins.php');
require_once('nav_constants.php');

/*************************************************************************
DEVELOPMENT
*************************************************************************/
/*  Mobile Detect Class
/*  Reference: http://mobiledetect.net/  */
require_once('mobile_detect/Mobile_Detect.php');
// set class for use
$detect = new Mobile_Detect;

/*************************************************************************
PAGE RELATED
*************************************************************************/
// Get Current Body Class by url
//$base = 'http://'.$_SERVER["SERVER_NAME"].'/ztest';
$base = 'emj';
$body_class = set_body_class($base);

if($body_class == '') { $body_class = 'home'; }

// Select Plugins to include
$the_plugins = array(
						//'pretty_photo',
						//'scroll_to_fixed',
						//'financial_tables',
						//'slider',
						//'lightbox',
						//'scrollbar',
						'listblock',
						'ticket_slider',
						
				);

$plugins->add_plugin($the_plugins);
?>