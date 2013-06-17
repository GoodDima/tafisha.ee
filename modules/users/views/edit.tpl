<div class="container">
	<div class="mainContent">

		<fieldset>
			<legend>Muutis</legend>

			<form action="/users/post/" method="post">
				
				<div>
					<label for="user_username">Nimi</label>
					<input type="text" name="user[username]" id="user_username" value="{$user->username}" />
				</div>

				<div>
					<label for="user_email">E-mail</label>
					<input type="email" name="user[email]" id="user_email" value="{$user->email}" />
				</div>

				<input type="hidden" name="user_id" value="{$user->id}" />

				<input type="submit" />
				
			</form>

		</fieldset>


	</div>

	{widget controller='widgets' action='menu'}

	<br class="clearfloat" />
	
</div>