		<h4>{{ link_to_route('todos.show', $list->name, [$list->id]) }}</h4>
		<p>{{ $list->get_list_status($list->id) }}</p>


		<ul class="no-bullet button-group">
			<li>
				{{ link_to_route('todos.edit', 'edit', [$list->id], ['class' => 'tiny button']) }}
			</li>
			<li>
				{{ Form::model( $list, array('route' => ['todos.destroy', $list->id], 'method' => 'delete') ) }}
					{{ Form::button('destroy', ['type' => 'submit', 'class' => 'tiny button alert']) }}
				{{ Form::close() }}
			</li>
		</ul>