{assign var="nesting" value="0"}
{foreach from=$aPagesMain item=oPage name=rublist}
	{assign var="cmtlevel" value=$oPage->getLevel()}
			
	{if $nesting < $cmtlevel}
		<ul>
	{elseif $nesting > $cmtlevel}
		</li>
		{section name=closelist1  loop=$nesting-$cmtlevel}</ul></li>{/section}
	{elseif not $smarty.foreach.rublist.first}
		</li>
	{/if}
	
	<li><a href="{router page='page'}{$oPage->getUrlFull()}/">{$oPage->getTitle()}</a>
	
	{assign var="nesting" value=$cmtlevel}
	{if $smarty.foreach.rublist.last}
		{section name=closelist2 loop=$nesting}</li></ul>{/section}  
		</li>  
	{/if}
{/foreach}
		
	
	
	
	