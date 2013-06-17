<div class="container">
        <div class="mainContent">
        
		{foreach from=$events item='item'}

            <div class="post">
                <div class="readmore">
                	<a href="/events/eventedit/{$item->id}/">{$item->name} [ {$item->type->name} ]</a>
				</div>
            </div>
		
		{/foreach}
        

        </div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>