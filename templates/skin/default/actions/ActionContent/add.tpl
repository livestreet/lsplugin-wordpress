
				
				<form action="" method="POST">
					<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" /> 

					<p><label for="content_name">{$aLang.wordpress_content_field_name}:</label>
       				<input type="text" id="content_name" name="content_name" value="{$_aRequest.content_name}" class="w100p" /><br />      
      				</p>
									
					<p><label for="content_title">{$aLang.wordpress_content_field_title}:</label>
       				<input type="text" id="content_title" name="content_title" value="{$_aRequest.content_title}"  class="w100p" /><br />      
      				</p>
      				      									
					<p><label for="content_content">{$aLang.wordpress_content_field_content}:</label>
					
            			<div class="panel_form" style="background: #eaecea; ">       	 
	 						<a href="#" onclick="lsPanel.putTagAround('content_content','b'); return false;" class="button"><img src="{cfg name='path.static.skin'}/images/panel/bold_ru.gif" width="20" height="20" title="{$aLang.panel_b}"></a>
	 						<a href="#" onclick="lsPanel.putTagAround('content_content','i'); return false;" class="button"><img src="{cfg name='path.static.skin'}/images/panel/italic_ru.gif" width="20" height="20" title="{$aLang.panel_i}"></a>	 			
	 						<a href="#" onclick="lsPanel.putTagAround('content_content','u'); return false;" class="button"><img src="{cfg name='path.static.skin'}/images/panel/underline_ru.gif" width="20" height="20" title="{$aLang.panel_u}"></a>	 			
	 						<a href="#" onclick="lsPanel.putTagAround('content_content','s'); return false;" class="button"><img src="{cfg name='path.static.skin'}/images/panel/strikethrough.gif" width="20" height="20" title="{$aLang.panel_s}"></a>	 			
	 						&nbsp;
	 						<a href="#" onclick="lsPanel.putTagUrl('content_content','URL'); return false;" class="button"><img src="{cfg name='path.static.skin'}/images/panel/link.gif" width="20" height="20"  title="{$aLang.panel_url}"></a>
	 					</div>
	 				
	 				<textarea name="content_content" id="content_content" rows="20">{$_aRequest.content_content}</textarea></p>
										     				
     				<p><input type="checkbox" id="content_is_php" name="content_is_php" value="1" {if $_aRequest.content_is_php==1}checked{/if}/>
      				<label for="content_is_php"> &mdash; {$aLang.wordpress_content_field_is_php}</label>	     				            
     				</p>
	 				
					
					<p class="buttons">					
					<input type="submit" name="submit_content_save" value="{$aLang.wordpress_content_submit_save}">&nbsp;  
					<input type="submit" name="submit_content_cancel" value="{$aLang.wordpress_content_submit_cancel}" onclick="window.location='{router page='contentany'}'; return false;">&nbsp;
					</p>
					
					<input type="hidden" name="content_id" value="{$_aRequest.content_id}">
				</form>