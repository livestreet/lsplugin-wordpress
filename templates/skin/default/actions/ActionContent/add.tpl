{include file='window_load_img.tpl' sToLoad='content_content'}
<script type="text/javascript">
	jQuery(document).ready(function($){
	ls.lang.load({lang_load name="panel_b,panel_i,panel_u,panel_s,panel_url,panel_url_promt,panel_code,panel_video,panel_image,panel_cut,panel_quote,panel_list,panel_list_ul,panel_list_ol,panel_title,panel_clear_tags,panel_video_promt,panel_list_li"});
	// Подключаем редактор
	$('#content_content').markItUp(getMarkitupSettings());
	});
</script>

<form action="" method="POST">
	<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" /> 

	<p><label for="content_name">{$aLang.wordpress_content_field_name}:</label><br />
	<input type="text" id="content_name" name="content_name" value="{$_aRequest.content_name}" class="input-wide" /></p>
					
	<p><label for="content_title">{$aLang.wordpress_content_field_title}:</label><br />
	<input type="text" id="content_title" name="content_title" value="{$_aRequest.content_title}"  class="input-wide" /></p>
											
	<label for="content_content">{$aLang.wordpress_content_field_content}:</label>

	<textarea name="content_content" id="content_content" rows="20" class="input-wide">{$_aRequest.content_content}</textarea>
											
	<p><label><input type="checkbox" id="content_is_php" name="content_is_php" value="1" {if $_aRequest.content_is_php==1}checked{/if} class="checkbox" />
	{$aLang.wordpress_content_field_is_php}</label></p>
	
				
	<input type="submit" name="submit_content_save" value="{$aLang.wordpress_content_submit_save}" />
	<input type="submit" name="submit_content_cancel" value="{$aLang.wordpress_content_submit_cancel}" onclick="window.location='{router page='contentany'}'; return false;" />
		
</form>
<br /><br />