<div class="block search">
	<form action="{router page='search'}topics/" method="GET">
		<input type="text" onblur="if (!value) value=defaultValue" onclick="if (value==defaultValue) value=''" value="{$aLang.search}" name="q" class="input-text" />
		<input type="submit" value="{$aLang.search}" class="input-submit" />
	</form>
</div>
