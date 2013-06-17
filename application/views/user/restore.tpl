<div class="container">

<h2>Restore</h2>
{if ($message)}
    <h3 class="message">
		{$message}
    </h3>
{/if}
 
<form action="/user/restore" method="post">

	<label for="email">E-mail</label>
	<input type="text" name="email" id="email" value="" /><br />

	<input type="submit" value="Restore" /><br />

</form>

<p>Or <a href="/user/create">create a new account</a></p>

</div>