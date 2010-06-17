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
 * Добавляем в функционал в модуль "Topic"
 *
 */
class PluginWordpress_ModuleTopic extends PluginWordpress_Inherit_ModuleTopic {
	/**
	 * Дополнительная обработка топиков
	 *
	 * @return unknown
	 */
	public function GetTopicsAdditionalData($aTopicId,$aAllowData=array('user'=>array(),'blog'=>array('owner'=>array(),'relation_user'),'vote','favourite','comment_new')) {
		$aTopics=parent::GetTopicsAdditionalData($aTopicId,$aAllowData);
				
		$aWpTopics=$this->PluginWordpress_Wp_GetTopicsByArrayId($aTopicId);		
		foreach ($aTopics as $oTopic) {
			if (isset($aWpTopics[$oTopic->getId()])) {
				$oTopic->setTitleLat($aWpTopics[$oTopic->getId()]->getTitleLat());
			} else {
				$oTopic->setTitleLat(null);
			}
		}
			
		return $aTopics;		
	}
	/**
	 * Дополнительная обработка удаления топика
	 *
	 * @param unknown_type $oTopicId
	 * @return unknown
	 */
	public function DeleteTopic($oTopicId) {
		$bResult=parent::DeleteTopic($oTopicId);
		
		if ($oTopicId instanceof ModuleTopic_EntityTopic) {
			$sTopicId=$oTopicId->getId();			
		} else {
			$sTopicId=$oTopicId;
		}
		
		if ($bResult) {
			$this->PluginWordpress_Wp_DeleteTopicById($sTopicId);
		}
		return $bResult;
	}
		
}
?>