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
 * Обрабатывает управление контентом произвольных блоках
 *
 */
class PluginWordpress_ActionContent extends ActionPlugin {		
	/**
	 * Инициализация 
	 *
	 * @return null
	 */
	public function Init() {
		$this->SetDefaultEvent('index');
		$this->Viewer_AddHtmlTitle($this->Lang_Get('wordpress_content'));
		
		/**
		 * Если пользователь не авторизован и не админ, то выкидываем его
		 */
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if (!$this->oUserCurrent or !$this->oUserCurrent->isAdministrator()) {			
			return $this->EventNotFound();
		}
	}
	
	protected function RegisterEvent() {
		$this->AddEvent('index','EventIndex');
		$this->AddEvent('add','EventAdd');
		$this->AddEventPreg('/^edit$/i','/^\d+$/i','EventEdit');
		$this->AddEventPreg('/^delete$/i','/^\d+$/i','EventDelete');
	}
		
	
	/**********************************************************************************
	 ************************ РЕАЛИЗАЦИЯ ЭКШЕНА ***************************************
	 **********************************************************************************
	 */
	
	
	protected function EventIndex() {				
		/**
		 * Получаем и загружаем список всех блоков
		 */
		$aContents=$this->PluginWordpress_Wp_GetContents();		
		$this->Viewer_Assign('aContents',$aContents);
	}
	
	protected function EventAdd() {
		$this->setTemplateAction('index');		
		/**
		 * Получаем и загружаем список всех блоков
		 */
		$aContents=$this->PluginWordpress_Wp_GetContents();		
		$this->Viewer_Assign('aContents',$aContents);
		
		if (isPost('submit_content_save')) {
			/**
		 	* Проверяем корректность полей
		 	*/
			if (!$this->CheckFields()) {
				return ;
			}
			/**
		 	* Заполняем свойства
		 	*/
			$oContent=Engine::GetEntity('PluginWordpress_Wp_Content');
			$oContent->setIsPhp(getRequest('content_is_php') ? 1 : 0);			
			$oContent->setName(getRequest('content_name'));
			$oContent->setTitle(getRequest('content_title'));
			$oContent->setContent(getRequest('content_content'));			
			/**
		 	* Добавляем
			 */		
			if ($this->PluginWordpress_Wp_AddContent($oContent)) {
				$this->Message_AddNotice($this->Lang_Get('wordpress_content_submit_save_ok'),null,true);
				Router::Location(Router::GetPath('contentany'));			
			} else {
				$this->Message_AddError($this->Lang_Get('system_error'));
			}
		}						
	}
	
	protected function EventEdit() {
		if (!($oContent=$this->PluginWordpress_Wp_GetContentById($this->getParam(0)))) {
			return $this->EventNotFound();
		}
		$this->Viewer_Assign('oContentEdit',$oContent);		
		$this->setTemplateAction('index');
		/**
		 * Получаем и загружаем список всех блоков
		 */
		$aContents=$this->PluginWordpress_Wp_GetContents();		
		$this->Viewer_Assign('aContents',$aContents);
		
		if (isPost('submit_content_save')) {
			if (!$this->CheckFields($oContent)) {
				return ;
			}
			$oContent->setIsPhp(getRequest('content_is_php') ? 1 : 0);			
			$oContent->setName(getRequest('content_name'));
			$oContent->setTitle(getRequest('content_title'));
			$oContent->setContent(getRequest('content_content'));
			/**
			 * Сохраняем
			 */
			if ($this->PluginWordpress_Wp_UpdateContent($oContent)) {
				$this->Message_AddNotice($this->Lang_Get('wordpress_content_submit_save_ok'),null,true);
				Router::Location(Router::GetPath('contentany'));			
			} else {
				$this->Message_AddError($this->Lang_Get('system_error'));
			}
		} else {
			$_REQUEST['content_is_php']=$oContent->getIsPhp();
			$_REQUEST['content_name']=$oContent->getName();
			$_REQUEST['content_title']=$oContent->getTitle();
			$_REQUEST['content_content']=$oContent->getContent();
		}
	}
	
	protected function EventDelete() {
		if (!($oContent=$this->PluginWordpress_Wp_GetContentById($this->getParam(0)))) {
			return $this->EventNotFound();
		}
		$this->Security_ValidateSendForm();	
		$this->setTemplateAction('index');
		
		if ($this->PluginWordpress_Wp_DeleteContent($oContent->getId())) {
			$this->Message_AddNotice($this->Lang_Get('wordpress_content_action_delete_ok'),null,true);
			Router::Location(Router::GetPath('contentany'));
		} else {
			$this->Message_AddError($this->Lang_Get('system_error'));
		}
	}
	
	protected function CheckFields($oContentEdit=null) {		
		$this->Security_ValidateSendForm();	
		
		$bOk=true;		
		if (!func_check(getRequest('content_name',null,'post'),'text',1,50)) {
			$this->Message_AddError($this->Lang_Get('wordpress_content_field_name_error'),$this->Lang_Get('error'));
			$bOk=false;
		} else {
			if ($oContentOld=$this->PluginWordpress_Wp_GetContentByName(getRequest('content_name',null,'post')) and $oContentOld->getId()!=$oContentEdit->getId()) {
				$this->Message_AddError($this->Lang_Get('wordpress_content_field_name_exists'),$this->Lang_Get('error'));
				$bOk=false;
			}
		}
		return $bOk;
	}
}
?>