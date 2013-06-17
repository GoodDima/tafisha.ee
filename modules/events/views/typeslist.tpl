<div class="container">
        <div class="mainContent">
        
		{foreach from=$types item='item'}

            <div class="post">
                <div class="readmore">
                	<a href="/events/typeedit/{$item->id}/">{$item->name}</a>
				</div>
            </div>
		
		{/foreach}
        
        <a href="/events/typeadd/">++Add++</a>

        </div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>