Color Picker Plus
=================

An ExpressionEngine fieldtype add-on with user group permissions for setting color presets.


Installation
-----

1. Copy /system/third_party/color_picker_plus/ to /system/expressionengine/third_party/
2. Copy /themes/third_party/color_picker_plus/ to /themes/third_party/
3. Install the module from Add-ons » Modules
4. If not included with module install, install the fieldtype from Add-ons » Fieldtypes


Preferences
-----

Modify the desired settings from Add-ons » Module (or Fieldtype) » Color Picker Plus
 * To grant a member group access to save and reset the fieldtype's Quick Color squares (on the right side of the pop-up color picker window), change the group's setting to "Yes."
 * Adjust what the default Quick Colors will be. To reset the default Quick Colors back to the fieldtype's defaults, click the "Reset to Default Colors" button. Changes here apply to all Color Picker Plus fields/Matrix cells.
 * Users (if their member group has permission) can change the Quick Colors in the pop-up color picker. From within the pop-up, clicking "Reset to defaults" will reset to the color values defined in the module preferences.
 * Quick Color values are a 6-character hexidecimal color value. Example: bright red = hex value "ff0000".
 * Click "Submit" to save any changes.


Usage
-----

* Color Picker Plus is compatible with Matrix.
* In the entry edit view, the field may be edited directly. Clicking the color square next to the field will open the color picker.
* The new color can be selected by any combination of clicking in the big box on the left, adjusting the slider in the color bar, entering H/S/V, RGB, or hexidecimal (#) values, or clicking in one of the Quick Color boxes to the right. Click the "OK" button to save the new color choice in the field. Click the "Cancel" button to cancel the new color choice.
* If the user's member group has permission, the user can change the Quick Colors in the pop-up color picker. Choose a new color then 'shift + click' in any color box to save the new color. The Quick Colors are stored once for the Color Picker Plus fieldtype, and can be changed in any field's pop-up color picker window. Clicking the "Reset to defaults" button will reset the Quick Colors to module's preset Quick Colors.


Programming Notes
-----
* Color Picker Plus uses Digital Magic Productions' jPicker jQuery plugin. http://www.digitalmagicpro.com/jPicker/
* Since jPicker adds code to the page for each instance of the pop-up color picker, Color Picker Plus fieldtype may not scale up well if there are a large number of Color Picker Plus fields or cells in a field group and channel entry.
