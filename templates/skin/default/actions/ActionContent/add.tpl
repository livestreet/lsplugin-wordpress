<form action="" method="POST">
	<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" /> 

	<p><label for="content_name">{$aLang.wordpress_content_field_name}:</label><br />
	<input type="text" id="content_name" name="content_name" value="{$_aRequest.content_name}" class="input-wide" /></p>
					
	<p><label for="content_title">{$aLang.wordpress_content_field_title}:</label><br />
	<input type="text" id="content_title" name="content_title" value="{$_aRequest.content_title}"  class="input-wide" /></p>
											
	<label for="content_content">{$aLang.wordpress_content_field_content}:</label>
	<div class="panel-form">       	 
		<a href="#" onclick="lsPanel.putTagAround('content_content','b'); return false;" class="button"><img src="{$sTemplateWebPathPlugin}images/panel/bold_ru.gif" width="20" height="20" title="{$aLang.panel_b}"></a>
		<a href="#" onclick="lsPanel.putTagAround('content_content','i'); return false;" class="button"><img src="{$sTemplateWebPathPlugin}images/panel/italic_ru.gif" width="20" height="20" title="{$aLang.panel_i}"></a>	 			
		<a href="#" onclick="lsPanel.putTagAround('content_content','u'); return false;" class="button"><img src="{$sTemplateWebPathPlugin}images/panel/underline_ru.gif" width="20" height="20" title="{$aLang.panel_u}"></a>	 			
		<a href="#" onclick="lsPanel.putTagAround('content_content','s'); return false;" class="button"><img src="{$sTemplateWebPathPlugin}images/panel/strikethrough.gif" width="20" height="20" title="{$aLang.panel_s}"></a>	 			
		&nbsp;
		<a href="#" onclick="lsPanel.putTagUrl('content_content','URL'); return false;" class="button"><img src="{$sTemplateWebPathPlugin}images/panel/link.gif" width="20" height="20"  title="{$aLang.panel_url}"></a>
	</div>
	
	<textarea name="content_content" id="content_content" rows="20" class="input-wide">{$_aRequest.content_content}</textarea>
											
	<p><label><input type="checkbox" id="content_is_php" name="content_is_php" value="1" {if $_aRequest.content_is_php==1}checked{/if} class="checkbox" />
	{$aLang.wordpress_content_field_is_php}</label></p>
	
				
	<input type="submit" name="submit_content_save" value="{$aLang.wordpress_content_submit_save}" />
	<input type="submit" name="submit_content_cancel" value="{$aLang.wordpress_content_submit_cancel}" onclick="window.location='{router page='contentany'}'; return false;" />
	
	<input type="hidden" name="content_id" value="{$_aRequest.content_id}" />
</form>
<br /><br />