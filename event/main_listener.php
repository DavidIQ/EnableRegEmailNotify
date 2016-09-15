<?php
/**
 *
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */

namespace davidiq\EnableRegEmailNotify\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_add_after'	=> 'enable_email_notifications',
		);
	}

	/* @var \phpbb\controller\helper */
	protected $helper;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper	$helper		Controller helper object
	*/
	public function __construct(\phpbb\controller\helper $helper)
	{
		$this->helper = $helper;
	}

	/**
	* Modifies the user registration information to enable the e-mail notifications
	*
	* @param \phpbb\event\data	$event	Event object
	*/
	public function enable_email_notifications($event)
	{
	    global $db, $phpbb_container;
        $user_id = (int) $event['user_id'];
        if ($user_id > 0)
        {
            // First update the user_notify value to subscribe to topics by default
            $sql = 'UPDATE ' . USERS_TABLE . "
                SET user_notify = 1
                WHERE user_id = $user_id";

            $db->sql_query($sql);

            // Now set the notification settings for email
            $phpbb_notifications = $phpbb_container->get('notification_manager');
            $phpbb_notifications->add_subscription('notification.type.quote', 0, 'notification.method.email', $user_id);
            $phpbb_notifications->add_subscription('notification.type.pm', 0, 'notification.method.email', $user_id);
            $phpbb_notifications->add_subscription('moderation_queue', 0, 'notification.method.email', $user_id);
        }
	}
}
