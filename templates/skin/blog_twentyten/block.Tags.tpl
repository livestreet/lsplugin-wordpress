<div class="block">
	<h2>{$aLang.wordpress_block_tags}</h2>
	
	<ul class="cloud">
		{foreach from=$wp_aTags item=oTagItem}
			<li><a class="w{$oTagItem->getSize()}" rel="tag" href="{router page='tag'}{$oTagItem->getText()|escape:'html'}/">{$oTagItem->getText()|escape:'html'}</a></li>	
		{/foreach}
	</ul>
</div>