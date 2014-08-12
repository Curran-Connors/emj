<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Custom Extension Hook Extension
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Extension
 * @author		Carl Crawley, Made by Hippo
 * @link		http://www.madebyhippo.com
 */

class Delete_file_ext {
	
	public $settings 		= array();
	public $description		= 'catch when deleting content - to perform extra features.';
	public $docs_url		= '';
	public $name			= 'File Delete';
	public $settings_exist	= 'n';
	public $version			= '1.0';
	
	private $EE;
	
	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	public function __construct($settings = '')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;
	}// ----------------------------------------------------------------------
	
	/**
	 * Activate Extension
	 *
	 * This function enters the extension into the exp_extensions table
	 *
	 * @see http://codeigniter.com/user_guide/database/index.html for
	 * more information on the db class.
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		// Setup custom settings in this array.
		$this->settings = array();
		
		$data = array(
			'class'		=> __CLASS__,
			'method'	=> 'delete_entries_start',
			'hook'		=> 'delete_entries_start',
			'settings'	=> serialize($this->settings),
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);

		$this->EE->db->insert('extensions', $data);			
		
	}	

	// ----------------------------------------------------------------------
	
	public function delete_entries_start()
    {
		// no channel id -- only entry id in form of array for multiple edits.
		
		// declare array delete
		
		$deleteArray = $_REQUEST['delete'];
		
		// loop the entries and figure out which one is channel 2 - as this is only performed for blue book -- ugh.
		foreach( $deleteArray as $i => $entry_id )
		{
			$this->EE->db->select('cd.channel_id,ct.title,cd.field_id_10 as PDF, cd.field_id_29 as abbrev');
			$this->EE->db->from('channel_titles ct');
			$this->EE->db->join('channel_data cd', 'cd.entry_id = ct.entry_id');
			$this->EE->db->where('cd.entry_id',$entry_id);
			$this->EE->db->order_by('ct.entry_id');
			$query = $this->EE->db->get()->row();
			
			// get variables from query object
			$channel_id = $query->channel_id;
			$title = $query->title;
			$pdf = $query->PDF;
			$abbrev = $query->abbrev;
			// if its blue book only
			switch($channel_id)
			{
				case 2:
				
					// channel is Blue Book
					
					// query for the pdf id
					$pdf = str_replace("{filedir_2}","pdf_indexer/pdfs/",$pdf);
					$sql = "SELECT distinct pdf_id 
							FROM PDFS 
							where pdf_title = ?
							and pdf_path = ?";
	
					$success = $this->EE->db->query($sql,array($title,$pdf))->result();
					foreach($success as $e=>$obj)
					{
						// get the pdf id from the query object
						$pdf_id = $obj->pdf_id;
						
						
						// delete from PDFS
						$deletePDF = "DELETE FROM PDFS WHERE pdf_id = ?";
						$this->EE->db->query($deletePDF,array($pdf_id));
						if( $this->EE->db->affected_rows() > 0)
						{
							// if it deleted from PDFS -- delete from pdf_pages.
							// delete from pdf_pages
							$deletePages = "DELETE FROM pdf_pages WHERE pdf_id = ?";
							$this->EE->db->query($deletePages,array($pdf_id));
							if( $this->EE->db->affected_rows() > 0)
							{
								return true;
							}		
						}
					}					
					break;
				case 5:
					// channel is language
					$success = exec('java -jar "'.ROOT_PATH.'/plugins/language_switcher/language_switcher.jar" delete "'.$abbrev.'"', $results);
					
					break;	
				
			}
	
		}
    }

	// ----------------------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * This method removes information from the exp_extensions table
	 *
	 * @return void
	 */
	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	// ----------------------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * This function performs any necessary db updates when the extension
	 * page is visited
	 *
	 * @return 	mixed	void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}
	}	
	
	// ----------------------------------------------------------------------
}

/* End of file ext.custom_extension_hook.php */
/* Location: /system/expressionengine/third_party/custom_extension_hook/ext.custom_extension_hook.php */