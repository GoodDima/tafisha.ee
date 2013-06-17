<div class="row" id="tpopup">
  <div class="teventpopup span8 offset3">
    <!-- Popup 2 cols -->
    <div class="row">
      <div class="tpopupimage span3">
		{if $event->images.cover}
			<img src="{$event->images.cover}" style="" width="170" height="250" />
		{else}
			<img src="http://placehold.it/170x250" style="" width="170" height="250">
		{/if}

        
      </div>
      <div class="span4">
        <h4>{$event->name}</h4>

		{$event->description_full}

      </div>
    </div>
    <div class="row tpopupscreens">

      <div class="span2">
		{if $event->images.add[0]}
        <img src="{$event->images.add[0]}" style="" width="170" height="250">
		{else}
		<img src="http://placehold.it/150x90" style="" width="170" height="250">
		{/if}
      </div>
	
      <div class="span2">
		{if $event->images.add[1]}
        <img src="{$event->images.add[1]}" style="" width="170" height="250">
		{else}
		<img src="http://placehold.it/150x90" style="" width="170" height="250">
		{/if}
      </div>

      <div class="span2">
		{if $event->images.add[2]}
        <img src="{$event->images.add[2]}" style="" width="170" height="250">
		{else}
		<img src="http://placehold.it/150x90" style="" width="170" height="250">
		{/if}
      </div>

      <div class="span2">
		{if $event->images.add[3]}
        <img src="{$event->images.add[3]}" style="" width="170" height="250">
		{else}
		<img src="http://placehold.it/150x90" style="" width="170" height="250">
		{/if}
      </div>

    </div>
    <div class="row">
      <div class="span8 tpopuprasp">
        <p>Расписание</p>
      </div>
    </div>
    <!-- Popup 1 col -->
    <div class="row"></div>
  </div>
</div>