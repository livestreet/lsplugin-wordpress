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

class PluginWordpress_HookWp extends Hook {

    public function RegisterHook() {
        $this->AddHook('init_action', 'InitAction');
        $this->AddHook('module_topic_updatetopic_before', 'UpdateTopic');
        $this->AddHook('module_topic_addtopic_after', 'AddTopic');
        $this->AddHook('template_main_menu_tree','MenuTree');
        $this->AddHook('topic_show','TopicShow');
    }

    public function InitAction() {    	
		/**
		 * Подхватываем обработку URL вида /archive/YYYY/mm/dd/.../
		 */
    	if (Router::GetAction()=='archive') {    		
    		$sEvent=Router::GetActionEvent();    		
    		$aParams=Router::GetParams();    		
    		if (preg_match("@^\d{4}$@",$sEvent) and preg_match("@^\d{2}$@",Router::GetParam(0))  and preg_match("@^\d{2}$@",Router::GetParam(1)) and preg_match("@^[\w_\-]+$@",Router::GetParam(2)) ) {    			
    			/**
    			 * Получаем топик
    			 */    			
    			if ($oTopic=$this->PluginWordpress_Wp_GetTopicByDateAndTitleLat($sEvent.'-'.Router::GetParam(0).'-'.Router::GetParam(1),Router::GetParam(2))) {    				
    				if ($oTopic->getBlog()->getType()=='personal') {    					
    					Router::Action('blog',$oTopic->getId().'.html',array());
    				} else {
    					Router::Action('blog',$oTopic->getBlog()->getUrl(),array($oTopic->getId().'.html'));
    				}
    			}
    		}    		
    	}
    	/**
    	 * Проверяем возможность пользователю добавлять топики
    	 */
    	$oUserCurrent=$this->User_GetUserCurrent();
    	if (in_array(Router::GetAction(),array('topic','question','link','photoset')) and Router::GetActionEvent()=='add') {
    		if ($oUserCurrent and Config::get('plugin.wordpress.topic.can_add')=='admin' and !$oUserCurrent->isAdministrator()) {    			
    			Router::Action('error','404');
    		}
    	}
    }
    
    public function UpdateTopic($aParams) {    	
    	$this->PluginWordpress_Wp_UpdateTopicUrl($aParams[0]);
    }
    
    public function AddTopic($aParams) {
    	if ($oTopic=$aParams['result']) {
    		$this->PluginWordpress_Wp_UpdateTopicUrl($oTopic);
    	}    	
    }    
    
    public function MenuTree() {
    	$aPages=$this->PluginPage_Page_GetPages(array('main'=>1,'active'=>1));		
		$this->Viewer_Assign('aPagesMain',$aPages);
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'main_menu.tpl');
    }
    
    public function TopicShow($aParams) {
    	$oTopic=$aParams['oTopic'];
    	$oTopic->setCountRead($oTopic->getCountRead()+1);
    	$this->Topic_UpdateTopic($oTopic);
    }
}
?>