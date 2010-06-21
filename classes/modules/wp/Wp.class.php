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

class PluginWordpress_ModuleWp extends Module {
	protected $oMapper;
	protected $oUserCurrent=null;
	
	public function Init() {		
		$this->oMapper=Engine::GetMapper(__CLASS__);
		$this->oUserCurrent=$this->User_GetUserCurrent();
	}
	
	/**
	 * Получает первый топик по дате
	 *
	 * @return ModuleTopic_EntityTopic
	 */
	public function GetFirstTopic() {		
		return $this->oMapper->GetFirstTopic();
	}
	/**
	 * Получает список топиков по диапазону дат
	 *
	 * @param string $sDateBegin
	 * @param string $sDateEnd	 
	 * @param int $iCurrPage
	 * @param int $iPerPage
	 * @param bool $bAddAccessible
	 * @return array('collection'=>array(ModuleTopic_EntityTopic),'count'=>int)
	 */
	public function GetTopicsByDate($sDateBegin,$sDateEnd,$iPage,$iPerPage,$bAddAccessible=true) {
		$aCloseBlogs = ($this->oUserCurrent && $bAddAccessible) 
			? $this->Blog_GetInaccessibleBlogsByUser($this->oUserCurrent)
			: $this->Blog_GetInaccessibleBlogsByUser();
		
		$s = serialize($aCloseBlogs);
		if (false === ($data = $this->Cache_Get("topic_archive_{$sDateBegin}_{$sDateEnd}_{$iPage}_{$iPerPage}_{$s}"))) {			
			$data = array('collection'=>$this->oMapper->GetTopicsByDate($sDateBegin,$sDateEnd,$aCloseBlogs,$iCount,$iPage,$iPerPage),'count'=>$iCount);
			$this->Cache_Set($data, "topic_archive_{$sDateBegin}_{$sDateEnd}_{$iPage}_{$iPerPage}_{$s}", array('topic_update','topic_new'), 60*60*24*5);
		}
		$data['collection']=$this->Topic_GetTopicsAdditionalData($data['collection']);
		return $data;		
	}
	
	public function GetTopicsByCountRead($iLimit,$bAddAccessible=true) {
		$aCloseBlogs = ($this->oUserCurrent && $bAddAccessible) 
			? $this->Blog_GetInaccessibleBlogsByUser($this->oUserCurrent)
			: $this->Blog_GetInaccessibleBlogsByUser();
			
		$s = serialize($aCloseBlogs);
		if (false === ($data = $this->Cache_Get("topic_count_read_{$iLimit}_{$s}"))) {			
			$data = $this->oMapper->GetTopicsByCountRead($aExcludeBlog,$iLimit);
			$this->Cache_Set($data, "topic_count_read_{$iLimit}_{$s}", array('topic_update','topic_new'), 60*60*24*5);
		}
		$data=$this->Topic_GetTopicsAdditionalData($data);
		return $data;	
	}
	/**
	 * Получает контент по ID
	 *
	 * @param string $sId
	 * @return PluginWordpress_ModuleWp_EntityContent
	 */
	public function GetContentById($sId) {
		return $this->oMapper->GetContentById($sId);
	}
	/**
	 * Получает контент по имени(name) 
	 *
	 * @param string $sName
	 * @return PluginWordpress_ModuleWp_EntityContent
	 */
	public function GetContentByName($sName) {
		return $this->oMapper->GetContentByName($sName);
	}
	/**
	 * Получает весь список контента
	 *
	 * @return array
	 */
	public function GetContents() {
		return $this->oMapper->GetContents();
	}
	/**
	 * Добавляет контент
	 *
	 * @param PluginWordpress_ModuleWp_EntityContent $oContent
	 */
	public function AddContent(PluginWordpress_ModuleWp_EntityContent $oContent) {
		if ($iId=$this->oMapper->AddContent($oContent)) {
			$oContent->setId($iId);
			return $oContent;
		}
		return false;
	}
	/**
	 * Обновляет контент
	 *
	 * @param PluginWordpress_ModuleWp_EntityContent $oContent
	 */
	public function UpdateContent(PluginWordpress_ModuleWp_EntityContent $oContent) {
		$res=$this->oMapper->UpdateContent($oContent);
		if ($res or $res===0) {			
			return true;
		}
		return false;
	}	
	/**
	 * Удаляет контент
	 *
	 * @param unknown_type $sContentId
	 * @return unknown
	 */
	public function DeleteContent($sContentId) {
		return $this->oMapper->DeleteContent($sContentId);
	}
	/**
	 * Получает топик по его латинсокму названиею и дате
	 *
	 * @param string $sDate (Y-m-d)
	 * @param string $sTitle
	 * @return ModuleTopic_EntityTopic
	 */
	public function GetTopicByDateAndTitleLat($sDate,$sTitle) {
		if (false === ($data = $this->Cache_Get("topic_by_date_and_titlelat_{$sDate}_{$sTitle}"))) {			
			$data = $this->oMapper->GetTopicByDateAndTitleLat($sDate,$sTitle);
			$this->Cache_Set($data, "topic_by_date_and_titlelat_{$sDate}_{$sTitle}", array('wp_topic_update'), 60*60*24*5);
		}		
		return $this->Topic_GetTopicById($data);
	}
	/**
	 * Обновление доп. информации о топике
	 *
	 * @param PluginWordpress_ModuleWp_EntityTopic $oWpTopic
	 * @return unknown
	 */
	public function UpdateTopic(PluginWordpress_ModuleWp_EntityTopic $oWpTopic) {
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('wp_topic_update'));
		return $this->oMapper->UpdateTopic($oWpTopic);
	}
	/**
	 * Удаляет доп. инфу о топике
	 *
	 * @param unknown_type $sId
	 * @return unknown
	 */
	public function DeleteTopicById($sId) {
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('wp_topic_update'));
		return $this->oMapper->DeleteTopicById($sId);
	}
	/**
	 * Обновление URL топика
	 *
	 * @param unknown_type $oTopic
	 */
	public function UpdateTopicUrl($oTopic) {
		$oWpTopic=Engine::GetEntity('PluginWordpress_Wp_Topic');
    	$oWpTopic->setId($oTopic->getId());
    	$oWpTopic->setDate(date("Y-m-d",strtotime($oTopic->getDateAdd())));    	
    	
    	$i=2;
    	$sTitle=func_translit($oTopic->getTitle());
    	while (($oWpTopicOld=$this->PluginWordpress_Wp_GetTopicByDateAndTitleLat($oWpTopic->getDate(),$sTitle)) and $oWpTopicOld->getId()!=$oWpTopic->getId()) {
    		$sTitle.='_'.$i;
    		$i++;
    	}
    	$oWpTopic->setTitleLat($sTitle);
    	$oTopic->setTitleLat($sTitle);
    	$this->PluginWordpress_Wp_UpdateTopic($oWpTopic);
	}
	/**
	 * Получает список доп. данных топика по массиву ID
	 *
	 * @param unknown_type $aTopicId
	 * @return unknown
	 */
	public function GetTopicsByArrayId($aTopicId) {
		if (!is_array($aTopicId)) {
			$aTopicId=array($aTopicId);
		}
		$aTopicId=array_unique($aTopicId);	
		$aTopics=array();	
		$s=join(',',$aTopicId);
		if (false === ($data = $this->Cache_Get("wp_topic_id_{$s}"))) {			
			$data = $this->oMapper->GetTopicsByArrayId($aTopicId);
			foreach ($data as $oTopic) {
				$aTopics[$oTopic->getId()]=$oTopic;
			}
			$this->Cache_Set($aTopics, "wp_topic_id_{$s}", array("wp_topic_update"), 60*60*24*1);
			return $aTopics;
		}		
		return $data;
	}
}
?>