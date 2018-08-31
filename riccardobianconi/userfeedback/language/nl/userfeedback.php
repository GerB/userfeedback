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
	'USERFEEDBACK_TITLE'							=> 'Gebruiker’s feedback',
	'USERFEEDBACK_FEEDBACK'							=> 'Feedback',
	'USERFEEDBACK_FEEDBACKOF'						=> 'Feedback voor',
	'USERFEEDBACK_MAIN'								=> 'Hoofd pagina',
	'USERFEEDBACK_BEST_USERS'						=> 'Hall of fame',
	'USERFEEDBACK_WORST_USERS'						=> 'Hall of shame',
	'USERFEEDBACK_VIEWMORE'							=> 'Bekijk meer',	
	'USERFEEDBACK_SEARCH'							=> 'Zoek Gebruiker’s feedback',
	'USERFEEDBACK_SCORE'							=> 'Score',
	'USERFEEDBACK_PERCENTAGE'						=> 'Positieve Feedback',
	'USERFEEDBACK_BUYER'							=> 'Koper',
	'USERFEEDBACK_SELLER'							=> 'Verkoper',
	'USERFEEDBACK_TRADE'							=> 'Ruiler',
	'USERFEEDBACK_POS'								=> 'Positief',
	'USERFEEDBACK_NEU'								=> 'Neutraal',
	'USERFEEDBACK_NEG'								=> 'Negatief',
	'USERFEEDBACK_NUM_FEEDBACKS'					=>  array(
		1	=> '%d feedback',
		2	=> '%d feedbacks',
	),
	'USERFEEDBACK_LINK'								=> 'Onderwerp ID van de deal',
	'USERFEEDBACK_LINKOPT'							=> 'Onderwerp ID van de deal (optioneel)',
	'USERFEEDBACK_ADD'								=> 'Voeg feedback toe',
	'USERFEEDBACK_EDIT'								=> 'Bewerk feedback',
	'USERFEEDBACK_DELETE'							=> 'Verwijder Feedback',
	'USERFEEDBACK_RANK'								=> 'Rang',
	'USERFEEDBACK_USER'								=> 'Gebruiker',
	'USERFEEDBACK_ROLE'								=> 'Rol',
	'USERFEEDBACK_ROLE_ALL'							=> 'Alle',
	'USERFEEDBACK_ROLE_BUYER'						=> 'Koper',
	'USERFEEDBACK_ROLE_SELLER'						=> 'Verkoper',
	'USERFEEDBACK_ROLE_TRADE'						=> 'Ruiler',
	'USERFEEDBACK_FILTER'							=> 'Filter',
	'USERFEEDBACK_FILTER_ALL'						=> 'alle',
	'USERFEEDBACK_FILTER_POS'						=> 'positief',
	'USERFEEDBACK_FILTER_NEU'						=> 'neutraal',
	'USERFEEDBACK_FILTER_NEG'						=> 'negatief',
	'USERFEEDBACK_DETAILS'							=> 'Details',
	'USERFEEDBACK_FROM'								=> 'Van',
	'USERFEEDBACK_ONDATE'							=> 'Op',
	'USERFEEDBACK_COMMENT'							=> 'Commentaar',
	'USERFEEDBACK_IP'								=> 'IP',
	'USERFEEDBACK_COMMENTOPT'						=> 'Commentaar (optioneel)',
	'USERFEEDBACK_ADDED'							=> 'Feedback is toegevoegd! Je wordt binnen enkele seconden doorverwezen',
	'USERFEEDBACK_EDITED'							=> 'Feedback is bewerkt!, Je wordt binnen enkele seconden doorverwezen.',
	'USERFEEDBACK_DELETED'							=> 'Feedback is verwijderd, Je wordt binnen enkele seconden doorverwezen.',
	'USERFEEDBACK_ALREADYVOTED'						=> 'Je hebt al gestemd op deze gebruiker!',
	'USERFEEDBACK_NOFOUND'							=> 'Er werd geen feedback gevonden',
	'USERFEEDBACK_CANNOTACCESS'						=> 'You cannot access gebruiker’s feedback',
	'USERFEEDBACK_CANNOTYOURSELF'					=> 'Je kan geen feedback aan jezelf geven!',
	'USERFEEDBACK_CANNOTADD'						=> 'You cannot add feedback',
	'USERFEEDBACK_CANNOTEDIT'						=> 'Je beschikt niet over voldoende permissies om deze feedback aan te passen!',
	'USERFEEDBACK_CANNOTDELETE'						=> 'Je beschikt niet over voldoende permissies om deze feedback te verwijderen',
	'USERFEEDBACK_ANTIFLOOD'						=> 'Je kan slechts feedback toevoegen om de %s seconden (3600 = 1 uur)',
	'USERFEEDBACK_ANTIFLOOD_SAME'					=> 'Je kan pas opnieuw feedback toevoegen na %s seconden (3600 = 1 uur) aan dezelfde gebruiker',
	'USERFEEDBACK_INVALIDLINK'						=> 'Ongeldig onderwerp ID',
	'USERFEEDBACK_INVALIDLINK2'						=> 'Ongeldige onderwerp ID, alleen onderwerpen uit de volgende forums <strong>%s</strong> zijn geldig',
	'USERFEEDBACK_INVALIDLINK3'						=> 'Invalid topic ID, the topic must be created by you or your trade partner',
	'USERFEEDBACK_NEWFEEDBACK'						=> 'Je hebt zonet een nieuwe feedback ontvangen',
	'USERFEEDBACK_NEWFEEDBACKMSG'					=> 'Je hebt zonet een nieuwe %s feedback ontvangen van  %s',
	'USERFEEDBACK_COMMENT_SHORT'					=> 'Je moet een opmerking ingeven van op zijn minst %d tekens',
	'USERFEEDBACK_COMMENT_LONG'						=> 'Je kan geen reactie toevoegen die meer dan  %d tekens bevat',
));
