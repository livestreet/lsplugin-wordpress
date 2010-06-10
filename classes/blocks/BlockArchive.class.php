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
 * Обработка блока с архивом
 *
 */
class PluginWordpress_BlockArchive extends Block {
	public function Exec() {		
		/**
		 * Получаем самый старый топик и от него получаем архив по месяцам
		 */					
		$aArchive=array();		
		if ($oTopicFirst=$this->PluginWordpress_Wp_GetFirstTopic()) {
			$iDate=strtotime($oTopicFirst->getDateAdd());
			while (date("Ym",$iDate)<=date("Ym")) {
				$aArchive[]=array(
				'date' => date("Y-m-1 00:00:00",$iDate)
				);
				$iDate=mktime(0,0,0,date("m",$iDate)+1,date("d",$iDate),date("Y",$iDate));
			}
		}
		$this->Viewer_Assign('wp_aArchive',$aArchive);
	}
}
?>