<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', $item->product, ['class' => 'form-control', 'placeholder' => 'Product Name', 'readonly'=>'readonly']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif


</div>


<div class="form-group @if ($errors->has('qty')) has-error @endif">

    {!! Form::label('qty', 'Quantity') !!}
    {!! Form::selectRange('qty', 1, $item->qty,1, ['class' => 'form-control']) !!}
    @if ($errors->has('qty')) <p
            class="help-block">{{ $errors->first('qty') }}</p> @endif

</div>

<div class="form-group @if ($errors->has('description')) has-error @endif">

    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('name', null, ['class' => 'form-control', 'placeholder' => 'Description','size' => '30x5']) !!}
    @if ($errors->has('description')) <p
            class="help-block">{{ $errors->first('description') }}</p> @endif

</div>

<input type="hidden" name="store_id" value="{{$item->id}}">