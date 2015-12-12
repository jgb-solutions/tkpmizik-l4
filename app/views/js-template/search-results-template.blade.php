<script type="text/template" id="searchResultsTemplate">

<tr accesskey="r">
	<td>
		<strong>
			<span class="glyphicon glyphicon-<%= icon %>"></span>
			<a href="/<%= type %>/<%= id %>">
				<%= name %></a>
		</strong>
	</td>
	<td>
		<span class="glyphicon glyphicon-play"></span>
		<strong><%= play %></strong>
	</td>
	<td>
		<span class="glyphicon glyphicon-download"></span>
		<strong><%= download %></strong>
	</td>
</tr>

</script>