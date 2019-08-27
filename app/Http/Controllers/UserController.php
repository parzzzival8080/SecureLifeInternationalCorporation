<?php

namespace App\Http\Controllers;

use App\Genealogy;
use App\Http\Controllers\Bronze\BronzeController;
use ErrorException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationsController;
use App\Informations;
use App\Keys;
use App\Roles;
use App\Sponsorships;
use App\TemporaryGenea;
use App\User;
use App\UserAccountStatus;
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
        try {
            $user = User::where(\DB::raw('substr(code, 1, 3)'), '=', 'SLD')->get()->last()->code;
            $code = str_pad(substr($user, 4) +1,5,0,STR_PAD_LEFT);
            $code = 'SLD-'.$code;
        } catch (ErrorException $exception) {
            $code = 'SLD-00001';
        }
        $request['code']=$code;
        //check if sponsor is valid
        $sponsor= User::where('code', '=', $request['sponsor'])->get();

        //if sponsor is valid
        if (!$sponsor->isEmpty()){

            //encrypt password
            $request['name']=strtoupper($request['name']);
            $request['type']='diamond';
            $request['password'] = bcrypt($request['password']);
            $request['role_id']=Roles::where('name', '=', 'user')->value('id');
            
            //save in User database
            $user = User::create($request->all());

            //save in Information database
            $request['user_id']=$user->id;
            $request['firstname']=strtoupper($request['firstname']);
            $request['lastname']=strtoupper($request['lastname']);
            $request['mi']=strtoupper($request['mi']);
            $info = Informations::create($request->all());

            //save in Sponsorships database
            foreach($sponsor as $sponsor)
            {
                Sponsorships::create([
                    'user_id'=>$user->id,
                    'sponsor_id'=>$sponsor->id
                ]);
            }
            
            //for return
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $success['type'] = 'user';
            $success['photo'] = $info->photo;
            $success['code'] = $user->code;
            $success['status'] = $user->status;

            //get all admin to notify
        $adminsID = User::select('id')->where('role_id', '=', Roles::where('name', '=', 'admin')->value('id'))->get();

            foreach($adminsID as $thisAdmin)
            {
                $data = ['UserCreatedID'=>$success['id'] ,'UserCreatedName'=>$success['name']]; //fill data array
                $notif = ['type'=>'UserRegistered', 'user_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
                $notifcontroller= new NotificationsController; //initialize NotificationsController
                $notifcontroller->store($notif); //call store function of NotificationsController
            }
            
            return response()->json(['success' => $success]);
        }

        //if sponsor is SECUREDREAM123456, default admin
        else if (strtoupper($request['sponsor'])=='SECUREDREAM123456'){
            $request['password'] = bcrypt($request['password']); //encrypt password
            
            $request['name']=strtoupper($request['name']);
            $request['role_id']=Roles::where('name', '=', 'admin')->value('id');
            $request['code']='securelife';
            $request['status']='Active';
            $request['type']='none';

            $user = User::create($request->all());
            
            //save in Information database
            $request['user_id']=$user->id;
            $request['firstname']=strtoupper($request['firstname']);
            $request['lastname']=strtoupper($request['lastname']);
            $request['mi']=strtoupper($request['mi']);
            $request['sponsor'] = 'securelife';
            $info=Informations::create($request->all());
            
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $success['type'] = 'admin';
            $success['photo'] = $info->photo;
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
        //code generator
        try {
            $user = User::where(\DB::raw('substr(code, 1, 3)'), '=', 'SLB')->get()->last()->code;
            $request['code'] = str_pad(substr($user, 4) +1,5,0,STR_PAD_LEFT);
            $request['code'] = 'SLB-'.$request['code'];
        } catch (ErrorException $exception) {
            $request['code'] = 'SLB-00001';
        }
        
        //check if sponsor is valid
        $sponsor= User::where('code', '=', $request['sponsor'])->get();

        //if sponsor is valid
        if ($sponsor->isEmpty()){
            return response()->json(['error' => 'Incorrect Sponsor ID']);
        }
        
        $request['referal_id'] = User::where('code', '=', $request['sponsor'])->value('id');
        $request['reference_id'] = User::where('code', '=', $request['placement'])->value('id');
        $request['name']=strtoupper($request['name']);
        $request['firstname']=strtoupper($request['firstname']);
        $request['lastname']=strtoupper($request['lastname']);
        $request['mi']=strtoupper($request['mi']);
        $request['type']='bronze';
        $request['password'] = bcrypt($request['password']);
        $request['role_id']=Roles::where('name', '=', 'user')->value('id');

        //check genea
        $referal_genea = Genealogy::where('user_id', $request->referal_id)->get()->first();
        $reference_genea = Genealogy::where('user_id', $request->reference_id)->get()->first();
        $bonzecontroller = new BronzeController;
        $reference_genea_upstreams = $bonzecontroller->retrieve_upstream_genea($reference_genea);
        array_push($reference_genea_upstreams, $reference_genea);

        if(!in_array($referal_genea, $reference_genea_upstreams)) {
            return response()->json(['error' => 'Cross-Lining is not allowed!']);
        }

        if (Genealogy::where('user_id', '=', $request['referal_id'])->get()->isEmpty())
        {
            return response()->json(['error' => 'Incorrect Placement ID']);
        }

        if (!Genealogy::where('reference_id', '=', $request['reference_id'])->where('position', '=', $request['position'])->get()->isEmpty())
        {
            return response()->json(['error' => 'Position is taken']);
        }

        //save in User database
        $user = User::create($request->all());

        //save in Information database
        $request['user_id']=$user->id;
        $info = Informations::create($request->all());

        //save in Sponsorships database
        foreach($sponsor as $sponsor)
        {
            Sponsorships::create([
                'user_id'=>$user->id,
                'sponsor_id'=>$sponsor->id
            ]);
        }

        TemporaryGenea::create($request->all());

        //for return
        $success['name'] = $user->name;
        $success['id'] = $user->id;
        $success['type'] = 'user';
        $success['photo'] = $info->photo;
        $success['code'] = $user->code;
        $success['status'] = $user->status;
        $success['reference_id'] = $request['reference_id'];
        $success['referal_id'] = $request['referal_id'];
        $success['position'] = $request['position'];

        //get all admin to notify
        $adminsID = User::select('id')->where('type', '=', 'admin')->get();

        foreach($adminsID as $thisAdmin)
        {
            $data = ['UserCreatedID'=>$success['id'] ,'UserCreatedName'=>$success['name']]; //fill data array
            $notif = ['type'=>'UserRegistered', 'user_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
            $notifcontroller= new NotificationsController; //initialize NotificationsController
            $notifcontroller->store($notif); //call store function of NotificationsController
        }
        
        return response()->json(['success' => $success]);
    }

    public function login()
    {
        $user = User::where('username', '=', request('username'))->get();
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
                $success['type'] = Roles::where('id', '=', Auth::user()->role_id)->value('name');
                $success['photo'] = Informations::where('user_id', '=', Auth::user()->id)->value('photo');
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
                $success['type'] = Roles::where('id', '=', Auth::user()->role_id)->value('name');
                $success['photo'] = Informations::where('user_id', '=', Auth::user()->id)->value('photo');
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

    public function registerActivateBronze (Request $request)
    {
        //code generator
        try {
            $user = User::where(\DB::raw('substr(code, 1, 3)'), '=', 'SLB')->get()->last()->code;
            $request['code'] = str_pad(substr($user, 4) +1,5,0,STR_PAD_LEFT);
            $request['code'] = 'SLB-'.$request['code'];
        } catch (ErrorException $exception) {
            $request['code'] = 'SLB-00001';
        }
        
        //check if sponsor is valid
        $sponsor= User::where('code', '=', $request['sponsor'])->get();

        //if sponsor is valid
        if ($sponsor->isEmpty()){
            return response()->json(['error' => 'Incorrect Sponsor ID']);
        }
        
        $request['referal_id'] = User::where('code', '=', $request['sponsor'])->value('id');
        $request['reference_id'] = User::where('code', '=', $request['placement'])->value('id');
        $request['name']=strtoupper($request['name']);
        $request['firstname']=strtoupper($request['firstname']);
        $request['lastname']=strtoupper($request['lastname']);
        $request['mi']=strtoupper($request['mi']);
        $request['type']='bronze';
        $request['password'] = bcrypt($request['password']);
        $request['role_id']=Roles::where('name', '=', 'user')->value('id');

        //check genea
        $referal_genea = Genealogy::where('user_id', $request->referal_id)->get()->first();
        $reference_genea = Genealogy::where('user_id', $request->reference_id)->get()->first();
        $bonzecontroller = new BronzeController;
        $reference_genea_upstreams = $bonzecontroller->retrieve_upstream_genea($reference_genea);
        array_push($reference_genea_upstreams, $reference_genea);

        if(!in_array($referal_genea, $reference_genea_upstreams)) {
            return response()->json(['error' => 'Cross-Lining is not allowed!']);
        }

        if (Genealogy::where('user_id', '=', $request['referal_id'])->get()->isEmpty())
        {
            return response()->json(['error' => 'Incorrect Placement ID']);
        }

        if (!Genealogy::where('reference_id', '=', $request['reference_id'])->where('position', '=', $request['position'])->get()->isEmpty())
        {
            return response()->json(['error' => 'Position is taken']);
        }

        $keys= Keys::where('key', '=', $request['activationcode'])
        ->where('pin', '=', $request['pin'])
        ->where('status', '=', 'Inactive')
        ->where('user_id', '=', User::where('role_id', '=', '1')->value('id'))
        ->get();
        if ($keys->isEmpty()){
            return response()->json(['error' => 'Invalid Key']);
        }
        foreach ($keys as $keys)
        {
            $keys->update(['status'=>'Active']);
        }
        //save in User database
        $user = User::create($request->all());

        //save in Information database
        $request['user_id']=$user->id;
        Informations::create($request->all());

        //save in Sponsorships database
        foreach($sponsor as $sponsor)
        {
            Sponsorships::create([
                'user_id'=>$user->id,
                'sponsor_id'=>$sponsor->id
            ]);
        }
           
        $status = '';
        if (substr($request['activationcode'], 0, 4) == 'SLCD')
        {
            $status = 'cd';
        }
        else
        {
            $status = 'active';
        }

        UserAccountStatus::create([
            'user_id'=>$user->id,
            'status'=>$status,
        ]);

        $geneaController = new BronzeController;
        $geneaController->create_genealogy($request);

        //get all admin to notify
        $adminsID = User::select('id')->where('type', '=', 'admin')->get();

        foreach($adminsID as $thisAdmin)
        {
            $data = ['UserCreatedID'=>$user->id ,'UserCreatedName'=>$user->name]; //fill data array
            $notif = ['type'=>'UserRegistered', 'user_id' => $thisAdmin->id, 'data'=> json_encode($data)]; //fill notif array
            $notifcontroller= new NotificationsController; //initialize NotificationsController
            $notifcontroller->store($notif); //call store function of NotificationsController
        }
        
        return response()->json(['success' => 'Successfully added user!']);
    }
}
