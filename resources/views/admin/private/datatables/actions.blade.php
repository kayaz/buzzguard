<div class="text-right">
    <a href="" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pokaz wpis"><i class="fe-eye"></i></a>
    <a href="{{ route('admin.project.private.post.edit', [$row->project_id, $row->id]) }}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edytuj"><i class="fe-edit"></i></a>
    <form method="POST" action="{{ route('admin.project.private.post.destroy', $row->id) }}" class="d-inline-flex">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn action-button confirmForm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $row->id }}"><i class="fe-trash-2"></i></button>
    </form>
</div>
