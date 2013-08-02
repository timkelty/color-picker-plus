Color Picker Plus
=================

ExpressionEngine fieldtype add-on with some nice user group permissions for setting preset colors for a channel fieldtype.


Installation Instructions
-----

1. Copy /system/third_party/color_picker_plus/ to /system/expressionengine/third_party/
2. Copy /themes/third_party/color_picker_plus/ to /themes/third_party/
3. Install the module from Add-ons » Modules
4. If not included with module install, install the fieldtype from Add-ons » Fieldtypes
5. Modify the desired settings from Add-ons » Color Picker Plus
 * If you want any member groups to be able to change (save or reset) the Quick Color squares on the right side of the pop-up color picker window, change those groups to "Yes" here.
 * Adjust what the default Quick Colors will be. To reset the default Quick Colors back to Color Picker Plus defaults, click the "Reset to Default Colors" button. Changes here apply to all Color Picker Plus fields/Matrix cells.
 * Users (if their member group has permission) can change the Quick Colors in the pop-up color picker. From within the pop-up, clicking "Reset to defaults" will reset to the color values defined in the module preferences.
 * Quick Color values are a 6-character hexidecimal color value. Example: bright red = hex value "ff0000".
 * Click "Submit" to save any changes.
6. In the Control Panel/Admin/Channel Administration/Channel Fields, Create a New Channel Field Group or edit an existing channel field group. Create/edit a channel field and set/change the fieldtype to Color Picker Plus. Color Picker Plus is also available as a Matrix field cell type.


Usage
-----
* When editing a channel entry that uses a channel field group that has Color Picker Plus field or Matrix cell, the field will display with a background color of the field's value. The field may be edited directly. Clicking the color square next to the field will pop-up the color picker.

* The new color can be selected by any combination of clicking in the big box on the left, adjusting the slider in the color bar, entering H/S/V, RGB, or hexidecimal (#) values, or clicking in one of the Quick Color boxes to the right. Click the "OK" button to save the new color choice in the field. Click the "Cancel" button to cancel the new color choice.

* If the user's member group is set to allow it, the user can change the Quick Colors in the pop-up color picker. Shift + click in any color box to save the new color. The Quick Colors are stored once for the Color Picker Plus fieldtype, and can be changed in any field's or cell's pop-up color picker window. Clicking the "Reset to defaults" button will reset the Quick Colors that are stored in the pop-up color picker windows. The Quick Colors will be reset to what's stored in the preferences for the Color Picker Plus fieldtype.


Programming Notes
-----
* Color Picker Plus uses Digital Magic Productions' jPicker jQuery plugin. http://www.digitalmagicpro.com/jPicker/

* Since jPicker adds code to the page for each instance of the pop-up color picker, Color Picker Plus fieldtype may not scale up well if there are a large number of Color Picker Plus fields or cells in a field group and channel entry.
