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
	'ACP_CAT_USERFEEDBACK'						=> 'Gebruiker’s feedback',
	'ACP_USERFEEDBACK'							=> 'Gebruiker’s feedback',
	'ACP_USERFEEDBACK_PREFS'					=> 'Voorkeuren',
	'ACP_USERFEEDBACK_MANAGE'					=> 'Beheer Feedback',
	// Preferences
	'ACP_USERFEEDBACK_PERM_EXPLAIN'				=> '
	<p>To set user and moderators powers go to Permissions -> Groups’ Permissions<br />then for every group set the permissions inside category “Feedback” as you want.</p>
	',
	'ACP_USERFEEDBACK_ROLE_SET'					=> 'Rollen instellingen',
	'ACP_USERFEEDBACK_ROLE_ENABLE'				=> 'Add Role field in feedback',
	'ACP_USERFEEDBACK_SCORE_ENABLE'				=> 'Schakel score systeem in(Ebay)',
	'ACP_USERFEEDBACK_SCORE_POS'				=> 'Positieve multiplicatoreffecten',
	'ACP_USERFEEDBACK_SCORE_NEU'				=> 'Neutrale multiplicatoreffecten',
	'ACP_USERFEEDBACK_SCORE_NEG'				=> 'Negatieve multiplicatoreffecten',
	'ACP_USERFEEDBACK_LINK_SET'					=> 'Link instellingen',
	'ACP_USERFEEDBACK_LINK_ENABLE'				=> 'Onderwerp Link toevoegen in feedback veld <br />(Indien het is ingesteld op “nee”,worden de volgende opties worden genegeerd)',
	'ACP_USERFEEDBACK_LINK_FORCE'				=> 'Onderwerp link is vereist',
	'ACP_USERFEEDBACK_LINK_FORCE_IN'			=> 'Een van de handelaren moet het onderwerp hebben gestart',
	'ACP_USERFEEDBACK_LINK_FORUM'				=> 'Het gelinkt onderwerp moet uit een van deze forums komen<br />(Laat dit leeg als je het niet wilt gebruiken.)',
	'ACP_USERFEEDBACK_LINK_FORUM_D'				=> 'Forum id’s moeten door een komma gescheiden worden (bvb: 1,3,4)',
	'ACP_USERFEEDBACK_COMM_SET'					=> 'Reactie instellingen',
	'ACP_USERFEEDBACK_COMM_MINCHARS'			=> 'Minimale lengte (in tekens)',
	'ACP_USERFEEDBACK_COMM_MAXCHARS'			=> 'Maximale lengte (in tekens)',
	'ACP_USERFEEDBACK_COMM_URL'					=> 'De ingevoegde url wordt klikbaar',
	'ACP_USERFEEDBACK_ANTIFLOOD'				=> 'Anti-flood',
	'ACP_USERFEEDBACK_ANTIFLOOD_DESC'			=> 'Tijd in seconden, nadat een gebruiker een nieuwe feedback kan toevoegen (3600 is gelijk aan 1 uur)',
	'ACP_USERFEEDBACK_ANTIFLOOD_SAME'			=> 'Tijd in seconden, nadat een gebruiker een nieuwe feedback kan toevoegen aan dezelfde gebruiker (3600 is gelijk aan 1 uur)',
	'ACP_USERFEEDBACK_RANKINGS'					=> 'Rangen',
	'ACP_USERFEEDBACK_TOP_MAIN'					=> 'Gebruikers die getoond worden in de beste/slechtste pagina',
	'ACP_USERFEEDBACK_TOP_BEST'					=> 'Gebruikers die getoond worden in de beste pagina',
	'ACP_USERFEEDBACK_TOP_WORST'				=> 'Gebruikers die getoond worden in de slechtste pagina',
	'ACP_USERFEEDBACK_IGNOREDACP'				=> '(genegeerd in ACP)',
	'ACP_USERFEEDBACK_CONFUPDATED'				=> 'Feedback voorkeurs instellingen bijgewerkt',
	'ACP_USERFEEDBACK_PAG_SET'					=> 'Paginering instellingen',
	'ACP_USERFEEDBACK_PAG_SET_D'				=> 'Stel 0 tot paginering uitschakelen',
	'ACP_USERFEEDBACK_PAG_FEEDBACKS_PER_PAGE'	=> 'Feedback per pagina in detail',
	// Manage
	'ACP_USERFEEDBACK_SEARCH'					=> 'Zoek gebruiker',
	'ACP_USERFEEDBACK_FEEDBACK'					=> 'Feedback',
	'ACP_USERFEEDBACK_FEEDBACKOF'				=> 'Feedback van',
	'ACP_USERFEEDBACK_SCORE'					=> 'Score',
	'ACP_USERFEEDBACK_PERCENTAGE'				=> 'Positieve Feedback',
	'ACP_USERFEEDBACK_BUYER'					=> 'Koper',
	'ACP_USERFEEDBACK_SELLER'					=> 'verkoper',
	'ACP_USERFEEDBACK_TRADE'					=> 'Ruiler',
	'ACP_USERFEEDBACK_POS'						=> 'Positief',
	'ACP_USERFEEDBACK_NEU'						=> 'Neutraal',
	'ACP_USERFEEDBACK_NEG'						=> 'Negatief',
	'ACP_USERFEEDBACK_NUM_FEEDBACKS'			=> array(
		1	=> '%d feedback',
		2	=> '%d feedbacks',
	),
	'ACP_USERFEEDBACK_LINK'						=> 'Handel onderwerp ID',
	'ACP_USERFEEDBACK_LINKOPT'					=> 'Handel onderwerp (optional)',
	'ACP_USERFEEDBACK_ADD'						=> 'Voeg feedback toe',
	'ACP_USERFEEDBACK_EDIT'						=> 'Bewerk Feedback',
	'ACP_USERFEEDBACK_DELETE'					=> 'Verwijder Feedback',
	'ACP_USERFEEDBACK_ADDED'					=> 'Feedback is toegevoegd! Je wordt binnen enkele seconden doorverwezen.',
	'ACP_USERFEEDBACK_EDITED'					=> 'Feedback is bewerkt!, Je wordt binnen enkele seconden doorverwezen.',	
	'ACP_USERFEEDBACK_DELETED'					=> 'Feedback is verwijderd, Je wordt binnen enkele seconden doorverwezen.',
	'ACP_USERFEEDBACK_ROLE'						=> 'Rol',
	'ACP_USERFEEDBACK_ROLE_ALL'					=> 'alle',
	'ACP_USERFEEDBACK_ROLE_BUYER'				=> 'Koper',
	'ACP_USERFEEDBACK_ROLE_SELLER'				=> 'Verkoper',
	'ACP_USERFEEDBACK_ROLE_TRADE'				=> 'Ruiler',
	'ACP_USERFEEDBACK_FILTER'					=> 'Filter',
	'ACP_USERFEEDBACK_FILTER_ALL'				=> 'alle',
	'ACP_USERFEEDBACK_FILTER_POS'				=> 'positief',
	'ACP_USERFEEDBACK_FILTER_NEU'				=> 'neutraal',
	'ACP_USERFEEDBACK_FILTER_NEG'				=> 'negatief',
	'ACP_USERFEEDBACK_DETAILS'					=> 'Details',
	'ACP_USERFEEDBACK_FROM'						=> 'Van',
	'ACP_USERFEEDBACK_ONDATE'					=> 'Op',
	'ACP_USERFEEDBACK_COMMENT'					=> 'Reactie',
	'ACP_USERFEEDBACK_IP'						=> 'IP',
	'ACP_USERFEEDBACK_COMMENTOPT'				=> 'Reactie (optional)',
	'ACP_USERFEEDBACK_NOFOUND'					=> 'Er werd geen feedback gevonden',
	'ACP_USERFEEDBACK_INVALIDLINK'				=> 'Ongeldige onderwerp ID',	
	'ACP_USERFEEDBACK_NEWFEEDBACK'				=> 'Je hebt zonet een nieuwe feedback ontvangen',
	'ACP_USERFEEDBACK_NEWFEEDBACKMSG'			=> 'Je hebt zonet een nieuwe %s feedback ontvangen van %s',
));
