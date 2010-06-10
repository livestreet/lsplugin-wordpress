<div class="block">
	<h2>{$aLang.wordpress_block_user_about}</h2>

	{if $wp_oUserAbout}
		{$aLang.wordpress_block_user_about_login}: {$wp_oUserAbout->getLogin()}<br>
		
		{if $wp_oUserAbout->getProfileName()}
			{$aLang.wordpress_block_user_about_name}: {$wp_oUserAbout->getProfileName()}<br>	
		{/if}
		
		{if ($wp_oUserAbout->getProfileCountry()|| $wp_oUserAbout->getProfileCity())}
			{$aLang.wordpress_block_user_about_place}: 
			{if $wp_oUserAbout->getProfileCity()}
				{$aLang.wordpress_block_user_about_place_city} {$wp_oUserAbout->getProfileCity()|escape:'html'}
			{/if}
			{if $wp_oUserAbout->getProfileCountry()}
				{if $wp_oUserAbout->getProfileCity()},{/if} {$wp_oUserAbout->getProfileCountry()|escape:'html'}<br>
			{/if}
		{/if}
		
		{if $wp_oUserAbout->getProfileIcq()}
			{$aLang.wordpress_block_user_about_icq}: {$wp_oUserAbout->getProfileIcq()}<br>
		{/if}

		{if $wp_oUserAbout->getMail() and $oConfig->GetValue('plugin.wordpress.block.user_about.show_mail')}
			{$aLang.wordpress_block_user_about_mail}: {$wp_oUserAbout->getMail()}<br>
		{/if}
	{else}

	{/if}
</div>