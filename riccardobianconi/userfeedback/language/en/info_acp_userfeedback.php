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
	'ACP_CAT_USERFEEDBACK'						=> 'User Feedback',
	'ACP_USERFEEDBACK'							=> 'User Feedback',
	'ACP_USERFEEDBACK_PREFS'					=> 'Preferences',
	'ACP_USERFEEDBACK_MANAGE'					=> 'Manage Feedback',
	// Preferences
	'ACP_USERFEEDBACK_PERM_EXPLAIN'				=> '
	<p>To set user and moderators powers go to Permissions -> Groups’ Permissions<br />then for every group set the permissions inside category “Feedback” as you want.</p>
	',
	'ACP_USERFEEDBACK_ROLE_SET'					=> 'Role Settings',
	'ACP_USERFEEDBACK_ROLE_ENABLE'				=> 'Add Role field in feedback',
	'ACP_USERFEEDBACK_SCORE_ENABLE'				=> 'Enable score system',
	'ACP_USERFEEDBACK_SCORE_POS'				=> 'Positive multiplier',
	'ACP_USERFEEDBACK_SCORE_NEU'				=> 'Neutral multiplier',
	'ACP_USERFEEDBACK_SCORE_NEG'				=> 'Negative multiplier',
	'ACP_USERFEEDBACK_LINK_SET'					=> 'Link Settings',
	'ACP_USERFEEDBACK_LINK_ENABLE'				=> 'Add Topic Link field in feedback<br />(if set to “no”, next options will be ignored)',
	'ACP_USERFEEDBACK_LINK_FORCE'				=> 'Topic link is required',
	'ACP_USERFEEDBACK_LINK_FORCE_IN'			=> 'One of the traders must have created the linked topic',
	'ACP_USERFEEDBACK_LINK_FORUM'				=> 'Linked topic has to be in one of these forums<br />(leave blank if you don’t want this check)',
	'ACP_USERFEEDBACK_LINK_FORUM_D'				=> 'Forum IDs comma separated (ex: 1,3,4)',
	'ACP_USERFEEDBACK_COMM_SET'					=> 'Comment Settings',
	'ACP_USERFEEDBACK_COMM_MINCHARS'			=> 'Minimum length (in characters)',
	'ACP_USERFEEDBACK_COMM_MAXCHARS'			=> 'Maximum length (in characters)',
	'ACP_USERFEEDBACK_COMM_URL'					=> 'URL inserted will become a clickable Link',
	'ACP_USERFEEDBACK_ANTIFLOOD'				=> 'Anti-flood',
	'ACP_USERFEEDBACK_ANTIFLOOD_DESC'			=> 'Amount of time, in seconds, after a user can insert a new feedback',
	'ACP_USERFEEDBACK_ANTIFLOOD_SAME'			=> 'Amount of time, in seconds, after a user can insert a new feedback to the same user',
	'ACP_USERFEEDBACK_RANKINGS'					=> 'Rankings',
	'ACP_USERFEEDBACK_TOP_MAIN'					=> 'Users shown on Best/Worst in main page',
	'ACP_USERFEEDBACK_TOP_BEST'					=> 'Users shown on Best Users page',
	'ACP_USERFEEDBACK_TOP_WORST'				=> 'Users shown on Worst Users page',
	'ACP_USERFEEDBACK_IGNOREDACP'				=> '(ignored in ACP)',
	'ACP_USERFEEDBACK_CONFUPDATED'				=> 'Feedback settings updated',
	'ACP_USERFEEDBACK_PAG_SET'					=> 'Pagination Settings',
	'ACP_USERFEEDBACK_PAG_SET_D'				=> 'Set 0 to disable pagination',
	'ACP_USERFEEDBACK_PAG_FEEDBACKS_PER_PAGE'	=> 'Feedbacks per page in details',
	// Manage
	'ACP_USERFEEDBACK_SEARCH'					=> 'Search User',
	'ACP_USERFEEDBACK_FEEDBACK'					=> 'Feedback',
	'ACP_USERFEEDBACK_FEEDBACKOF'				=> 'Feedback of',
	'ACP_USERFEEDBACK_SCORE'					=> 'Score',
	'ACP_USERFEEDBACK_PERCENTAGE'				=> 'Positive Feedback',
	'ACP_USERFEEDBACK_BUYER'					=> 'Buyer',
	'ACP_USERFEEDBACK_SELLER'					=> 'Seller',
	'ACP_USERFEEDBACK_TRADE'					=> 'Trade',
	'ACP_USERFEEDBACK_POS'						=> 'Positive',
	'ACP_USERFEEDBACK_NEU'						=> 'Neutral',
	'ACP_USERFEEDBACK_NEG'						=> 'Negative',
	'ACP_USERFEEDBACK_NUM_FEEDBACKS'			=> array(
		1	=> '%d feedback',
		2	=> '%d feedbacks',
	),
	'ACP_USERFEEDBACK_LINK'						=> 'Trade topic ID',
	'ACP_USERFEEDBACK_LINKOPT'					=> 'Trade topic ID (optional)',
	'ACP_USERFEEDBACK_ADD'						=> 'Add Feedback',
	'ACP_USERFEEDBACK_EDIT'						=> 'Edit Feedback',
	'ACP_USERFEEDBACK_DELETE'					=> 'Delete Feedback',
	'ACP_USERFEEDBACK_ADDED'					=> 'Feedback added, you’ll be redirected to user feedback in seconds.',
	'ACP_USERFEEDBACK_EDITED'					=> 'Feedback edited, you’ll be redirected to user feedback in seconds.',	
	'ACP_USERFEEDBACK_DELETED'					=> 'Feedback deleted, you’ll be redirected to user feedback in seconds.',
	'ACP_USERFEEDBACK_ROLE'						=> 'Role',
	'ACP_USERFEEDBACK_ROLE_ALL'					=> 'all',
	'ACP_USERFEEDBACK_ROLE_BUYER'				=> 'buyer',
	'ACP_USERFEEDBACK_ROLE_SELLER'				=> 'seller',
	'ACP_USERFEEDBACK_ROLE_TRADE'				=> 'trade',
	'ACP_USERFEEDBACK_FILTER'					=> 'Filter',
	'ACP_USERFEEDBACK_FILTER_ALL'				=> 'all',
	'ACP_USERFEEDBACK_FILTER_POS'				=> 'positive',
	'ACP_USERFEEDBACK_FILTER_NEU'				=> 'neutral',
	'ACP_USERFEEDBACK_FILTER_NEG'				=> 'negative',
	'ACP_USERFEEDBACK_DETAILS'					=> 'Details',
	'ACP_USERFEEDBACK_FROM'						=> 'From',
	'ACP_USERFEEDBACK_ONDATE'					=> 'On',
	'ACP_USERFEEDBACK_COMMENT'					=> 'Comment',
	'ACP_USERFEEDBACK_IP'						=> 'IP',
	'ACP_USERFEEDBACK_COMMENTOPT'				=> 'Comment (optional)',
	'ACP_USERFEEDBACK_NOFOUND'					=> 'No feedback found',
	'ACP_USERFEEDBACK_INVALIDLINK'				=> 'Invalid topic ID',	
	'ACP_USERFEEDBACK_NEWFEEDBACK'				=> 'You have received a new feedback',
	'ACP_USERFEEDBACK_NEWFEEDBACKMSG'			=> 'You have received a new %s feedback from %s',
));
