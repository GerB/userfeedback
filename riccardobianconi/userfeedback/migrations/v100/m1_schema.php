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

class m1_schema extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v318');
	}
	
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'userfeedback'		=> array(
					'COLUMNS'		=> array(
						'userfeedback_id'		=> array('UINT', NULL, 'auto_increment'),
						'userfeedback_to'		=> array('UINT', 0),
						'userfeedback_from'		=> array('UINT', 0),
						'userfeedback_role'		=> array('TINT:1', 0),
						'userfeedback_vote'		=> array('TINT:1', 2),
						'userfeedback_link'		=> array('UINT', 0),
						'userfeedback_comment'	=> array('TEXT_UNI', ''),
						'userfeedback_ip'		=> array('VCHAR:40', ''),
						'userfeedback_date'		=> array('TIMESTAMP', 0),
						'bbcode_bitfield'		=> array('VCHAR:255', ''),
						'bbcode_uid'			=> array('VCHAR:8', ''),
					),
					'PRIMARY_KEY'	=> 'userfeedback_id',
					'KEYS'			=> array(
						'ufb_to'	=> array('INDEX', 'userfeedback_to'), // max length for index name is 30
					),
				),
				$this->table_prefix . 'userfeedback_tot'	=> array(
					'COLUMNS'		=> array(
						'userfeedback_user'	=> array('UINT', 0),
						'userfeedback_pos'	=> array('UINT', 0),
						'userfeedback_neg'	=> array('UINT', 0),
						'userfeedback_neu'	=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'userfeedback_user',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'userfeedback',
				$this->table_prefix . 'userfeedback_tot',
			),
		);
	}
	
}
