<script type="text/template" id="searchResultsTemplate">

<tr accesskey="r">
	<td>
		<strong>
			<i class="fa fa-<%= icon %>"></i>
			<a href="/<%= type %>/<%= id %>">
				<%= name %>
			</a>
			<% if (type == 'mp3' && price == 'paid')
			{%>
				<i class="fa fa-dollar"></i>
			<%}%>
		</strong>
	</td>
	<td>
		<i class="fa fa-eye"></i>
		<strong><%= views %></strong>
	</td>
	<td>
		<i class="fa fa-download"></i>
		<strong><%= download %></strong>
	</td>
</tr>

</script>