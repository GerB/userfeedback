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
	'USERFEEDBACK_TITLE'							=> 'User Feedback',
	'USERFEEDBACK_FEEDBACK'							=> 'Feedback',
	'USERFEEDBACK_FEEDBACKOF'						=> 'Feedback of',
	'USERFEEDBACK_MAIN'								=> 'Main Page',
	'USERFEEDBACK_BEST_USERS'						=> 'Best Users',
	'USERFEEDBACK_WORST_USERS'						=> 'Worst Users',
	'USERFEEDBACK_VIEWMORE'							=> 'View More',	
	'USERFEEDBACK_SEARCH'							=> 'Search User Feedback',
	'USERFEEDBACK_SCORE'							=> 'Score',
	'USERFEEDBACK_PERCENTAGE'						=> 'Positive Feedback',
	'USERFEEDBACK_BUYER'							=> 'Buyer',
	'USERFEEDBACK_SELLER'							=> 'Seller',
	'USERFEEDBACK_TRADE'							=> 'Trade',
	'USERFEEDBACK_POS'								=> 'Positive',
	'USERFEEDBACK_NEU'								=> 'Neutral',
	'USERFEEDBACK_NEG'								=> 'Negative',
	'USERFEEDBACK_NUM_FEEDBACKS'					=>  array(
		1	=> '%d feedback',
		2	=> '%d feedbacks',
	),
	'USERFEEDBACK_LINK'								=> 'Trade topic ID',
	'USERFEEDBACK_LINKOPT'							=> 'Trade topic ID (optional)',
	'USERFEEDBACK_ADD'								=> 'Add Feedback',
	'USERFEEDBACK_EDIT'								=> 'Edit Feedback',
	'USERFEEDBACK_DELETE'							=> 'Delete Feedback',
	'USERFEEDBACK_RANK'								=> 'Rank',
	'USERFEEDBACK_USER'								=> 'User',
	'USERFEEDBACK_ROLE'								=> 'Role',
	'USERFEEDBACK_ROLE_ALL'							=> 'all',
	'USERFEEDBACK_ROLE_BUYER'						=> 'buyer',
	'USERFEEDBACK_ROLE_SELLER'						=> 'seller',
	'USERFEEDBACK_ROLE_TRADE'						=> 'trade',
	'USERFEEDBACK_FILTER'							=> 'Filter',
	'USERFEEDBACK_FILTER_ALL'						=> 'all',
	'USERFEEDBACK_FILTER_POS'						=> 'positive',
	'USERFEEDBACK_FILTER_NEU'						=> 'neutral',
	'USERFEEDBACK_FILTER_NEG'						=> 'negative',
	'USERFEEDBACK_DETAILS'							=> 'Details',
	'USERFEEDBACK_FROM'								=> 'From',
	'USERFEEDBACK_ONDATE'							=> 'On',
	'USERFEEDBACK_COMMENT'							=> 'Comment',
	'USERFEEDBACK_IP'								=> 'IP',
	'USERFEEDBACK_COMMENTOPT'						=> 'Comment (optional)',
	'USERFEEDBACK_ADDED'							=> 'Feedback added, you’ll be redirected to user feedback in seconds.',
	'USERFEEDBACK_EDITED'							=> 'Feedback edited, you’ll be redirected to user feedback in seconds.',
	'USERFEEDBACK_DELETED'							=> 'Feedback deleted, you’ll be redirected to user feedback in seconds.',
	'USERFEEDBACK_ALREADYVOTED'						=> 'You have already voted for this user',
	'USERFEEDBACK_NOFOUND'							=> 'No feedback found',
	'USERFEEDBACK_CANNOTACCESS'						=> 'You cannot access users feedback',
	'USERFEEDBACK_CANNOTYOURSELF'					=> 'You cannot insert a feedback to yourself',
	'USERFEEDBACK_CANNOTADD'						=> 'You cannot add feedback',
	'USERFEEDBACK_CANNOTEDIT'						=> 'You cannot edit this feedback',
	'USERFEEDBACK_CANNOTDELETE'						=> 'You cannot delete this feedback',
	'USERFEEDBACK_ANTIFLOOD'						=> 'You can insert a feedback only every %s seconds',
	'USERFEEDBACK_ANTIFLOOD_SAME'					=> 'You can insert a feedback to the same user only every %s seconds',
	'USERFEEDBACK_INVALIDLINK'						=> 'Invalid topic ID',
	'USERFEEDBACK_INVALIDLINK2'						=> 'Invalid topic ID, only topics of forums %s are valid',
	'USERFEEDBACK_INVALIDLINK3'						=> 'Invalid topic ID, the topic must be created by you or your trade partner',
	'USERFEEDBACK_NEWFEEDBACK'						=> 'You have received new feedback',
	'USERFEEDBACK_NEWFEEDBACKMSG'					=> 'You have received new %s feedback from %s',
	'USERFEEDBACK_COMMENT_SHORT'					=> 'You have to insert a comment of at least %d characters',
	'USERFEEDBACK_COMMENT_LONG'						=> 'You cannot insert a comment longer than %d characters',
));
