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
	'ACP_CAT_USERFEEDBACK'						=> 'Feedbacks des utilisateurs',
	'ACP_USERFEEDBACK'							=> 'Feedbacks des utilisateurs',
	'ACP_USERFEEDBACK_PREFS'					=> 'Préférences',
	'ACP_USERFEEDBACK_MANAGE'					=> 'Gérer les Feedbacks',
	// Preferences
	'ACP_USERFEEDBACK_PERM_EXPLAIN'				=> '
	<p> Pour régler les permissions d’utilisateur et de modérateur, allez dans Permissions -> Permissions des groupes<br /> Après pour chaque groupe, régler les permissions dans la catégorie “Feedback” comme vous le souhaitez.</p>
	',
	'ACP_USERFEEDBACK_ROLE_SET'					=> 'Réglages des rôles',
	'ACP_USERFEEDBACK_ROLE_ENABLE'				=> 'Ajouter le champ rôle dans les feedback',
	'ACP_USERFEEDBACK_SCORE_ENABLE'				=> 'Activer le système de score',
	'ACP_USERFEEDBACK_SCORE_POS'				=> 'Multiplicateur Positif',
	'ACP_USERFEEDBACK_SCORE_NEU'				=> 'Multiplicateur Neutre',
	'ACP_USERFEEDBACK_SCORE_NEG'				=> 'Multiplicateur Negatif',
	'ACP_USERFEEDBACK_LINK_SET'					=> 'Réglages des liens',
	'ACP_USERFEEDBACK_LINK_ENABLE'				=> 'Ajouter le lien du topic dans les champs<br />(si “non”, les autres options seront ignorés)',
	'ACP_USERFEEDBACK_LINK_FORCE'				=> 'Lien du topic requis',
	'ACP_USERFEEDBACK_LINK_FORCE_IN'			=> 'Un des traders doit avoir créé le topic',
	'ACP_USERFEEDBACK_LINK_FORUM'				=> 'Les liens des topics doivent etre dans un de ces forums<br />(laisser blanc si vous ne voulez pas cette option)',
	'ACP_USERFEEDBACK_LINK_FORUM_D'				=> 'Les id des forums séparés par des virgules (ex: 1,3,4)',
	'ACP_USERFEEDBACK_COMM_SET'					=> 'Réglages des commentaires',
	'ACP_USERFEEDBACK_COMM_MINCHARS'			=> 'Taille minimale(en caractères)',
	'ACP_USERFEEDBACK_COMM_MAXCHARS'			=> 'Taille maximale (en caractères)',
	'ACP_USERFEEDBACK_COMM_URL'					=> 'Les URL ajoutées deviennent des liens cliquables',
	'ACP_USERFEEDBACK_ANTIFLOOD'				=> 'Anti-flood',
	'ACP_USERFEEDBACK_ANTIFLOOD_DESC'			=> 'Temps nécessaire, en secondes, pour que l’utilisateur puisse rajouter une nouvelle feedback',
	'ACP_USERFEEDBACK_ANTIFLOOD_SAME'			=> 'Temps nécessaire, en secondes, pour que l’utilisateur puisse rajouter une nouvelle feedback au même utilisateur',
	'ACP_USERFEEDBACK_RANKINGS'					=> 'Classement',
	'ACP_USERFEEDBACK_TOP_MAIN'					=> 'Nombre d’utilisateurs montré dans la page d’accueil “Meilleurs/Mauvais”',
	'ACP_USERFEEDBACK_TOP_BEST'					=> 'Nombre d’utilisateurs montré dans le “Meilleurs traders”',
	'ACP_USERFEEDBACK_TOP_WORST'				=> 'Nombre d’utilisateurs montré dans le “Mauvais traders”',
	'ACP_USERFEEDBACK_IGNOREDACP'				=> '(ignoré dans l’ACP)',
	'ACP_USERFEEDBACK_CONFUPDATED'				=> 'Mise a jour des préferences des Feedbacks',
	'ACP_USERFEEDBACK_PAG_SET'					=> 'Réglages des Pagination',
	'ACP_USERFEEDBACK_PAG_SET_D'				=> 'Set 0 pour désactiver la pagination',
	'ACP_USERFEEDBACK_PAG_FEEDBACKS_PER_PAGE'	=> 'Feedback par page en détails',
	// Manage
	'ACP_USERFEEDBACK_SEARCH'					=> 'Rechercher utilisateur',
	'ACP_USERFEEDBACK_FEEDBACK'					=> 'Feedback',
	'ACP_USERFEEDBACK_FEEDBACKOF'				=> 'Feedback de',
	'ACP_USERFEEDBACK_SCORE'					=> 'Score',
	'ACP_USERFEEDBACK_PERCENTAGE'				=> 'Feedbacks positives',
	'ACP_USERFEEDBACK_BUYER'					=> 'Acheteur',
	'ACP_USERFEEDBACK_SELLER'					=> 'Vendeur',
	'ACP_USERFEEDBACK_TRADE'					=> 'Trade',
	'ACP_USERFEEDBACK_POS'						=> 'Positive',
	'ACP_USERFEEDBACK_NEU'						=> 'Neutre',
	'ACP_USERFEEDBACK_NEG'						=> 'Négative',
	'ACP_USERFEEDBACK_NUM_FEEDBACKS'			=> array(
		1	=> '%d feedback',
		2	=> '%d feedbacks',
	),
	'ACP_USERFEEDBACK_LINK'						=> 'Trade topic ID',
	'ACP_USERFEEDBACK_LINKOPT'					=> 'Trade topic ID (optionnel)',
	'ACP_USERFEEDBACK_ADD'						=> 'Ajouter une Feedback',
	'ACP_USERFEEDBACK_EDIT'						=> 'Éditer Feedback',
	'ACP_USERFEEDBACK_DELETE'					=> 'Supprimer Feedback',
	'ACP_USERFEEDBACK_ADDED'					=> 'Feedback ajoutée, vous allez être redirigé dans quelques secondes.',
	'ACP_USERFEEDBACK_EDITED'					=> 'Feedback éditée, vous allez être redirigé dans quelques secondes.',	
	'ACP_USERFEEDBACK_DELETED'					=> 'Feedback supprimée, vous allez être redirigé dans quelques secondes.',
	'ACP_USERFEEDBACK_ROLE'						=> 'Rôle',
	'ACP_USERFEEDBACK_ROLE_ALL'					=> 'Tous',
	'ACP_USERFEEDBACK_ROLE_BUYER'				=> 'Acheteur',
	'ACP_USERFEEDBACK_ROLE_SELLER'				=> 'Vendeur',
	'ACP_USERFEEDBACK_ROLE_TRADE'				=> 'Trade',
	'ACP_USERFEEDBACK_FILTER'					=> 'Filtre',
	'ACP_USERFEEDBACK_FILTER_ALL'				=> 'Toutes',
	'ACP_USERFEEDBACK_FILTER_POS'				=> 'positive',
	'ACP_USERFEEDBACK_FILTER_NEU'				=> 'neutre',
	'ACP_USERFEEDBACK_FILTER_NEG'				=> 'négative',
	'ACP_USERFEEDBACK_DETAILS'					=> 'Détails',
	'ACP_USERFEEDBACK_FROM'						=> 'De',
	'ACP_USERFEEDBACK_ONDATE'					=> 'Date',
	'ACP_USERFEEDBACK_COMMENT'					=> 'Commentaires',
	'ACP_USERFEEDBACK_IP'						=> 'IP',
	'ACP_USERFEEDBACK_COMMENTOPT'				=> 'Commentaire (optionnel)',
	'ACP_USERFEEDBACK_NOFOUND'					=> 'Pas de feedback trouvée',
	'ACP_USERFEEDBACK_INVALIDLINK'				=> 'ID du topic invalide',	
	'ACP_USERFEEDBACK_NEWFEEDBACK'				=> 'Vous avez reçu une nouvelle feedback',
	'ACP_USERFEEDBACK_NEWFEEDBACKMSG'			=> 'Vous avez reçu une feedback %s de %s',
));
