<div class="container">
<h2>Create a New User</h2>
{if ($message)}
    <h3 class="message">
		{$message}
    </h3>
{/if}
 
<form action="/user/create" method="post">
 
	<label for="username">Username</label>
	<input type="text" name="username" id="username" value="{$smarty.post.username}" /><br />
	<div class="error">
		{$errors.username}
	</div>

	<label for="email">Email Address</label>
	<input type="text" name="email" id="email" value="{$smarty.post.email}" /><br />
	<div class="error">
		{$errors.email}
	</div>

	<label for="password">Password</label>
	<input type="password" name="password" id="password" /><br />
	<div class="error">
		{$errors._external.password}
	</div>

	<label for="password_confirm">Confirm Password</label>
	<input type="password" name="password_confirm" id="password_confirm" /><br />
	<div class="error">
		{$errors._external.password_confirm}
	</div>
 
<input type="submit" value="Create User" /><br />

</form>
 
<p>Or <a href="/user/login">login</a> if you have an account already.</p>

</div>