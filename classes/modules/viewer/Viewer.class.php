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
 * Добавляем в модуль "Viewer" свои методы
 *
 */
class PluginWordpress_ModuleViewer extends PluginWordpress_Inherit_ModuleViewer {
	/**
	 * Возвращает объект шаблонизатора Smarty
	 *
	 * @return unknown
	 */
	public function GetSmartyObject() {
		return $this->oSmarty;
	}
}
?>