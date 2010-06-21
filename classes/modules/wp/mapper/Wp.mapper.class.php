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

class PluginWordpress_ModuleWp_MapperWp extends Mapper {	
		
	public function GetFirstTopic() {
		$sql = "SELECT 
					t.*							 
				FROM 
					".Config::Get('db.table.topic')." as t						
				WHERE 
					t.topic_publish = 1 									
				ORDER BY t.topic_date_add asc LIMIT 0,1";		
		if ($aRow=$this->oDb->selectRow($sql)) {
			return Engine::GetEntity('Topic',$aRow);
		}		
		return null;
	}
	
	public function GetTopicsByDate($sDateBegin,$sDateEnd,$aExcludeBlog,&$iCount,$iCurrPage,$iPerPage) {
		$sql = "				
							SELECT 		
								topic_id										
							FROM 
								".Config::Get('db.table.topic')."								
							WHERE 
								topic_date_add >= ?
								and
								topic_date_add <= ?
								and
								topic_publish = 1
								{ AND blog_id NOT IN (?a) }
                            ORDER BY topic_id DESC	
                            LIMIT ?d, ?d ";
		
		$aTopics=array();
		if ($aRows=$this->oDb->selectPage(
				$iCount,$sql,$sDateBegin,$sDateEnd,
				(is_array($aExcludeBlog)&&count($aExcludeBlog)) ? $aExcludeBlog : DBSIMPLE_SKIP,
				($iCurrPage-1)*$iPerPage, $iPerPage
			)
		) {
			foreach ($aRows as $aTopic) {
				$aTopics[]=$aTopic['topic_id'];
			}
		}
		return $aTopics;
	}
	
	public function GetTopicsByCountRead($aExcludeBlog,$iLimit) {
		$sql = "				
							SELECT 		
								topic_id										
							FROM 
								".Config::Get('db.table.topic')."								
							WHERE 								
								topic_publish = 1
								{ AND blog_id NOT IN (?a) }
                            ORDER BY topic_count_read DESC	
                            LIMIT 0, ?d ";
		
		$aTopics=array();
		if ($aRows=$this->oDb->select(
				$sql,
				(is_array($aExcludeBlog)&&count($aExcludeBlog)) ? $aExcludeBlog : DBSIMPLE_SKIP,
				$iLimit
			)
		) {
			foreach ($aRows as $aTopic) {
				$aTopics[]=$aTopic['topic_id'];
			}
		}
		return $aTopics;
	}
	
	public function GetContentById($sId) {
		$sql = "SELECT * FROM ".Config::Get('plugin.wordpress.table.content')." WHERE id = ?d ";
		if ($aRow=$this->oDb->selectRow($sql,$sId)) {
			return Engine::GetEntity('PluginWordpress_Wp_Content',$aRow);
		}
		return null;
	}
	
	public function GetContentByName($sName) {
		$sql = "SELECT * FROM ".Config::Get('plugin.wordpress.table.content')." WHERE name = ? ";
		if ($aRow=$this->oDb->selectRow($sql,$sName)) {
			return Engine::GetEntity('PluginWordpress_Wp_Content',$aRow);
		}
		return null;
	}
	
	public function GetContents() {				
		$sql = "SELECT 
					*							 
				FROM 
					".Config::Get('plugin.wordpress.table.content')." 				 									
				ORDER BY name ";
		$aCollection=array();
		if ($aRows=$this->oDb->select($sql)) {
			foreach ($aRows as $aRow) {
				$aCollection[]=Engine::GetEntity('PluginWordpress_Wp_Content',$aRow);
			}
		}		
		return $aCollection;
	}
	
	public function AddContent(PluginWordpress_ModuleWp_EntityContent $oContent) {
		$sql = "INSERT INTO  ".Config::Get('plugin.wordpress.table.content')." 
			SET name = ?, title = ?, is_php = ?d, content = ? ";
		if ($sId=$this->oDb->query($sql,$oContent->getName(),$oContent->getTitle(),$oContent->getIsPhp(),$oContent->getContent())) {
			return $sId;
		}
		return false;
	}
	
	public function UpdateContent(PluginWordpress_ModuleWp_EntityContent $oContent) {
		$sql = "UPDATE  ".Config::Get('plugin.wordpress.table.content')." 
			SET name = ?, title = ?, is_php = ?d, content = ? WHERE id = ?d ";
		return $this->oDb->query($sql,$oContent->getName(),$oContent->getTitle(),$oContent->getIsPhp(),$oContent->getContent(),$oContent->getId());
	}
	
	public function DeleteContent($sContentId) {
		$sql = "DELETE FROM  ".Config::Get('plugin.wordpress.table.content')." 
			 WHERE id = ?d ";
		return $this->oDb->query($sql,$sContentId);
	}
	
	public function GetTopicByDateAndTitleLat($sDate,$sTitle) {
		$sql = "SELECT id FROM ".Config::Get('plugin.wordpress.table.topic')." WHERE date = ? and title_lat = ? limit 0,1";
		if ($aRow=$this->oDb->selectRow($sql,$sDate,$sTitle)) {
			return $aRow['id'];
		}
		return null;
	}
	
	public function UpdateTopic(PluginWordpress_ModuleWp_EntityTopic $oWpTopic) {
		$sql = "REPLACE INTO  ".Config::Get('plugin.wordpress.table.topic')." 
			SET date = ?, title_lat = ?, id = ?d ";
		if ($aRow=$this->oDb->query($sql,$oWpTopic->getDate(),$oWpTopic->getTitleLat(),$oWpTopic->getId())) {
			return true;
		}
		return false;
	}
	
	public function DeleteTopicById($sId) {
		$sql = "DELETE FROM ".Config::Get('plugin.wordpress.table.topic')." WHERE id = ?d ";
		if ($aRow=$this->oDb->query($sql,$sId)) {
			return true;
		}
		return false;
	}
	
	public function GetTopicsByArrayId($aArrayId) {
		if (!is_array($aArrayId) or count($aArrayId)==0) {
			return array();
		}
				
		$sql = "SELECT 
					*							 
				FROM 
					".Config::Get('plugin.wordpress.table.topic')."
				WHERE 
					id IN(?a) 									
				ORDER BY FIELD(id,?a) ";
		$aTopics=array();
		if ($aRows=$this->oDb->select($sql,$aArrayId,$aArrayId)) {
			foreach ($aRows as $aTopic) {
				$aTopics[]=Engine::GetEntity('PluginWordpress_Wp_Topic',$aTopic);
			}
		}		
		return $aTopics;
	}
}
?>