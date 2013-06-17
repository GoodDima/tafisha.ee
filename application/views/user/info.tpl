<div class="container">
<h2>Info for  user "{$user->username}"</h2>
 
<ul>
    <li>Email: {$user->email}</li>
    <li>Number of logins: {$user->logins}</li>
    <li>Last Login: {$user->last_login}</li>
</ul>
 
<a href="/user/logout">Logout</a>
</div>