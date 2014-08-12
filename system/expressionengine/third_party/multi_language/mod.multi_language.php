<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package			Multi Language
 * @subpackage		Multi Language
 * @category		Module
 * @author			Ben Croker
 * @link				http://www.putyourlightson.net/projects/multi_language/
 */
 

class Multi_language {


	// -------------------------
	//  Constructor
	// -------------------------
	
	function Multi_language( $switch = TRUE )
	{
		$this->EE =& get_instance();
	} 
	// END
	
	
	// -------------------------
	//  Get phrase
	// -------------------------
	
	function phrase($phrase_index='')
	{
		if (!$phrase_index)
		{
			if (!$phrase_index = $this->EE->TMPL->fetch_param('index'))
			{
				return '';
			}
		}
		
		$phrase = '';
		
		// get phrase from database
		$query = $this->EE->db->query("SELECT * FROM exp_multi_language WHERE phrase_index = '".strtolower($phrase_index)."'");
		
		if ($row = $query->row())
		{
			// get user language
			$user_language = 'en';
			
			if (isset($this->EE->config->_global_vars['user_language']))
			{
				$user_language = $this->EE->config->_global_vars['user_language'];
			}
			
			$field = 'phrase_'.$user_language;
			
			$phrase = (isset($row->$field) && $row->$field) ? $row->$field : $row->phrase_en;
			
			// addslashes if this is a javascript template
			if (substr($this->EE->uri->uri_string, -3) == '_js')
			{
				$phrase = addslashes($phrase);
			}
		}
		
		return $phrase;
	}
    /* END */
	
	
}
// END CLASS

/* End of file mod.multi_language.php */
/* Location: ./system/expressionengine/third_party/multi_language/mod.multi_language.php */
?>