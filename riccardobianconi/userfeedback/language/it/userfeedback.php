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
	'USERFEEDBACK_TITLE'							=> 'Referenze Utente',
	'USERFEEDBACK_FEEDBACK'							=> 'Referenze',
	'USERFEEDBACK_FEEDBACKOF'						=> 'Referenze di',
	'USERFEEDBACK_MAIN'								=> 'Pagina Principale',
	'USERFEEDBACK_BEST_USERS'						=> 'Migliori Utenti',
	'USERFEEDBACK_WORST_USERS'						=> 'Peggiori Utenti',
	'USERFEEDBACK_VIEWMORE'							=> 'Mostra altri',
	'USERFEEDBACK_SEARCH'							=> 'Ricerca Referenze Utente',
	'USERFEEDBACK_SCORE'							=> 'Score',
	'USERFEEDBACK_PERCENTAGE'						=> 'Feedback positivi',
	'USERFEEDBACK_BUYER'							=> 'Compratore',
	'USERFEEDBACK_SELLER'							=> 'Venditore',
	'USERFEEDBACK_TRADE'							=> 'Scambio',
	'USERFEEDBACK_POS'								=> 'Positiva',
	'USERFEEDBACK_NEU'								=> 'Neutrale',
	'USERFEEDBACK_NEG'								=> 'Negativa',
	'USERFEEDBACK_NUM_FEEDBACKS'					=>  array(
		1	=> '%d referenza',
		2	=> '%d referenze',
	),
	'USERFEEDBACK_LINK'								=> 'ID Topic trattativa',
	'USERFEEDBACK_LINKOPT'							=> 'ID Topic trattativa (opzionale)',
	'USERFEEDBACK_ADD'								=> 'Aggiungi Referenza',
	'USERFEEDBACK_EDIT'								=> 'Modifica Referenza',
	'USERFEEDBACK_DELETE'							=> 'Cancella Referenza',
	'USERFEEDBACK_RANK'								=> 'Posizione',
	'USERFEEDBACK_USER'								=> 'Utente',
	'USERFEEDBACK_ROLE'								=> 'Ruolo',
	'USERFEEDBACK_ROLE_ALL'							=> 'tutte',
	'USERFEEDBACK_ROLE_BUYER'						=> 'compratore',
	'USERFEEDBACK_ROLE_SELLER'						=> 'venditore',
	'USERFEEDBACK_ROLE_TRADE'						=> 'scambio',
	'USERFEEDBACK_FILTER'							=> 'Filtro',
	'USERFEEDBACK_FILTER_ALL'						=> 'tutte',
	'USERFEEDBACK_FILTER_POS'						=> 'positiva',
	'USERFEEDBACK_FILTER_NEU'						=> 'neutrale',
	'USERFEEDBACK_FILTER_NEG'						=> 'negativa',
	'USERFEEDBACK_DETAILS'							=> 'Dettagli',
	'USERFEEDBACK_FROM'								=> 'Da',
	'USERFEEDBACK_ONDATE'							=> 'Il',
	'USERFEEDBACK_COMMENT'							=> 'Commento',
	'USERFEEDBACK_IP'								=> 'IP',
	'USERFEEDBACK_COMMENTOPT'						=> 'Commento (opzionale)',
	'USERFEEDBACK_ADDED'							=> 'Referenza aggiunta, sarai a breve reindirizzato alle referenze utente.',
	'USERFEEDBACK_EDITED'							=> 'Referenza modificata, sarai a breve reindirizzato alle referenze utente.',	
	'USERFEEDBACK_DELETED'							=> 'Referenza cancellata, sarai a breve reindirizzato alle referenze utente.',
	'USERFEEDBACK_ALREADYVOTED'						=> 'Hai già votato per questo utente',	
	'USERFEEDBACK_NOFOUND'							=> 'Nessuna referenza trovata',
	'USERFEEDBACK_CANNOTACCESS'						=> 'Non puoi accedere alle referenze degli utenti',
	'USERFEEDBACK_CANNOTYOURSELF'					=> 'Non puoi inserirti una referenza',
	'USERFEEDBACK_CANNOTADD'						=> 'Non puoi inserire referenze',
	'USERFEEDBACK_CANNOTEDIT'						=> 'Non puoi modificare questa referenza',
	'USERFEEDBACK_CANNOTDELETE'						=> 'Non puoi cancellare questa referenza',
	'USERFEEDBACK_INVALIDLINK'						=> 'Topic ID non valido',
	'USERFEEDBACK_INVALIDLINK2'						=> 'Topic ID non valido, solo i topic dei forum %s sono validi',
	'USERFEEDBACK_INVALIDLINK3'						=> 'Topic ID non valido, il topic deve essere stato creato da te o dal tuo partner nello scambio',
	'USERFEEDBACK_ANTIFLOOD'						=> 'Puoi inserire una referenza soltanto ogni %s secondi',
	'USERFEEDBACK_ANTIFLOOD'						=> 'Puoi inserire una referenza allo stesso utente soltanto ogni %s secondi',
	'USERFEEDBACK_NEWFEEDBACK'						=> 'Hai ricevuto una nuova referenza',
	'USERFEEDBACK_NEWFEEDBACKMSG'					=> 'Hai ricevuto una nuova referenza %s da %s',
	'USERFEEDBACK_COMMENT_SHORT'					=> 'Devi inserire un commento di almeno %d caratteri',
	'USERFEEDBACK_COMMENT_LONG'						=> 'Non puoi inserire un commento più lungo di %d caratteri',
));
