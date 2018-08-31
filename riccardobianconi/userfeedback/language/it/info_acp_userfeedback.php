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
	'ACP_CAT_USERFEEDBACK'						=> 'Referenze Utente',
	'ACP_USERFEEDBACK'							=> 'Referenze Utente',
	'ACP_USERFEEDBACK_PREFS'					=> 'Preferenze',
	'ACP_USERFEEDBACK_MANAGE'					=> 'Gestione Referenze',
	// Preferences
	'ACP_USERFEEDBACK_PERM_EXPLAIN'				=> '
	<p>Per settare i poteri di utenti e moderatori vai in Permessi -> Permessi Gruppi<br />quindi per ogni gruppo setta i permessi della categoria “Feedback” come vuoi.</p>
	',
	'ACP_USERFEEDBACK_ROLE_SET'					=> 'Opzioni Ruolo',
	'ACP_USERFEEDBACK_ROLE_ENABLE'				=> 'Aggiungi il campo Ruolo alla referenza',
	'ACP_USERFEEDBACK_SCORE_ENABLE'				=> 'Abilita lo score',
	'ACP_USERFEEDBACK_SCORE_POS'				=> 'Moltiplicatore positive',
	'ACP_USERFEEDBACK_SCORE_NEU'				=> 'Moltiplicatore neutrali',
	'ACP_USERFEEDBACK_SCORE_NEG'				=> 'Moltiplicatore negative',
	'ACP_USERFEEDBACK_LINK_SET'					=> 'Opzioni Link',
	'ACP_USERFEEDBACK_LINK_ENABLE'				=> 'Aggiungi il campo Link al Topic alla referenza<br />(se settato a “no”, le prossime opzioni saranno ignorate)',
	'ACP_USERFEEDBACK_LINK_FORCE'				=> 'Inserire un link è obbligatorio',
	'ACP_USERFEEDBACK_LINK_FORCE_IN'			=> 'Uno dei soggetti deve aver creato il topic collegato',
	'ACP_USERFEEDBACK_LINK_FORUM'				=> 'Il topic collegato deve essere in uno di questi forum<br />(lascia vuoto se non vuoi questo controllo)',
	'ACP_USERFEEDBACK_LINK_FORUM_D'				=> 'Forum ID separati da virgola (es: 1,3,4)',
	'ACP_USERFEEDBACK_COMM_SET'					=> 'Opzioni dei Commenti',
	'ACP_USERFEEDBACK_COMM_MINCHARS'			=> 'Lunghezza minima (in caratteri)',
	'ACP_USERFEEDBACK_COMM_MAXCHARS'			=> 'Lunghezza massima (in caratteri)',
	'ACP_USERFEEDBACK_COMM_URL'					=> 'Gli URL inseriti diventeranno Link cliccabili',
	'ACP_USERFEEDBACK_ANTIFLOOD'				=> 'Anti-flood',
	'ACP_USERFEEDBACK_ANTIFLOOD_DESC'			=> 'Lasso di tempo, in secondi, dopo il quale l’utente può inserire una nuova referenza',
	'ACP_USERFEEDBACK_ANTIFLOOD_SAME'			=> 'Lasso di tempo, in secondi, dopo il quale l’utente può inserire una nuova referenza allo stesso utente',
	'ACP_USERFEEDBACK_RANKINGS'					=> 'Classifica',
	'ACP_USERFEEDBACK_TOP_MAIN'					=> 'Utenti mostrati in Migliori/Peggiori nella pagina principale',
	'ACP_USERFEEDBACK_TOP_BEST'					=> 'Utenti mostrati nella pagina Migliori Utenti',
	'ACP_USERFEEDBACK_TOP_WORST'				=> 'Utenti mostrati nella pagina Peggiori Utenti',
	'ACP_USERFEEDBACK_IGNOREDACP'				=> '(ignorato nell’ACP)',
	'ACP_USERFEEDBACK_CONFUPDATED'				=> 'Preferenze Referenze aggiornate',
	'ACP_USERFEEDBACK_PAG_SET'					=> 'Opzioni Paginazione',
	'ACP_USERFEEDBACK_PAG_SET_D'				=> 'Inserisci 0 per disattivare la paginazione',
	'ACP_USERFEEDBACK_PAG_FEEDBACKS_PER_PAGE'	=> 'Referenze per pagina nei dettagli',
	// Manage
	'ACP_USERFEEDBACK_SEARCH'					=> 'Ricerca Utente',
	'ACP_USERFEEDBACK_FEEDBACK'					=> 'Referenze',
	'ACP_USERFEEDBACK_FEEDBACKOF'				=> 'Referenze di',
	'ACP_USERFEEDBACK_SCORE'					=> 'Score',
	'ACP_USERFEEDBACK_PERCENTAGE'				=> 'Feedback positivi',
	'ACP_USERFEEDBACK_BUYER'					=> 'Compratore',
	'ACP_USERFEEDBACK_SELLER'					=> 'Venditore',
	'ACP_USERFEEDBACK_TRADE'					=> 'Scambio',
	'ACP_USERFEEDBACK_POS'						=> 'Positiva',
	'ACP_USERFEEDBACK_NEU'						=> 'Neutrale',
	'ACP_USERFEEDBACK_NEG'						=> 'Negativa',
	'ACP_USERFEEDBACK_NUM_FEEDBACKS'			=> array(
		1	=> '%d referenza',
		2	=> '%d referenze',
	),
	'ACP_USERFEEDBACK_LINK'						=> 'ID Topic trattativa',
	'ACP_USERFEEDBACK_LINKOPT'					=> 'ID Topic trattativa (opzionale)',
	'ACP_USERFEEDBACK_ADD'						=> 'Aggiungi Referenza',
	'ACP_USERFEEDBACK_EDIT'						=> 'Modifica Referenza',
	'ACP_USERFEEDBACK_DELETE'					=> 'Cancella Referenza',
	'ACP_USERFEEDBACK_ADDED'					=> 'Referenza aggiunta, sarai a breve reindirizzato alle referenze utente.',
	'ACP_USERFEEDBACK_EDITED'					=> 'Referenza modificata, sarai a breve reindirizzato alle referenze utente.',	
	'ACP_USERFEEDBACK_DELETED'					=> 'Referenza cancellata, sarai a breve reindirizzato alle referenze utente.',
	'ACP_USERFEEDBACK_ROLE'						=> 'Ruolo',
	'ACP_USERFEEDBACK_ROLE_ALL'					=> 'tutte',
	'ACP_USERFEEDBACK_ROLE_BUYER'				=> 'compratore',
	'ACP_USERFEEDBACK_ROLE_SELLER'				=> 'venditore',
	'ACP_USERFEEDBACK_ROLE_TRADE'				=> 'scambio',
	'ACP_USERFEEDBACK_FILTER'					=> 'Filtro',
	'ACP_USERFEEDBACK_FILTER_ALL'				=> 'tutte',
	'ACP_USERFEEDBACK_FILTER_POS'				=> 'positiva',
	'ACP_USERFEEDBACK_FILTER_NEU'				=> 'neutrale',
	'ACP_USERFEEDBACK_FILTER_NEG'				=> 'negativa',
	'ACP_USERFEEDBACK_DETAILS'					=> 'Dettagli',
	'ACP_USERFEEDBACK_FROM'						=> 'Da',
	'ACP_USERFEEDBACK_ONDATE'					=> 'Il',
	'ACP_USERFEEDBACK_COMMENT'					=> 'Commento',
	'ACP_USERFEEDBACK_IP'						=> 'IP',
	'ACP_USERFEEDBACK_COMMENTOPT'				=> 'Commento (opzionale)',
	'ACP_USERFEEDBACK_NOFOUND'					=> 'Nessuna referenza trovata',
	'ACP_USERFEEDBACK_INVALIDLINK'				=> 'Topic ID non valido',
	'ACP_USERFEEDBACK_NEWFEEDBACK'				=> 'Hai ricevuto una nuova referenza',
	'ACP_USERFEEDBACK_NEWFEEDBACKMSG'			=> 'Hai ricevuto una nuova referenza %s da %s',
));
