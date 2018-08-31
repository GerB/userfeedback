<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\event;

/**
* Extension main event listener
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	/**
	 * Auth object
	 * @var \phpbb\auth\auth
	 */
	protected $auth;
	
	/**
	 * Helper object
	 * @var \phpbb\controller\helper
	 */
	protected $helper;

	/**
	 * Template object
	 * @var \phpbb\template\template
	 */
	protected $template;
	
	/**
	 * Extension common functions
	 * @var \riccardobianconi\userfeedback\common\common_functions
	 */
	protected $common_functions;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth $auth Auth object
	 * @param \phpbb\controller\helper $helper Helper object
	 * @param \phpbb\template\template $template Template object
	 * @param \riccardobianconi\userfeedback\common\common_functions $common_functions Extension common functions
	 * @access public
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\controller\helper $helper, \phpbb\template\template $template, \riccardobianconi\userfeedback\common\common_functions $common_functions)
	{
		$this->auth = $auth;
		$this->helper = $helper;
		$this->template = $template;
		$this->common_functions = $common_functions;
	}
	
	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'					=> 'load_language_on_setup',
			'core.page_header'					=> 'add_page_header_links',
			'core.viewtopic_modify_post_row'	=> 'add_feedback_summary_user_topic',
			'core.memberlist_view_profile'		=> 'add_feedback_summary_user_profile',
			'core.permissions'					=> 'add_permissions',
		);
	}
	
	/**
	* Load language file on setup
	*
	* @param object $event Event object
	* @access public
	*/
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name'	=> 'riccardobianconi/userfeedback',
			'lang_set'	=> 'userfeedback_common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}
	
	/**
	* Add links on navigation
	*
	* @param object $event Event object
	* @access public
	*/
	public function add_page_header_links($event)
	{
		$this->template->assign_vars(array(
			'U_FEEDBACK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => '')),
			'U_MY_FEEDBACK'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'myfeedback')),
		));
	}
	
	/**
	* Add feedback summary in poster profile inside topic
	*
	* @param object $event Event object
	* @access public
	*/
	public function add_feedback_summary_user_topic($event)
	{
		$event['post_row'] = array_merge($event['post_row'], array(
			'U_FEEDBACK_OF'				=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $event['poster_id'])),
			'POSTER_FEEDBACK_SUMMARY'	=> $this->auth->acl_get('u_userfeedback_access') ? $this->common_functions->get_user_feedback_summary($event['poster_id']) : '',
		));
	}
	
	/**
	* Add feedback summary in user profile
	*
	* @param object $event Event object
	* @access public
	*/
	public function add_feedback_summary_user_profile($event)
	{
		$this->template->assign_vars(array(
			'U_FEEDBACK_OF'		=> $this->helper->route('riccardobianconi_userfeedback_controller', array('mode' => 'feedback', 'u' => $event['member']['user_id'])),
			'FEEDBACK_SUMMARY'	=> $this->auth->acl_get('u_userfeedback_access') ? $this->common_functions->get_user_feedback_summary($event['member']['user_id']) : '',
		));
	}
	
	/**
	* Add extension permissions
	*
	* @param object $event Event object
	* @access public
	*/
	public function add_permissions($event)
	{
		$categories = $event['categories'];
		$categories['userfeedback'] = 'ACP_CAT_USERFEEDBACK';
		$event['categories'] = $categories;
		
		$permissions = $event['permissions'];
		$permissions['u_userfeedback_access'] = array('lang' => 'ACL_U_USERFEEDBACK_ACCESS', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_add'] = array('lang' => 'ACL_U_USERFEEDBACK_ADD', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_edit'] = array('lang' => 'ACL_U_USERFEEDBACK_EDIT', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_delete'] = array('lang' => 'ACL_U_USERFEEDBACK_DELETE', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_addmore'] = array('lang' => 'ACL_U_USERFEEDBACK_ADDMORE', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_ignoreflood'] = array('lang' => 'ACL_U_USERFEEDBACK_IGNOREFLOOD', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_bbcode'] = array('lang' => 'ACL_U_USERFEEDBACK_BBCODE', 'cat' => 'userfeedback');
		$permissions['u_userfeedback_smilies'] = array('lang' => 'ACL_U_USERFEEDBACK_SMILIES', 'cat' => 'userfeedback');
		$permissions['m_userfeedback_edit'] = array('lang' => 'ACL_M_USERFEEDBACK_EDIT', 'cat' => 'userfeedback');
		$permissions['m_userfeedback_delete'] = array('lang' => 'ACL_M_USERFEEDBACK_DELETE', 'cat' => 'userfeedback');
		$permissions['m_userfeedback_viewip'] = array('lang' => 'ACL_M_USERFEEDBACK_VIEWIP', 'cat' => 'userfeedback');
		$permissions['a_userfeedback_settings'] = array('lang' => 'ACL_A_USERFEEDBACK_SETTINGS', 'cat' => 'userfeedback');
		$event['permissions'] = $permissions;
	}
}
