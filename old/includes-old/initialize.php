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
						
				);

$plugins->add_plugin($the_plugins);
?>