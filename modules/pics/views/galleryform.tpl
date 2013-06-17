<div class="container">
        <div class="mainContent">

		<fieldset>
			<legend>Gallery</legend>

			<form method="post">
				
				<div>
					<label for="gallery_tag">Tag</label>
					<input type="text" name="gallery[tag]" id="gallery_tag" value="{$gallery->tag}" />
				</div>

				<div>
					<label for="gallery_hide">Hidden</label>
					<input type="hidden" name="gallery[hide]" value="n" />
					<input type="checkbox" name="gallery[hide]" id="gallery_hide" value="y"{if $gallery->hide neq 'n'} checked="checked"{/if} />
				</div>

				<input type="submit" />

			</form>

		</fieldset>
		
		{if $gallery}
			<ul>
			{foreach from=$gallery->items->find_all() item='item'}
				<li><img src="/uploads/{$item->path}/small.jpg" /></li>
			{/foreach}
			</ul>
		{/if}

		{if $gallery}
			<br />
			<fieldset>
				<legend>Pictures</legend>

				<form method="post" enctype="multipart/form-data">

					<div>
						<label for="picture">File</label>
						<input type="file" name="picture" id="picture" />
					</div>
					
					<input type="submit" />

				</form>

			</fieldset>
		{/if}

        </div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>