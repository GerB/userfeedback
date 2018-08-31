<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2018 Ger Bruinsma
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\migrations\v120;

class m1_mysql55 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\riccardobianconi\userfeedback\migrations\v110\m1_config');
	}

    public function update_schema()
    {
        return array(
            'change_columns'    => array(
                $this->table_prefix . 'userfeedback_tot'        => array(
                    'userfeedback_pos'        => array('BINT', 0),
                    'userfeedback_neg'        => array('BINT', 0),
                    'userfeedback_neu'        => array('BINT', 0),
                ),
            ),
        );
    }
}