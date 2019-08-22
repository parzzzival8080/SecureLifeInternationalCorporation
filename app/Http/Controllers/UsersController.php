<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotifController;

use App\User;

use Cloudder;

class UserController extends Controller
{
    
    public function index()
    {
        $user = User::all();
        return response()->json(['users'=>$user]);
    }

    //add user in UserList
    public function store(Request $request)
    {

        $request['password'] = bcrypt($request['password']);

        $user = User::create($request->all());
        return $user;
    }

    public function registerDiamond(Request $request)
    {
        $str = '';
        $user = User::where(\DB::raw('substr(code, 1, 3)'), '=', 'SLD')->latest()->value('code');
        
        $str = $user;
        if ($user = '')
        {
            $code = 'SLD-00001';
        }
        else
        {
            $code = str_pad(substr($str, 4) +1,5,0,STR_PAD_LEFT);
            $code = 'SLD-'.$code;
        }
        $request['code']=$code;
        //check if sponsor is valid
        $sponsor= User::where('code', '=', $request['sponsor'])->get();

        //if sponsor is valid
        if (!$sponsor->isEmpty()){

            //encrypt password
            $request['name']=strtoupper($request['name']);
            $request['firstname']=strtoupper($request['firstname']);
            $request['lastname']=strtoupper($request['lastname']);
            $request['mi']=strtoupper($request['mi']);
            $request['account_type']='diamond';
            $request['password'] = bcrypt($request['password']);
            
            //save in database
            $user = User::create($request->all());

            //for return
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $success['type'] = $user->type;
            $success['photo'] = $user->photo;
            $success['code'] = $user->code;
            $success['status'] = $user->status;

            //get all admin to notify
            $adminsID = User::select('id')->where('type', '=', 'admin')->get();

            foreach($adminsID as $thisAdmin)
            {
                $data = ['UserCreatedID'=>$success['id'] ,'UserCreatedName'=>$success['name']]; //fill data array
                $notif = ['type'=>'UserRegistered', 'notifiable_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
                $notifcontroller= new NotifController; //initialize NotifController
                $notifcontroller->store($notif); //call store function of NotifController
            }
            
            return response()->json(['success' => $success]);
        }

        //if sponsor is SL123456, default admin
        else if (strtoupper($request['sponsor'])=='SECUREDREAM123456'){
            $request['password'] = bcrypt($request['password']); //encrypt password
            
            $request['name']=strtoupper($request['name']);
            $request['firstname']=strtoupper($request['firstname']);
            $request['lastname']=strtoupper($request['lastname']);
            $request['mi']=strtoupper($request['mi']);
            $request['type']='admin';
            $request['code']='securelife';
            $request['status']='Active';
            $request['sponsor'] = 'securelife';
            $request['account_type']='none';

            $user = User::create($request->all());
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $success['type'] = $user->type;
            $success['photo'] = $user->photo;
            $success['code'] = $user->code;
            $success['status'] = $user->status;

            return response()->json(['success' => $success]);
        }
        else{
            return response()->json(['error' => 'Incorrect Sponsor ID']);
        }
    }

    public function registerBronze(Request $request)
    {
        $str = '';
        $user = User::where(\DB::raw('substr(code, 1, 3)'), '=', 'SLB')->latest()->value('code');
        
        $str = $user;
        if ($user = '')
        {
            $code = 'SLB-00001';
        }
        else
        {
            $code = str_pad(substr($str, 4) +1,5,0,STR_PAD_LEFT);
            $code = 'SLB-'.$code;
        }
        $request['code']=$code;
        //check if sponsor is valid
        $sponsor= User::where('code', '=', $request['sponsor'])->get();

        //if sponsor is valid
        if (!$sponsor->isEmpty()){

            //encrypt password
            $request['name']=strtoupper($request['name']);
            $request['firstname']=strtoupper($request['firstname']);
            $request['lastname']=strtoupper($request['lastname']);
            $request['mi']=strtoupper($request['mi']);
            $request['account_type']='bronze';
            $request['password'] = bcrypt($request['password']);
            
            //save in database
            $user = User::create($request->all());

            //for return
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $success['type'] = $user->type;
            $success['photo'] = $user->photo;
            $success['code'] = $user->code;
            $success['status'] = $user->status;

            //get all admin to notify
            $adminsID = User::select('id')->where('type', '=', 'admin')->get();

            foreach($adminsID as $thisAdmin)
            {
                $data = ['UserCreatedID'=>$success['id'] ,'UserCreatedName'=>$success['name']]; //fill data array
                $notif = ['type'=>'UserRegistered', 'notifiable_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
                $notifcontroller= new NotifController; //initialize NotifController
                $notifcontroller->store($notif); //call store function of NotifController
            }
            
            return response()->json(['success' => $success]);
        }
        else{
            return response()->json(['error' => 'Incorrect Sponsor ID']);
        }
    }

    public function login()
    {
        $user = User::where('username', '=', request('username'))->get();
        $code = User::where('code', '=', request('username'))->get();
        $email = User::where('email', '=', request('username'))->get();
        //check if credentials are valid
        if (!$user->isEmpty()) {
            
            $credentials = [
                'username' => request('username'), 
                'password' => request('password')
            ];
            
            //check if credentials are valid
            if (Auth::attempt($credentials)) {
                Auth::login($credentials);
                $success['name'] = Auth::user()->name;
                $success['id'] = Auth::user()->id;
                $success['type'] = Auth::user()->type;
                $success['photo'] = Auth::user()->photo;
                $success['code'] = Auth::user()->code;
                $success['status'] = Auth::user()->status;
                // $success['token'] = Auth::user()->createToken('MyApp')->accessToken; //keep this for sample
                
                return response()->json(['success' => $success]);
            }
        }
        else if (!$email->isEmpty()) {
                
            $credentials = [
                'email' => request('username'), 
                'password' => request('password')
            ];
            
            //check if credentials are valid
            if (Auth::attempt($credentials)) {
                $success['name'] = Auth::user()->name;
                $success['id'] = Auth::user()->id;
                $success['type'] = Auth::user()->type;
                $success['photo'] = Auth::user()->photo;
                $success['code'] = Auth::user()->code;
                $success['status'] = Auth::user()->status;
                // $success['token'] = Auth::user()->createToken('MyApp')->accessToken; //keep this for sample
                
                return response()->json(['success' => $success]);
            }
        }
        else
        {
            return response()->json(['error' => 'Unauthorised']);
        }
    }
     
    public function show($id)
    {
        //
        
    }

    public function update(Request $request, $id)
    {
        //find user
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$user->id],
        ]);
        if($request['password'] <> ''){
            $this->validate($request,[
                'password' => ['required', 'string', 'min:6'],
            ]);
            $request['password'] = Hash::make($request['password']);
        }
        if($request['nopic']==false){
            Cloudder::upload($request['photo'], null, ['folder'=>'SecureLife/profile_pictures_test/']);
            $request['photo'] = Cloudder::show(Cloudder::getPublicId());
        }
        $user->update($request->all());
        return ['message' => 'Updated user','path'=> $request['photo']];
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return ['message' => 'User Deleted'];
    }
    
    public function profile(Request $request)
    {
        return User::where('id', '=', $request['id'])->get();
    }
}
