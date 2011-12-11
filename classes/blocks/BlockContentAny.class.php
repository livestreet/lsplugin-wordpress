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
 * Обработка блока с произвольным содержанием
 *
 */
class PluginWordpress_BlockContentAny extends Block {
	public function Exec() {
		/**
		 * Получаем информацию для вывода в блок
		 */
		$sId=$this->GetParam('id');
		if (is_int($sId)) {
			$oContent=$this->PluginWordpress_Wp_GetContentById($sId);
		} else {
			$oContent=$this->PluginWordpress_Wp_GetContentByName($sId);
		}
		
		if ($oContent) {			
			if ($oContent->getIsPhp() and Config::Get('plugin.wordpress.block.content_any.allow_php')) {
				ob_start();
				@eval($oContent->getContent());
				$sContent=ob_get_contents();
				ob_end_clean();
			} else {
				$sContent=$oContent->getContent();
			}
			$this->Viewer_Assign('wp_sContentAnyTitle',$oContent->getTitle());
			$this->Viewer_Assign('wp_sContentAny',$sContent);
		} else {
			$this->Viewer_Assign('wp_sContentAnyTitle',null);
			$this->Viewer_Assign('wp_sContentAny',null);
		}
	}
}
?>