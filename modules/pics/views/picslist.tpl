<div class="container">
        <div class="mainContent">
        
		{foreach from=$galleries item='item'}

            <div class="post">
                <div class="readmore">
                	<a href="/pics/edit/{$item->tag}/">{$item->tag}</a>
				</div>
            </div>
		
		{/foreach}
        
		</div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>