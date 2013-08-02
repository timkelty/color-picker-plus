<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
ft.ssd_color_picker.php
An advanced color picker ExpressionEngine FieldType
*/

class Ssd_color_picker_ft extends EE_Fieldtype {

	var $info = array(
	    'name'    => 'The Color Picker',
	    'version' => '1.0'
	);

	/**
	 * Display Field
	 * 
	 * @return string  The field's HTML
	 */
	function display_field($data)
	{
		$this->EE =& get_instance();
		$this->EE->load->helper('form');

		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/css/jPicker-1.1.6.min.css" />');
		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/css/jPicker.css" />');
		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'javascript/compressed/jquery/jquery.js"></script>');
		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/jpicker-1.1.6.min.js"></script>');
//		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/jpicker-1.1.6.js"></script>');

		$sql = 'SELECT field_label FROM '.$this->EE->db->dbprefix.'channel_fields WHERE field_id="'.$this->field_id.'"';
		$results = $this->EE->db->query($sql);
		if ( $results->num_rows() == 0 ) {
			$field_label = $this->field_id;
		} else {
			$result_array = $results->result_array();
			$field_label = $result_array[0]['field_label'];
		}

		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		$query = $this->EE->db->query("SHOW TABLES LIKE '".$dbTableName."'");
		if ($query->num_rows() > 0) {
			$query = $this->EE->db->query("SELECT row_id, quickcolor FROM " . $dbTableName . " ORDER BY row_id;");
			$quicklist_str = '';
			foreach ($query->result_array() as $row) {
				if (!($row['quickcolor']=='')) {
					$quicklist_str        .= 'new $.jPicker.Color({ ahex: "'.$row['quickcolor']      .'" }),';
				} else {
					$quicklist_str        .= 'new $.jPicker.Color(),';
				}
			}		
			// drop trailing comma
			$quicklist_str = substr($quicklist_str, 0, -1);
		} else {
			// settings db table doesn't exist or can't be accessed, fill in with hard-coded jPicker presets
			$quicklist_str = '';
		}

		$quicklistdefault_str = '';
		$query = get_instance()->db->select('settings')
			                       ->where('name', 'ssd_color_picker')
			                       ->get('fieldtypes');
		$settings = unserialize(base64_decode($query->row('settings')));
		for ($i=0; $i<=71; $i++) {
			$istr = substr('00'.$i, -2);
			$ikey = 'qc'.$istr;
			if (!($settings[$ikey]=='')) {
				$quicklistdefault_str .= 'new $.jPicker.Color({ ahex: "'.$settings[$ikey] .'" }),';
			} else {
				$quicklistdefault_str .= 'new $.jPicker.Color(),';
			}
		}
		// drop trailing comma
		$quicklistdefault_str = substr($quicklistdefault_str, 0, -1);

		$usersMemberGroupId = $this->EE->session->userdata('group_id');
		$groupsdbTableName = $dbTableName . "_member_groups";
	    $sql = 'SELECT can_save_changes FROM '.$groupsdbTableName.' WHERE group_id = '.$usersMemberGroupId.';';
		$results = $this->EE->db->query($sql);
		if ( $results->num_rows() > 0 ) {
			$resultArray = $results->result_array();
			$can_save_changes = $resultArray[0]['can_save_changes'];
		} else {
			$can_save_changes = 'n';
		}

		/* plain pop-up color picker
		*/
		$imagesPath = URL_THIRD_THEMES.'ssd_color_picker/images/';
		$this->EE->javascript->output('
			$("input[name='.$this->field_name.']").jPicker(
				{
					window:
					{
						title:"'.$field_label.'"
					},
					color:
					{
						quickList: [ '.$quicklist_str.' ],
						quickListDefault: [ '.$quicklistdefault_str.' ]
					},
					images:
					{
						clientPath:"'.$imagesPath.'"
					},
					updateurl:"'.$this->EE->config->config['cp_url'].'?D=cp",
					cansavechanges:"'.$can_save_changes.'"
				}
			);
		');

		$form = form_input (array(
			'name'      => $this->field_name,
			'value'     => $data,
			'size'      => '8',
			'maxlength' => '8',
			'class'     => 'ssd_color_picker',
			'style'     => 'width:60px; position: relative; height: 23px; margin-right: 4px; top: 4px;'
		));

		return $form;

	}

	// --------------------------------------------------------------------

	/**
	 * Display Global Settings
	 */
	function display_global_settings()
	{
		if ($this->EE->addons_model->module_installed('ssd_color_picker')) {
			$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=ssd_color_picker');
		} else {
			$this->EE->lang->loadfile('ssd_color_picker');
			$this->EE->session->set_flashdata('message_failure', lang('ssd_color_picker_no_module'));
			$this->EE->functions->redirect(BASE.AMP.'C=addons_modules');
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Install Fieldtype
	 *
	 * @access	public
	 * @return	default global settings
	 *
	 */
	function install()
	{		
		// -------------------------------------------
		// Create the default preferences
		// -------------------------------------------
		$settings = array(
			'qc00'      => 'ffaaffff',
			'qc01'      => 'ff5656ff',
			'qc02'      => 'ff0000ff',
			'qc03'      => 'bf0000ff',
			'qc04'      => '7f0000ff',
			'qc05'      => 'ffffffff',
			'qc06'      => 'ffd4aaff',
			'qc07'      => 'ffaa56ff',
			'qc08'      => 'ff7f00ff',
			'qc09'      => 'bf5f00ff',
			'qc10'      => '7f3f00ff',
			'qc11'      => 'e5e5e5ff',
			'qc12'      => 'ffffaaff',
			'qc13'      => 'ffff56ff',
			'qc14'      => 'ffff00ff',
			'qc15'      => 'bfbf00ff',
			'qc16'      => '7f7f00ff',
			'qc17'      => 'ccccccff',
			'qc18'      => 'd4ffaaff',
			'qc19'      => 'aaff56ff',
			'qc20'      => '7fff00ff',
			'qc21'      => '5fbf00ff',
			'qc22'      => '3f7f00ff',
			'qc23'      => 'b2b2b2ff',
			'qc24'      => 'aaffaaff',
			'qc25'      => '56ff56ff',
			'qc26'      => '00ff00ff',
			'qc27'      => '00bf00ff',
			'qc28'      => '007f00ff',
			'qc29'      => '999999ff',
			'qc30'      => 'aaffd4ff',
			'qc31'      => '56ffaaff',
			'qc32'      => '00ff7fff',
			'qc33'      => '00bf5fff',
			'qc34'      => '007f3fff',
			'qc35'      => '7f7f7fff',
			'qc36'      => 'aaffffff',
			'qc37'      => '56ffffff',
			'qc38'      => '00ffffff',
			'qc39'      => '00bfbfff',
			'qc40'      => '007f7fff',
			'qc41'      => '666666ff',
			'qc42'      => 'aad4ffff',
			'qc43'      => '56aaffff',
			'qc44'      => '007fffff',
			'qc45'      => '005fbfff',
			'qc46'      => '003f7fff',
			'qc47'      => '4c4c4cff',
			'qc48'      => 'aaaaffff',
			'qc49'      => '5656ffff',
			'qc50'      => '0000ffff',
			'qc51'      => '0000bfff',
			'qc52'      => '00007fff',
			'qc53'      => '333333ff',
			'qc54'      => 'd4aaffff',
			'qc55'      => 'aa56ffff',
			'qc56'      => '7f00ffff',
			'qc57'      => '5f00bfff',
			'qc58'      => '3f007fff',
			'qc59'      => '191919ff',
			'qc60'      => 'ffaaffff',
			'qc61'      => 'ff56ffff',
			'qc62'      => 'ff00ffff',
			'qc63'      => 'bf00bfff',
			'qc64'      => '7f007fff',
			'qc65'      => '000000ff',
			'qc66'      => 'ffaad4ff',
			'qc67'      => 'ff56aaff',
			'qc68'      => 'ff007fff',
			'qc69'      => 'bf005fff',
			'qc70'      => '7f003fff',
			'qc71'      => ''
		);
		return $settings;
	}

	// --------------------------------------------------------------------

	/**
	 * Uninstall Fieldtype
	 *
	 * @access	public
	 * 
	 */
	function uninstall()
	{
		parent::uninstall();
	}

	// --------------------------------------------------------------------

	/**
	 * Display Cell
	 * 
	 * @return string  The field's HTML
	 *
	 */
	function display_cell($data)
	{
		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/css/jPicker-1.1.6.min.css" />');
		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/css/jPicker.css" />');
		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'javascript/compressed/jquery/jquery.js"></script>');
		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/jpicker-1.1.6.min.js"></script>');
//		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/ssd_color_picker/jpicker-1.1.6.js"></script>');

		$cell_name = $this->cell_name;

		$fieldId = str_replace( '[', '', $cell_name);
		$fieldId = str_replace( ']', '', $fieldId);

		$r['class'] = 'ssd_color_picker';
		$r['data'] = '<input type="text" class="jPicker jPickerCell" id="'.$fieldId.'" name="'.$cell_name.'" value="'.$data.'" />';
		
		$field_label = 'Select a color';
		
		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		$query = $this->EE->db->query("SHOW TABLES LIKE '".$dbTableName."'");
		if ($query->num_rows() > 0) {
			$query = $this->EE->db->query("SELECT row_id, quickcolor FROM " . $dbTableName . " ORDER BY row_id;");
			$quicklist_str = '';
			foreach ($query->result_array() as $row) {
				if (!($row['quickcolor']=='')) {
					$quicklist_str        .= 'new $.jPicker.Color({ ahex: "'.$row['quickcolor']      .'" }),';
				} else {
					$quicklist_str        .= 'new $.jPicker.Color(),';
				}
			}		
			// drop trailing comma
			$quicklist_str = substr($quicklist_str, 0, -1);
		} else {
			// settings db table doesn't exist or can't be accessed, fill in with hard-coded jPicker presets
			$quicklist_str = '';
		}

		$quicklistdefault_str = '';
		$query = get_instance()->db->select('settings')
			                       ->where('name', 'ssd_color_picker')
			                       ->get('fieldtypes');
		$settings = unserialize(base64_decode($query->row('settings')));
		for ($i=0; $i<=71; $i++) {
			$istr = substr('00'.$i, -2);
			$ikey = 'qc'.$istr;
			if (!($settings[$ikey]=='')) {
				$quicklistdefault_str .= 'new $.jPicker.Color({ ahex: "'.$settings[$ikey] .'" }),';
			} else {
				$quicklistdefault_str .= 'new $.jPicker.Color(),';
			}
		}
		// drop trailing comma
		$quicklistdefault_str = substr($quicklistdefault_str, 0, -1);

		$usersMemberGroupId = $this->EE->session->userdata('group_id');
		$groupsdbTableName = $dbTableName . "_member_groups";
		$sql = 'SELECT can_save_changes FROM '.$groupsdbTableName.' WHERE group_id = '.$usersMemberGroupId.';';
		$results = $this->EE->db->query($sql);
		if ( $results->num_rows() > 0 ) {
			$resultArray = $results->result_array();
			$can_save_changes = $resultArray[0]['can_save_changes'];
		} else {
			$can_save_changes = 'n';
		}

		/* plain pop-up color picker 
		*/
		$imagesPath = URL_THIRD_THEMES.'ssd_color_picker/images/';
		$this->EE->javascript->output('
			Matrix.bind("ssd_color_picker", "display", function(cell){
				$(\'.jPickerCell\').each(function() {
					if (!$(this).next().hasClass(\'jPicker\')) {
						$(this).jPicker(
							{
								window:
								{
									title: "'.$field_label.'"
								},
								color:
								{
									quickList: [ '.$quicklist_str.' ],
									quickListDefault: [ '.$quicklistdefault_str.' ]
								},
								images:
								{
									clientPath:"'.$imagesPath.'"
								},
								updateurl:"'.$this->EE->config->config['cp_url'].'?D=cp",
								cansavechanges:"'.$can_save_changes.'"
							}
						);
					}
				});
			});
		');
		
		return $r;
	}

	// --------------------------------------------------------------------


} 	/* END class */
/* End of file ft.ssd_color_picker.php */
/* Location: ./system/expressionengine/third_party/ssd_color_picker/ft.ssd_color_picker.php */ 