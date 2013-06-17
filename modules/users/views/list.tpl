<div class="container">
        <div class="mainContent">
        
		{foreach from=$users item='item'}

            <div class="post">
                <div class="readmore">
                	<a href="/users/edit/{$item->id}/">{$item->username} [{$item->email}]</a>
				</div>
            </div>
		
		{/foreach}
        

        </div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>