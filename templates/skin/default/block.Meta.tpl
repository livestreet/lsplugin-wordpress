	<div class="block meta">
		<h2>{$aLang.wordpress_block_meta}</h2>
		
		<ul>
			{if $oUserCurrent}
				<li><a href="{$oUserCurrent->getUserWebPath()}" class="username">{$oUserCurrent->getLogin()}</a></li>
				
				{if $oConfig->GetValue('plugin.wordpress.topic.can_add')=='user' or $oUserCurrent->isAdministrator()}
					<li><a href="{router page='topic'}add/" class="create">{$aLang.wordpress_block_meta_topic_add}</a></li>
				{/if}
				
				
				{if $iUserCurrentCountTalkNew}
					<li><a href="{router page='talk'}" class="message-new" id="new_messages" title="{$aLang.wordpress_block_meta_messages}">{$aLang.wordpress_block_meta_messages} ({$iUserCurrentCountTalkNew})</a></li>
				{else}
					<li><a href="{router page='talk'}" id="new_messages">{$aLang.wordpress_block_meta_messages} ({$iUserCurrentCountTalkNew})</a></li>
				{/if}
				<li><a href="{router page='settings'}profile/">{$aLang.wordpress_block_meta_settings}</a></li>
				{if $oUserCurrent->isAdministrator()}
					<li><a href="{router page='admin'}">{$aLang.wordpress_block_meta_admin}</a></li>
					<li><a href="{router page='contentany'}">{$aLang.wordpress_block_meta_contentany}</a></li>
				{/if}
				<li><a href="{router page='login'}exit/?security_ls_key={$LIVESTREET_SECURITY_KEY}">{$aLang.wordpress_block_meta_exit}</a></li>
			{else}
				<li><a href="{router page='registration'}">{$aLang.wordpress_block_meta_registration}</a></li>
				<li><a href="{router page='login'}">{$aLang.wordpress_block_meta_login}</a></li>
			{/if}
		</ul>
	</div>