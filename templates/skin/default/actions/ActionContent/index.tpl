{include file='header.tpl'}


<h2>{$aLang.wordpress_content}</h2>
<br />	
{if $sEvent=='add'}
	<h4>{$aLang.wordpress_content_action_add_title}</h4>
	{include file="$sTemplatePathPlugin/actions/ActionContent/add.tpl"}
{elseif $sEvent=='edit'}
	<h4>{$aLang.wordpress_content_action_edit_title} «{$oContentEdit->getName()}»</h4>
	{include file="$sTemplatePathPlugin/actions/ActionContent/add.tpl"}
{else}
	<a href="{router page='contentany'}add/" class="page-new">{$aLang.wordpress_content_action_add}</a>
{/if}



<table width="100%" cellspacing="0" class="table">
	<thead>
		<tr>
			<td align="center" width="30px">{$aLang.wordpress_content_field_id}</td>
			<td align="left" width="200px">{$aLang.wordpress_content_field_name}</td>    	
			<td align="left">{$aLang.wordpress_content_field_title}</th>
			<td align="center" width="50px">{$aLang.wordpress_content_field_php}</td>    	   	
			<td align="center" width="60px">{$aLang.wordpress_content_action}</td>    	   	
		</tr>
  	</thead>
	
	<tbody>
	{foreach from=$aContents item=oContent name=el}    
		{if $smarty.foreach.el.iteration % 2  == 0}
			{assign var=className value=''}
		{else}
			{assign var=className value='colored'}
		{/if}
		
		<tr class="{$className}" onmouseover="this.className='colored_sel';" onmouseout="this.className='{$className}';"> 
			<td align="center" valign="middle">    	
				{$oContent->getId()}
			</td> 
			<td align="left" valign="middle">    	
				{$oContent->getName()}
			</td>
			<td align="left">
				{$oContent->getTitle()}
			</td>   
			<td align="center">
				{if $oContent->getIsPhp()}
					{$aLang.page_admin_active_yes}
				{else}
					{$aLang.page_admin_active_no}
				{/if}
			</td>    
			<td align="center">  
				<a href="{router page='contentany'}edit/{$oContent->getId()}/"><img src="{$sTemplateWebPathPlugin}images/edit.gif" alt="{$aLang.wordpress_content_action_edit}" title="{$aLang.wordpress_content_action_edit}" border="0"/></a>      	
				&nbsp;
				<a href="{router page='contentany'}delete/{$oContent->getId()}/?security_ls_key={$LIVESTREET_SECURITY_KEY}" onclick="return confirm('«{$oContent->getName()}»: {$aLang.wordpress_content_action_delete_confirm}');"><img src="{$sTemplateWebPathPlugin}images/delete.gif" alt="{$aLang.wordpress_content_action_delete}" title="{$aLang.wordpress_content_action_delete}" border="0"/></a>        	    
			 </td>   
		</tr>
	{/foreach}
	</tbody>
</table>


{include file='footer.tpl'}