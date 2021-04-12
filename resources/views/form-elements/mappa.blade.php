{{--[
    'label' => 'Label',
    'name' => 'input_name',
    'value' => $form->value,
    'rows' => $rows,
    'cols' => $cols,
    'class' => $class,
    'sublabel' => 'Sub-label'
]--}}
<div class="form-group row"><label for="{{$name}}" class="col-2 col-form-label control-label">{{$label}}@isset($sublabel)<br><span>{{$sublabel}}</span>@endisset</label><div class="col-10"><textarea class="form-control @isset($class){{$class}}@endisset" id="{{$name}}" name="{{$name}}" @isset($rows)rows="{{$rows}}"@endisset @isset($cols)cols="{{$cols}}"@endisset>{{ $value }}</textarea></div></div>
