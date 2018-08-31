<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\acp;

class userfeedback_module
{
	/**
	 * Config object
	 * @var \phpbb\config\config
	 */
	protected $config;
	
	/**
	 * Request object
	 * @var \phpbb\request\request
	 */
	protected $request;
	
	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;
	
	/**
	 * Container interface
	 * @var ContainerInterface
	 */
	protected $phpbb_container;
	
	/**
	 * Extension admin controller
	 * @var \riccardobianconi\userfeedback\controller\admin_controller
	 */
	protected $admin_controller;

	/**
	 * Form action url
	 * @var string
	 */
	public $u_action;
	
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct()
	{
		global $config, $request, $user, $phpbb_container;
		
		$this->config = $config;
		$this->request = $request;
		$this->user = $user;
		$this->phpbb_container = $phpbb_container;
		
		// Get instance of the admin controller
		$this->admin_controller = $this->phpbb_container->get('riccardobianconi.userfeedback.admin_controller');
	}
	
	/**
	 * Entry point
	 *
	 * @param int $id Id of the acp page to display
	 * @param string $mode Mode of the acp page to display
	 * @return Response object containing rendered page
	 * @access public
	 */
	public function main($id, $mode)
	{
		// Set the action url to use for forms and links
		$this->admin_controller->set_form_action_url($this->u_action);
		
		$this->tpl_name = 'acp_feedback';
		
		switch ($mode)
		{

			// extension settings page
			case 'settings':
				$this->page_title = $this->user->lang('ACP_USERFEEDBACK_PREFS');

				// if submitting data
				if ($this->request->is_set_post('submit'))
				{
					$this->admin_controller->save_settings();
				}
				
				$this->admin_controller->display_settings();
			break;

			// manage user feedback pages: search, add, edit
			case 'manage':
				$this->page_title = $this->user->lang('ACP_USERFEEDBACK_MANAGE');

				$action = $this->request->variable('action', '');
				
				if ($action === 'search') // search feedbacks page
				{
					$start = $this->request->variable('start', 0);
					$limit = (int) $this->config['userfeedback_pag_feedbacks_per_page'];
					$this->admin_controller->set_pagination_enabled(($limit > 0) ? true : false);
					$this->admin_controller->search_feedback($start, $limit);
				}
				elseif ($action === 'add') // add feedback page
				{
					$this->admin_controller->add_feedback();
				}
				elseif ($action === 'edit') // edit feedback page
				{
					$this->admin_controller->edit_feedback();
				}
				elseif ($action === 'delete') // delete feedback page
				{
					$this->admin_controller->delete_feedback();
				}
				else
				{
					$this->admin_controller->display_search_feedback();
				}
			break;
			
			default:
		}
	}
}
