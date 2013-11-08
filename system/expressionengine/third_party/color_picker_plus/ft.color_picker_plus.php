<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
ft.color_picker_plus.php
A color picker ExpressionEngine Field Type
*/

class Color_picker_plus_ft extends EE_Fieldtype {

	var $info = array(
	    'name'    => 'Color Picker Plus',
	    'version' => '1.1'
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

		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/css/jPicker-1.1.6.min.css" />');
		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/css/jPicker.css" />');
		// $this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'javascript/compressed/jquery/jquery.js"></script>');
		$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/jpicker-1.1.6.min.js"></script>');
		// $this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/jpicker-1.1.6.js"></script>');

		$sql = 'SELECT field_label FROM '.$this->EE->db->dbprefix.'channel_fields WHERE field_id="'.$this->field_id.'"';
		$results = $this->EE->db->query($sql);
		if ( $results->num_rows() == 0 ) {
			$field_label = $this->field_id;
		} else {
			$result_array = $results->result_array();
			$field_label = $result_array[0]['field_label'];
		}

		$dbTableName = $this->EE->db->dbprefix . "color_picker_plus";
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
			                       ->where('name', 'color_picker_plus')
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
		$imagesPath = URL_THIRD_THEMES.'color_picker_plus/images/';
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
			'class'     => 'color_picker_plus',
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
		if ($this->EE->addons_model->module_installed('color_picker_plus')) {
			$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=color_picker_plus');
		} else {
			$this->EE->lang->loadfile('color_picker_plus');
			$this->EE->session->set_flashdata('message_failure', lang('color_picker_plus_no_module'));
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
			'qc00'      => 'ffaaaa',
			'qc01'      => 'ff5656',
			'qc02'      => 'ff0000',
			'qc03'      => 'bf0000',
			'qc04'      => '7f0000',
			'qc05'      => 'ffffff',
			'qc06'      => 'ffd4aa',
			'qc07'      => 'ffaa56',
			'qc08'      => 'ff7f00',
			'qc09'      => 'bf5f00',
			'qc10'      => '7f3f00',
			'qc11'      => 'e5e5e5',
			'qc12'      => 'ffffaa',
			'qc13'      => 'ffff56',
			'qc14'      => 'ffff00',
			'qc15'      => 'bfbf00',
			'qc16'      => '7f7f00',
			'qc17'      => 'cccccc',
			'qc18'      => 'd4ffaa',
			'qc19'      => 'aaff56',
			'qc20'      => '7fff00',
			'qc21'      => '5fbf00',
			'qc22'      => '3f7f00',
			'qc23'      => 'b2b2b2',
			'qc24'      => 'aaffaa',
			'qc25'      => '56ff56',
			'qc26'      => '00ff00',
			'qc27'      => '00bf00',
			'qc28'      => '007f00',
			'qc29'      => '999999',
			'qc30'      => 'aaffd4',
			'qc31'      => '56ffaa',
			'qc32'      => '00ff7f',
			'qc33'      => '00bf5f',
			'qc34'      => '007f3f',
			'qc35'      => '7f7f7f',
			'qc36'      => 'aaffff',
			'qc37'      => '56ffff',
			'qc38'      => '00ffff',
			'qc39'      => '00bfbf',
			'qc40'      => '007f7f',
			'qc41'      => '666666',
			'qc42'      => 'aad4ff',
			'qc43'      => '56aaff',
			'qc44'      => '007fff',
			'qc45'      => '005fbf',
			'qc46'      => '003f7f',
			'qc47'      => '4c4c4c',
			'qc48'      => 'aaaaff',
			'qc49'      => '5656ff',
			'qc50'      => '0000ff',
			'qc51'      => '0000bf',
			'qc52'      => '00007f',
			'qc53'      => '333333',
			'qc54'      => 'd4aaff',
			'qc55'      => 'aa56ff',
			'qc56'      => '7f00ff',
			'qc57'      => '5f00bf',
			'qc58'      => '3f007f',
			'qc59'      => '191919',
			'qc60'      => 'ffaaff',
			'qc61'      => 'ff56ff',
			'qc62'      => 'ff00ff',
			'qc63'      => 'bf00bf',
			'qc64'      => '7f007f',
			'qc65'      => '000000',
			'qc66'      => 'ffaad4',
			'qc67'      => 'ff56aa',
			'qc68'      => 'ff007f',
			'qc69'      => 'bf005f',
			'qc70'      => '7f003f',
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
		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/css/jPicker-1.1.6.min.css" />');
		$this->EE->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/css/jPicker.css" />');
		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'javascript/compressed/jquery/jquery.js"></script>');
		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/jpicker-1.1.6.min.js"></script>');
//		$this->EE->cp->add_to_head('<script type="text/javascript" src="'.$this->EE->config->item('theme_folder_url').'third_party/color_picker_plus/jpicker-1.1.6.js"></script>');

		$cell_name = $this->cell_name;

		$fieldId = str_replace( '[', '', $cell_name);
		$fieldId = str_replace( ']', '', $fieldId);

		$r['class'] = 'color_picker_plus';
		$r['data'] = '<input type="text" class="jPicker jPickerCell" id="'.$fieldId.'" name="'.$cell_name.'" value="'.$data.'" />';
		
		$field_label = 'Select a color';
		
		$dbTableName = $this->EE->db->dbprefix . "color_picker_plus";
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
			                       ->where('name', 'color_picker_plus')
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
		$imagesPath = URL_THIRD_THEMES.'color_picker_plus/images/';
		$this->EE->javascript->output('
			Matrix.bind("color_picker_plus", "display", function(cell){
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
/* End of file ft.color_picker_plus.php */
/* Location: ./system/expressionengine/third_party/color_picker_plus/ft.color_picker_plus.php */ 