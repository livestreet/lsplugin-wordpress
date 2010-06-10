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
 * Обрабатывает вывод архива
 *
 */
class PluginWordpress_ActionArchive extends ActionPlugin {		
	/**
	 * Инициализация 
	 *
	 * @return null
	 */
	public function Init() {
		
	}
	
	protected function RegisterEvent() {
		$this->AddEventPreg('/^\d{4}$/i','/^(page(\d+))?$/i','/^$/i','EventArchiveYear');		
		$this->AddEventPreg('/^\d{4}$/i','/^\d{2}$/i','/^(page(\d+))?$/i','/^$/i','EventArchiveMonth');		
		$this->AddEventPreg('/^\d{4}$/i','/^\d{2}$/i','/^\d{2}$/i','/^(page(\d+))?$/i','/^$/i','EventArchiveDay');		
	}
		
	
	/**********************************************************************************
	 ************************ РЕАЛИЗАЦИЯ ЭКШЕНА ***************************************
	 **********************************************************************************
	 */
	
	
	protected function EventArchiveYear() {
		$iYear=$this->sCurrentEvent;
		$iPage=$this->GetParamEventMatch(0,2) ? $this->GetParamEventMatch(0,2) : 1;
		return $this->EventArchive($iYear,null,null,$iPage);
	}
	
	protected function EventArchiveMonth() {
		$iYear=$this->sCurrentEvent;
		$iMonth=$this->GetParam(0);
		$iPage=$this->GetParamEventMatch(1,2) ? $this->GetParamEventMatch(1,2) : 1;		
		return $this->EventArchive($iYear,$iMonth,null,$iPage);
	}
	
	protected function EventArchiveDay() {
		$iYear=$this->sCurrentEvent;
		$iMonth=$this->GetParam(0);
		$iDay=$this->GetParam(1);
		$iPage=$this->GetParamEventMatch(2,2) ? $this->GetParamEventMatch(2,2) : 1;		
		return $this->EventArchive($iYear,$iMonth,$iDay,$iPage);
	}
	
	/**
	 * Отображение архива
	 *
	 */
	protected function EventArchive($iYear,$iMonth,$iDay,$iPage) {		
		if ($iDay) {
			$sDateBegin="{$iYear}-{$iMonth}-{$iDay} 00:00:00";
			$sDateEnd="{$iYear}-{$iMonth}-{$iDay} 23:59:59";
			$sPageUrl="{$iYear}/{$iMonth}/{$iDay}";
		} elseif ($iMonth) {
			$sDateBegin="{$iYear}-{$iMonth}-01 00:00:00";
			$sDateEnd="{$iYear}-{$iMonth}-31 23:59:59";
			$sPageUrl="{$iYear}/{$iMonth}";
		} else {
			$sDateBegin="{$iYear}-01-01 00:00:00";
			$sDateEnd="{$iYear}-12-31 23:59:59";
			$sPageUrl="{$iYear}";
		}				
		$this->Viewer_Assign("wp_sDateBeginArchive",$sDateBegin);
		$this->Viewer_Assign("wp_sDateEndArchive",$sDateEnd);
		$this->Viewer_Assign("wp_iYearArchive",$iYear);
		$this->Viewer_Assign("wp_iMonthArchive",$iMonth);
		$this->Viewer_Assign("wp_iDayArchive",$iDay);
		
		/**
		 * Получаем топики
		 */
		$aResult=$this->PluginWordpress_Wp_GetTopicsByDate($sDateBegin,$sDateEnd,$iPage,Config::Get('plugin.wordpress.archive.per_page'));		
		$aTopics=$aResult['collection'];	
		/**
		 * Формируем постраничность
		 */		
		$aPaging=$this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('plugin.wordpress.archive.per_page'),6,Router::GetPath('archive').$sPageUrl);
		/**
		 * Загружаем переменные в шаблон
		 */				
		$this->Viewer_Assign('aPaging',$aPaging);
		$this->Viewer_Assign('aTopics',$aTopics);
		/**
		 * Устанавливаем шаблон вывода
		 */
		$this->SetTemplateAction('archive');
	}	
}
?>