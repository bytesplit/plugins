<?php
/**
 * i-MSCP RecaptchaPMA Plugin
 * Copyright (C) 2010-2014 by Sascha Bay
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category    iMSCP
 * @package     iMSCP_Plugin
 * @subpackage  RecaptchaPMA
 * @copyright   2010-2014 by Sascha Bay
 * @author      Sascha Bay <info@space2place.de>
 * @link        http://www.i-mscp.net i-MSCP Home Site
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL v2
 */

/**
 * Class iMSCP_Plugin_RecaptchaPMA
 */
class iMSCP_Plugin_RecaptchaPMA extends iMSCP_Plugin_Action
{
	/**
	 * Register a callback for the given event(s).
	 *
	 * @param iMSCP_Events_Manager_Interface $eventsManager
	 */
	public function register(iMSCP_Events_Manager_Interface $eventsManager)
	{
		$eventsManager->registerListener(iMSCP_Events::onBeforeInstallPlugin, $this);
	}

	/**
	 * onBeforeInstallPlugin event listener
	 *
	 * @param iMSCP_Events_Event $event
	 * @return void
	 */
	public function onBeforeInstallPlugin($event)
	{
		$this->checkCompat($event);
	}
	
	 /**
     * Check plugin compatibility
     *
     * @param iMSCP_Events_Event $event
     */
    protected function checkCompat($event)
    {
        if ($event->getParam('pluginName') == $this->getName()) {
            if (version_compare($event->getParam('pluginManager')->getPluginApiVersion(), '0.2.10', '<')) {
                set_page_message(
                    tr('Your i-MSCP version is not compatible with this plugin. Try with a newer version.'), 'error'
                );

                $event->stopPropagation();
            }
        }
    }
}
