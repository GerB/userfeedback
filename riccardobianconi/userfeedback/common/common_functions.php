<?php
/**
*
* User Feedback extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 Riccardo Bianconi <http://www.riccardobianconi.it>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace riccardobianconi\userfeedback\common;

/**
 * Extension common functions
 */
class common_functions
{
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
	 * Database table storing feedback totals by user
	 * @var string
	 */
	protected $table_feedback_tot;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface $db Database object
	 * @param \phpbb\config\config $config Config object
	 * @param string $table_feedback_tot Database table storing feedback totals by user
	 * @access public
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, $table_feedback_tot)
	{
		$this->db = $db;
		$this->config = $config;
		$this->table_feedback_tot = $table_feedback_tot;
	}
	
	/**
	 * Get user feedback summary for display
	 *
	 * @param int $uid User id
	 * @return string User feedback summary as html for display
	 * @access public
	 */
	public function get_user_feedback_summary($uid)
	{
		$uid = (int) $uid;
		
		$q = 'SELECT
				userfeedback_pos,
				userfeedback_neg,
				userfeedback_neu
				FROM ' . $this->table_feedback_tot . '
				WHERE userfeedback_user = ' . $uid;
		$r = $this->db->sql_query($q);
		$a = $this->db->sql_fetchrow($r);
		$this->db->sql_freeresult($r);
		if (!$a)
		{
			if ($this->config['userfeedback_score'])
			{
				return '<span class="neutral">0</span> (0%)';
			}
			else
			{
				return '<span class="positive">0</span>|<span class="neutral">0</span>|<span class="negative">0</span>';
			}
		}
		
		if ($this->config['userfeedback_score'])
		{
			$score = (int) $a['userfeedback_pos'] * (float) $this->config['userfeedback_score_pos'] + 
					 (int) $a['userfeedback_neu'] * (float) $this->config['userfeedback_score_neu'] + 
					 (int) $a['userfeedback_neg'] * (float) $this->config['userfeedback_score_neg'];
			$percentage = 0;
			$tot = (int) $a['userfeedback_pos'] + (int) $a['userfeedback_neg'];
			if ($tot)
			{
				$percentage = round(((int) $a['userfeedback_pos'] / $tot) * 100);
			}
			
			if ($score === 0)
			{
				$css_class = 'neutral';
			}
			elseif ($score < 0)
			{
				$css_class = 'negative';
			}
			else
			{
				$css_class = 'positive';
			}
			return '<span class="' . $css_class . '">' . $score . '</span> (' . $percentage . '%)';
		}
		else
		{
			return '<span class="positive">' . $a['userfeedback_pos'] . '</span>|<span class="neutral">' . $a['userfeedback_neu'] . '</span>|<span class="negative">' . $a['userfeedback_neg'] . '</span>';
		}
	}
}
