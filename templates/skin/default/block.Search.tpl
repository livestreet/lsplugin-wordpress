<div class="block">
	<h2>{$aLang.wordpress_block_search}</h2>
	
	<form action="{router page='search'}topics/" method="GET">
		<input type="text" onblur="if (!value) value=defaultValue" onclick="if (value==defaultValue) value=''" value="{$aLang.search}" name="q" />
		<input type="submit" value="" />
	</form>
</div>
