<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\migrations\v100;

class m4_modules extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\riccardobianconi\userfeedback\migrations\v100\m3_permissions');
	}
	
	public function update_data()
	{
		return array(
		
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_CAT_USERFEEDBACK',
			)),
			
			array('module.add', array(
				'acp',
				'ACP_CAT_USERFEEDBACK',
				array(
					'module_basename'	=> '\riccardobianconi\userfeedback\acp\userfeedback_module',
					'modes'				=> array('settings', 'manage'),
				),
			)),
			
		);
	}

	public function revert_data()
	{
		return array(
		
			array('module.remove', array(
				'acp',
				'ACP_CAT_USERFEEDBACK',
				array(
					'module_basename'	=> '\riccardobianconi\userfeedback\acp\userfeedback_module',
					'modes'				=> array('settings', 'manage'),
				),
			)),
			
			array('module.remove', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_CAT_USERFEEDBACK',
			)),

		);
	}
	
}
