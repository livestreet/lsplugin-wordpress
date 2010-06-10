{include file='header.tpl'}

{if $wp_iDayArchive}
	{$aLang.wordpress_block_archive_day}: {date_format format="F j, Y" declination=0 date=$wp_sDateBeginArchive}
{elseif $wp_iMonthArchive}
	{$aLang.wordpress_block_archive_month}: {date_format format="F Y" declination=0 date=$wp_sDateBeginArchive} 
{else}
	{$aLang.wordpress_block_archive_year}: {date_format format="Y" date=$wp_sDateBeginArchive} 
{/if}

<br />
<br />

{include file='topic_list.tpl'}
{include file='footer.tpl'}