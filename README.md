MenuBuilder
===========

General menu building class for PHP, takes in an array, returns a number of useful formats.

The array structure for a single menu item looks like this:

array(
	'menuItem' => array(
		'id' => string,
		'class' => array|string|null,
		'filters' => array|string|null,
		'contents' => array(
			'text' => string|null,
			'url' => string|null
			'target' => string|null
			'onclick' => string|null
			'style' => string|null
		),
		'children' => array(menuItems)|null
	),
)



You can submenu as much as you'd like, just by inserting menu-blocks into the 'children' value of its parent

Description of each key:

id : unique id for this menu item.  Optional, if it isn't provided, the system will id each item with a menu_#

class : array of classes (or single class) to apply to the menu item.  Optional

filters : Optional restrictions for this menu item. Building a menu takes on a array|string param containing filters

contents : Menu item contents

	text : Text in display

	url : optional url

	target : optional url target

	onclick : optional onclick call

	style : optional inline style adjustments

children : Optional location to place submenu items.  All submenus must follow the same structure as the parent.

