<div class="block author">
	<h2>{$aLang.wordpress_block_user_about}</h2>

	{if $wp_oUserAbout}
		<strong>{$aLang.wordpress_block_user_about_login}:</strong> {$wp_oUserAbout->getLogin()}<br>
		
		{if $wp_oUserAbout->getProfileName()}
			<strong>{$aLang.wordpress_block_user_about_name}:</strong>  {$wp_oUserAbout->getProfileName()}<br>	
		{/if}
		
		{if ($wp_oUserAbout->getProfileCountry()|| $wp_oUserAbout->getProfileCity())}
			<strong>{$aLang.wordpress_block_user_about_place}:</strong>
			{if $wp_oUserAbout->getProfileCity()}
				{$aLang.wordpress_block_user_about_place_city} {$wp_oUserAbout->getProfileCity()|escape:'html'}
			{/if}
			{if $wp_oUserAbout->getProfileCountry()}
				{if $wp_oUserAbout->getProfileCity()},{/if} {$wp_oUserAbout->getProfileCountry()|escape:'html'}<br />
			{/if}
		{/if}
		
		{if $wp_oUserAbout->getProfileIcq()}
			<strong>{$aLang.wordpress_block_user_about_icq}:</strong> {$wp_oUserAbout->getProfileIcq()}<br>
		{/if}

		{if $wp_oUserAbout->getMail() and $oConfig->GetValue('plugin.wordpress.block.user_about.show_mail')}
			<strong>{$aLang.wordpress_block_user_about_mail}:</strong> {$wp_oUserAbout->getMail()}<br>
		{/if}
	{else}

	{/if}
</div>