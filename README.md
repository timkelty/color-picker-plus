SSDD Color Picker
================

ExpressionEngine fieldtype add-on with some nice user group permissions for setting preset colors for a channel fieldtype.


Installation Instructions

1. In system/expressionengine/third_party, create a folder named "ssd_color_picker" and copy
	language folder
	views folder
	config.php
	ft.ssd_color_picker.php
	mcp.ssd_color_picker.php
	upd.ssd_color_picker.php
into it.

2. In themes/third_party, create a folder named "ssd_color_picker" and copy
	css folder
	images folder
	jpicker-1.1.6.js
	jpicker-1.1.6.min.js
into it.

3. In the Control Panel/Add-ons/Fieldtypes click Install for the SSD Color Picker fieldtype. Install both the Fieldtype and the Module.

4. Preferences

Click the fieldtype name, "SSD Color Picker" to edit the fieldtype preferences.

If you want any member groups to be able to change (save or reset) the Quick Color squares on the right side of the pop-up color picker window, change those groups to "Yes" here, and then click the Submit button at the bottom of the page to save the preferences.

You can also adjust what the default Quick Colors will be. To reset the default Quick Colors back to the SSD Color Picker defaults, click the "Reset to Default Colors" button. Click the Submit button at the bottom of the page to save the changes.

The Quick Color fields in the field/cell preferences are stored once for the SSD Color Picker fieldtype/Matrix celltype. Changes here apply to all SSD Color Picker fields/Matrix cells.

Users (if their member group is set to allow it) can change the Quick Colors in the pop-up color picker. If they click the "Reset to defaults" button in the pop-up color picker, the Quick Colors there will be reset to the values set here in the fieldtype preferences.

Quick Color values are a 6-character hexidecimal color value plus a 2-character alpha channel hexidecimal value. Enter the alpha value as "ff." The SSD Color Picker fieldtype may support alpha values in a future version.

Example: bright red = hex value "ff0000". Adding the alpha value "ff" gives "ff0000ff"

Click the "Update" button at the bottom of the screen to save the changes.

5. In the Control Panel/Admin/Channel Administration/Channel Fields, Create a New Channel Field Group or edit an existing channel field group. Create/edit a channel field and set/change the fieldtype to SSD Color Picker. SSD Color Picker is also available as a Matrix field cell type.


Usage
When editing a channel entry that uses a channel field group that has a SSD Color Picker field or Matrix cell, the field/cell will display with a background color of the field's/cell's value. The field may be edited directly. Clicking the color square next to the field will pop up the color picker.

The new color can be selected by any combination of clicking in the big box on the left, adjusting the slider in the color bar, entering H/S/V, RGB, or hexidecimal (#) values, or clicking in one of the Quick Color boxes to the right. Click the "OK" button to save the new color choice in the field. Click the "Cancel" button to cancel the new color choice.

If the user's member group is set to allow it, the user can change the Quick Colors in the pop-up color picker. Shift + click in any color box to save the new color. The Quick Colors are stored once for the SSD Color Picker fieldtype, and can be changed in any field's or cell's pop-up color picker window. Clicking the "Reset to defaults" button will reset the Quick Colors that are stored in the pop-up color picker windows. The Quick Colors will be reset to what's stored in the preferences for the SSD Color Picker fieldtype.


Programming Notes
The SSD Color Picker fieldtype for ExpressionEngine uses Digital Magic Productions' jPicker jQuery plugin. http://www.digitalmagicpro.com/jPicker/

Since jPicker adds code to the page for each instance of the pop-up color picker, the SSD Color Picker fieldtype may not scale up well if there are a large number of SSD Color Picker fields or cells in a field group and channel entry.