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

class m2_config extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\riccardobianconi\userfeedback\migrations\v100\m1_schema');
	}
	
	public function update_data()
	{
		return array(
			array('config.add', array('userfeedback_antiflood', 0)),
			array('config.add', array('userfeedback_antiflood_same', 0)),
			array('config.add', array('userfeedback_comm_minchars', 0)),
			array('config.add', array('userfeedback_comm_maxchars', 500)),
			array('config.add', array('userfeedback_comm_bbcode', 0)),
			array('config.add', array('userfeedback_comm_smilies', 1)),
			array('config.add', array('userfeedback_comm_url', 0)),
			array('config.add', array('userfeedback_link_enable', 0)),
			array('config.add', array('userfeedback_link_force', 0)),
			array('config.add', array('userfeedback_link_force_in', 0)),
			array('config.add', array('userfeedback_link_forum', '')),
			array('config.add', array('userfeedback_m_haspower', 0)),
			array('config.add', array('userfeedback_role_enable', 1)),
			array('config.add', array('userfeedback_score', 0)),
			array('config.add', array('userfeedback_score_pos', 1)),
			array('config.add', array('userfeedback_score_neu', 0)),
			array('config.add', array('userfeedback_score_neg', -1)),
			array('config.add', array('userfeedback_top_best', 50)),
			array('config.add', array('userfeedback_top_main', 10)),
			array('config.add', array('userfeedback_top_worst', 50)),
			array('config.add', array('userfeedback_u_canedit', 1)),
			array('config.add', array('userfeedback_u_morethanone', 0)),
		);
	}

	public function revert_data()
	{
		return array(
			array('config.remove', array('userfeedback_antiflood')),
			array('config.remove', array('userfeedback_antiflood_same')),
			array('config.remove', array('userfeedback_comm_minchars')),
			array('config.remove', array('userfeedback_comm_maxchars')),
			array('config.remove', array('userfeedback_comm_bbcode')),
			array('config.remove', array('userfeedback_comm_smilies')),
			array('config.remove', array('userfeedback_comm_url')),
			array('config.remove', array('userfeedback_link_enable')),
			array('config.remove', array('userfeedback_link_force')),
			array('config.remove', array('userfeedback_link_force_in')),
			array('config.remove', array('userfeedback_link_forum')),
			array('config.remove', array('userfeedback_m_haspower')),
			array('config.remove', array('userfeedback_role_enable')),
			array('config.remove', array('userfeedback_score')),
			array('config.remove', array('userfeedback_score_pos')),
			array('config.remove', array('userfeedback_score_neu')),
			array('config.remove', array('userfeedback_score_neg')),
			array('config.remove', array('userfeedback_top_best')),
			array('config.remove', array('userfeedback_top_main')),
			array('config.remove', array('userfeedback_top_worst')),
			array('config.remove', array('userfeedback_u_canedit')),
			array('config.remove', array('userfeedback_u_morethanone')),
		);
	}
	
}
