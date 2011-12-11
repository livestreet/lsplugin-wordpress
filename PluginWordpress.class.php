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
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
	die('Hacking attempt!');
}

class PluginWordpress extends Plugin {
	
	protected $aInherits=array(       
       'module'  =>array('ModuleViewer','ModuleTopic'),       
       'entity'  =>array('ModuleTopic_EntityTopic'),       
	);

	public function __construct() {
		parent::__construct();

		$this->aDelegates=array(
			'template'  =>array(Config::Get('path.root.server').'/plugins/page/templates/skin/default/actions/ActionPage/add.tpl'=>'_actions/ActionPage/add.tpl'),
		);
	}
	
	/**
	 * Активация плагина	 
	 */
	public function Activate() {		
		if (!$this->isTableExists('prefix_wp_content')) {
			/**
			 * При активации выполняем SQL дамп
			 */
			$this->ExportSQL(dirname(__FILE__).'/dump.sql');
		}
		return true;
	}
	
	/**
	 * Инициализация плагина
	 */
	public function Init() {
		$aPaths=glob(Plugin::GetPath(__CLASS__).'templates/skin/*',GLOB_ONLYDIR);		
		/**
		 * Подключает файл оформления дефолтного стиля
		 */
		if (!($aPaths and in_array(Config::Get('view.skin'),array_map('basename',$aPaths)))) {
			Config::Set('head.rules.wpblockstyle', array(
				'path'=>'.+',
				'css' => array(
					'include' => array(
						Plugin::GetTemplateWebPath(__CLASS__)."css/style.css",
					)
				),
			));
		}
		
	}
}
?>