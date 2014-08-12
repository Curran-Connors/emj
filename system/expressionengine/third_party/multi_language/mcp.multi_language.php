<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package			Multi Language
 * @subpackage		Multi Language
 * @category		Module
 * @author			Ben Croker
 * @link				http://www.putyourlightson.net/projects/multi_language/
 */
 

class Multi_language_mcp {

	
	// -------------------------
	//  Constructor
	// -------------------------
	
	function Multi_language_mcp( $switch = TRUE )
	{
		$this->EE =& get_instance();
	} 
	// END
	
	
	// ----------------------------------------
	//  Module Homepage
	// ----------------------------------------

	function index($message = '')
	{
		$this->EE->load->library('table');
		$this->EE->load->library('javascript');
		
		if (version_compare(APP_VER, '2.6.0', '>='))
		{
			$this->EE->view->cp_page_title = $this->EE->lang->line('multi_language');
		}
		else
		{
			$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('multi_language'));
		}

		$this->EE->cp->set_right_nav(array(
								'create_new_phrase' => BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=edit', 
								'add_language' => '#'
							));
		 
		 
		// get fields
		$vars['fields'] = array();		
		$fields = $this->EE->db->list_fields('multi_language');
		
		foreach ($fields as $field)
		{
			if ($field != 'phrase_id')
			{
				$vars['fields'][] = $field;
				$vars['field_headings'][] = ($field == 'phrase_index') ? lang($field) : lang($field).' (<a href="'.BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'.AMP.'method=delete_language_confirm'.AMP.'field='.$field.'" title="Delete">x</a>)';
			}
		}		
		
		// add blank field heading for delete column
		$vars['field_headings'][] = '';
				
		
		// get phrases
		$query = $this->EE->db->query("SELECT * FROM exp_multi_language ORDER BY phrase_index");
		$vars['phrases'] = $query->result();
		
		
		// set character limit based on number of languages
		$vars['char_limit'] = round(100 / (count($vars['fields']) - 2));
		
		
		return $this->EE->load->view('index', $vars, TRUE);
	}
	/* END */

		
	/** -----------------------------------------------------------
	/**  Edit
	/** -----------------------------------------------------------*/

	function edit()
	{	
		$this->EE->load->helper('form');
		$this->EE->load->library('table');
		
		$this->EE->cp->set_breadcrumb(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language', lang('multi_language'));
		
		$phrase_id = $this->EE->input->get('phrase_id');
		
		if ($phrase_id)
		{
			if (version_compare(APP_VER, '2.6.0', '>='))
			{
				$this->EE->view->cp_page_title = $this->EE->lang->line('edit_phrase');
			}
			else
			{
				$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('edit_phrase'));
			}

			$query = $this->EE->db->get_where('multi_language', array('phrase_id' => $phrase_id));
			$vars['fields'] = $query->row_array();
			$vars['phrase_index'] = $vars['fields']['phrase_index'];
		}
		
		else
		{
			if (version_compare(APP_VER, '2.6.0', '>='))
			{
				$this->EE->view->cp_page_title = $this->EE->lang->line('add_phrase');
			}
			else
			{
				$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('add_phrase'));
			}
		
			$vars['fields'] = $this->EE->db->list_fields('multi_language');
			$vars['phrase_index'] = '';
		}
		
		$vars['phrase_id'] = $phrase_id;
		
		
		return $this->EE->load->view('edit', $vars, TRUE);
	}
	/* END */
	
	
	/** -----------------------------------------------------------
	/**  Update
	/** -----------------------------------------------------------*/

	function update()
	{  		
		$phrase_id = $this->EE->input->post('phrase_id');
		
		// check for required fields
		$errors = array();
		
		if ($this->EE->input->post('phrase_index') == '')
		{
			show_error(lang('no_phrase_index'));
		}
		
		// does phrase index have invalid characters?		
		$phrase_index = strtolower(str_replace(' ', '_', $this->EE->input->post('phrase_index')));
		
		if (preg_match('/[^a-z0-9\_\-]/i', $phrase_index)) 
		{
			show_error(lang('invalid_characters'));
		}
				  
		// is the phrase index taken?
		$query = $this->EE->db->get_where('multi_language', array('phrase_index' => $phrase_index));	   
	  
		if ((!$phrase_id || $this->EE->input->post('phrase_index') != $this->EE->input->post('cur_phrase_index')) && $query->num_rows > 0)
		{
			show_error(lang('duplicate_phrase_index'));
		}
		
	  
	  // prepare data for db
		$data = $_POST;
		$id = $data['phrase_id'];
		unset($data['phrase_id']);
		unset($data['cur_phrase_index']);
		unset($data['submit']);
			
			
	  // construct the query based on whether we are updating or inserting
	  if ($phrase_id)
		{
			$this->EE->db->update('multi_language', $data, 'phrase_id = '.$id); 
		}
		
		else
		{
			$this->EE->db->insert('multi_language', $data); 
		}
		
		
		$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language'); 
	}
	/* END */
	
	
	/** -----------------------------------------------------------
	/**  Delete confirm
	/** -----------------------------------------------------------*/

	function delete_confirm()
	{  
		$this->EE->cp->set_breadcrumb(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language', lang('multi_language'));
		
		if (version_compare(APP_VER, '2.6.0', '>='))
		{
			$this->EE->view->cp_page_title = $this->EE->lang->line('delete_confirm');
		}
		else
		{
			$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('delete_confirm'));
		}

		if (!$phrase_id = $this->EE->input->get('phrase_id') )
		{
			$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language');
		}
		
		$query = $this->EE->db->query("SELECT phrase_index FROM exp_multi_language WHERE phrase_id = '".$phrase_id."'");
		$row = $query->row();
		$vars['phrase_index'] = $row->phrase_index;
		$vars['phrase_id'] = $phrase_id;
		
		return $this->EE->load->view('delete_confirm', $vars, TRUE);
	}
	/* END */	
   
   
	/** -----------------------------------------------------------
	/**  Delete phrase
	/** -----------------------------------------------------------*/

	function delete_phrase()
	{  
		if ($phrase_id = $this->EE->input->post('phrase_id'))
		{
			$this->EE->db->query("DELETE FROM exp_multi_language WHERE phrase_id = '".$phrase_id."'");
		}
		
		$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language');
	}
	/* END */
	
	
	/** -----------------------------------------------------------
	/**  Add language
	/** -----------------------------------------------------------*/

	function add_language()
	{  
		if (!$language_code = $this->EE->input->post('language_code'))
		{
			$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language');
		}
		
		$this->EE->db->query("ALTER TABLE exp_multi_language ADD phrase_".$language_code.' TEXT');

		$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language');
	}
	/* END */
	
	
	/** -----------------------------------------------------------
	/**  Delete language confirm
	/** -----------------------------------------------------------*/

	function delete_language_confirm()
	{  
		$this->EE->cp->set_breadcrumb(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language', lang('multi_language'));
		
		if (version_compare(APP_VER, '2.6.0', '>='))
		{
			$this->EE->view->cp_page_title = $this->EE->lang->line('delete_confirm');
		}
		else
		{
			$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('delete_confirm'));
		}

		if (!$field = $this->EE->input->get('field') )
		{
			$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language');
		}
		
		$vars['field'] = $field;
		
		return $this->EE->load->view('delete_language_confirm', $vars, TRUE);
	}
	/* END */	
   
   
	/** -----------------------------------------------------------
	/**  Delete language
	/** -----------------------------------------------------------*/

	function delete_language()
	{  
		if ($field = $this->EE->input->post('field'))
		{
			$this->EE->db->query("ALTER TABLE exp_multi_language DROP ".$field);
		}
		
		$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=multi_language');
	}
	/* END */
	
	
}
// END CLASS

/* End of file mcp.multi_language.php */
/* Location: ./system/expressionengine/third_party/multi_language/mcp.multi_language.php */
?>