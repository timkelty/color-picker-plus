<?php if (! defined('BASEPATH')) exit('Invalid file request');

/**
 * SSD Color Picker Module CP Class for EE2
 *
 * @package   SSD Color Picker
 * @author    John Langer
 */
class Ssd_color_picker_mcp {

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();

		if (REQ == 'CP')
		{
			$this->base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=ssd_color_picker';

			// Set the right nav
			$this->EE->cp->set_right_nav(array(
				'ssd_color_picker_settings' => BASE.AMP.$this->base.AMP.'method=index'
			));
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Update QuickColor choice
	 */
	function qcupdate()
	{
		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		$query = $this->EE->db->query("SHOW TABLES LIKE '".$dbTableName."'");
		if ($query->num_rows() > 0) {
			// if row_id and quickcolor GET paramaters are set
			// just process this one (shift-click to save one quickcolor)
			$row_id = $this->EE->input->get('row_id');
			$quickcolor = $this->EE->input->get('quickcolor');
			if ($row_id && ($quickcolor !== FALSE)) {
				$data = array('quickcolor' => $quickcolor);
				$sql = $this->EE->db->update_string($dbTableName, $data, "row_id = '".$row_id."'");
				$this->EE->db->query($sql);		
			}

			// if quickListDefault GET parameter is set
			// process everything (reset all to defaults)
			$quickListDefault = $this->EE->input->get('quickListDefault');			
			if ($quickListDefault !== FALSE) {
				$quickListDefaultArray = explode(",", $quickListDefault);
				// for each element in quickListDefault
				foreach ($quickListDefaultArray as $key => $value){
					$leadingZero = '';
					if ($key < 10) {
						$leadingZero = "0";
					}
					$row_id = "qc" . $leadingZero . $key;
					if ($value == 'null') {
						$value = NULL;
					}
					$data = array('quickcolor' => $value);
					$sql = $this->EE->db->update_string($dbTableName, $data, "row_id = '".$row_id."'");
					$this->EE->db->query($sql);
				}
			}
		} else {
			// table doesn't exist
		}
	}

	// --------------------------------------------------------------------
	/**
	 * Set Page Title
	 */
	private function _set_page_title($line = 'ssd_color_picker_module_name')
	{
		if ($line != 'ssd_color_picker_module_name')
		{
			$this->EE->cp->set_breadcrumb(BASE.AMP.$this->base, $this->EE->lang->line('ssd_color_picker_module_name'));
		}

		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line($line));
	}

	// --------------------------------------------------------------------

	/**
	 * Index
	 */
	function index()
	{
		$this->EE->load->library('table');
		$this->_set_page_title();
		$vars['base'] = $this->base;
		$defaults = array(
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
		$query = get_instance()->db->select('settings')
			                       ->where('name', 'ssd_color_picker')
			                       ->get('fieldtypes');
		$settings = unserialize(base64_decode($query->row('settings')));

		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		$groupsdbTableName = $dbTableName . "_member_groups";
		
		// get list of Member Groups that already have a row in exp_ssd_color_picker_member_groups
		$cpmgArr = array();
		$cpmgSql = 'SELECT group_id, can_save_changes FROM '.$groupsdbTableName;
		$cpmgResults = $this->EE->db->query($cpmgSql);
		if ($cpmgResults->num_rows() > 0) {
			foreach ($cpmgResults->result_array() as $cpmgRow) {
				$cpmgArr[$cpmgRow['group_id']] = $cpmgRow['can_save_changes'];
			}
		}

		// get list of Member Groups
		$groupsList = '<ul>Member Group<br /><br />';
		$groupsSettingList = '<ul>Can Save/Reset Quick Colors<br /><br />';
		$sql = 'SELECT group_id, group_title FROM '.$this->EE->db->dbprefix.'member_groups';
		$results = $this->EE->db->query($sql);
		if ( $results->num_rows() > 0 ) {
			foreach ($results->result_array() as $row) {
				$group_id = $row['group_id'];
				if (!array_key_exists($group_id, $cpmgArr)) {
					$cpmgArr["$group_id"] = 'n';
					$addSql = 'INSERT INTO '.$groupsdbTableName.' (group_id, can_save_changes) VALUES ('.$group_id.', \'n\') ON DUPLICATE KEY UPDATE can_save_changes=\'n\';'; 
					$addResults = $this->EE->db->query($addSql);
				}
				$yChecked = $cpmgArr["$group_id"] == 'y' ? 'checked' : '';
				$nChecked = $cpmgArr["$group_id"] != 'y' ? 'checked' : '';
				$groupsList.= '<li class="ssdcpPrefs">' . $row['group_title'] . '</li>';
				$groupsSettingList.= '<li class="ssdcpPrefs"><input type="radio" name="group_id_'.$row['group_id'].'" value="y" ' . $yChecked . '/>Yes&nbsp;&nbsp;<input type="radio" name="group_id_'.$row['group_id'].'" value="n" ' . $nChecked . '/>No</li>';
			}
		}
		$groupsList.= '</ul>';
		$groupsSettingList.= '</ul>';
		$vars['groupsList'] = $groupsList;
		$vars['groupsSettingList'] = $groupsSettingList;

		$vars = array_merge($vars, $defaults, $settings);

		return $this->EE->load->view('index', $vars, TRUE);
	}

	/**
	 * Save Settings
	 */
	function save_settings()
	{
		$settings = array(
			'qc00'      => $this->EE->input->post('qc00'),
			'qc01'      => $this->EE->input->post('qc01'),
			'qc02'      => $this->EE->input->post('qc02'),
			'qc03'      => $this->EE->input->post('qc03'),
			'qc04'      => $this->EE->input->post('qc04'),
			'qc05'      => $this->EE->input->post('qc05'),
			'qc06'      => $this->EE->input->post('qc06'),
			'qc07'      => $this->EE->input->post('qc07'),
			'qc08'      => $this->EE->input->post('qc08'),
			'qc09'      => $this->EE->input->post('qc09'),
			'qc10'      => $this->EE->input->post('qc10'),
			'qc11'      => $this->EE->input->post('qc11'),
			'qc12'      => $this->EE->input->post('qc12'),
			'qc13'      => $this->EE->input->post('qc13'),
			'qc14'      => $this->EE->input->post('qc14'),
			'qc15'      => $this->EE->input->post('qc15'),
			'qc16'      => $this->EE->input->post('qc16'),
			'qc17'      => $this->EE->input->post('qc17'),
			'qc18'      => $this->EE->input->post('qc18'),
			'qc19'      => $this->EE->input->post('qc19'),
			'qc20'      => $this->EE->input->post('qc20'),
			'qc21'      => $this->EE->input->post('qc21'),
			'qc22'      => $this->EE->input->post('qc22'),
			'qc23'      => $this->EE->input->post('qc23'),
			'qc24'      => $this->EE->input->post('qc24'),
			'qc25'      => $this->EE->input->post('qc25'),
			'qc26'      => $this->EE->input->post('qc26'),
			'qc27'      => $this->EE->input->post('qc27'),
			'qc28'      => $this->EE->input->post('qc28'),
			'qc29'      => $this->EE->input->post('qc29'),
			'qc30'      => $this->EE->input->post('qc30'),
			'qc31'      => $this->EE->input->post('qc31'),
			'qc32'      => $this->EE->input->post('qc32'),
			'qc33'      => $this->EE->input->post('qc33'),
			'qc34'      => $this->EE->input->post('qc34'),
			'qc35'      => $this->EE->input->post('qc35'),
			'qc36'      => $this->EE->input->post('qc36'),
			'qc37'      => $this->EE->input->post('qc37'),
			'qc38'      => $this->EE->input->post('qc38'),
			'qc39'      => $this->EE->input->post('qc39'),
			'qc40'      => $this->EE->input->post('qc40'),
			'qc41'      => $this->EE->input->post('qc41'),
			'qc42'      => $this->EE->input->post('qc42'),
			'qc43'      => $this->EE->input->post('qc43'),
			'qc44'      => $this->EE->input->post('qc44'),
			'qc45'      => $this->EE->input->post('qc45'),
			'qc46'      => $this->EE->input->post('qc46'),
			'qc47'      => $this->EE->input->post('qc47'),
			'qc48'      => $this->EE->input->post('qc48'),
			'qc49'      => $this->EE->input->post('qc49'),
			'qc50'      => $this->EE->input->post('qc50'),
			'qc51'      => $this->EE->input->post('qc51'),
			'qc52'      => $this->EE->input->post('qc52'),
			'qc53'      => $this->EE->input->post('qc53'),
			'qc54'      => $this->EE->input->post('qc54'),
			'qc55'      => $this->EE->input->post('qc55'),
			'qc56'      => $this->EE->input->post('qc56'),
			'qc57'      => $this->EE->input->post('qc57'),
			'qc58'      => $this->EE->input->post('qc58'),
			'qc59'      => $this->EE->input->post('qc59'),
			'qc60'      => $this->EE->input->post('qc60'),
			'qc61'      => $this->EE->input->post('qc61'),
			'qc62'      => $this->EE->input->post('qc62'),
			'qc63'      => $this->EE->input->post('qc63'),
			'qc64'      => $this->EE->input->post('qc64'),
			'qc65'      => $this->EE->input->post('qc65'),
			'qc66'      => $this->EE->input->post('qc66'),
			'qc67'      => $this->EE->input->post('qc67'),
			'qc68'      => $this->EE->input->post('qc68'),
			'qc69'      => $this->EE->input->post('qc69'),
			'qc70'      => $this->EE->input->post('qc70'),
			'qc71'      => $this->EE->input->post('qc71')
		);

		$data['settings'] = base64_encode(serialize($settings));

		$this->EE->db->where('name', 'ssd_color_picker');
		$this->EE->db->update('fieldtypes', $data);

		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		$groupsdbTableName = $dbTableName . "_member_groups";

		$sql = 'SELECT group_id FROM '.$this->EE->db->dbprefix.'member_groups';
		$results = $this->EE->db->query($sql);
		if ( $results->num_rows() > 0 ) {
			foreach ($results->result_array() as $row) {
				$group_id = $row['group_id'];
				$postName = 'group_id_'.$group_id;
				$postValue = $this->EE->input->post($postName)=='y' ? 'y' : 'n';
				$addSql = 'INSERT INTO '.$groupsdbTableName.' (group_id, can_save_changes) VALUES ('.$group_id.', \''.$postValue.'\') ON DUPLICATE KEY UPDATE can_save_changes=\''.$postValue.'\';'; 
				$addResults = $this->EE->db->query($addSql);
			}
		}

		// redirect to Index
		$this->EE->session->set_flashdata('message_success', lang('global_settings_saved'));
		$this->EE->functions->redirect(BASE.AMP.$this->base);
	}

}
