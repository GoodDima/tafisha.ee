<script type="text/javascript" src="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.js"></script>
<link href="/design/css/forms.css" rel="stylesheet" type="text/css" />

<div class="container">
        <div class="mainContent">


		<form method="post" enctype="multipart/form-data" class="form-horizontal">
		    <fieldset>
		      <div id="legend" class="">
		          <legend class=""><h1>Создание события</h1></legend>
		      </div>
		    <div class="control-group">

		          <!-- Select Basic -->
		          <label class="control-label">Тип события</label>
		          <div class="controls">
					<select name="event[type_id]" class='input-xlarge'>
						{foreach from=$types item=item}
							<option value="{$item->id}"{if $item->id eq $event->type_id} selected{/if}>{$item->name}
						{/foreach}
					</select>
		          </div>

		        </div>
			<hr>
		    <div class="control-group">
		          <label class="control-label">Фоновая картинка</label>

		          <!-- File Upload -->
		          <div class="controls">
		            <input class="input-file span4" id="fileInput" type="file" name="images[background]">
		          </div>
		          {if $event->images.background}
		          	<a href='{$event->images.background}' target='_blank'>{$event->images.background}</a>
		          {/if}

		        </div>
		
		    
		
		    <div class="control-group">
		
		          <!-- Text input-->
		          <label class="control-label" for="input01">Название</label>
		          <div class="controls">
		            <input type="text" name="event[name]" value="{$event->name}" placeholder="" class="input-xlarge span6" />
		          </div>

		        </div>
		
		    <div class="control-group">
		          <label class="control-label">Обложка</label>
		
		          <!-- File Upload -->
		          <div class="controls">
		            <input class="input-file" id="fileInput" type="file" name="images[cover]">
		          </div>
		          {if $event->images.cover}
		          	<a href='{$event->images.cover}' target='_blank'>{$event->images.cover}</a>
		          {/if}

		        </div>
		
		    <div class="control-group">
		
		          <!-- Textarea -->
		          <label class="control-label">Короткое описание</label>
		          <div class="controls">
		            <div class="textarea">
		                  <textarea type="" name="event[description_short]" class="span6" style="margin: 0px; height: 37px;">{$event->description_short}</textarea>
		            </div>
		          </div>

			</div>
		
		    <div class="control-group">
		
		          <!-- Textarea -->
		          <label class="control-label">Длинное описание</label>
		          <div class="controls">
		            <div class="textarea">
		                  <textarea type="" name="event[description_full]" class="span6" style="margin: 0px;  height: 112px;">{$event->description_full}</textarea>
		            </div>
		          </div>
			</div>
		
		    
		
		    
		
		    <div class="control-group">

					{foreach from=$event->images.add item=image name=add_images}
			          <label class="control-label">Доп. картинка</label>
			
			          <!-- File Upload -->
			          <div class="controls">
			            <input class="input-file" id="fileInput" name="images[add][{$smarty.foreach.add_images.index}]" type="file">
			          </div>
			          <a href='{$event->images.add[$smarty.foreach.add_images.index]}' target='_blank'>{$event->images.add[$smarty.foreach.add_images.index]}</a>
			        {/foreach}

			          <label class="control-label">Доп. картинка</label>
			
			          <!-- File Upload -->
			          <div class="controls">
			            <input class="input-file" id="fileInput" name="images[add][{$smarty.foreach.add_images.iteration}]" type="file">
			          </div>
		
		          <!-- Text input-->
		          <label class="control-label" for="input01">Ссылка на видео</label>
		          <div class="controls">
		            <input type="text" placeholder="с YouTube" class="input-xlarge span3">
		            <p class="help-block"></p>
		          </div>
		        </div>
		
		<hr>              
		              
		    <div class="control-group">
		          <!-- Text input-->
		          <label class="control-label" for="input01">Теги</label>
		
		        <div id="wrapper">
		        <div class="controls">
		            <input type="text" name="event[tags]" id="tag1" class="input-xlarge span6" value="{$event->tags}" />
		            <p class="help-block">Теги через запятую</p>
		          </div>
		          </div>            
		</div>
		
		    <div class="control-group">
		          <label class="control-label"></label>
		
		          <!-- Button -->
		          <div class="controls">
		            <button class="btn btn-primary">Сохранить</button>
		          </div>
		        </div>
		
		    </fieldset>
		  </form>
<script>
{literal}
// Customize the call to tagsInput to match your code.
// Include all the parameters you are calling, and any other code 
// necessary to demonstrate the problem you are having.
// The docs are here: http://xoxco.com/projects/code/tagsinput
// 
// If you can't recreate the problem here, check your original code for issues.

$('#tag1').tagsInput({
    // my parameters here
});


// Once you can recreate the problem here,
// * Click the "Update" button above
// * Then send the resulting link to info@xoxco.com
// Someone from XOXCO will get in touch as soon as possible.
{/literal}
</script>


        </div>
        <!-- end .sidebar1 -->
        <!-- begin .mainContent -->
        
        {widget controller='widgets' action='menu'}
        
        <br class="clearfloat" />
</div>
