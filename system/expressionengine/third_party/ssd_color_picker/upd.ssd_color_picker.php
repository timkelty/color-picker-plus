<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


if (! defined('PATH_THIRD')) define('PATH_THIRD', EE_APPPATH.'third_party/');
require_once PATH_THIRD.'ssd_color_picker/config.php';


/**
 * SSD Color Picker Update Class for EE2
 *
 * @package   The Color Picker
 * @author    Shoe Shine Design & Development
 */
class Ssd_color_picker_upd {

	var $version = SSD_COLOR_PICKER_VER;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	 * Install
	 */
	function install()
	{
		$this->EE->load->dbforge();
		
		$name_no_space = str_replace(' ', '_', SSD_COLOR_PICKER_NAME);
		$this->EE->db->insert('modules', array(
			'module_name'        => $name_no_space,
			'module_version'     => SSD_COLOR_PICKER_VER,
			'has_cp_backend'     => 'y',
			'has_publish_fields' => 'n'
		));
		
		// -------------------------------------------
		//  Create the exp_ssd_color_picker table and populate it
		// -------------------------------------------

		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		if (! $this->EE->db->table_exists($dbTableName)) {
			$query = $this->EE->db->query("CREATE TABLE `" . $dbTableName . "` (
			`row_id` varchar(6) NOT NULL,
			`quickcolor` varchar(8) DEFAULT NULL,
			PRIMARY KEY (`row_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
			
			$query = $this->EE->db->query(
			"INSERT INTO " . $dbTableName . " (row_id, quickcolor)
			VALUES
			('qc00', 'ffaaffff'),
			('qc01', 'ff5656ff'),
			('qc02', 'ff0000ff'),
			('qc03', 'bf0000ff'),
			('qc04', '7f0000ff'),
			('qc05', 'ffffffff'),
			('qc06', 'ffd4aaff'),
			('qc07', 'ffaa56ff'),
			('qc08', 'ff7f00ff'),
			('qc09', 'bf5f00ff'),
			('qc10', '7f3f00ff'),
			('qc11', 'e5e5e5ff'),
			('qc12', 'ffffaaff'),
			('qc13', 'ffff56ff'),
			('qc14', 'ffff00ff'),
			('qc15', 'bfbf00ff'),
			('qc16', '7f7f00ff'),
			('qc17', 'ccccccff'),
			('qc18', 'd4ffaaff'),
			('qc19', 'aaff56ff'),
			('qc20', '7fff00ff'),
			('qc21', '5fbf00ff'),
			('qc22', '3f7f00ff'),
			('qc23', 'b2b2b2ff'),
			('qc24', 'aaffaaff'),
			('qc25', '56ff56ff'),
			('qc26', '00ff00ff'),
			('qc27', '00bf00ff'),
			('qc28', '007f00ff'),
			('qc29', '999999ff'),
			('qc30', 'aaffd4ff'),
			('qc31', '56ffaaff'),
			('qc32', '00ff7fff'),
			('qc33', '00bf5fff'),
			('qc34', '007f3fff'),
			('qc35', '7f7f7fff'),
			('qc36', 'aaffffff'),
			('qc37', '56ffffff'),
			('qc38', '00ffffff'),
			('qc39', '00bfbfff'),
			('qc40', '007f7fff'),
			('qc41', '666666ff'),
			('qc42', 'aad4ffff'),
			('qc43', '56aaffff'),
			('qc44', '007fffff'),
			('qc45', '005fbfff'),
			('qc46', '003f7fff'),
			('qc47', '4c4c4cff'),
			('qc48', 'aaaaffff'),
			('qc49', '5656ffff'),
			('qc50', '0000ffff'),
			('qc51', '0000bfff'),
			('qc52', '00007fff'),
			('qc53', '333333ff'),
			('qc54', 'd4aaffff'),
			('qc55', 'aa56ffff'),
			('qc56', '7f00ffff'),
			('qc57', '5f00bfff'),
			('qc58', '3f007fff'),
			('qc59', '191919ff'),
			('qc60', 'ffaaffff'),
			('qc61', 'ff56ffff'),
			('qc62', 'ff00ffff'),
			('qc63', 'bf00bfff'),
			('qc64', '7f007fff'),
			('qc65', '000000ff'),
			('qc66', 'ffaad4ff'),
			('qc67', 'ff56aaff'),
			('qc68', 'ff007fff'),
			('qc69', 'bf005fff'),
			('qc70', '7f003fff'),
			('qc71', '');"
			);
		} else {
			// table already exists, what needs to be done?
			// if future versions use a different database table structure
			//   may need an update function to add tables/columns or adjust
			//   the table structure, but if the install function is running
			//   the table/s shouldn't exist
		}

		// -------------------------------------------
		//  Create the exp_ssd_color_picker_member_groups table
		// -------------------------------------------

		$groupsdbTableName = $dbTableName . "_member_groups";
		if (! $this->EE->db->table_exists($groupsdbTableName)) {
			$query = $this->EE->db->query("CREATE TABLE `" . $groupsdbTableName . "` (
			`group_id` smallint(4) unsigned NOT NULL,
			`can_save_changes` char(1) DEFAULT 'n',
			PRIMARY KEY (`group_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Update
	 */
	function update($current = '')
	{
		// necessary to get EE to update the version number
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Uninstall
	 */
	function uninstall()
	{
		// remove row from exp_modules
		$name_no_space = str_replace(' ', '_', SSD_COLOR_PICKER_NAME);
		$this->EE->db->delete('modules', array('module_name' => $name_no_space));

		// drop the exp_ssd_color_picker and exp_ssd_color_picker_member_groups tables
		$dbTableName = $this->EE->db->dbprefix . "ssd_color_picker";
		$groupsdbTableName = $dbTableName . "_member_groups";
		$query = $this->EE->db->query("DROP TABLE IF EXISTS `".$dbTableName."`");
		$query = $this->EE->db->query("DROP TABLE IF EXISTS `".$groupsdbTableName."`");

		return TRUE;
	}

}
