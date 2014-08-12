<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine Multi Language Module
 *
 * @package			Multi Language
 * @subpackage		Multi Language
 * @category		Module
 * @author			Ben Croker
 * @link				http://www.putyourlightson.net/projects/multi_language/
 */
 

class Multi_language_upd {

	var $version = '2.0.1';


	function Multi_language_upd()
	{
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
		$this->EE->load->dbforge();
	}

	// --------------------------------------------------------------------

	/**
	 * Module Installer
	 *
	 * @access	public
	 * @return	bool
	 */

	function install()
	{		
		$fields = array(
						'phrase_id'	=> array(
											'type'			=> 'int',
											'constraint'		=> 7,
											'unsigned'		=> TRUE,
											'null'			=> FALSE,
											'auto_increment'	=> TRUE
										),
						'phrase_index'	=> array(
											'type' 			=> 'varchar',
											'constraint'		=> '200',
											'null'			=> FALSE,
											'default'			=> ''
										),
						'phrase_en'	=> array(
											'type'			=> 'text',
											'null'			=> FALSE
										),
						'phrase_es'	=> array(
											'type'			=> 'text',
											'null'			=> FALSE
										),
						'phrase_it'	=> array(
											'type'			=> 'text',
											'null'			=> FALSE
										)
		);

		$this->EE->dbforge->add_field($fields);
		$this->EE->dbforge->add_key('phrase_id', TRUE);
		$this->EE->dbforge->create_table('multi_language', TRUE);
		
		
		// add module
		$data = array(
			'module_name' 	=> 'Multi_language',
			'module_version' 	=> $this->version,
			'has_cp_backend' 	=> 'y'
		);
		$this->EE->db->insert('modules', $data);
		
		
		return TRUE;
	}
	// END
	
	
	// ----------------------------------------
	//  Module uninstaller
	// ----------------------------------------

	function uninstall()
	{
		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => 'Multi_language'));

		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');

		$this->EE->db->where('module_name', 'Multi_language');
		$this->EE->db->delete('modules');

		$this->EE->dbforge->drop_table('multi_language');

		return TRUE;
	}
	// END
	
	
	/** ------------------------------------
	/**  Update Module
	/** ------------------------------------*/
	
	function update($current='')
	{
		if ($current == '' || $current == $this->version)
		{
			return FALSE;
		}
		
		$this->EE->db->query("UPDATE exp_modules 
					SET module_version = '".$this->version."' 
					WHERE module_name = 'Multi_language'");
	}
	/* END */
	
}
// END CLASS

/* End of file upd.multi_language.php */
/* Location: ./system/expressionengine/third_party/multi_language/upd.multi_language.php */
?>