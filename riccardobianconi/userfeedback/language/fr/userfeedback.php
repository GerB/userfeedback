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
	'USERFEEDBACK_TITLE'							=> 'Feedbacks des utilisateurs',
	'USERFEEDBACK_FEEDBACK'							=> 'Feedback',
	'USERFEEDBACK_FEEDBACKOF'						=> 'Feedback de',
	'USERFEEDBACK_MAIN'								=> 'Page principale',
	'USERFEEDBACK_BEST_USERS'						=> 'Meilleurs traders',
	'USERFEEDBACK_WORST_USERS'						=> 'Mauvais traders',
	'USERFEEDBACK_VIEWMORE'							=> 'Voir plus',	
	'USERFEEDBACK_SEARCH'							=> 'Rechercher les feedbacks de',
	'USERFEEDBACK_SCORE'							=> 'Score',
	'USERFEEDBACK_PERCENTAGE'						=> 'Feedbacks positives',
	'USERFEEDBACK_BUYER'							=> 'Acheteur',
	'USERFEEDBACK_SELLER'							=> 'Vendeur',
	'USERFEEDBACK_TRADE'							=> 'Trade',
	'USERFEEDBACK_POS'								=> 'Positive',
	'USERFEEDBACK_NEU'								=> 'Neutre',
	'USERFEEDBACK_NEG'								=> 'Négative',
	'USERFEEDBACK_NUM_FEEDBACKS'					=>  array(
		1	=> '%d feedback',
		2	=> '%d feedbacks',
	),
	'USERFEEDBACK_LINK'								=> 'ID du topic de trade',
	'USERFEEDBACK_LINKOPT'							=> 'ID du topic de trade (optionnel)',
	'USERFEEDBACK_ADD'								=> 'Ajouter Feedback',
	'USERFEEDBACK_EDIT'								=> 'Éditer Feedback',
	'USERFEEDBACK_DELETE'							=> 'Supprimer Feedback',
	'USERFEEDBACK_RANK'								=> 'Rang',
	'USERFEEDBACK_USER'								=> 'Utilisateur',
	'USERFEEDBACK_ROLE'								=> 'Rôle',
	'USERFEEDBACK_ROLE_ALL'							=> 'Tous',
	'USERFEEDBACK_ROLE_BUYER'						=> 'Acheteur',
	'USERFEEDBACK_ROLE_SELLER'						=> 'Vendeur',
	'USERFEEDBACK_ROLE_TRADE'						=> 'Trade',
	'USERFEEDBACK_FILTER'							=> 'Filtre',
	'USERFEEDBACK_FILTER_ALL'						=> 'Toutes',
	'USERFEEDBACK_FILTER_POS'						=> 'positive',
	'USERFEEDBACK_FILTER_NEU'						=> 'neutre',
	'USERFEEDBACK_FILTER_NEG'						=> 'négative',
	'USERFEEDBACK_DETAILS'							=> 'Détails',
	'USERFEEDBACK_FROM'								=> 'De',
	'USERFEEDBACK_ONDATE'							=> 'Date',
	'USERFEEDBACK_COMMENT'							=> 'Commentaires',
	'USERFEEDBACK_IP'								=> 'IP',
	'USERFEEDBACK_COMMENTOPT'						=> 'Commentaire (optionnel)',
	'USERFEEDBACK_ADDED'							=> 'Feedback ajoutée, vous allez être redirigé dans quelques secondes.',
	'USERFEEDBACK_EDITED'							=> 'Feedback editée, vous allez être redirigé dans quelques secondes.',
	'USERFEEDBACK_DELETED'							=> 'Feedback supprimée, vous allez être redirigé dans quelques secondes.',
	'USERFEEDBACK_ALREADYVOTED'						=> 'Vous avez déja donné une feedback pour ce membre',
	'USERFEEDBACK_NOFOUND'							=> 'Pas de feedback trouvée',
	'USERFEEDBACK_CANNOTACCESS'						=> 'Vous ne pouvez pas accèder au feedbacks des utilisateurs',
	'USERFEEDBACK_CANNOTYOURSELF'					=> 'Vous ne pouvez pas vous rajouter de feedback',
	'USERFEEDBACK_CANNOTADD'						=> 'Vous ne pouvez pas ajouter de feedback',
	'USERFEEDBACK_CANNOTEDIT'						=> 'Vous ne pouvez pas éditer cette feedback',
	'USERFEEDBACK_CANNOTDELETE'						=> 'Vous ne pouvez pas supprimer cette feedback',
	'USERFEEDBACK_ANTIFLOOD'						=> 'Vous ne pouvez rajouter une feedback que toutes les %s secondes',
	'USERFEEDBACK_ANTIFLOOD_SAME'					=> 'Vous ne pouvez rajouter une feedback au même utilisateur que toutes les %s secondes',
	'USERFEEDBACK_INVALIDLINK'						=> 'ID du topic invalide',
	'USERFEEDBACK_INVALIDLINK2'						=> 'ID du topic invalide, seul les topics du forum %s sont valides',
	'USERFEEDBACK_INVALIDLINK3'						=> 'ID du topic invalide, le topic doit avoir été créé par vous ou par votre trader',
	'USERFEEDBACK_NEWFEEDBACK'						=> 'Vous avez reçu une nouvelle feedback',
	'USERFEEDBACK_NEWFEEDBACKMSG'					=> 'Vous avec reçu une nouvelle feedback %s de %s',
	'USERFEEDBACK_COMMENT_SHORT'					=> 'Vous devez insérer un commentaire d’au moins %d caracteres',
	'USERFEEDBACK_COMMENT_LONG'						=> 'Vous ne pouvez pas ajouter un commentaire de plus de %d caracteres',
));
