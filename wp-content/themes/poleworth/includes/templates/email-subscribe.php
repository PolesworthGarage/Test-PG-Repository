<h2>Add Email Subscription</h2>
<form method="post">
	<table class="form-table">
		<tr valign="top">
			<th>
				<strong>First Name</strong>
			</th>
			<td>
				<strong>Last Name</strong>
			</td>
			<td>
				<strong>E-Mail</strong>
			</td>
			<td>
				<strong>Mailing List</strong>
			</td>
		</tr>
		<tr valign="top">
			<td>
				<input type="text" name="first-name" class="regular-text" />
			</td>
			<td>
				<input type="text" name="last-name" class="regular-text" />
			</td>
			<td>
				<input type="text" name="email" class="regular-text" />
			</td>
			<td>
				<select name="list">
					<option value="0e85df4908">General Mailing List</option>
					<option value="0e85df4908">Trade Mailing List</option>
				</select>
			</td>
		</tr>
		<tr valign="top">
			<td>
				<?php submit_button(); ?>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
</form>