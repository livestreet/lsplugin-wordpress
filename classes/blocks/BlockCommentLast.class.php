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
 * Обработка блока с последними комментариями
 *
 */
class PluginWordpress_BlockCommentLast extends Block {
	public function Exec() {		
		/**
		 * Получаем список комментов
		 */		
		$aComments=$this->Comment_GetCommentsOnline('topic',Config::Get('plugin.wordpress.block.comment_last.count'));
		$this->Viewer_Assign('wp_aCommentsLast',$aComments);
	}
}
?>