<div class="form-group row">
    @isset($required)
        {!! Form::label($name, '<div class="text-right">'.$label.' <span class="text-danger d-inline">*</span></div>', ['class' => 'col-2 col-form-label control-label required'], false) !!}
    @else
        {!! Form::label($name, '<div class="text-right">'.$label.'</div>', ['class' => 'col-2 col-form-label control-label required'], false) !!}
    @endisset
    <div class="col-4">
        @isset($value)
            {!! Form::text($name, old($name, $value), ['class' => 'form-control']) !!}
        @else
            {!! Form::text($name, null, ['class' => 'form-control']) !!}
        @endisset
        @if($errors->first($name))<div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>@endif
    </div>
</div>
