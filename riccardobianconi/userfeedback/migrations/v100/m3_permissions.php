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

class m3_permissions extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\riccardobianconi\userfeedback\migrations\v100\m2_config');
	}
	
	public function update_data()
	{
		$data = array();
		
		// User permissions
		
		$data[] = array('permission.add', array('u_userfeedback_access'));
		$data[] = array('permission.add', array('u_userfeedback_add'));
		$data[] = array('permission.add', array('u_userfeedback_edit'));
		$data[] = array('permission.add', array('u_userfeedback_delete'));
		$data[] = array('permission.add', array('u_userfeedback_addmore'));
		$data[] = array('permission.add', array('u_userfeedback_ignoreflood'));
		$data[] = array('permission.add', array('u_userfeedback_bbcode'));
		$data[] = array('permission.add', array('u_userfeedback_smilies'));
		
		if ($this->role_exists('ROLE_USER_FULL'))
		{
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_access'));
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_add'));
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_edit'));
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_delete'));
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_ignoreflood'));
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_bbcode'));
			$data[] = array('permission.permission_set', array('ROLE_USER_FULL', 'u_userfeedback_smilies'));
		}
		if ($this->role_exists('ROLE_USER_STANDARD'))
		{
			$data[] = array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_userfeedback_access'));
			$data[] = array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_userfeedback_add'));
			$data[] = array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_userfeedback_edit'));
			$data[] = array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_userfeedback_delete'));
			$data[] = array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_userfeedback_bbcode'));
			$data[] = array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_userfeedback_smilies'));
		}
		if ($this->role_exists('ROLE_USER_LIMITED'))
		{
			$data[] = array('permission.permission_set', array('ROLE_USER_LIMITED', 'u_userfeedback_access'));
		}
		if ($this->role_exists('ROLE_USER_NOPM'))
		{
			$data[] = array('permission.permission_set', array('ROLE_USER_NOPM', 'u_userfeedback_access'));
		}
		if ($this->role_exists('ROLE_USER_NOAVATAR'))
		{
			$data[] = array('permission.permission_set', array('ROLE_USER_NOAVATAR', 'u_userfeedback_access'));
		}
		
		// Moderator permissions
		
		$data[] = array('permission.add', array('m_userfeedback_edit'));
		$data[] = array('permission.add', array('m_userfeedback_delete'));
		$data[] = array('permission.add', array('m_userfeedback_viewip'));
		
		if ($this->role_exists('ROLE_MOD_FULL'))
		{
			$data[] = array('permission.permission_set', array('ROLE_MOD_FULL', 'm_userfeedback_edit'));
			$data[] = array('permission.permission_set', array('ROLE_MOD_FULL', 'm_userfeedback_delete'));
			$data[] = array('permission.permission_set', array('ROLE_MOD_FULL', 'm_userfeedback_viewip'));
		}
		if ($this->role_exists('ROLE_MOD_STANDARD'))
		{
			$data[] = array('permission.permission_set', array('ROLE_MOD_STANDARD', 'm_userfeedback_edit'));
			$data[] = array('permission.permission_set', array('ROLE_MOD_STANDARD', 'm_userfeedback_delete'));
		}
		
		// Admin permissions
		
		$data[] = array('permission.add', array('a_userfeedback_settings'));
		
		if ($this->role_exists('ROLE_ADMIN_FULL'))
		{
			$data[] = array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_userfeedback_settings'));
		}
		if ($this->role_exists('ROLE_ADMIN_STANDARD'))
		{
			$data[] = array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_userfeedback_settings'));
		}
			
		return $data;
	}

	public function revert_data()
	{
		$data = array();
		
		// User permissions
		
		if ($this->role_exists('ROLE_USER_FULL'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_access'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_add'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_edit'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_delete'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_ignoreflood'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_bbcode'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_FULL', 'u_userfeedback_smilies'));
		}
		if ($this->role_exists('ROLE_USER_STANDARD'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_USER_STANDARD', 'u_userfeedback_access'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_STANDARD', 'u_userfeedback_add'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_STANDARD', 'u_userfeedback_edit'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_STANDARD', 'u_userfeedback_delete'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_STANDARD', 'u_userfeedback_bbcode'));
			$data[] = array('permission.permission_unset', array('ROLE_USER_STANDARD', 'u_userfeedback_smilies'));
		}
		if ($this->role_exists('ROLE_USER_LIMITED'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_USER_LIMITED', 'u_userfeedback_access'));
		}
		if ($this->role_exists('ROLE_USER_NOPM'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_USER_NOPM', 'u_userfeedback_access'));
		}
		if ($this->role_exists('ROLE_USER_NOAVATAR'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_USER_NOAVATAR', 'u_userfeedback_access'));
		}
		
		$data[] = array('permission.remove', array('u_userfeedback_access'));
		$data[] = array('permission.remove', array('u_userfeedback_add'));
		$data[] = array('permission.remove', array('u_userfeedback_edit'));
		$data[] = array('permission.remove', array('u_userfeedback_delete'));
		$data[] = array('permission.remove', array('u_userfeedback_addmore'));
		$data[] = array('permission.remove', array('u_userfeedback_ignoreflood'));
		$data[] = array('permission.remove', array('u_userfeedback_bbcode'));
		$data[] = array('permission.remove', array('u_userfeedback_smilies'));
		
		// Moderator permissions
		
		if ($this->role_exists('ROLE_MOD_FULL'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_MOD_FULL', 'm_userfeedback_edit'));
			$data[] = array('permission.permission_unset', array('ROLE_MOD_FULL', 'm_userfeedback_delete'));
			$data[] = array('permission.permission_unset', array('ROLE_MOD_FULL', 'm_userfeedback_viewip'));
		}
		if ($this->role_exists('ROLE_MOD_STANDARD'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_MOD_STANDARD', 'm_userfeedback_edit'));
			$data[] = array('permission.permission_unset', array('ROLE_MOD_STANDARD', 'm_userfeedback_delete'));
		}
		
		$data[] = array('permission.remove', array('m_userfeedback_edit'));
		$data[] = array('permission.remove', array('m_userfeedback_delete'));
		$data[] = array('permission.remove', array('m_userfeedback_viewip'));
		
		// Admin permissions
		
		if ($this->role_exists('ROLE_ADMIN_FULL'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_ADMIN_FULL', 'a_userfeedback_settings'));
		}
		if ($this->role_exists('ROLE_ADMIN_STANDARD'))
		{
			$data[] = array('permission.permission_unset', array('ROLE_ADMIN_STANDARD', 'a_userfeedback_settings'));
		}
			
		$data[] = array('permission.remove', array('a_userfeedback_settings'));
			
		return $data;
	}
	
	protected function role_exists($role)
	{
		$sql = 'SELECT role_id
				FROM ' . ACL_ROLES_TABLE . "
				WHERE role_name = '" . $this->db->sql_escape($role) . "'";
		$result = $this->db->sql_query_limit($sql, 1);
		$role_id = $this->db->sql_fetchfield('role_id');
		$this->db->sql_freeresult($result);
		return (bool) $role_id;
	}
	
}
