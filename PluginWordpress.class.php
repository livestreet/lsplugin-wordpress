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
	die('Hacking attemp!');
}

class PluginWordpress extends Plugin {
	
	protected $aInherits=array(       
       'module'  =>array('ModuleViewer','ModuleTopic'),       
       'entity'  =>array('ModuleTopic_EntityTopic'),       
	);

	
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
		//$this->Viewer_ClearBlocks('right');
		
		$this->Viewer_AddBlock('right','Meta',array('plugin'=>'wordpress'),10);
		$this->Viewer_AddBlock('right','TopicPopular',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','TopicLast',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','Blogs',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','Tags',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','CommentLast',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','UserAbout',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','Search',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','ContentAny',array('plugin'=>'wordpress','id'=>'test'),1);
		$this->Viewer_AddBlock('right','Archive',array('plugin'=>'wordpress'),1);
		$this->Viewer_AddBlock('right','Calendar',array('plugin'=>'wordpress'),1);
		
		
		
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