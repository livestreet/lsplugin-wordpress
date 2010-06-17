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
 * Обработка блока с популярными топиками
 *
 */
class PluginWordpress_BlockTopicPopular extends Block {
	public function Exec() {		
		/**
		 * Получаем список топиков
		 */			
		$aTopics=$this->PluginWordpress_Wp_GetTopicsByCountRead(Config::Get('plugin.wordpress.block.topic_popular.count'));
		$this->Viewer_Assign('wp_aTopicsPopular',$aTopics);
	}
}
?>