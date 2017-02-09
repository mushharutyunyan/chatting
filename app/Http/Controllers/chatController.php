<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\Models\Room;
use App\Models\Chat;
use App\Models\User;
use App\Models\Active;
use Auth;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Http\Requests\RoomRequest;
class chatController extends Controller {
	
    public function index(){
        if (!Auth::guest()){
            $rooms = Room::All();
            Active::where('user_id','=',Auth::user()->id)->update(array('active'=>false));
        }else{
            $rooms = Room::where('visibility','=',1)->get();
        }
        foreach($rooms as $key => $room){
            if($room['private'] == 1){
                $check_private_active_user = Active::where('room_id','=',$room->id)->where('user_id','=',Auth::user()->id)->count();
                if(!$check_private_active_user){
                    $rooms[$key]['private_active'] = false;
                }else{
                    $rooms[$key]['private_active'] = true;
                }
            }else{
                $rooms[$key]['private_active'] = true;
            }
        }
      
        return view('rooms', compact('rooms'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        Active::where('user_id','=',Auth::user()->id)->update(array('active'=>false));
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RoomRequest $request)
    {
        $destinationPath = "assets/images";
        $data = Request::all();
        if($data['private'] == 1){
            $key = $this->generateRandomString(60);
            $data['visibility'] = 2;
            $data['private_key'] = $key;
        }
        $file = Request::file('image');
        $fileName = md5(time()).$file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $data['image'] = $fileName;
        $create = Room::create($data);
        return Redirect::to('/rooms');
        
    }
    public function open($room){
        
        $room = Room::where('name',"=",$room)->firstOrFail();
        $online = Active::where('room_id','=',$room->id)->where('active','=',true)->get();
        if (!Auth::guest()){
            $check_active_row = Active::where('room_id','=',$room->id)->where('user_id','=',Auth::user()->id)->count();
            if(!$check_active_row){
                Active::create(array('room_id' => $room->id,
                                     'user_id' => Auth::user()->id,
                                     'active' => true));
            }else{
                Active::where('user_id','=',Auth::user()->id)->update(array('active'=>false));
                Active::where('room_id','=',$room->id)->where('user_id','=',Auth::user()->id)->update(array('active' => true));
            }
        }
        $messages = Chat::where('room_id','=',$room->id)->get();
        return view('open',['messages' => $messages,'room_id' => $room->id, 'online' => $online]);
    }
    public function sendMessage(){
        if (!Auth::guest()){
            $user_id = Auth::user()->id;
        }else{
            $check_guest_user = User::where('name','=',Request::ip())->count();
            if(!$check_guest_user){
                $create_guest_user = User::create(array('name' => Request::ip()));
                $user_id = $create_guest_user->id;
            }else{
                $guest_user = User::where('name','=',Request::ip())->firstOrFail();
                $user_id = $guest_user->id;
            }
        }
        $data = ['message' => Request::input('message'), 'user_id' => $user_id,'room_id' => Request::input('room_id')];
        Chat::create($data);
        return response()->json([]);
    }
    public function getMessages(Request $request){
        $data = Request::all();
        $messages = Chat::where('room_id','=',$data["room_id"])->get();
        foreach($messages as $message){
            $message['name'] = $message->user->name;
        }
        return response()->json($messages);
    }
    public function activate($key){
        $room = Room::where('private_key','=',$key)->firstOrFail();
        Active::create(array('room_id' => $room->id,
                             'user_id' => Auth::user()->id,
                             'active' => false));
        echo "<script>window.location.replace('/rooms')</script>";
    }
    public  function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}