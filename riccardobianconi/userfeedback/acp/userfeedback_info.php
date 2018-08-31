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

class userfeedback_info
{
	public function module()
	{
		return array(
			'filename'	=> '\riccardobianconi\userfeedback\acp\userfeedback_module',
			'title'		=> 'ACP_USERFEEDBACK',
			'version'	=> '1.1.0',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_USERFEEDBACK_PREFS',
					'auth'	=> 'ext_riccardobianconi/userfeedback && acl_a_userfeedback_settings',
					'cat'	=> array('ACP_CAT_USERFEEDBACK'),
				),
				'manage'	=> array(
					'title'	=> 'ACP_USERFEEDBACK_MANAGE',
					'auth'	=> 'ext_riccardobianconi/userfeedback && acl_a_board',
					'cat'	=> array('ACP_CAT_USERFEEDBACK'),
				),
			),
		);
	}
}
