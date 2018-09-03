<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\controller;

use riccardobianconi\userfeedback\common\common_constants;

/**
 * Extension admin controller
 */
class admin_controller
{
	/**
	 * Database object
	 * @var \phpbb\db\driver\driver_interface
	 */
	protected $db;

	/**
	 * Config object
	 * @var \phpbb\config\config
	 */
	protected $config;
	
	/**
	 * Extension manager object
	 * @var \phpbb\extension\manager
	 */
	protected $extension_manager;
	
	/**
	* Pagination object
	* @var \phpbb\pagination
	*/
	protected $pagination;
	
	/**
	 * Request object
	 * @var \phpbb\request\request
	 */
	protected $request;
	
	/**
	 * Template object
	 * @var \phpbb\template\template
	 */
	protected $template;
	
	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;
	
	/**
	 * phpBB root path
	 * @var string
	 */
	protected $phpbb_root_path;
	
	/**
	 * PHP file extension
	 * @var string
	 */
	protected $php_ext;

	/**
	 * Database table storing user feedbacks
	 * @var string
	 */
	protected $table_feedback;

	/**
	 * Database table storing feedback totals by user
	 * @var string
	 */
	protected $table_feedback_tot;

	/**
	 * Form action url
	 * @var string
	 */
	protected $u_action;
	
	/**
	 * Variable to check if pagination is enabled
	 * @var bool
	 */
	protected $pagination_enabled;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface $db Database object
	 * @param \phpbb\config\config $config Config object
	 * @param \phpbb\extension\manager $extension_manager Extension manager object
	 * @param \phpbb\pagination $pagination Pagination object
	 * @param \phpbb\request\request $request Request object
	 * @param \phpbb\template\template $template Template object
	 * @param \phpbb\user $user User object
	 * @param string $phpbb_root_path phpBB root path
	 * @param string $php_ext PHP file extension
	 * @param string $table_feedback Database table storing user feedbacks
	 * @param string $table_feedback_tot Database table storing feedback totals by user
	 * @access public
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\extension\manager $extension_manager, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext, $table_feedback, $table_feedback_tot)
	{
		$this->db = $db;
		$this->config = $config;
		$this->extension_manager = $extension_manager;
		$this->pagination = $pagination;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->table_feedback = $table_feedback;
		$this->table_feedback_tot = $table_feedback_tot;
	}
	
	/**
	 * Display extension settings page
	 *
	 * @access public
	 */
	public function display_settings()
	{
		// assign values for display
		$this->template->assign_vars(array(
			'USERFEEDBACK_ANTIFLOOD'				=> $this->config['userfeedback_antiflood'],
			'USERFEEDBACK_ANTIFLOOD_SAME'			=> $this->config['userfeedback_antiflood_same'],
			'USERFEEDBACK_COMM_MINCHARS'			=> $this->config['userfeedback_comm_minchars'],
			'USERFEEDBACK_COMM_MAXCHARS'			=> $this->config['userfeedback_comm_maxchars'],
			'USERFEEDBACK_COMM_BBCODE'				=> $this->config['userfeedback_comm_bbcode'],
			'USERFEEDBACK_COMM_SMILIES'				=> $this->config['userfeedback_comm_smilies'],
			'USERFEEDBACK_COMM_URL'					=> $this->config['userfeedback_comm_url'],
			'USERFEEDBACK_LINK_ENABLE'				=> $this->config['userfeedback_link_enable'],
			'USERFEEDBACK_LINK_FORCE'				=> $this->config['userfeedback_link_force'],
			'USERFEEDBACK_LINK_FORCE_IN'			=> $this->config['userfeedback_link_force_in'],
			'USERFEEDBACK_LINK_FORUM'				=> $this->config['userfeedback_link_forum'],
			'USERFEEDBACK_M_HASPOWER'				=> $this->config['userfeedback_m_haspower'],
			'USERFEEDBACK_PAG_FEEDBACKS_PER_PAGE'	=> $this->config['userfeedback_pag_feedbacks_per_page'],
			'USERFEEDBACK_ROLE_ENABLE'				=> $this->config['userfeedback_role_enable'],
			'USERFEEDBACK_SCORE'					=> $this->config['userfeedback_score'],
			'USERFEEDBACK_SCORE_POS'				=> $this->config['userfeedback_score_pos'],
			'USERFEEDBACK_SCORE_NEU'				=> $this->config['userfeedback_score_neu'],
			'USERFEEDBACK_SCORE_NEG'				=> $this->config['userfeedback_score_neg'],
			'USERFEEDBACK_TOP_BEST'					=> $this->config['userfeedback_top_best'],
			'USERFEEDBACK_TOP_MAIN'					=> $this->config['userfeedback_top_main'],
			'USERFEEDBACK_TOP_WORST'				=> $this->config['userfeedback_top_worst'],
			'USERFEEDBACK_U_CANEDIT'				=> $this->config['userfeedback_u_canedit'],
			'USERFEEDBACK_U_MORETHENONE'			=> $this->config['userfeedback_u_morethenone'],
			'USERFEEDBACK_ACTION'					=> "{$this->u_action}&amp;mode=settings&amp;submit",
			'ACP_USERFEEDBACK_PAGE'					=> 'settings',
		));
	}
	
	/**
	 * Save extension settings
	 *
	 * @access public
	 */
	public function save_settings()
	{
		// get form data
		$link_forum = $this->request->variable('link_forum', '');
		$fields = array(
			'antiflood'					=> $this->request->variable('antiflood', 0),
			'antiflood_same'			=> $this->request->variable('antiflood_same', 0),
			'comm_minchars'				=> $this->request->variable('comm_minchars', 0),
			'comm_maxchars'				=> $this->request->variable('comm_maxchars', 0),
			'comm_bbcode'				=> $this->request->variable('comm_bbcode', 0),
			'comm_smilies'				=> $this->request->variable('comm_smilies', 0),
			'comm_url'					=> $this->request->variable('comm_url', 0),
			'link_enable'				=> $this->request->variable('link_enable', 0),
			'link_force'				=> $this->request->variable('link_force', 0),
			'link_force_in'				=> $this->request->variable('link_force_in', 0),
			'link_forum'				=> preg_match('/^([0-9]+,)*[0-9]+$/D', $link_forum) ? $link_forum : '',
			'm_haspower'				=> $this->request->variable('m_haspower', 0),
			'pag_feedbacks_per_page'	=> $this->request->variable('pag_feedbacks_per_page', 0),
			'role_enable'				=> $this->request->variable('role_enable', 0),
			'score'						=> $this->request->variable('score', 0),
			'score_pos'					=> $this->request->variable('score_pos', 1),
			'score_neu'					=> $this->request->variable('score_neu', 0),
			'score_neg'					=> $this->request->variable('score_neg', -1),
			'top_best'					=> $this->request->variable('top_best', 0),
			'top_main'					=> $this->request->variable('top_main', 0),
			'top_worst'					=> $this->request->variable('top_worst', 0),
			'u_canedit'					=> $this->request->variable('u_canedit', 0),
			'u_morethenone'				=> $this->request->variable('u_morethenone', 0),
		);

		// update extension configurations
		foreach ($fields as $field => $value)
		{
			$this->config->set('userfeedback_' . $field, $value);
		}

		meta_refresh(3, "{$this->u_action}&amp;mode=settings");
		trigger_error($this->user->lang['ACP_USERFEEDBACK_CONFUPDATED']);
	}
	
	/**
	 * Display search user feedback page
	 *
	 * @access public
	 */
	public function display_search_feedback()
	{
		$this->template->assign_vars(array(
			'USERFEEDBACK_ACTION'	=> "{$this->u_action}&amp;mode=manage&amp;action=search",
			'ACP_USERFEEDBACK_PAGE'	=> 'search',
		));
	}
	
	/**
	 * Search user feedback
	 *
	 * @param int $start Pagination start page
	 * @param int $limit Pagination limit
	 * @access public
	 */
	public function search_feedback($start, $limit)
	{
		$start = (int) $start;
		$limit = (int) $limit;
		
		// get form data
		$uid = $this->request->variable('u', ANONYMOUS);
		$un = $this->request->variable('un', '', true);
		$filter_role = $this->request->variable('fr', 'all');
		$filter_vote = $this->request->variable('fv', 'all');
		$ord_by = $this->request->variable('ord_by', 'date');
		$ord_type = $this->request->is_set('asc') ? 'asc' : 'desc';
		if (!in_array($filter_role, array('buyer', 'seller', 'trade')))
		{
			$filter_role = 'all';
		}
		if (!in_array($filter_vote, array('positive', 'neutral', 'negative')))
		{
			$filter_vote = 'all';
		}
		if (!in_array($ord_by, array('from', 'ip')))
		{
			$ord_by = 'date';
		}
		
		if ($un)
		{
			$where_clause = "username_clean = '" . $this->db->sql_escape(utf8_clean_string($un)) . "'";
		}
		else
		{
			$where_clause = "user_id = $uid";
		}
		
		// get user data
		$q = 'SELECT
				user_id,
				user_type,
				username,
				user_colour
				FROM ' . USERS_TABLE . '
				WHERE ' . $where_clause;
		$r = $this->db->sql_query($q);
		$a = $this->db->sql_fetchrow($r);
		if (!$a)
		{
			trigger_error($this->user->lang['NO_USER']);
		}
		$this->db->sql_freeresult($r);
		
		if ($a['user_type'] == USER_IGNORE)
		{
			trigger_error($this->user->lang['NO_USER']);		
		}
		
		$uid = $a['user_id'];
		$un = $a['username'];
		$uc = $a['user_colour'];
		
		// get general feedback data
		$q = 'SELECT
				userfeedback_pos,
				userfeedback_neg,
				userfeedback_neu
				FROM ' . $this->table_feedback_tot . "
				WHERE userfeedback_user = $uid";
		$r = $this->db->sql_query($q);
		$a = $this->db->sql_fetchrow($r);
		if (!$a)
		{
			$a['userfeedback_pos'] = 0;
			$a['userfeedback_neu'] = 0;
			$a['userfeedback_neg'] = 0;
		}					
		$this->db->sql_freeresult($r);
		
		$pos = (int) $a['userfeedback_pos'];
		$neu = (int) $a['userfeedback_neu'];
		$neg = (int) $a['userfeedback_neg'];
		
		// calculate score if enabled
		$score = false;
		$percentage = false;
		if ($this->config['userfeedback_score'])
		{
			$score = $pos - $neg;
			$percentage = 0;
			$tot = $pos + $neg;
			if ($tot)
			{
				$percentage = round(($pos / $tot) * 100);
			}
		}
		
		//
		// get user detailed feedback data
		//
		
		$q_filters = '';
		if ($this->config['userfeedback_role_enable'])
		{
			if ($filter_role === 'trade')
			{
				$q_filters .= ' AND f.userfeedback_role = 0';
			}
			elseif ($filter_role === 'buyer')
			{
				$q_filters .= ' AND f.userfeedback_role = 1';
			}
			elseif ($filter_role === 'seller')
			{
				$q_filters .= ' AND f.userfeedback_role = 2';
			}
		}
		
		if ($filter_vote === 'negative')
		{
			$q_filters .= ' AND f.userfeedback_vote = 0';
		}
		elseif ($filter_vote === 'positive')
		{
			$q_filters .= ' AND f.userfeedback_vote = 1';
		}
		elseif ($filter_vote === 'neutral')
		{
			$q_filters .= ' AND f.userfeedback_vote = 2';
		}
		
		if ($ord_by === 'from')
		{
			$q_filters .= ' ORDER BY u.username_clean ' . $ord_type;
		}
		elseif ($ord_by === 'ip')
		{
			$q_filters .= ' ORDER BY INET_ATON(f.userfeedback_ip) ' . $ord_type;						
		}
		else
		{
			$q_filters .= ' ORDER BY f.userfeedback_' . $ord_by . ' ' . $ord_type;
		}
		
		// get details total
		$q = 'SELECT
				COUNT(f.userfeedback_id) as total_feedbacks
				FROM ' . $this->table_feedback . ' as f, ' . USERS_TABLE . " as u
				WHERE f.userfeedback_to = $uid
					AND u.user_id = f.userfeedback_from";
		
		$r = $this->db->sql_query($q . $q_filters);
		$total_feedbacks = (int) $this->db->sql_fetchfield('total_feedbacks');
		$this->db->sql_freeresult($r);
		
		// get detailed feedback data
		$q = 'SELECT
				f.userfeedback_id,
				f.userfeedback_to,
				f.userfeedback_from,
				f.userfeedback_role,
				f.userfeedback_vote,
				f.userfeedback_link,
				f.userfeedback_comment,
				f.userfeedback_ip,
				f.userfeedback_date,
				f.bbcode_bitfield,
				f.bbcode_uid,
				u.username,
				u.user_colour
				FROM ' . $this->table_feedback . ' as f, ' . USERS_TABLE . " as u
				WHERE f.userfeedback_to = $uid
					AND u.user_id = f.userfeedback_from";
					
		// if paginating feedbacks
		if ($this->pagination_enabled)
		{
			$r = $this->db->sql_query_limit($q . $q_filters, $limit, $start);
		}
		else
		{
			$r = $this->db->sql_query($q . $q_filters);
		}
		
		// assign detailed feedback values for display
		while ($a = $this->db->sql_fetchrow($r))
		{
			if ((int) $a['userfeedback_role'] === common_constants::ROLE_BUYER)
			{
				$role = $this->user->lang['ACP_USERFEEDBACK_ROLE_BUYER'];
			}
			elseif ((int) $a['userfeedback_role'] === common_constants::ROLE_SELLER)
			{
				$role = $this->user->lang['ACP_USERFEEDBACK_ROLE_SELLER'];
			}
			else
			{
				$role = $this->user->lang['ACP_USERFEEDBACK_ROLE_TRADE'];
			}
			
			if ((int) $a['userfeedback_vote'] === common_constants::VOTE_POSITIVE)
			{
				$vote = '<span style="color:green;">' . $this->user->lang['ACP_USERFEEDBACK_FILTER_POS'] . '</span>';
			}
			elseif ((int) $a['userfeedback_vote'] === common_constants::VOTE_NEGATIVE)
			{
				$vote = '<span style="color:black;">' . $this->user->lang['ACP_USERFEEDBACK_FILTER_NEU'] . '</span>';
			}
			else
			{
				$vote = '<span style="color:red;">' . $this->user->lang['ACP_USERFEEDBACK_FILTER_NEG'] . '</span>';
			}
			
			if ($a['userfeedback_link'])
			{
				$link = generate_board_url() . '/viewtopic.' . $this->php_ext . '?t=' . $a['userfeedback_link'];
			}
			else
			{
				$link = false;
			}
			
			if (!class_exists('\parse_message'))
			{
				include($this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext);
			}
			$comm_parser = new \parse_message($a['userfeedback_comment']);
			$comm_parser->bbcode_bitfield = $a['bbcode_bitfield'];
			$comm_parser->bbcode_uid = $a['bbcode_uid'];
			$comm_parser->format_display(true, true, true);
		
			$this->template->assign_block_vars('feedback', array(
				'USERFEEDBACK_URL'			=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=" . $a['userfeedback_from'],
				'USERFEEDBACK_USER'			=> get_username_string('username', $a['userfeedback_from'], $a['username'], $a['user_colour']),
				'USERFEEDBACK_USER_COL'		=> get_username_string('colour', $a['userfeedback_from'], $a['username'], $a['user_colour']),
				'USERFEEDBACK_PROFILE'		=> get_username_string('profile', $a['userfeedback_from'], $a['username'], $a['user_colour']),
				'USERFEEDBACK_TO'			=> $a['userfeedback_to'],
				'USERFEEDBACK_FROM'			=> $a['userfeedback_from'],
				'USERFEEDBACK_ROLE'			=> $role,
				'USERFEEDBACK_VOTE'			=> $vote,
				'USERFEEDBACK_LINK'			=> $link,
				'USERFEEDBACK_COMMENT'		=> $comm_parser->message,
				'USERFEEDBACK_IP'			=> $a['userfeedback_ip'],
				'USERFEEDBACK_DATE'			=> $this->user->format_date($a['userfeedback_date'], 'd/m/y'),
				'USERFEEDBACK_EDIT'			=> true,
				'USERFEEDBACK_EDITURL'		=> "{$this->u_action}&amp;mode=manage&amp;action=edit&amp;feedback=" . $a['userfeedback_id'],
				'USERFEEDBACK_DELETEURL'	=> "{$this->u_action}&amp;mode=manage&amp;action=delete&amp;feedback=" . $a['userfeedback_id'],
			));
		}
		$this->db->sql_freeresult($r);
		
		// assign user and general feedback values for display
		$this->template->assign_vars(array(
			'USERFEEDBACK_TOUSER'			=> get_username_string('full', $uid, $un, $uc),
			'USERFEEDBACK_SCORE'			=> $score,
			'USERFEEDBACK_PERCENTAGE'		=> $percentage,
			'USERFEEDBACK_POS'				=> $pos,
			'USERFEEDBACK_NEG'				=> $neg,
			'USERFEEDBACK_NEU'				=> $neu,
			'USERFEEDBACK_TOT_FEEDBACKS'	=> $this->user->lang('ACP_USERFEEDBACK_NUM_FEEDBACKS', $total_feedbacks),
			'USERFEEDBACK_ACTION'			=> "{$this->u_action}&amp;mode=manage&amp;action=add&amp;user_id=$uid",
			'USERFEEDBACK_ROLE_ALL'			=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fv=$filter_vote&amp;$ord_type",
			'USERFEEDBACK_ROLE_BUYER'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=buyer&amp;fv=$filter_vote&amp;$ord_type",
			'USERFEEDBACK_ROLE_SELLER'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=seller&amp;fv=$filter_vote&amp;$ord_type",
			'USERFEEDBACK_ROLE_TRADE'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=trade&amp;fv=$filter_vote&amp;$ord_type",
			'USERFEEDBACK_FILTER_ALL'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fr=$filter_role&amp;$ord_type",
			'USERFEEDBACK_FILTER_POS'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=positive&amp;$ord_type",
			'USERFEEDBACK_FILTER_NEU'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=neutral&amp;$ord_type",
			'USERFEEDBACK_FILTER_NEG'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=negative&amp;$ord_type",
			'USERFEEDBACK_ORDER_FROMA'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=from&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc",
			'USERFEEDBACK_ORDER_FROMD'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=from&amp;fr=$filter_role&amp;fv=$filter_vote",
			'USERFEEDBACK_ORDER_IPA'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=ip&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc",
			'USERFEEDBACK_ORDER_IPD'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=ip&amp;fr=$filter_role&amp;fv=$filter_vote",
			'USERFEEDBACK_ORDER_DATEA'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=date&amp;fr=$filter_role&amp;fv=$filter_vote&amp;asc",
			'USERFEEDBACK_ORDER_DATED'		=> "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=date&amp;fr=$filter_role&amp;fv=$filter_vote",
			'USERFEEDBACK_S_ROLE'			=> $this->config['userfeedback_role_enable'],
			'USERFEEDBACK_S_LINK'			=> $this->config['userfeedback_link_enable'],
			'USERFEEDBACK_S_PAGINATION'		=> $this->pagination_enabled,
			'PAGE_NUMBER'					=> $this->pagination_enabled ? $this->pagination->on_page($total_feedbacks, $limit, $start) : 1,
			'USERFEEDBACK_PAGE'				=> 'show',
		));
		
		// if using pagination
		if ($this->pagination_enabled)
		{
			$page_url = "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$uid&amp;ord_by=$ord_by&amp;fr=$filter_role&amp;fv=$filter_vote&amp;$ord_type";
			
			$this->pagination->generate_template_pagination($page_url, 'pagination', 'start', $total_feedbacks, $limit, $start);
		}
	}
	
	/**
	 * Add user feedback
	 *
	 * @access public
	 */
	public function add_feedback()
	{
		// get form data
		$to_id = $this->request->variable('user_id', 0);
		$submit = $this->request->is_set_post('submit') ? true : false;
		
		// get user data
		$q = 'SELECT
				user_type,
				username,
				user_lang,
				user_colour
				FROM ' . USERS_TABLE . "
				WHERE user_id = $to_id";
		$r = $this->db->sql_query($q);
		$a = $this->db->sql_fetchrow($r);
		$this->db->sql_freeresult($r);
		if (!$a)
		{
			trigger_error($this->user->lang['NO_USER']);
		}
		if ($a['user_type'] == USER_IGNORE)
		{
			trigger_error($this->user->lang['NO_USER']);		
		}
		
		$to_lang = $a['user_lang'];
		if (!$submit) // display page
		{
			$hidden = build_hidden_fields(array(
				'submit'	=> true,
				'user_id'	=> $to_id,
			));
			add_form_key('add_feedback');
			$this->template->assign_vars(array(
				'USERFEEDBACK_TOUSER'			=> get_username_string('full', $to_id, $a['username'], $a['user_colour']),
				'USERFEEDBACK_ACTION'			=> "{$this->u_action}&amp;mode=manage&amp;action=add",
				'USERFEEDBACK_HIDDEN'			=> $hidden,
				'USERFEEDBACK_S_ROLE'			=> $this->config['userfeedback_role_enable'],
				'USERFEEDBACK_S_LINK'			=> $this->config['userfeedback_link_enable'],
				'USERFEEDBACK_S_LINK_FORCE'		=> $this->config['userfeedback_link_force'],
				'USERFEEDBACK_PAGE'				=> 'add',
			));
		}
		else // submit data
		{
			// validate form data
			if (!check_form_key('add_feedback'))
			{
				trigger_error($this->user->lang['FORM_INVALID']);
			}
			$to_un = $a['username'];
			$from_un = $this->request->variable('from', '', true);
			$role = $this->request->variable('role', 0);
			$vote = $this->request->variable('vote', 0);
			$link = $this->request->variable('link', 0);
			$comm = $this->request->variable('comment', '', true);
			if ($role !== common_constants::ROLE_BUYER && $role !== common_constants::ROLE_SELLER)
			{
				$role = common_constants::ROLE_TRADE;
			}
			if ($vote !== common_constants::VOTE_NEGATIVE && $vote !== common_constants::VOTE_POSITIVE)
			{
				$vote = common_constants::VOTE_NEUTRAL;
			}
			
			// get user data
			$q = 'SELECT
					user_id
					FROM ' . USERS_TABLE . "
					WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($from_un)) . "'";
			$r = $this->db->sql_query($q);
			if (!$a = $this->db->sql_fetchrow($r))
			{
				trigger_error($this->user->lang['NO_USER']);
			}
			$this->db->sql_freeresult($r);
			$from_id = $a['user_id'];
			
			// get general feedback data
			$q = 'SELECT * 
					FROM ' . $this->table_feedback_tot . "
					WHERE userfeedback_user = $to_id";
			$r = $this->db->sql_query($q);
			if (!$this->db->sql_fetchrow($r))
			{
				$insert = array(
					'userfeedback_user'	=> $to_id,
				);
				$this->db->sql_query('INSERT INTO ' . $this->table_feedback_tot . ' ' . $this->db->sql_build_array('INSERT', $insert));
			}
			$this->db->sql_freeresult($r);
			
			// insert feedback data
			if (!class_exists('\parse_message'))
			{
				include($this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext);
			}
			$comm_parser = new \parse_message($comm);
			$comm_parser->parse(true, true, true, false, false, false, true);
			$insert = array(
				'userfeedback_to'			=> $to_id,
				'userfeedback_from'			=> $from_id,
				'userfeedback_role'			=> $role,
				'userfeedback_vote'			=> $vote,
				'userfeedback_link'			=> $link,
				'userfeedback_comment'		=> $comm_parser->message,
				'userfeedback_ip'			=> $this->user->ip,
				'userfeedback_date'			=> time(),
				'bbcode_bitfield'			=> $comm_parser->bbcode_bitfield,
				'bbcode_uid'				=> $comm_parser->bbcode_uid,
			);
			$this->db->sql_query('INSERT INTO ' . $this->table_feedback . ' ' . $this->db->sql_build_array('INSERT', $insert));
			
			if (!file_exists($this->extension_manager->get_extension_path('riccardobianconi/userfeedback') . 'language/' . basename($to_lang) . '/info_acp_userfeedback.' . $this->php_ext))
			{
				$to_lang = $this->config['default_lang'];
			}
			include($this->extension_manager->get_extension_path('riccardobianconi/userfeedback') . 'language/' . basename($to_lang) . '/info_acp_userfeedback.' . $this->php_ext);
			
			if ($vote === common_constants::VOTE_NEGATIVE)
			{		
				$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neg = userfeedback_neg + 1 WHERE userfeedback_user = ' . $to_id);
				$vote_text = $lang['ACP_USERFEEDBACK_FILTER_NEG'];
			}
			elseif ($vote === common_constants::VOTE_POSITIVE)
			{
				$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_pos = userfeedback_pos + 1 WHERE userfeedback_user = ' . $to_id);
				$vote_text = $lang['ACP_USERFEEDBACK_FILTER_POS'];
			}
			else
			{
				$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neu = userfeedback_neu + 1 WHERE userfeedback_user = ' . $to_id);
				$vote_text = $lang['ACP_USERFEEDBACK_FILTER_NEU'];
			}
			
			// send notice of addition via private message to user
			if (!function_exists('submit_pm'))
			{
				include($this->phpbb_root_path . 'includes/functions_privmsgs.' . $this->php_ext);
			}
			$pm_parser = new \parse_message();
			$pm_parser->message = sprintf($lang['ACP_USERFEEDBACK_NEWFEEDBACKMSG'], $vote_text, $from_un);
			$pm_parser->parse(true, true, true, false, false, true, true);
			$pm_data = array(
				'from_user_id'		=> $from_id,
				'from_user_ip'		=> $this->user->ip,
				'from_username'		=> $from_un,
				'enable_sig'		=> false,
				'enable_bbcode'		=> true,
				'enable_smilies'	=> true,
				'enable_urls'		=> false,
				'icon_id'			=> 0,
				'bbcode_bitfield'	=> $pm_parser->bbcode_bitfield,
				'bbcode_uid'		=> $pm_parser->bbcode_uid,
				'message'			=> $pm_parser->message,
				'address_list'		=> array('u' => array($to_id => 'to')),
			);
			submit_pm('post', $lang['ACP_USERFEEDBACK_NEWFEEDBACK'], $pm_data, false);
		
			// show result
			meta_refresh(3, "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=$to_id");
			trigger_error($this->user->lang['ACP_USERFEEDBACK_ADDED']);
		}
	}
	
	/**
	 * Edit user feedback
	 *
	 * @access public
	 */
	public function edit_feedback()
	{
		// get form data
		$feed_id = $this->request->variable('feedback',0);
		$submit = $this->request->is_set_post('submit') ? true : false;
		
		// get feedback to edit data
		$q = 'SELECT
				f.userfeedback_to,
				f.userfeedback_from,
				f.userfeedback_role,
				f.userfeedback_vote,
				f.userfeedback_link,
				f.userfeedback_comment,
				f.bbcode_bitfield,
				f.bbcode_uid,
				u.username,
				u.user_colour
				FROM ' . $this->table_feedback . ' as f, ' . USERS_TABLE . " as u
				WHERE f.userfeedback_id = $feed_id
					AND f.userfeedback_to = u.user_id";
		$r = $this->db->sql_query($q);
		$a = $this->db->sql_fetchrow($r);
		$this->db->sql_freeresult($r);
		if (!$a)
		{
			trigger_error($this->user->lang['USERFEEDBACK_NOFOUND']);
		}
		
		if (!$submit) // show form
		{
			$hidden = build_hidden_fields(array(
				'submit'	=> true,
				'feedback'	=> $feed_id,
			));
			
			if (!class_exists('\parse_message'))
			{
				include($this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext);
			}
			$comm_parser = new \parse_message($a['userfeedback_comment']);
			$comm_parser->decode_message($a['bbcode_uid']);
			
			add_form_key('edit_feedback');
			
			$this->template->assign_vars(array(
				'USERFEEDBACK_FROM'			=> $a['userfeedback_from'],
				'USERFEEDBACK_TOUSER'		=> get_username_string('full', $a['userfeedback_to'], $a['username'], $a['user_colour']),
				'USERFEEDBACK_ROLE'			=> $a['userfeedback_role'],
				'USERFEEDBACK_VOTE'			=> $a['userfeedback_vote'],
				'USERFEEDBACK_LINK'			=> $a['userfeedback_link'],
				'USERFEEDBACK_COMM'			=> $comm_parser->message,
				'USERFEEDBACK_ACTION'		=> "{$this->u_action}&amp;mode=manage&amp;action=edit",
				'USERFEEDBACK_HIDDEN'		=> $hidden,
				'USERFEEDBACK_S_ROLE'		=> $this->config['userfeedback_role_enable'],
				'USERFEEDBACK_S_LINK'		=> $this->config['userfeedback_link_enable'],
				'USERFEEDBACK_S_LINK_FORCE'	=> $this->config['userfeedback_link_force'],
				'USERFEEDBACK_PAGE'			=> 'edit',
			));
		}
		else // submit form
		{
			// get form data
			if (!check_form_key('edit_feedback')){
				trigger_error($this->user->lang['FORM_INVALID']);
			}
			$role = $this->request->variable('role', 0);
			$vote = $this->request->variable('vote', 0);
			$link = $this->request->variable('link', 0);
			$comm = $this->request->variable('comment', '', true);
			if ($role !== common_constants::ROLE_BUYER && $role !== common_constants::ROLE_SELLER)
			{
				$role = common_constants::ROLE_TRADE;
			}
			if ($vote !== common_constants::VOTE_NEGATIVE && $vote !== common_constants::VOTE_POSITIVE)
			{
				$vote = common_constants::VOTE_NEUTRAL;
			}
		
			// update feedback data
			if (!class_exists('\parse_message'))
			{
				include($this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext);
			}
			$comm_parser = new \parse_message($comm);
			$comm_parser->parse(true, true, true, false, false, false, true);
			$update = array(
				'userfeedback_to'		=> $a['userfeedback_to'],
				'userfeedback_from'		=> $a['userfeedback_from'],
				'userfeedback_role'		=> $role,
				'userfeedback_vote'		=> $vote,
				'userfeedback_link'		=> $link,
				'userfeedback_comment'	=> $comm_parser->message,
				'userfeedback_ip'		=> $this->user->ip,
//				'userfeedback_date'		=> time(),
				'bbcode_bitfield'		=> $comm_parser->bbcode_bitfield,
				'bbcode_uid'			=> $comm_parser->bbcode_uid,
			);
			$this->db->sql_query('UPDATE ' . $this->table_feedback . ' SET ' . $this->db->sql_build_array('UPDATE', $update) . ' WHERE userfeedback_id = ' . $feed_id);
		
			$previous_vote = (int) $a['userfeedback_vote'];
			if ($vote !== $previous_vote)
			{
				if ($previous_vote === common_constants::VOTE_NEGATIVE)
				{	
					$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neg = userfeedback_neg - 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
				}
				elseif ($previous_vote === common_constants::VOTE_POSITIVE)
				{
					$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_pos = userfeedback_pos - 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
				}
				else
				{
					$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neu = userfeedback_neu - 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
				}
				
				if ($vote === common_constants::VOTE_NEGATIVE)
				{	
					$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neg = userfeedback_neg + 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
				}
				elseif ($vote === common_constants::VOTE_POSITIVE)
				{
					$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_pos = userfeedback_pos + 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
				}
				else
				{
					$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neu = userfeedback_neu + 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
				}
			}				
		
			meta_refresh(3, "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=" . $a['userfeedback_to']);
			trigger_error($this->user->lang['ACP_USERFEEDBACK_EDITED']);
		}
	}
	
	/**
	 * Delete user feedback
	 *
	 * @access public
	 */
	public function delete_feedback()
	{
		if ($this->user->data['user_id'] == ANONYMOUS)
		{
			login_box('');
		}
		
		$confirm = false;
		if (confirm_box(true))
		{
			$confirm = true;
		}
		else
		{
			confirm_box(false, $this->user->lang['ACP_USERFEEDBACK_DELETE']);
		}
		
		$from_id = (int)$this->user->data['user_id'];
		$feed_id = $this->request->variable('feedback', 0);
		
		$q = 'SELECT
				f.userfeedback_to,
				f.userfeedback_vote,
				u.username
				FROM ' . $this->table_feedback . ' as f, ' . USERS_TABLE . " as u
				WHERE f.userfeedback_id = $feed_id
					AND f.userfeedback_to = u.user_id";
		$r = $this->db->sql_query($q);
		$a = $this->db->sql_fetchrow($r);
		$this->db->sql_freeresult($r);
		if (!$a)
		{
			trigger_error($this->user->lang['ACP_USERFEEDBACK_NOFOUND']);
		}
		
		if (!$confirm)
		{
			meta_refresh(1, "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=" . $a['userfeedback_to']);
			trigger_error($this->user->lang['BACK_TO_PREV']);
		}
		
		$this->db->sql_query('DELETE FROM ' . $this->table_feedback . ' WHERE userfeedback_id = ' . $feed_id);
		
		$vote = (int) $a['userfeedback_vote'];
		if ($vote === common_constants::VOTE_NEGATIVE)
		{	
			$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neg = userfeedback_neg - 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
		}
		elseif ($vote === common_constants::VOTE_POSITIVE)
		{
			$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_pos = userfeedback_pos - 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
		}
		else
		{
			$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . ' SET userfeedback_neu = userfeedback_neu - 1 WHERE userfeedback_user = ' . $a['userfeedback_to']);
		}
		
		$q = 'DELETE
				FROM ' . $this->table_feedback_tot . '
				WHERE userfeedback_pos = 0
				AND userfeedback_neg = 0
				AND userfeedback_neu = 0';
		$r = $this->db->sql_query($q);
		
		meta_refresh(3, "{$this->u_action}&amp;mode=manage&amp;action=search&amp;u=" . $a['userfeedback_to']);
		trigger_error($this->user->lang['ACP_USERFEEDBACK_DELETED']);
	}
	
	/**
	 * Set form action url
	 *
	 * @access public
	 */
	public function set_form_action_url($u_action)
	{
		$this->u_action = $u_action;
	}
	
	/**
	 * Set if enable pagination
	 *
	 * @access public
	 */
	public function set_pagination_enabled($pagination_enabled)
	{
		$this->pagination_enabled = $pagination_enabled;
	}
}
