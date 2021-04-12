{{--[
    'label' => 'Label',
    'name' => 'input_name',
    'required' => null / 1,
    'value' => $form->value,
    'sublabel' => 'Sub-label'
]--}}
<div class="form-group row">
    <label for="form_{{ $name }}" class="col-2 col-form-label control-label"><div class="text-right">{!! $label !!}@isset($required) <span class="text-danger d-inline">*</span>@endisset @isset($sublabel)<br><span>{!! $sublabel !!}</span>@endisset</div></label>
    <div class="col-4">
        <input id="form_{{ $name }}" value="{{ old($name, $value) }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" type="text"@isset($required) required @endisset>
        @if($errors->first($name))<div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>@endif
    </div>
</div>
