<div class="container">

<h2>Restore</h2>
{if ($message)}
    <h3 class="message">
		{$message}
    </h3>
{else}

	<form action="/user/restore_hash/{$hash}/" method="post">

		<label for="new_password">New Password</label>
		<input type="password" name="password" id="new_password" value="" /><br />

		<label for="confirm_password">Confirm Password</label>
		<input type="password" name="password_confirm" id="confirm_password" value="" /><br />
	
		<input type="submit" value="Restore" /><br />
	
	</form>

{/if}

</div>