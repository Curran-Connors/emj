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

class Entry_submission_absolute_end_ext {
	
	public $settings 		= array();
	public $description		= 'catch when publishing content - to perform extra features.';
	public $docs_url		= '';
	public $name			= 'Content Publish';
	public $settings_exist	= 'n';
	public $version			= '1.0';
	public $APIKEY 			= "AIzaSyAVq6EjFY26ze6w1nPKnq6un3CrYCzLo0E";

	
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
			'method'	=> 'entry_submission_absolute_end',
			'hook'		=> 'entry_submission_absolute_end',
			'settings'	=> serialize($this->settings),
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);

		$this->EE->db->insert('extensions', $data);			
		
	}	

	// ----------------------------------------------------------------------
	
	public function entry_submission_absolute_end($entry_id, $meta, $data, $view_url)
    {
		// make sure we are publishing with a channel id.
		if( isset($_REQUEST['channel_id']) )
		{
			$channel_id = $_REQUEST['channel_id'];
			$entry_id = $_REQUEST['entry_id'];
			switch($channel_id)
			{
				case 2:  // blue book entry
					if(isset($_REQUEST['field_id_10_hidden_file']))
					{
			
						$filename = $_REQUEST['field_id_10_hidden_file'];
						$title = $_REQUEST['title'];
						$success = exec('java -jar "'.ROOT_PATH.'/pdf_indexer/PDF_Indexer.jar" index "'.$filename.'" "'.$title.'"', $results);
						
					}				
					break;
				case 5:  // language
					// switch on entry id - if 0 :: new entry otherwise :: existing.
					switch($entry_id)
					{
						case 0: // NEW PUBLICATION :: CREATE LANGUAGE
					///		print_r($_REQUEST);
							$title = ucwords($_REQUEST['title']);
							$abbrev = strtolower($_REQUEST['field_id_29']);
							$success = exec('java -jar "'.ROOT_PATH.'/plugins/language_switcher/language_switcher.jar" create "'.$abbrev.'" "'.$title.'"', $results);
							break;	
						default: // EDITING AN EXISTING LANGUAGE - RUN THE EDIT COMMAND.
							$title = ucwords($_REQUEST['title']);
							$abbrev = strtolower($_REQUEST['field_id_29']);
							$success = exec('java -jar "'.ROOT_PATH.'/plugins/language_switcher/language_switcher.jar" edit "'.$abbrev.'" "'.$title.'"', $results);
					}
					break;
				case 10:
					switch($entry_id)
					{
						case 0: // NEW PUBLICATION :: get long - lat	
							// get address and url_encode it							
							// pull post values from the page
							$street 			= trim($_REQUEST['field_id_53']);
							$city 				= trim($_REQUEST['field_id_54']);
							$state 				= trim($_REQUEST['field_id_55']);
							$zip 				= trim($_REQUEST['field_id_56']);
							$location_name		= trim($_REQUEST['field_id_61']);
							// set up the address that will be used for geocoding
							$fullAddr			= urlencode($street) . "," . urlencode($city) . "," . urlencode($state) . "," . urlencode($zip);							
							// run geocoding function to get location object
							$locationObj = $this->GetJsonGeoCode($fullAddr);
							
							// pull lat and long from location object
							$lat = $locationObj->lat;
							$lng = $locationObj->lng;
							
							// submit function -- need to grab the entry_id of the recently submitted entry.
							
							
							// QUERY THE DATABASE SEARCH THE emj_channel_data TABLE
							$sql = "SELECT entry_id from emj_channel_data
									 WHERE channel_id = ?
									 AND field_id_53 = ?
									 AND field_id_54 = ?
									 AND field_id_55 = ?
									 AND field_id_56 = ?
									 AND field_id_61 = ?
									 LIMIT 1"; 
							// set params for select query
							$params = array(
								$channel_id,
								$street,
								$city,
								$state,
								$zip,
								$location_name
							);
							// execute select query
							$query = ee()->db->query($sql,$params);
							// check if returned rows
							if ($query->num_rows() > 0)
							{
								// results
								$entry_id_obj = $query->result();
								$entry_id_obj = $entry_id_obj[0]->entry_id;
								// we have an entry id 
								// add the rows to the table.
								// set up params for insert query
								$param	= array(
										$channel_id,
										$entry_id_obj,
										$lng,
										$lat,
										$location_name
									);
									// insert query sql
									$insert_SQL = "INSERT INTO emj_location_markers 
														( channel_id,entry_id,lng,lat,title) 
													VALUES
														(?,?,?,?,?)";
									// execute insert query
									$Insert_query = ee()->db->query($insert_SQL,$param);
							}
	
							// debug
							/*
							echo "<pre>";
							
								print_r($Insert_query);
							
							echo "</pre>";
							
							exit('still debugging this section -- line number -- ' . __LINE__);	
							
							*/
	
	
							break;	
						default: // EDITING AN EXISTING LANGUAGE - RUN THE EDIT COMMAND.
							// pull post values from the page
							$street 			= trim($_REQUEST['field_id_53']);
							$city 				= trim($_REQUEST['field_id_54']);
							$state 				= trim($_REQUEST['field_id_55']);
							$zip 				= trim($_REQUEST['field_id_56']);
							$location_name		= trim($_REQUEST['field_id_61']);
							// set up the address that will be used for geocoding
							$fullAddr			= urlencode($street) . "," . urlencode($city) . "," . urlencode($state) . "," . urlencode($zip);							
							// run geocoding function to get location object
							$locationObj = $this->GetJsonGeoCode($fullAddr);
							
							// pull lat and long from location object
							$lat = $locationObj->lat;
							$lng = $locationObj->lng;
							
							// edit function -- already have the entry_id. NO NEED TO CHECK WE ARE ALREADY INSIDE THE CHECK CONDITION LOL							
							// QUERY THE DATABASE SEARCH THE emj_location_markers TABLE
							
							// since entry exists -- grab the location_map_id - and run the update command.
							$sql = "SELECT id from emj_location_markers
									 WHERE entry_id = ?
									 LIMIT 1"; 
							// set params for query
							$params = array(
								$entry_id
							);
							// execute query
							$query = ee()->db->query($sql,$params);
							// check if rows
							if ($query->num_rows() > 0)
							{
								// result set exists.
								$marker_id_obj = $query->result();
								$marker_id_obj = $marker_id_obj[0]->id;
								// set params for query
									$param	= array(
										$lng,
										$lat,
										$location_name,
										$marker_id_obj
									);
									// SQL for update query				
									$update_SQL = "UPDATE emj_location_markers
													SET lng = ?,lat = ?,title = ?
													WHERE id = ?";
													
									// execute query
									$update_query = ee()->db->query($update_SQL,$param);
									// check if success
									if($update_query)
										return true;
									else
										return false;
										
							}
							else
							{
								// get from channel data
								$sql = "SELECT entry_id from emj_channel_data
									 WHERE channel_id = ?
									 AND field_id_53 = ?
									 AND field_id_54 = ?
									 AND field_id_55 = ?
									 AND field_id_56 = ?
									 AND field_id_61 = ?
									 LIMIT 1"; 
								// set params for select query
								$params = array(
									$channel_id,
									$street,
									$city,
									$state,
									$zip,
									$location_name
								);
								// execute select query
								$query = ee()->db->query($sql,$params);
								// check if returned rows
								if ($query->num_rows() > 0)
								{
									// results
									$entry_id_obj = $query->result();
									$entry_id_obj = $entry_id_obj[0]->entry_id;
									// we have an entry id 
									// add the rows to the table.
									// set up params for insert query
									$param	= array(
											$channel_id,
											$entry_id_obj,
											$lng,
											$lat,
											$location_name
										);
										// insert query sql
										$insert_SQL = "INSERT INTO emj_location_markers 
															( channel_id,entry_id,lng,lat,title) 
														VALUES
															(?,?,?,?,?)";
										// execute insert query
										$Insert_query = ee()->db->query($insert_SQL,$param);
										
										if($Insert_query)
											return true;
										else
											return false;
								}
							}
							
							// debug
							/*
							echo "<pre>";
							
								print_r($Insert_query);
							
							echo "</pre>";
							
							exit('still debugging this section -- line number -- ' . __LINE__);	
							*/

					}				
					break;
				default:
					return false;
			}
		}
    }
	private function GetJsonGeoCode($address)
	{
		 /**************************************
		 *     GEOCODING ADDRESS FUNCTION.
		 *     author: Vincent Testa 8/1/14
		 *************************************/
		
		$geoCodeURL = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=".$this->APIKEY;
		// call the results via cURL -> more secure than file_get_contents.
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL            => $geoCodeURL,
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true
		);
		// set opts
		curl_setopt_array($ch, $curlConfig);
		// execute the call and pull the results
		$result = curl_exec($ch);
		// close the connection
		curl_close($ch);
		// set results into array format for easy parsing - and pull the location
		$resultObj = $this->ParseJsonGeoCode($result);						
		return $resultObj;		
	
	}
	private function ParseJsonGeoCode($json)
	{
		// decode json string into an object
		$ArrayResults = json_decode($json);
		
		// grab the location object
		$_location_array = $ArrayResults->results[0]->geometry->location;
		
		// return the location object
		return $_location_array;
						
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