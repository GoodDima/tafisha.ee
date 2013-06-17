<div class="container">

<h2>Login</h2>
{if ($message)}
    <h3 class="message">
		{$message}
    </h3>
{/if}
 
<form action="/user/login" method="post">

	<label for="username">Username</label>
	<input type="text" name="username" id="username" value="{$smarty.post.username}" /><br />

	<label for="password">Password</label>
	<input type="password" name="password" id="password" value="" /><br />

	<label for="password">Remember Me</label>
	<input type="checkbox" name="remember" id="remember" /><br />

	<input type="submit" value="Login" /><br />

</form>
 
<p>(Remember Me keeps you logged in for 2 weeks)</p>
 
<p>Or <a href="/user/create">create a new account</a></p>

<p>Or <a href="/user/restore">restore your password</a></p>

</div>