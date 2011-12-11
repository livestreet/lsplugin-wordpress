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
 * Обработка блока с календарем
 *
 */
class PluginWordpress_BlockCalendar extends Block {
	public function Exec() {		
		$oSmarty=$this->Viewer_GetSmartyObject();
		
		$iYear=$oSmarty->getTemplateVars('wp_iYearArchive');
		$iMonth=$oSmarty->getTemplateVars('wp_iMonthArchive');
		$iDay=$oSmarty->getTemplateVars('wp_iDayArchive');

		if ($iYear and $iMonth) {			
			$iDate=mktime(0,0,0,$iMonth,1,$iYear);
		} else {
			$iDate=mktime(0,0,0,date("m"),1,date("Y"));
		}
		
		/**
		 * Определяем предыдущую и следующую даты в календаре
		 */		
		$sDatePrev=null;
		if ($oTopicFirst=$this->PluginWordpress_Wp_GetFirstTopic()) {
			$iDateFirst=strtotime($oTopicFirst->getDateAdd());
			if (mktime(0,0,0,date("m",$iDate)-1,1,date("Y",$iDate))>=mktime(0,0,0,date("m",$iDateFirst),1,date("Y",$iDateFirst))) {
				$sDatePrev=date("Y-m-d H:i:s",mktime(0,0,0,date("m",$iDate)-1,1,date("Y",$iDate)));
			}
		}
		
		if (mktime(0,0,0,date("m",$iDate)+1,1,date("Y",$iDate))<=mktime(0,0,0,date("m"),1,date("Y"))) {
			$sDateNext=date("Y-m-d H:i:s",mktime(0,0,0,date("m",$iDate)+1,1,date("Y",$iDate)));
		} else {
			$sDateNext=null;
		}
		/**
		 * Формируем список дней к которым есть топики
		 */
		$aDateTopic=array();
		$sDateBegin=date("Y-m-1 00:00:00",$iDate);
		$sDateEnd=date("Y-m-31 23:59:59",$iDate);
		$aResult=$this->PluginWordpress_Wp_GetTopicsByDate($sDateBegin,$sDateEnd,1,1000);		
		foreach ($aResult['collection'] as $oTopic) {
			$aDateTopic[date("d",strtotime($oTopic->getDateAdd()))]=1;
		}		
		/**
		 * Формируем календарь
		 */
		$aCalendar=array();
		$aCalendarWeek=array();
		$iCountDay=date('t',$iDate);
		$aDays=range(1,$iCountDay);
		$iWeekStart=date('N',$iDate);		
		$iWeek=1;		
		while (count($aDays)) {			
			$aDay=null;
			if (count($aCalendar) or $iWeek>=$iWeekStart) {
				$iDay=array_shift($aDays);
				if ($iDay<10) $iDay='0'.(int)$iDay;
				$aDay=array(					
					'date' => date("Y",$iDate)."-".date("m",$iDate)."-{$iDay} 00:00:00",
				);
				if (isset($aDateTopic[$iDay])) {
					$aDay['topic']=true;
				} else {
					$aDay['topic']=false;
				}
			}
			
			$aCalendarWeek[$iWeek]=$aDay;
			
			$iWeek++;
			if ($iWeek%8==0 or count($aDays)==0) {				
				$iWeek=1;
				$aCalendar[]=$aCalendarWeek;
				$aCalendarWeek=array();				
			}
		}
		$aLastWeek=$aCalendar[count($aCalendar)-1];
		if (count($aLastWeek)<7) {
			foreach (range(count($aLastWeek)+1,7) as $i) {
				$aLastWeek[$i]=null;
			}			
			$aCalendar[count($aCalendar)-1]=$aLastWeek;
		}
		
		$this->Viewer_Assign('wp_aCalendar',array('date'=>date("Y-m-d 00:00:00",$iDate),'weeks'=>$aCalendar,'prev'=>$sDatePrev,'next'=>$sDateNext));		
	}
}
?>