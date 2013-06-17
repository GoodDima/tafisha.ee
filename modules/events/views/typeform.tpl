<div class="container">
        <div class="mainContent">

		<fieldset>
			<legend>Type</legend>

			<form method="post">
				
				<div>
					<label for="type_name">Nimi</label>
					<input type="text" name="type[name]" id="type_name" value="{$type->name}" />
				</div>

				<input type="submit" />
				
			</form>

		</fieldset>



        </div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>