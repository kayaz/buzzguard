<div class="form-group row">
    {!! Form::label($name, '<div class="text-right">'.$label.' <span class="text-danger d-inline">*</span></div>', ['class' => 'col-2 col-form-label control-label required'], false) !!}
    <div class="col-4">
        @if($selected)
            {!! Form::select($name.'[]', $select, $selected, array('class' => 'form-control', 'multiple')) !!}
        @else
            {!! Form::select($name.'[]', $select, [], array('class' => 'form-control', 'multiple')) !!}
        @endif
        @if($errors->first($name))<div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>@endif
    </div>
</div>
