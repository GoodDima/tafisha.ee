{if $user}
<div class="container">
	<h2>widget "{$user->username}"</h2>

	<ul>
	    <li>Email: {$user->email}</li>
	    <li>Number of logins: {$user->logins}</li>
	    <li>Last Login: {$user->last_login}</li>
	</ul>

	<a href="/user/logout">Logout</a>
</div>
{else}
<div class="container">
	<a href="/user/login">Login</a>
</div>
{/if}