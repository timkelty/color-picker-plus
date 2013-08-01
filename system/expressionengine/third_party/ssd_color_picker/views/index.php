<?php

echo form_open($base.AMP.'method=save_settings');

$this->table->set_template($cp_table_template);
$this->table->set_heading(array(array('style' => 'width: 50%', 'data' => lang('preference')), lang('setting')));

$this->cp->add_to_head('<link rel="stylesheet" media="screen" href="'.$this->config->item('theme_folder_url').'third_party/ssd_color_picker/css/jPicker.css" />');
$this->table->add_row( $groupsList, $groupsSettingList );

$this->table->add_row(
	lang('ssd_color_picker_reset', 'resetqcs'),
	'<span class="resetqcs button submit">'.lang('ssd_color_picker_reset_btn').'</span>'
);
$this->cp->add_to_head('<script type="text/javascript">'.
	'$(document).ready(function() {
		$(".resetqcs").hover(function() {
			$(this).css("cursor", "pointer");
		});				
		$(".resetqcs").click(function() {
			$(\'input[name="qc00"]\').val("ffaaffff");
			$(\'input[name="qc01"]\').val("ff5656ff");
			$(\'input[name="qc02"]\').val("ff0000ff");
			$(\'input[name="qc03"]\').val("bf0000ff");
			$(\'input[name="qc04"]\').val("7f0000ff");
			$(\'input[name="qc05"]\').val("ffffffff");
			$(\'input[name="qc06"]\').val("ffd4aaff");
			$(\'input[name="qc07"]\').val("ffaa56ff");
			$(\'input[name="qc08"]\').val("ff7f00ff");
			$(\'input[name="qc09"]\').val("bf5f00ff");
			$(\'input[name="qc10"]\').val("7f3f00ff");
			$(\'input[name="qc11"]\').val("e5e5e5ff");
			$(\'input[name="qc12"]\').val("ffffaaff");
			$(\'input[name="qc13"]\').val("ffff56ff");
			$(\'input[name="qc14"]\').val("ffff00ff");
			$(\'input[name="qc15"]\').val("bfbf00ff");
			$(\'input[name="qc16"]\').val("7f7f00ff");
			$(\'input[name="qc17"]\').val("ccccccff");
			$(\'input[name="qc18"]\').val("d4ffaaff");
			$(\'input[name="qc19"]\').val("aaff56ff");
			$(\'input[name="qc20"]\').val("7fff00ff");
			$(\'input[name="qc21"]\').val("5fbf00ff");
			$(\'input[name="qc22"]\').val("3f7f00ff");
			$(\'input[name="qc23"]\').val("b2b2b2ff");
			$(\'input[name="qc24"]\').val("aaffaaff");
			$(\'input[name="qc25"]\').val("56ff56ff");
			$(\'input[name="qc26"]\').val("00ff00ff");
			$(\'input[name="qc27"]\').val("00bf00ff");
			$(\'input[name="qc28"]\').val("007f00ff");
			$(\'input[name="qc29"]\').val("999999ff");
			$(\'input[name="qc30"]\').val("aaffd4ff");
			$(\'input[name="qc31"]\').val("56ffaaff");
			$(\'input[name="qc32"]\').val("00ff7fff");
			$(\'input[name="qc33"]\').val("00bf5fff");
			$(\'input[name="qc34"]\').val("007f3fff");
			$(\'input[name="qc35"]\').val("7f7f7fff");
			$(\'input[name="qc36"]\').val("aaffffff");
			$(\'input[name="qc37"]\').val("56ffffff");
			$(\'input[name="qc38"]\').val("00ffffff");
			$(\'input[name="qc39"]\').val("00bfbfff");
			$(\'input[name="qc40"]\').val("007f7fff");
			$(\'input[name="qc41"]\').val("666666ff");
			$(\'input[name="qc42"]\').val("aad4ffff");
			$(\'input[name="qc43"]\').val("56aaffff");
			$(\'input[name="qc44"]\').val("007fffff");
			$(\'input[name="qc45"]\').val("005fbfff");
			$(\'input[name="qc46"]\').val("003f7fff");
			$(\'input[name="qc47"]\').val("4c4c4cff");
			$(\'input[name="qc48"]\').val("aaaaffff");
			$(\'input[name="qc49"]\').val("5656ffff");
			$(\'input[name="qc50"]\').val("0000ffff");
			$(\'input[name="qc51"]\').val("0000bfff");
			$(\'input[name="qc52"]\').val("00007fff");
			$(\'input[name="qc53"]\').val("333333ff");
			$(\'input[name="qc54"]\').val("d4aaffff");
			$(\'input[name="qc55"]\').val("aa56ffff");
			$(\'input[name="qc56"]\').val("7f00ffff");
			$(\'input[name="qc57"]\').val("5f00bfff");
			$(\'input[name="qc58"]\').val("3f007fff");
			$(\'input[name="qc59"]\').val("191919ff");
			$(\'input[name="qc60"]\').val("ffaaffff");
			$(\'input[name="qc61"]\').val("ff56ffff");
			$(\'input[name="qc62"]\').val("ff00ffff");
			$(\'input[name="qc63"]\').val("bf00bfff");
			$(\'input[name="qc64"]\').val("7f007fff");
			$(\'input[name="qc65"]\').val("000000ff");
			$(\'input[name="qc66"]\').val("ffaad4ff");
			$(\'input[name="qc67"]\').val("ff56aaff");
			$(\'input[name="qc68"]\').val("ff007fff");
			$(\'input[name="qc69"]\').val("bf005fff");
			$(\'input[name="qc70"]\').val("7f003fff");
			$(\'input[name="qc71"]\').val("");
		});
	});'
	.'</script>');

$this->table->add_row(lang('ssd_color_picker_qc00', 'qc00'),form_input('qc00', $qc00, 'id="qc00"'));
$this->table->add_row(lang('ssd_color_picker_qc01', 'qc01'),form_input('qc01', $qc01, 'id="qc01"'));
$this->table->add_row(lang('ssd_color_picker_qc02', 'qc02'),form_input('qc02', $qc02, 'id="qc02"'));
$this->table->add_row(lang('ssd_color_picker_qc03', 'qc03'),form_input('qc03', $qc03, 'id="qc03"'));
$this->table->add_row(lang('ssd_color_picker_qc04', 'qc04'),form_input('qc04', $qc04, 'id="qc04"'));
$this->table->add_row(lang('ssd_color_picker_qc05', 'qc05'),form_input('qc05', $qc05, 'id="qc05"'));
$this->table->add_row(lang('ssd_color_picker_qc06', 'qc06'),form_input('qc06', $qc06, 'id="qc06"'));
$this->table->add_row(lang('ssd_color_picker_qc07', 'qc07'),form_input('qc07', $qc07, 'id="qc07"'));
$this->table->add_row(lang('ssd_color_picker_qc08', 'qc08'),form_input('qc08', $qc08, 'id="qc08"'));
$this->table->add_row(lang('ssd_color_picker_qc09', 'qc09'),form_input('qc09', $qc09, 'id="qc09"'));
$this->table->add_row(lang('ssd_color_picker_qc10', 'qc10'),form_input('qc10', $qc10, 'id="qc10"'));
$this->table->add_row(lang('ssd_color_picker_qc11', 'qc11'),form_input('qc11', $qc11, 'id="qc11"'));
$this->table->add_row(lang('ssd_color_picker_qc12', 'qc12'),form_input('qc12', $qc12, 'id="qc12"'));
$this->table->add_row(lang('ssd_color_picker_qc13', 'qc13'),form_input('qc13', $qc13, 'id="qc13"'));
$this->table->add_row(lang('ssd_color_picker_qc14', 'qc14'),form_input('qc14', $qc14, 'id="qc14"'));
$this->table->add_row(lang('ssd_color_picker_qc15', 'qc15'),form_input('qc15', $qc15, 'id="qc15"'));
$this->table->add_row(lang('ssd_color_picker_qc16', 'qc16'),form_input('qc16', $qc16, 'id="qc16"'));
$this->table->add_row(lang('ssd_color_picker_qc17', 'qc17'),form_input('qc17', $qc17, 'id="qc17"'));
$this->table->add_row(lang('ssd_color_picker_qc18', 'qc18'),form_input('qc18', $qc18, 'id="qc18"'));
$this->table->add_row(lang('ssd_color_picker_qc19', 'qc19'),form_input('qc19', $qc19, 'id="qc19"'));
$this->table->add_row(lang('ssd_color_picker_qc20', 'qc20'),form_input('qc20', $qc20, 'id="qc20"'));
$this->table->add_row(lang('ssd_color_picker_qc21', 'qc21'),form_input('qc21', $qc21, 'id="qc21"'));
$this->table->add_row(lang('ssd_color_picker_qc22', 'qc22'),form_input('qc22', $qc22, 'id="qc22"'));
$this->table->add_row(lang('ssd_color_picker_qc23', 'qc23'),form_input('qc23', $qc23, 'id="qc23"'));
$this->table->add_row(lang('ssd_color_picker_qc24', 'qc24'),form_input('qc24', $qc24, 'id="qc24"'));
$this->table->add_row(lang('ssd_color_picker_qc25', 'qc25'),form_input('qc25', $qc25, 'id="qc25"'));
$this->table->add_row(lang('ssd_color_picker_qc26', 'qc26'),form_input('qc26', $qc26, 'id="qc26"'));
$this->table->add_row(lang('ssd_color_picker_qc27', 'qc27'),form_input('qc27', $qc27, 'id="qc27"'));
$this->table->add_row(lang('ssd_color_picker_qc28', 'qc28'),form_input('qc28', $qc28, 'id="qc28"'));
$this->table->add_row(lang('ssd_color_picker_qc29', 'qc29'),form_input('qc29', $qc29, 'id="qc29"'));
$this->table->add_row(lang('ssd_color_picker_qc30', 'qc30'),form_input('qc30', $qc30, 'id="qc30"'));
$this->table->add_row(lang('ssd_color_picker_qc31', 'qc31'),form_input('qc31', $qc31, 'id="qc31"'));
$this->table->add_row(lang('ssd_color_picker_qc32', 'qc32'),form_input('qc32', $qc32, 'id="qc32"'));
$this->table->add_row(lang('ssd_color_picker_qc33', 'qc33'),form_input('qc33', $qc33, 'id="qc33"'));
$this->table->add_row(lang('ssd_color_picker_qc34', 'qc34'),form_input('qc34', $qc34, 'id="qc34"'));
$this->table->add_row(lang('ssd_color_picker_qc35', 'qc35'),form_input('qc35', $qc35, 'id="qc35"'));
$this->table->add_row(lang('ssd_color_picker_qc36', 'qc36'),form_input('qc36', $qc36, 'id="qc36"'));
$this->table->add_row(lang('ssd_color_picker_qc37', 'qc37'),form_input('qc37', $qc37, 'id="qc37"'));
$this->table->add_row(lang('ssd_color_picker_qc38', 'qc38'),form_input('qc38', $qc38, 'id="qc38"'));
$this->table->add_row(lang('ssd_color_picker_qc39', 'qc39'),form_input('qc39', $qc39, 'id="qc39"'));
$this->table->add_row(lang('ssd_color_picker_qc40', 'qc40'),form_input('qc40', $qc40, 'id="qc40"'));
$this->table->add_row(lang('ssd_color_picker_qc41', 'qc41'),form_input('qc41', $qc41, 'id="qc41"'));
$this->table->add_row(lang('ssd_color_picker_qc42', 'qc42'),form_input('qc42', $qc42, 'id="qc42"'));
$this->table->add_row(lang('ssd_color_picker_qc43', 'qc43'),form_input('qc43', $qc43, 'id="qc43"'));
$this->table->add_row(lang('ssd_color_picker_qc44', 'qc44'),form_input('qc44', $qc44, 'id="qc44"'));
$this->table->add_row(lang('ssd_color_picker_qc45', 'qc45'),form_input('qc45', $qc45, 'id="qc45"'));
$this->table->add_row(lang('ssd_color_picker_qc46', 'qc46'),form_input('qc46', $qc46, 'id="qc46"'));
$this->table->add_row(lang('ssd_color_picker_qc47', 'qc47'),form_input('qc47', $qc47, 'id="qc47"'));
$this->table->add_row(lang('ssd_color_picker_qc48', 'qc48'),form_input('qc48', $qc48, 'id="qc48"'));
$this->table->add_row(lang('ssd_color_picker_qc49', 'qc49'),form_input('qc49', $qc49, 'id="qc49"'));
$this->table->add_row(lang('ssd_color_picker_qc50', 'qc50'),form_input('qc50', $qc50, 'id="qc50"'));
$this->table->add_row(lang('ssd_color_picker_qc51', 'qc51'),form_input('qc51', $qc51, 'id="qc51"'));
$this->table->add_row(lang('ssd_color_picker_qc52', 'qc52'),form_input('qc52', $qc52, 'id="qc52"'));
$this->table->add_row(lang('ssd_color_picker_qc53', 'qc53'),form_input('qc53', $qc53, 'id="qc53"'));
$this->table->add_row(lang('ssd_color_picker_qc54', 'qc54'),form_input('qc54', $qc54, 'id="qc54"'));
$this->table->add_row(lang('ssd_color_picker_qc55', 'qc55'),form_input('qc55', $qc55, 'id="qc55"'));
$this->table->add_row(lang('ssd_color_picker_qc56', 'qc56'),form_input('qc56', $qc56, 'id="qc56"'));
$this->table->add_row(lang('ssd_color_picker_qc57', 'qc57'),form_input('qc57', $qc57, 'id="qc57"'));
$this->table->add_row(lang('ssd_color_picker_qc58', 'qc58'),form_input('qc58', $qc58, 'id="qc58"'));
$this->table->add_row(lang('ssd_color_picker_qc59', 'qc59'),form_input('qc59', $qc59, 'id="qc59"'));
$this->table->add_row(lang('ssd_color_picker_qc60', 'qc60'),form_input('qc60', $qc60, 'id="qc60"'));
$this->table->add_row(lang('ssd_color_picker_qc61', 'qc61'),form_input('qc61', $qc61, 'id="qc61"'));
$this->table->add_row(lang('ssd_color_picker_qc62', 'qc62'),form_input('qc62', $qc62, 'id="qc62"'));
$this->table->add_row(lang('ssd_color_picker_qc63', 'qc63'),form_input('qc63', $qc63, 'id="qc63"'));
$this->table->add_row(lang('ssd_color_picker_qc64', 'qc64'),form_input('qc64', $qc64, 'id="qc64"'));
$this->table->add_row(lang('ssd_color_picker_qc65', 'qc65'),form_input('qc65', $qc65, 'id="qc65"'));
$this->table->add_row(lang('ssd_color_picker_qc66', 'qc66'),form_input('qc66', $qc66, 'id="qc66"'));
$this->table->add_row(lang('ssd_color_picker_qc67', 'qc67'),form_input('qc67', $qc67, 'id="qc67"'));
$this->table->add_row(lang('ssd_color_picker_qc68', 'qc68'),form_input('qc68', $qc68, 'id="qc68"'));
$this->table->add_row(lang('ssd_color_picker_qc69', 'qc69'),form_input('qc69', $qc69, 'id="qc69"'));
$this->table->add_row(lang('ssd_color_picker_qc70', 'qc70'),form_input('qc70', $qc70, 'id="qc70"'));
$this->table->add_row(lang('ssd_color_picker_qc71', 'qc71'),form_input('qc71', $qc71, 'id="qc71"'));

echo $this->table->generate();

echo form_submit(array('name' => 'submit', 'value' => lang('submit'), 'class' => 'submit'));
echo form_close();

?>
