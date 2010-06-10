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
 * Обработка блока с тегами
 *
 */
class PluginWordpress_BlockTags extends Block {
	public function Exec() {		
		/**
		 * Получаем список тегов
		 */
		$aTags=$this->Topic_GetOpenTopicTags(Config::Get('plugin.wordpress.block.tags.count'));
		/**
		 * Расчитываем логарифмическое облако тегов
		 */
		if ($aTags) {
			$iMinSize=1; // минимальный размер шрифта
			$iMaxSize=10; // максимальный размер шрифта
			$iSizeRange=$iMaxSize-$iMinSize;
			
			$iMin=10000;
			$iMax=0;
			foreach ($aTags as $oTag) {
				if ($iMax<$oTag->getCount()) {
					$iMax=$oTag->getCount();
				}
				if ($iMin>$oTag->getCount()) {
					$iMin=$oTag->getCount();
				}
			}			
			
			$iMinCount=log($iMin+1);
			$iMaxCount=log($iMax+1);
			$iCountRange=$iMaxCount-$iMinCount;
			if ($iCountRange==0) {
				$iCountRange=1;
			}
			foreach ($aTags as $oTag) {
				$iTagSize=$iMinSize+(log($oTag->getCount()+1)-$iMinCount)*($iSizeRange/$iCountRange);
				$oTag->setSize(round($iTagSize)); // результирующий размер шрифта для тега
			}
			/**
		 	* Устанавливаем шаблон вывода
		 	*/
			$this->Viewer_Assign("wp_aTags",$aTags);
		}
	}	
}
?>