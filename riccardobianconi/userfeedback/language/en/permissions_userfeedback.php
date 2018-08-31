<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACL_U_USERFEEDBACK_ACCESS'			=> 'Can access User Feedback extension',
	'ACL_U_USERFEEDBACK_ADD'			=> 'Can add feedback',
	'ACL_U_USERFEEDBACK_EDIT'			=> 'Can edit his feedback',
	'ACL_U_USERFEEDBACK_DELETE'			=> 'Can delete his feedback',
	'ACL_U_USERFEEDBACK_ADDMORE'		=> 'Can add more than a feedback per user',
	'ACL_U_USERFEEDBACK_IGNOREFLOOD'	=> 'Can ignore flood limit',
	'ACL_U_USERFEEDBACK_BBCODE'			=> 'Can use bbcode in comments',
	'ACL_U_USERFEEDBACK_SMILIES'		=> 'Can use smilies in comments',
	'ACL_M_USERFEEDBACK_EDIT'			=> 'Can edit feedback',
	'ACL_M_USERFEEDBACK_DELETE'			=> 'Can delete feedback',
	'ACL_M_USERFEEDBACK_VIEWIP'			=> 'Can view IPs',
	'ACL_A_USERFEEDBACK_SETTINGS'		=> 'Can edit User Feedback settings',
));
