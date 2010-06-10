<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/**
 * Обработка блока "информация о пользователе"
 *
 */
class PluginWordpress_BlockUserAbout extends Block {
	public function Exec() {		
		/**
		 * Получаем пользователя
		 */			
		$oUser=$this->User_GetUserById(Config::Get('plugin.wordpress.block.user_about.id'));		
		$this->Viewer_Assign('wp_oUserAbout',$oUser);
	}
}
?>