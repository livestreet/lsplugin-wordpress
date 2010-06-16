<div class="block">
	<h2>{$aLang.wordpress_block_topic_popular}</h2>
	
	<ul>
		{foreach from=$wp_aTopicsPopular item=oTopicItem}
			<li><a href="{$oTopicItem->getUrl()}">{$oTopicItem->getTitle()|escape:'html'}</a></li>						
		{/foreach}
	</ul>
</div>