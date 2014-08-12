<?php
$system_path = '../system';
$assign_to_config['site_url'] = 'http://stage2.curran-connors.com/emj/emj-dev/fr/';
$debug = 0;
$assign_to_config['global_vars'] = array(
   "countrycode"=>"French",
   "site_url"=>"http://stage2.curran-connors.com/emj/emj-dev/"
); // This array must be associative
$routing['directory'] = '';
$routing['controller'] = 'ee';
$routing['function'] = 'index';
$assign_to_config['subclass_prefix'] = 'EE_';
if (realpath($system_path) !== FALSE){$system_path = realpath($system_path).'/';}
$system_path = rtrim($system_path, '/').'/';
if ( ! is_dir($system_path))	{
   exit("Your system folder path does not appear to be 
       set correctly. Please open the following file and 
       correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME)
);}
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('ROOT_PATH',"/var/www/vhosts/stage2.curran-connors.com/httpdocs/emj/emj-dev/");
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path.'codeigniter/system/'));
define('APPPATH', $system_path.'expressionengine/');
define('FCPATH', str_replace(SELF, '', __FILE__));
define('SYSDIR', trim(strrchr(trim(str_replace("\\", "/", $system_path), '/'), '/'), '/'));
define('DEBUG', $debug);  unset($debug);
if (DEBUG == 1){error_reporting(E_ALL);
@ini_set('display_errors', 1);
}else{error_reporting(0);}
require_once BASEPATH.'core/CodeIgniter'.EXT;
?>