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
 * Extension main controller
 */
class main_controller
{
	/**
	 * Auth object
	 * @var \phpbb\auth\auth
	 */
	protected $auth;
	
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
	 * Helper object
	 * @var \phpbb\controller\helper
	 */
	protected $helper;
	
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
	 * Variable to check if pagination is enabled
	 * @var bool
	 */
	protected $pagination_enabled;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth $auth Auth object
	 * @param \phpbb\db\driver\driver_interface $db Database object
	 * @param \phpbb\config\config $config Config object
	 * @param \phpbb\extension\manager $extension_manager Extension manager object
	 * @param \phpbb\controller\helper $helper Helper object
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
	public function __construct(\phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\extension\manager $extension_manager, \phpbb\controller\helper $helper, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext, $table_feedback, $table_feedback_tot)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->config = $config;
		$this->extension_manager = $extension_manager;
		$this->helper = $helper;
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
	 * Entry point for displaying pages
	 *
	 * @param string $mode Select page to display
	 * @return Response object containing rendered page
	 * @access public
	 */
	public function display($mode)
	{
		$this->user->add_lang_ext('riccardobianconi/userfeedback', 'userfeedback');
	
		if (!$this->auth->acl_get('u_userfeedback_access'))
		{
			trigger_error($this->user->lang('USERFEEDBACK_CANNOTACCESS'));
		}
		
		switch ($mode)
		{
			case 'feedback':
				$start = $this->request->variable('start', 0);
				$limit = (int) $this->config['userfeedback_pag_feedbacks_per_page'];
				$this->pagination_enabled = ($limit > 0) ? true : false;
				$this->show_feedback(0, $start, $limit);
			break;
			
			case 'myfeedback':
				$start = $this->request->variable('start', 0);
				$limit = (int) $this->config['userfeedback_pag_feedbacks_per_page'];
				$this->pagination_enabled = ($limit > 0) ? true : false;
				$this->show_feedback(1, $start, $limit);
			break;
			
			case 'add':
				$this->add_feedback();
			break;
			
			case 'edit':
				$this->edit_feedback();
			break;
			
			case 'delete':
				$this->delete_feedback();
			break;
			
			case 'best';
				$this->top_feedback('best');
			break;
			
			case 'worst';
				$this->top_feedback('worst');
			break;
			
			default:
				$this->index();
			break;
		}
	
		return $this->helper->render('feedback_body.html', $this->user->lang('USERFEEDBACK_TITLE'));
	}
	
	/**
	 * Extension entry page
	 *
	 * @access protected
	 */
	protected function index()
	{
		// get best users
		$r = $this->extract_best_worst('best', $this->config['userfeedback_top_main']);
		$this->template->assign_block_vars('best', array());
		while ($a = $this->db->sql_fetchrow($r))
		{
			if (!$this->config['userfeedback_score'])
			{
				$this->template->assign_block_vars('best', array(
					'USERFEEDBACK_LINK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['user_id'])),
					'USERFEEDBACK_USER'		=> get_username_string('username', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_USER_COL'	=> get_username_string('colour', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_PROFILE'	=> get_username_string('profile', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_POS'		=> $a['userfeedback_pos'],
					'USERFEEDBACK_NEG'		=> $a['userfeedback_neg'],
					'USERFEEDBACK_NEU'		=> $a['userfeedback_neu'],
				));
			}
			else
			{
				$this->template->assign_block_vars('best', array(
					'USERFEEDBACK_LINK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['user_id'])),
					'USERFEEDBACK_USER'		=> get_username_string('username', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_USER_COL'	=> get_username_string('colour', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_PROFILE'	=> get_username_string('profile', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_SCORE'	=> $a['userfeedback_score'],
				));
			}
		}
		$this->db->sql_freeresult($r);
		
		// get worst users
		$r = $this->extract_best_worst('worst', $this->config['userfeedback_top_main']);
		$this->template->assign_block_vars('worst', array());
		while ($a = $this->db->sql_fetchrow($r))
		{
			if (!$this->config['userfeedback_score'])
			{
				$this->template->assign_block_vars('worst', array(
					'USERFEEDBACK_LINK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['user_id'])),
					'USERFEEDBACK_USER'		=> get_username_string('username', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_USER_COL'	=> get_username_string('colour', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_PROFILE'	=> get_username_string('profile', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_POS'		=> $a['userfeedback_pos'],
					'USERFEEDBACK_NEG'		=> $a['userfeedback_neg'],
					'USERFEEDBACK_NEU'		=> $a['userfeedback_neu'],
				));
			}
			else
			{
				$this->template->assign_block_vars('worst', array(
					'USERFEEDBACK_LINK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['user_id'])),
					'USERFEEDBACK_USER'		=> get_username_string('username', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_USER_COL'	=> get_username_string('colour', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_PROFILE'	=> get_username_string('profile', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_SCORE'	=> $a['userfeedback_score'],
				));
			}
		}
		$this->db->sql_freeresult($r);
		
		// assign values for output
		$this->template->assign_vars(array(
			'USERFEEDBACK_ACTION'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback')),
			'USERFEEDBACK_MOREBEST'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'best')),
			'USERFEEDBACK_MOREWORST'	=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'worst')),
			'USERFEEDBACK_S_SCORE'		=> $this->config['userfeedback_score'],
			'USERFEEDBACK_PAGE'			=> 'index',
		));
	}
	
	/**
	 * List user feedback
	 *
	 * @param bool $my_feedback Flag for choosing between logged or any user feedback
	 * @param int $start Pagination start page
	 * @param int $limit Pagination limit
	 * @access protected
	 */
	protected function show_feedback($my_feedback, $start, $limit)
	{
		// set target user
		if ((bool) $my_feedback)
		{
			if ($this->user->data['user_id'] == ANONYMOUS)
			{
				login_box('');
			}
			$uid = $this->user->data['user_id'];
			$un = '';
		}
		else
		{
			$uid = $this->request->variable('u', ANONYMOUS);
			$un = $this->request->variable('un', '', true);
			if ($uid == ANONYMOUS && !$un)
			{
				trigger_error($this->user->lang['NO_USER']);
			}
		}
		
		$start = (int) $start;
		$limit = (int) $limit;
		
		//
		// set filters
		//
		
		$filter_role = $this->request->variable('fr', 'all');
		if (!in_array($filter_role, array('buyer', 'seller', 'trade')))
		{
			$filter_role = 'all';
		}
		
		$filter_vote = $this->request->variable('fv', 'all');
		if (!in_array($filter_vote, array('positive', 'neutral', 'negative')))
		{
			$filter_vote = 'all';
		}
		
		$ord_by = $this->request->variable('ord_by', 'date');
		if (!in_array($ord_by, array('from', 'ip')))
		{
			$ord_by = 'date';
		}
		
		$ord_type = $this->request->is_set('asc') ? 'asc' : 'desc';

		//
		// get user general data
		//
		
		if ($un)
		{
			$where_clause = "username_clean = '" . $this->db->sql_escape(utf8_clean_string($un)) . "'";
		}
		else
		{
			$where_clause = "user_id = $uid";
		}
		
		$q = 'SELECT
				user_id,
				user_type,
				username,
				user_colour
				FROM ' . USERS_TABLE . '
				WHERE ' . $where_clause;
		$r = $this->db->sql_query($q);
		if (!$a = $this->db->sql_fetchrow($r))
		{
			trigger_error($this->user->lang['NO_USER']);
		}
		$this->db->sql_freeresult($r);
		
		if ($a['user_type'] == USER_IGNORE)
		{
			trigger_error($this->user->lang['NO_USER']);
		}
		
		$uid = (int) $a['user_id'];
		$un = $a['username'];
		$uc = $a['user_colour'];
		
		//
		// get user general feedback data
		//
		
		$q = 'SELECT
				userfeedback_pos,
				userfeedback_neg,
				userfeedback_neu
				FROM ' . $this->table_feedback_tot . '
				WHERE userfeedback_user = ' . $uid;
		$r = $this->db->sql_query($q);
		if (!$a = $this->db->sql_fetchrow($r))
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
			$score = $pos * (float) $this->config['userfeedback_score_pos'] + 
					 $neu * (float) $this->config['userfeedback_score_neu'] +
					 $neg * (float) $this->config['userfeedback_score_neg'];
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
		
		// set query filters
		$q_filters = '';
		if ($this->config['userfeedback_role_enable'])
		{
			if ($filter_role == 'trade')
			{
				$q_filters .= ' AND f.userfeedback_role = 0';
			}
			elseif ($filter_role == 'buyer')
			{
				$q_filters .= ' AND f.userfeedback_role = 1';
			}
			elseif ($filter_role == 'seller')
			{
				$q_filters .= ' AND f.userfeedback_role = 2';
			}
		}
		
		if ($filter_vote == 'negative')
		{
			$q_filters .= ' AND f.userfeedback_vote = 0';
		}
		elseif ($filter_vote == 'positive')
		{
			$q_filters .= ' AND f.userfeedback_vote = 1';
		}
		elseif ($filter_vote == 'neutral')
		{
			$q_filters .= ' AND f.userfeedback_vote = 2';
		}
		
		if ($ord_by == 'from')
		{
			$q_filters .= ' ORDER BY u.username_clean ' . $ord_type;
		}
		elseif ($ord_by == 'ip')
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
		
		// get details
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
		
		while ($a = $this->db->sql_fetchrow($r))
		{
			$role = $this->decode_role($a['userfeedback_role']);
			$vote = $this->decode_vote($a['userfeedback_vote']);
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
			$comm_parser->format_display(true, $this->config['userfeedback_comm_url'], true);
			
			$this->template->assign_block_vars('feedback', array(
				'USERFEEDBACK_URL'			=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['userfeedback_from'])),
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
				'USERFEEDBACK_EDIT'			=> ($this->auth->acl_get('m_userfeedback_edit') || ($this->auth->acl_get('u_userfeedback_edit') && $a['userfeedback_from'] == (int) $this->user->data['user_id'])),
				'USERFEEDBACK_DELETE'		=> ($this->auth->acl_get('m_userfeedback_delete') || ($this->auth->acl_get('u_userfeedback_delete') && $a['userfeedback_from'] == (int) $this->user->data['user_id'])),
				'USERFEEDBACK_EDITURL'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'edit', 'feedback' => $a['userfeedback_id'])),
				'USERFEEDBACK_DELETEURL'	=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'delete', 'feedback' => $a['userfeedback_id'])),
			));
		}
		$this->db->sql_freeresult($r);
		
		// assign values for output
		$this->template->assign_vars(array(
			'USERFEEDBACK_TOUSER'			=> get_username_string('full', $uid, $un, $uc),
			'USERFEEDBACK_SCORE'			=> $score,
			'USERFEEDBACK_PERCENTAGE'		=> $percentage,
			'USERFEEDBACK_POS'				=> $pos,
			'USERFEEDBACK_NEG'				=> $neg,
			'USERFEEDBACK_NEU'				=> $neu,
			'USERFEEDBACK_TOT_FEEDBACKS'	=> $this->user->lang('USERFEEDBACK_NUM_FEEDBACKS', $total_feedbacks),
			'USERFEEDBACK_ACTION'			=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'add', 'user_id' => $uid)),
			'USERFEEDBACK_ROLE_ALL' 		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fv' => $filter_vote, $ord_type => 1)),
			'USERFEEDBACK_ROLE_BUYER' 		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => 'buyer', 'fv' => $filter_vote, $ord_type => 1)),
			'USERFEEDBACK_ROLE_SELLER'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => 'seller', 'fv' => $filter_vote, $ord_type => 1)),
			'USERFEEDBACK_ROLE_TRADE'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => 'trade', 'fv' => $filter_vote, $ord_type => 1)),
			'USERFEEDBACK_FILTER_ALL'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => $filter_role, $ord_type => 1)),
			'USERFEEDBACK_FILTER_POS' 		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => $filter_role, 'fv' => 'positive', $ord_type => 1)),
			'USERFEEDBACK_FILTER_NEU' 		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => $filter_role, 'fv' => 'neutral', $ord_type => 1)),
			'USERFEEDBACK_FILTER_NEG'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => $filter_role, 'fv' => 'negative', $ord_type => 1)),
			'USERFEEDBACK_ORDER_FROMA'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => 'from', 'fr' => $filter_role, 'fv' => $filter_vote, 'asc' => 1)),
			'USERFEEDBACK_ORDER_FROMD'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => 'from', 'fr' => $filter_role, 'fv' => $filter_vote)),
			'USERFEEDBACK_ORDER_IPA'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => 'ip', 'fr' => $filter_role, 'fv' => $filter_vote, 'asc' => 1)),
			'USERFEEDBACK_ORDER_IPD'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => 'ip', 'fr' => $filter_role, 'fv' => $filter_vote)),
			'USERFEEDBACK_ORDER_DATEA'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => 'date', 'fr' => $filter_role, 'fv' => $filter_vote, 'asc' => 1)),
			'USERFEEDBACK_ORDER_DATED'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => 'date', 'fr' => $filter_role, 'fv' => $filter_vote)),
			'ATTACH_ICON_IMG'				=> $this->user->img('icon_topic_latest', ''),
			'EDIT_IMG' 						=> $this->user->img('icon_post_edit', ''),
			'DELETE_IMG'					=> $this->user->img('icon_post_delete', ''),
			'USERFEEDBACK_SHOWIP'			=> $this->auth->acl_get('m_userfeedback_viewip'),
			'USERFEEDBACK_S_ROLE'			=> $this->config['userfeedback_role_enable'],
			'USERFEEDBACK_S_LINK'			=> $this->config['userfeedback_link_enable'],
			'USERFEEDBACK_S_PAGINATION'		=> $this->pagination_enabled,
			'PAGE_NUMBER'					=> $this->pagination_enabled ? $this->pagination->on_page($total_feedbacks, $limit, $start) : 1,
			'USERFEEDBACK_PAGE'				=> 'show',
		));
		
		// if using pagination
		if ($this->pagination_enabled)
		{
			$page_url = $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $uid, 'ord_by' => $ord_by, 'fr' => $filter_role, 'fv' => $filter_vote, $ord_type => 1));
			
			$this->pagination->generate_template_pagination($page_url, 'pagination', 'start', $total_feedbacks, $limit, $start);
		}
	}
	
	/**
	 * Add user feedback
	 *
	 * @access protected
	 */
	protected function add_feedback()
	{
		// check for logged user
		if ($this->user->data['user_id'] == ANONYMOUS)
		{
			login_box('');
		}
		
		// check for user permissions
		if (!$this->auth->acl_get('u_userfeedback_add'))
		{
			trigger_error($this->user->lang['USERFEEDBACK_CANNOTADD']);
		}
		
		$from_id = (int) $this->user->data['user_id'];
		$to_id = $this->request->variable('user_id', 0);
		$submit = $this->request->is_set_post('submit') ? true : false;
		
		// user cannot insert feedback to himself
		if ($from_id == $to_id)
		{
			trigger_error($this->user->lang['USERFEEDBACK_CANNOTYOURSELF']);
		}
		
		// check if user can insert more than a feedback per user
		if (!$this->auth->acl_get('u_userfeedback_addmore'))
		{
			$q = 'SELECT userfeedback_date
					FROM ' . $this->table_feedback . "
					WHERE userfeedback_from = $from_id
						AND userfeedback_to = $to_id";
			$r = $this->db->sql_query($q);
			if ($this->db->sql_fetchrow($r))
			{
				trigger_error($this->user->lang['USERFEEDBACK_ALREADYVOTED']);
			}
			$this->db->sql_freeresult($r);
		}
		
		// check for antiflood
		if ($this->config['userfeedback_antiflood'] > 0 && !$this->auth->acl_get('u_userfeedback_ignoreflood'))
		{
			$antiflood_time = time() - $this->config['userfeedback_antiflood'];
			$q = 'SELECT userfeedback_date
					FROM ' . $this->table_feedback . "
					WHERE userfeedback_from = $from_id
						AND userfeedback_date > '$antiflood_time'";
			$r = $this->db->sql_query($q);
			if ($this->db->sql_fetchrow($r))
			{
				trigger_error(sprintf($this->user->lang['USERFEEDBACK_ANTIFLOOD'], $this->config['userfeedback_antiflood']));
			}
			$this->db->sql_freeresult($r);
		}
		
		// check for antiflood on same user
		if ($this->config['userfeedback_antiflood_same'] > 0 && !$this->auth->acl_get('u_userfeedback_ignoreflood'))
		{
			$antiflood_same_time = time() - $this->config['userfeedback_antiflood_same'];
			$q = 'SELECT userfeedback_date
					FROM ' . $this->table_feedback . "
					WHERE userfeedback_from = $from_id
						AND userfeedback_to = $to_id
						AND userfeedback_date > '$antiflood_same_time'";
			$r = $this->db->sql_query($q);
			if ($this->db->sql_fetchrow($r))
			{
				trigger_error(sprintf($this->user->lang['USERFEEDBACK_ANTIFLOOD_SAME'], $this->config['userfeedback_antiflood_same']));
			}
			$this->db->sql_freeresult($r);
		}
		
		// get inserting user data
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
		
		if (!$submit) // show page with add feedback form
		{
			$hidden = build_hidden_fields(array(
				'submit'	=> true,
				'user_id'	=> $to_id,
			));
			add_form_key('add_feedback');
			$this->template->assign_vars(array(
				'USERFEEDBACK_TOUSER'		=> get_username_string('full', $to_id, $a['username'], $a['user_colour']),
				'USERFEEDBACK_ACTION'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'add')),
				'USERFEEDBACK_HIDDEN'		=> $hidden,
				'USERFEEDBACK_S_ROLE'		=> $this->config['userfeedback_role_enable'],
				'USERFEEDBACK_S_LINK'		=> $this->config['userfeedback_link_enable'],
				'USERFEEDBACK_S_LINK_FORCE'	=> $this->config['userfeedback_link_force'],
				'USERFEEDBACK_S_COMM_OPT'	=> $this->config['userfeedback_comm_minchars'] ? false : true,
				'USERFEEDBACK_PAGE'			=> 'add',
			));
		}
		else // submit form then show page with the result of submission
		{
			//
			// validate form submission
			//
			
			if (!check_form_key('add_feedback'))
			{
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
			if ($this->config['userfeedback_link_enable'])
			{
				$link_error = $this->check_link($link, $from_id, $to_id);
				if ($link_error)
				{
					trigger_error($link_error);
				}
			}
			else
			{
				$link = 0;
			}
			if (strlen($comm) < $this->config['userfeedback_comm_minchars'])
			{
				trigger_error(sprintf($this->user->lang['USERFEEDBACK_COMMENT_SHORT'], $this->config['userfeedback_comm_minchars']));
			}
			if (strlen($comm) > $this->config['userfeedback_comm_maxchars'])
			{
				trigger_error(sprintf($this->user->lang['USERFEEDBACK_COMMENT_LONG'], $this->config['userfeedback_comm_maxchars']));
			}
			
			// add feedback receiver to database if not already present
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
			$comm_parser->parse($this->auth->acl_get('u_userfeedback_bbcode'), $this->config['userfeedback_comm_url'], $this->auth->acl_get('u_userfeedback_smilies'), false, false, false, true);
			$insert = array(
				'userfeedback_to'		=> $to_id,
				'userfeedback_from'		=> $from_id,
				'userfeedback_role'		=> $role,
				'userfeedback_vote'		=> $vote,
				'userfeedback_link'		=> $link,
				'userfeedback_comment'	=> $comm_parser->message,
				'userfeedback_ip'		=> $this->user->ip,
				'userfeedback_date'		=> time(),
				'bbcode_bitfield'		=> $comm_parser->bbcode_bitfield,
				'bbcode_uid'			=> $comm_parser->bbcode_uid,
			);
			$this->db->sql_query('INSERT INTO ' . $this->table_feedback . ' ' . $this->db->sql_build_array('INSERT', $insert));
		
			// update user feedback total table
			if (!file_exists($this->extension_manager->get_extension_path('riccardobianconi/userfeedback') . 'language/' . basename($to_lang) . '/userfeedback.' . $this->php_ext))
			{
				$to_lang = $this->config['default_lang'];
			}
			include($this->extension_manager->get_extension_path('riccardobianconi/userfeedback') . 'language/' . basename($to_lang) . '/userfeedback.' . $this->php_ext);
			if ($vote === common_constants::VOTE_NEGATIVE)
			{
				$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . " SET userfeedback_neg = userfeedback_neg + 1 WHERE userfeedback_user = $to_id");
				$vote_text = $lang['USERFEEDBACK_FILTER_NEG'];
			}
			elseif ($vote === common_constants::VOTE_POSITIVE)
			{
				$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . " SET userfeedback_pos = userfeedback_pos + 1 WHERE userfeedback_user = $to_id");
				$vote_text = $lang['USERFEEDBACK_FILTER_POS'];
			}
			else
			{
				$this->db->sql_query('UPDATE ' . $this->table_feedback_tot . " SET userfeedback_neu = userfeedback_neu + 1 WHERE userfeedback_user = $to_id");
				$vote_text = $lang['USERFEEDBACK_FILTER_NEU'];
			}
			
			// send notice of addition via private message to user
			if (!function_exists('submit_pm'))
			{
				include($this->phpbb_root_path . 'includes/functions_privmsgs.' . $this->php_ext);
			}
			$pm_parser = new \parse_message();
			$pm_parser->message = sprintf($lang['USERFEEDBACK_NEWFEEDBACKMSG'], $vote_text, $this->user->data['username']);
			$pm_parser->parse(true, true, true, false, false, true, true);
			$pm_data = array(
				'from_user_id'		=> $this->user->data['user_id'],
				'from_user_ip'		=> $this->user->ip,
				'from_username'		=> $this->user->data['username'],
				'enable_sig'		=> false,
				'enable_bbcode'		=> false,
				'enable_smilies'	=> false,
				'enable_urls'		=> false,
				'icon_id'			=> 0,
				'bbcode_bitfield'	=> $pm_parser->bbcode_bitfield,
				'bbcode_uid'		=> $pm_parser->bbcode_uid,
				'message'			=> $pm_parser->message,
				'address_list'		=> array('u' => array($to_id => 'to')),
			);
			submit_pm('post', $lang['USERFEEDBACK_NEWFEEDBACK'], $pm_data, false);
		
			// show result
			meta_refresh(3, $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $to_id)));
			trigger_error($this->user->lang['USERFEEDBACK_ADDED']);
		}
	
	}
	
	/**
	 * Edit user feedback
	 *
	 * @access protected
	 */
	protected function edit_feedback()
	{
		// check for logged user
		if ($this->user->data['user_id'] == ANONYMOUS)
		{
			login_box('');
		}
		
		$from_id = (int)$this->user->data['user_id'];
		$feed_id = $this->request->variable('feedback', 0);
		$submit = $this->request->is_set_post('submit') ? true : false;
		
		// get feedback data
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
		
		// check for user permissions
		if (!$this->auth->acl_get('m_userfeedback_edit') && (!$this->auth->acl_get('u_userfeedback_edit') || $a['userfeedback_from'] != $from_id))
		{
			trigger_error($this->user->lang['USERFEEDBACK_CANNOTEDIT']);
		}
		
		if (!$submit) // show page with edit feedback form
		{
			$hidden = build_hidden_fields(array(
				'submit'	=> true,
				'feedback'	=> $feed_id,
			));
			add_form_key('edit_feedback');
			
			if (!class_exists('\parse_message'))
			{
				include($this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext);
			}
			$comm_parser = new \parse_message($a['userfeedback_comment']);
			$comm_parser->decode_message($a['bbcode_uid']);
			
			$this->template->assign_vars(array(
				'USERFEEDBACK_TOUSER'		=> get_username_string('full', $a['userfeedback_to'], $a['username'], $a['user_colour']),
				'USERFEEDBACK_ROLE'			=> $a['userfeedback_role'],
				'USERFEEDBACK_VOTE'			=> $a['userfeedback_vote'],
				'USERFEEDBACK_LINK'			=> $a['userfeedback_link'] ? $a['userfeedback_link'] : '',
				'USERFEEDBACK_COMM'			=> $comm_parser->message,
				'USERFEEDBACK_ACTION'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'edit')),
				'USERFEEDBACK_HIDDEN'		=> $hidden,
				'USERFEEDBACK_S_ROLE'		=> $this->config['userfeedback_role_enable'],
				'USERFEEDBACK_S_LINK'		=> $this->config['userfeedback_link_enable'],
				'USERFEEDBACK_S_LINK_FORCE'	=> $this->config['userfeedback_link_force'],
				'USERFEEDBACK_S_COMM_OPT'	=> $this->config['userfeedback_comm_minchars'] ? false : true,
				'USERFEEDBACK_PAGE'			=> 'edit',
			));
		}
		else // submit form then show page with the result of submission
		{
			//
			// validate form submission
			//
		
			if (!check_form_key('edit_feedback'))
			{
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
			if ($this->config['userfeedback_link_enable'])
			{
				$link_error = $this->check_link($link, $a['userfeedback_from'], $a['userfeedback_to']);
				if ($link_error)
				{
					trigger_error($link_error);
				}
			}
			else
			{
				$link = 0;
			}
			if (strlen($comm) < $this->config['userfeedback_comm_minchars'])
			{
				trigger_error(sprintf($this->user->lang['USERFEEDBACK_COMMENT_SHORT'], $this->config['userfeedback_comm_minchars']));
			}
			if (strlen($comm) > $this->config['userfeedback_comm_maxchars'])
			{
				trigger_error(sprintf($this->user->lang['USERFEEDBACK_COMMENT_LONG'], $this->config['userfeedback_comm_maxchars']));
			}
		
			// edit feedback data
			if (!class_exists('\parse_message'))
			{
				include($this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext);
			}
			$comm_parser = new \parse_message($comm);
			$comm_parser->parse($this->auth->acl_get('u_userfeedback_bbcode'), $this->config['userfeedback_comm_url'], $this->auth->acl_get('u_userfeedback_smilies'), false, false, false, true);
			$update = array(
				'userfeedback_to'		=> $a['userfeedback_to'],
				'userfeedback_from'		=> $a['userfeedback_from'],
				'userfeedback_role'		=> $role,
				'userfeedback_vote'		=> $vote,
				'userfeedback_link'		=> $link,
				'userfeedback_comment'	=> $comm_parser->message,
				'userfeedback_ip'		=> $this->user->ip,
				'userfeedback_date'		=> time(),
				'bbcode_bitfield'		=> $comm_parser->bbcode_bitfield,
				'bbcode_uid'			=> $comm_parser->bbcode_uid,
			);
			$this->db->sql_query('UPDATE ' . $this->table_feedback . ' SET ' . $this->db->sql_build_array('UPDATE', $update) . ' WHERE userfeedback_id = ' . $feed_id);
		
			// update user feedback total table
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
		
			meta_refresh(3, $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['userfeedback_to'])));
			trigger_error($this->user->lang['USERFEEDBACK_EDITED']);
		}

	}
	
	/**
	 * Delete user feedback
	 *
	 * @access protected
	 */
	protected function delete_feedback()
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
			confirm_box(false, $this->user->lang['USERFEEDBACK_DELETE']);
		}
	
		$from_id = (int)$this->user->data['user_id'];
		$feed_id = $this->request->variable('feedback', 0);
		
		// retrieve feedback data
		$q = 'SELECT
				f.userfeedback_to,
				f.userfeedback_from,
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
			trigger_error($this->user->lang['USERFEEDBACK_NOFOUND']);
		}
		
		if (!$confirm)
		{
			meta_refresh(1, $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['userfeedback_to'])));
			trigger_error($this->user->lang['BACK_TO_PREV']);
		}
		
		// check for permissions
		if (!$this->auth->acl_get('m_userfeedback_delete') && (!$this->auth->acl_get('u_userfeedback_delete') || $a['userfeedback_from'] != $from_id))
		{
			trigger_error($this->user->lang['USERFEEDBACK_CANNOTDELETE']);
		}
		
		// delete feedback
		$this->db->sql_query('DELETE FROM ' . $this->table_feedback . ' WHERE userfeedback_id = ' . $feed_id);
		
		// update user feedback total table
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
		
		// delete data from user feedback total table if all data are zeros
		$q = 'DELETE
				FROM ' . $this->table_feedback_tot . "
				WHERE userfeedback_pos = 0
				AND userfeedback_neg = 0
				AND userfeedback_neu = 0";
		$r = $this->db->sql_query($q);
		
		meta_refresh(3, $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['userfeedback_to'])));
		trigger_error($this->user->lang['USERFEEDBACK_DELETED']);
	}
	
	/**
	 * Retrieve best or worst users by user feedback
	 *
	 * @param string $type Select 'best' or 'worst' users
	 * @access protected
	 */
	protected function top_feedback($type)
	{
		// validate parameter
		$type = ($type == 'best') ? 'best' : 'worst';
		
		// get gest users
		$r = $this->extract_best_worst($type, $this->config['userfeedback_top_' . $type]);
		$this->template->assign_block_vars($type, array());
		
		// assign values for output
		while ($a = $this->db->sql_fetchrow($r))
		{
			if (!$this->config['userfeedback_score'])
			{
				$this->template->assign_block_vars($type, array(
					'USERFEEDBACK_LINK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['user_id'])),
					'USERFEEDBACK_USER'		=> get_username_string('username', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_USER_COL'	=> get_username_string('colour', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_PROFILE'	=> get_username_string('profile', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_POS'		=> $a['userfeedback_pos'],
					'USERFEEDBACK_NEG'		=> $a['userfeedback_neg'],
					'USERFEEDBACK_NEU'		=> $a['userfeedback_neu'],
				));
			}
			else
			{
				$this->template->assign_block_vars($type, array(
					'USERFEEDBACK_LINK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $a['user_id'])),
					'USERFEEDBACK_USER'		=> get_username_string('username', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_USER_COL'	=> get_username_string('colour', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_PROFILE'	=> get_username_string('profile', $a['user_id'], $a['username'], $a['user_colour']),
					'USERFEEDBACK_SCORE'	=> $a['userfeedback_score'],
				));
			}
		}
		$this->template->assign_vars(array(
			'USERFEEDBACK_S_SCORE'	=> $this->config['userfeedback_score'],
			'USERFEEDBACK_PAGE'		=> $type,
		));
	}
	
	/**
	 * Decode role for displaying
	 *
	 * @param int $role Role on user feedback
	 * @return string Role in html for display
	 * @access protected
	 */
	protected function decode_role($role)
	{
		$role = (int) $role;
		if ($role === common_constants::ROLE_BUYER)
		{
			return '<span class="buyer">' . $this->user->lang['USERFEEDBACK_ROLE_BUYER'] . '</span>';
		}
		elseif ($role === common_constants::ROLE_SELLER)
		{
			return '<span class="seller">' . $this->user->lang['USERFEEDBACK_ROLE_SELLER'] . '</span>';
		}
		return '<span class="trade">' . $this->user->lang['USERFEEDBACK_ROLE_TRADE'] . '</span>';
	}
	
	/**
	 * Decode vote for displaying
	 *
	 * @param int $vote Vote on user feedback
	 * @return string Role in html for display
	 * @access protected
	 */
	protected function decode_vote($vote)
	{
		$vote = (int) $vote;
		if ($vote === common_constants::VOTE_NEGATIVE)
		{
			return '<span class="negative">' . $this->user->lang['USERFEEDBACK_FILTER_NEG'] . '</span>';
		}
		elseif ($vote === common_constants::VOTE_POSITIVE)
		{
			return '<span class="positive">' . $this->user->lang['USERFEEDBACK_FILTER_POS'] . '</span>';
		}
		return '<span class="neutral">' . $this->user->lang['USERFEEDBACK_FILTER_NEU'] . '</span>';
	}
	
	/**
	 * Validate topic attached to user feedback
	 *
	 * @param int $topic Forum topic
	 * @param int $from User feedback from
	 * @param int $to User feedback to
	 * @return string Error message or empty string
	 * @access protected
	 */
	protected function check_link($topic, $from, $to)
	{
		$topic = (int) $topic;
		$from = (int) $from;
		$to = (int) $to;
		
		if (!$this->config['userfeedback_link_force'] && $topic == 0)
		{
			return '';
		}
		
		$q = 'SELECT
				forum_id,
				topic_poster
				FROM ' . TOPICS_TABLE . "
				WHERE topic_id = $topic";
		$r = $this->db->sql_query_limit($q, 1);
		$a = $this->db->sql_fetchrow($r);
		$this->db->sql_freeresult($r);
		if ($a)
		{
			if ($this->config['userfeedback_link_forum'])
			{
				if (!in_array($a['forum_id'], explode(',', $this->config['userfeedback_link_forum'])))
				{
					return sprintf($this->user->lang['USERFEEDBACK_INVALIDLINK2'], $this->config['userfeedback_link_forum']);
				}
			}
			if ($this->config['userfeedback_link_force_in'])
			{
				if (($a['topic_poster'] != $from)&&($a['topic_poster'] != $to))
				{
					return $this->user->lang['USERFEEDBACK_INVALIDLINK3'];
				}
			}
			return '';
		}
		return $this->user->lang['USERFEEDBACK_INVALIDLINK'];
	}
	
	/**
	 * Retrieve from database the best or worst users
	 *
	 * @param string $best_worst Flag for best or worst
	 * @param int $limit Number of best or worst users to retrieve
	 * @return mixed Query result handle with best or worst users, false on error
	 * @access protected
	 */
	protected function extract_best_worst($best_worst, $limit)
	{
		if (!$this->config['userfeedback_score'])
		{
			if ($best_worst == 'worst')
			{
				$best_worst = 'userfeedback_neg DESC, userfeedback_pos ASC, userfeedback_neu ASC';
			}
			else
			{
				$best_worst = 'userfeedback_pos DESC, userfeedback_neg ASC, userfeedback_neu ASC';
			}
			$q = 'SELECT
					f.userfeedback_pos,
					f.userfeedback_neg,
					f.userfeedback_neu,
					u.user_id,
					u.username,
					u.user_colour
					FROM ' . $this->table_feedback_tot . ' as f, ' . USERS_TABLE . " as u
					WHERE u.user_id = f.userfeedback_user
					ORDER BY $best_worst";
		}
		else
		{
			if ($best_worst == 'worst')
			{
				$best_worst = 'ASC';
			}
			else
			{
				$best_worst = 'DESC';
			}
			$q = 'SELECT
					((f.userfeedback_pos * ' . $this->config['userfeedback_score_pos'] . ') +
					(f.userfeedback_neg * ' . $this->config['userfeedback_score_neg'] . ') +
					(f.userfeedback_neu * ' . $this->config['userfeedback_score_neu'] . ')) as userfeedback_score,
					u.user_id,
					u.username,
					u.user_colour
					FROM ' . $this->table_feedback_tot . ' as f, ' . USERS_TABLE . " as u
					WHERE u.user_id = f.userfeedback_user
					ORDER BY userfeedback_score $best_worst";
		}
		return $this->db->sql_query_limit($q, abs((int) $limit));
	}
}
