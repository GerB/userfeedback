<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\migrations\v110;

class m1_config extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\riccardobianconi\userfeedback\migrations\v100\m5_mod_to_extension');
	}
	
	public function update_data()
	{
		return array(
			array('config.add', array('userfeedback_pag_feedbacks_per_page', 0)),
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('userfeedback_pag_feedbacks_per_page')),
		);
	}
	
}
