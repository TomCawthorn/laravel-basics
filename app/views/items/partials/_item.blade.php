@if (!$item->is_item_completed()) 
	{{ link_to_route('todos.items.completed', "Mark Complete",[$list->id, $item->id]) }}
@else
	{{ link_to_route('todos.items.completed', "Completed",[$list->id, $item->id]) }}
@endif

<h4>{{ link_to_route('todos.items.edit', $item->content, [$list->id, $item->id]) }}</h4>