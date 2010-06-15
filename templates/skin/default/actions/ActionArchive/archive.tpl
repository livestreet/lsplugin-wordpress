{include file='header.tpl'}

{if $wp_iDayArchive}
	<h4>{$aLang.wordpress_block_archive_day}: <span>{date_format format="F j, Y" declination=0 date=$wp_sDateBeginArchive}</span></h4>
{elseif $wp_iMonthArchive}
	<h4>{$aLang.wordpress_block_archive_month}: <span>{date_format format="F Y" declination=0 date=$wp_sDateBeginArchive}</span></h4>
{else}
	<h4>{$aLang.wordpress_block_archive_year}: <span>{date_format format="Y" date=$wp_sDateBeginArchive}</span></h4>
{/if}

{include file='topic_list.tpl'}
{include file='footer.tpl'}