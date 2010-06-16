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
	}
	
	protected function RegisterEvent() {
		$this->AddEvent('index','EventIndex');
		$this->AddEvent('add','EventAdd');
	}
		
	
	/**********************************************************************************
	 ************************ РЕАЛИЗАЦИЯ ЭКШЕНА ***************************************
	 **********************************************************************************
	 */
	
	
	protected function EventIndex() {
		/**
		 * Если пользователь не авторизован и не админ, то выкидываем его
		 */
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if (!$this->oUserCurrent or !$this->oUserCurrent->isAdministrator()) {			
			return $this->EventNotFound();
		}
				
		/**
		 * Получаем и загружаем список всех блоков
		 */
		$aContents=$this->PluginWordpress_Wp_GetContents();		
		$this->Viewer_Assign('aContents',$aContents);
	}
	
	protected function EventAdd() {
		$this->setTemplateAction('index');
	}
	
	
}
?>