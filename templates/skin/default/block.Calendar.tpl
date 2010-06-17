<div class="block">
	<h2>{date_format format="F Y" declination=0 date=$wp_aCalendar.date}</h2>
	
	<table class="calender">
		<thead>
			<tr>
				<th title="Monday">П</th>
				<th title="Tuesday">В</th>
				<th title="Wednesday">С</th>
				<th title="Thursday">Ч</th>
				<th title="Friday">П</th>
				<th title="Saturday">С</th>
				<th title="Sunday">В</th>
			</tr>
		</thead>

		
		<tbody>
		{foreach from=$wp_aCalendar.weeks item=aWeekItem}
			<tr>
				{foreach from=$aWeekItem item=aDayItem}
					{if $aDayItem}
						{if $aDayItem.topic}
							<td><a href="{router page='archive'}{date_format format="Y" date=$aDayItem.date}/{date_format format="m" date=$aDayItem.date}/{date_format format="d" date=$aDayItem.date}/">{date_format format="j" date=$aDayItem.date}</a></td>
						{else}
							<td>{date_format format="j" date=$aDayItem.date}</td>
						{/if}
					{else}	
						<td class="empty">&nbsp;</td>
					{/if}
				{/foreach}
			</tr>
		{/foreach}
		</tbody>

		
		<tfoot>
			<tr>
				<td colspan="3">
					{if $wp_aCalendar.prev}
						<a href="{router page='archive'}{date_format format="Y" date=$wp_aCalendar.prev}/{date_format format="m" date=$wp_aCalendar.prev}/">« {date_format format="F" declination=0 date=$wp_aCalendar.prev}</a>
					{/if}
				</td>
				<td>&nbsp;</td>
				<td colspan="3" style="text-align: right">
					{if $wp_aCalendar.next}
						<a href="{router page='archive'}{date_format format="Y" date=$wp_aCalendar.next}/{date_format format="m" date=$wp_aCalendar.next}/">{date_format format="F" declination=0 date=$wp_aCalendar.next} »</a>
					{/if}
				</td>
			</tr>
		</tfoot>
	</table>
</div>