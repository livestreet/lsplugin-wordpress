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

class PluginWordpress_ModuleTopic_EntityTopic extends PluginWordpress_Inherit_ModuleTopic_EntityTopic {    
    public function getUrl() {    	
    	if ($this->getPublishDraft() and $this->GetTitleLat()) {
    		$sDate=date("Y",strtotime($this->getDateAdd())).'/'.date("m",strtotime($this->getDateAdd())).'/'.date("d",strtotime($this->getDateAdd())).'/';    		
    		return Router::GetPath('archive').$sDate.$this->GetTitleLat().'/';
    	}
    	if ($this->getBlog()->getType()=='personal') {
    		return Router::GetPath('blog').$this->getId().'.html';
    	} else {
    		return Router::GetPath('blog').$this->getBlog()->getUrl().'/'.$this->getId().'.html';
    	}
    }
}
?>