@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        
        <div class="form-group">
            @if($errors->has())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </div>
        {!!Form::open(array('url' => '/store','files' => true))!!}

        <div class="form-group">
            {!!Form::label('name',' Room name:')!!}
            {!!Form::text('name',null,['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('image','Image:')!!}
            {!!Form::file('image',null,['class' => 'form-control'])!!}
        </div>
        <div class="form-group visibility_block">
            {!!Form::label('visibility',' Visibility:')!!}
            <select class='form-control' id='visibility' name="visibility">
                     <option value="1" selected>For All</option>
                     <option value="2">For Users</option>
            </select>
        </div>
        <div class="form-group">
            {!!Form::label('private',' Private:')!!}
            <select class='form-control' id='private' name="private">
                     <option value="0" selected>Public</option>
                     <option value="1">Private</option>
            </select>
        </div>
        <div class="form-group">
            {!!Form::button('Create',['type' => 'submit','class' => 'btn btn-primary'])!!}
        </div>
    </div>
</div>
<script>
$("#private").on("change",function(){
    if($(this).val() == 1){
        $('.visibility_block').hide()
    }else{
        $('.visibility_block').show()
    }
})
</script>
{!!Form::close()!!}
@endsection

