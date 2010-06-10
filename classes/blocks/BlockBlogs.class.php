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
 * Обработка блока с блогами("категориями")
 *
 */
class PluginWordpress_BlockBlogs extends Block {
	public function Exec() {		
		/**
		 * Получаем список блогов
		 */			
		$aTopics=$this->Topic_GetTopicsRatingByDate($sDate,Config::Get('plugin.wordpress.block.blogs.count'));
		
		$aResult=$this->Blog_GetBlogsRating(1,Config::Get('plugin.wordpress.block.blogs.count'));
		$this->Viewer_Assign('wp_aBlogs',$aResult['collection']);
	}
}
?>