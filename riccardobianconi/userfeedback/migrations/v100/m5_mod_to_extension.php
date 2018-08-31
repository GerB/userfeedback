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

class m5_mod_to_extension extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\riccardobianconi\userfeedback\migrations\v100\m4_modules');
	}
	
	public function effectively_installed()
	{
		return !isset($this->config['fb_score']);
	}
	
	public function update_data()
	{
		return array(
			array('custom', array(
				array(
					$this,
					'convert_feedback_table'
				)
			)),
			array('custom', array(
				array(
					$this,
					'convert_feedback_tot_table'
				)
			)),
			array('custom', array(
				array(
					$this,
					'convert_config_data'
				)
			)),
		);
	}

	public function revert_data()
	{
		return array(
		);
	}
	
	public function convert_feedback_table()
	{
		$q = 'SELECT
				fb_id,
				fb_to,
				fb_from,
				fb_role,
				fb_vote,
				fb_link,
				fb_comment,
				fb_ip,
				fb_date,
				bbcode_bitfield,
				bbcode_uid
				FROM ' . $this->table_prefix . 'shmk_feedback';
		$r = $this->db->sql_query($q);
		while ($a = $this->db->sql_fetchrow($r))
		{
			$insert = array(
				'userfeedback_id'		=> $a['fb_id'],
				'userfeedback_to'		=> $a['fb_to'],
				'userfeedback_from'		=> $a['fb_from'],
				'userfeedback_role'		=> $a['fb_role'],
				'userfeedback_vote'		=> $a['fb_vote'],
				'userfeedback_link'		=> $a['fb_link'],
				'userfeedback_comment'	=> $a['fb_comment'],
				'userfeedback_ip'		=> $a['fb_ip'],
				'userfeedback_date'		=> $a['fb_date'],
				'bbcode_bitfield'		=> $a['bbcode_bitfield'],
				'bbcode_uid'			=> $a['bbcode_uid'],
			);
			$this->db->sql_query('INSERT INTO ' . $this->table_prefix . 'userfeedback ' . $this->db->sql_build_array('INSERT', $insert));
		}
		$this->db->sql_freeresult($r);
	}
	
	public function convert_feedback_tot_table()
	{
		$q = 'SELECT
				fb_user,
				fb_pos,
				fb_neg,
				fb_neu
				FROM ' . $this->table_prefix . 'shmk_feedback_tot';
		$r = $this->db->sql_query($q);
		while ($a = $this->db->sql_fetchrow($r))
		{
			$insert = array(
				'userfeedback_user'		=> $a['fb_user'],
				'userfeedback_pos'		=> $a['fb_pos'],
				'userfeedback_neg'		=> $a['fb_neg'],
				'userfeedback_neu'		=> $a['fb_neu'],
			);
			$this->db->sql_query('INSERT INTO ' . $this->table_prefix . 'userfeedback_tot ' . $this->db->sql_build_array('INSERT', $insert));
		}
		$this->db->sql_freeresult($r);
	}
	
	public function convert_config_data()
	{
		$old_config = array();
		$q = 'SELECT
				fb_config,
				fb_config_val
				FROM ' . $this->table_prefix . 'shmk_feedback_config';
		$r = $this->db->sql_query($q);
		while ($a = $this->db->sql_fetchrow($r))
		{
			$old_config[$a['fb_config']] = $a['fb_config_val'];
		}
		$this->db->sql_freeresult($r);
		
		$this->config->set('userfeedback_antiflood', $old_config['antiflood']);
		$this->config->set('userfeedback_antiflood_same', $old_config['antiflood_same']);
		$this->config->set('userfeedback_comm_minchars', $old_config['comm_minchars']);
		$this->config->set('userfeedback_comm_maxchars', $old_config['comm_maxchars']);
		$this->config->set('userfeedback_comm_bbcode', $old_config['comm_bbcode']);
		$this->config->set('userfeedback_comm_smilies', $old_config['comm_smilies']);
		$this->config->set('userfeedback_comm_url', $old_config['comm_url']);
		$this->config->set('userfeedback_link_enable', $old_config['link_enable']);
		$this->config->set('userfeedback_link_force', $old_config['link_force']);
		$this->config->set('userfeedback_link_force_in', $old_config['link_force_in']);
		$this->config->set('userfeedback_link_forum', $old_config['link_forum']);
		$this->config->set('userfeedback_m_haspower', $old_config['m_haspower']);
		$this->config->set('userfeedback_role_enable', $old_config['role_enable']);
		$this->config->set('userfeedback_score', $this->config['fb_score']);
		$this->config->set('userfeedback_score_pos', $this->config['fb_score_pos']);
		$this->config->set('userfeedback_score_neu', $this->config['fb_score_neu']);
		$this->config->set('userfeedback_score_neg', $this->config['fb_score_neg']);
		$this->config->set('userfeedback_top_best', $old_config['top_best']);
		$this->config->set('userfeedback_top_main', $old_config['top_main']);
		$this->config->set('userfeedback_top_worst', $old_config['top_worst']);
		$this->config->set('userfeedback_u_canedit', $old_config['u_canedit']);
		$this->config->set('userfeedback_u_morethanone', $old_config['u_morethenone']);
	}
	
}
