<div class="block">
	<h2>{$aLang.wordpress_block_archive}</h2>
	
	<ul>
		{foreach from=$wp_aArchive item=aArchiveItem}
			<li><a href="{router page='archive'}{date_format format="Y" date=$aArchiveItem.date}/{date_format format="m" date=$aArchiveItem.date}/">{date_format format="F Y" declination=0 date=$aArchiveItem.date}</a></li>						
		{/foreach}
	</ul>
</div>