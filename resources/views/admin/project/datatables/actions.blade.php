<div class="text-right">
    <div class="dropdown float-right">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $row->id }}" data-bs-toggle="dropdown" aria-expanded="false"></button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $row->id }}">
            <li><button type="button" class="btn action-button show-modal" data-id="{{ $row->id }}"><i class="fe-eye"></i></button></li>
            @if($row->user_id == Auth::id() || auth()->user()->hasRole('Administrator'))
                <li><a href="{{ route('admin.project.post.edit', [$row->project_id, $row->id]) }}" class="btn action-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edytuj"><i class="fe-edit"></i></a></li>
            @endif
            @role('Administrator')
            <li><a href="{{ route('admin.project.post.move', [$row->project_id, $row->id]) }}" class="btn action-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Przenieś wpis"><i class="fe-repeat"></i></a></li>
            <li><a href="#" class="btn action-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Oznacz wpis"><i class="fe-star"></i></a></li>
            @endrole
            <li><form method="POST" action="{{ route('admin.project.post.destroy', $row->id) }}" class="d-inline-flex">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn action-button confirmForm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $row->id }}"><i class="fe-trash-2"></i></button>
            </form></li>
        </ul>
    </div>
</div>
