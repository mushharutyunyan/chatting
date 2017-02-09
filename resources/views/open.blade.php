@extends('layouts.app')

@section('content')
<style type="text/css">
    #messages{
        border: 1px solid black;
        height: 300px;
        margin-bottom: 8px;
        overflow: scroll;
        padding: 5px;
    }
</style>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{Request::segment(2)}}</div>
                <div class="panel-body">
 
                <div class="row">
                    <div class="col-lg-8" >
                        <div id="messages" >
                                @foreach($messages as $message)
                                <strong>{{$message->user->name}}:</strong><p>{{$message->message}} <em>({{$message->created_at}})</em></p></li>
                                @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4" >
                        <ul class="list-group">
                            @foreach($online as $on)
                            <li class="list-group-item" style="background-color:greenyellow">{{$on->user->name}} <em>(last update ({{$on->updated_at}}))</em></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-8" >
                            <form action="sendmessage" method="POST">
                                @if (!Auth::guest())
                                <input type="hidden" name="is_user" value="1" >
                                @else
                                <input type="hidden" name="is_user" value="0" >
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" name="room_id" value="{{$room_id}}" >
                                <textarea class="form-control msg"></textarea>
                                <br/>
                                <input type="button" value="Send" class="btn btn-success send-msg">
                            </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   setInterval(function(){
        var room_id = $("input[name='room_id']").val();
        var token = $("input[name='_token']").val();
       $.ajax({
            type: "POST",
            url: '{!! URL::to("getmessage") !!}',
            dataType: "json",
            data: {'_token':token,'room_id':room_id},
            success:function(data){
                var i = 0
                $.each(data,function(key,value){
                    if(i == 0){
                        $( "#messages" ).html( "<strong>"+value.user.name+":</strong><p>"+value.message+" <em>("+value.created_at+")</em></p>" );
                    }else{
                        $( "#messages" ).append( "<strong>"+value.user.name+":</strong><p>"+value.message+" <em>("+value.created_at+")</em></p>" );
                    }
                    i++
                })
            }
        }); 
   }, 3000);
    $(".send-msg").click(function(e){
        e.preventDefault();
        var token = $("input[name='_token']").val();
        var room_id = $("input[name='room_id']").val();
        var msg = $(".msg").val();
        if(msg != ''){
            $.ajax({
                type: "POST",
                url: '{!! URL::to("sendmessage") !!}',
                dataType: "json",
                data: {'_token':token,'message':msg,'room_id':room_id},
                success:function(data){
                    $(".msg").val('');
                    @if (!Auth::guest())
                        $( "#messages" ).append( "<strong>{{Auth::user()->name}}:</strong><p>"+msg+"</p>" );
                    @else
                        $( "#messages" ).append( "<strong>{{Request::ip()}}:</strong><p>"+msg+"</p>" );
                    @endif
                }
            });
        }else{
            alert("Please Add Message.");
        }
    })
</script>
@endsection
