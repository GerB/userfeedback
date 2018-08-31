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
 * Extension common constants
 */
final class common_constants
{
	/**
	 * Constant for negative Vote
	 * @var int
	 */
	const VOTE_NEGATIVE = 0;
	
	/**
	 * Constant for positive Vote
	 * @var int
	 */
	const VOTE_POSITIVE = 1;
	
	/**
	 * Constant for neutral Vote
	 * @var int
	 */
	const VOTE_NEUTRAL = 2;

	/**
	 * Constant for trade Role
	 * @var int
	 */
	const ROLE_TRADE = 0;
	
	/**
	 * Constant for buyer Role
	 * @var int
	 */
	const ROLE_BUYER = 1;
	
	/**
	 * Constant for seller Role
	 * @var int
	 */
	const ROLE_SELLER = 2;
}
