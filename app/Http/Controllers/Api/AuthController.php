<?php

namespace App\Http\Controllers\Api;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\ProviderImage;
    use App\Models\Notification;
    use App\Models\Package;
    use Validator;
    use Image;
class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'mobile'    => ['required', 'unique:users'],
            'address'   => ['required'],
        ]);
        if($request->type == 'provider'){
            $validator = Validator::make($request->all(), [
                'name'      => ['required', 'string', 'max:255'],
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  => ['required', 'string', 'min:8', 'confirmed'],
                'mobile'    => ['required', 'unique:users'],
                'address'   => ['required'],
                'address'   => ['required'],
                'front_ID_photo'          => ['required'],
                'back_ID_photo'           => ['required'],
                'back_craft_card_photo'   => ['required'],
                'front_craft_card_photo'  => ['required'],
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
        }

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if ($request['image'] == NUll){
            $data['image'] = 'images/avatar.jpg';
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];            
           $data['image'] =  $name;
        }
        $package = Package::where('id',$request->package_id)->first();
        $user =  User::create([
            'name'                   => $request['name'],
            'email'                  => $request['email'],
            'mobile'                 => $request['mobile'],
            'password'               => Hash::make($request['password']),
            'status'                 => '0',
            'type'                   => $request->type,
            'address'                => $request->address,
            'lan'                    => $request->lan,
            'lat'                    => $request->lat,
            'cr_number'              => $request->cr_number,
            'experience_certificate' => $request->experience_certificate,
            'business_license'       => $request->business_license,
            'bank_account_number'    => $request->bank_account_number,
            'company_link'           => $request->company_link,
            'package_id'             => $request->package_id,
            'image'                  => $data['image'],
            'rest_of_package'        => $package->price
        ]);
        if($user->type == 'provider'){

            if($request->file('front_ID_photo')){
                $image=$request->file('front_ID_photo');
                $input['front_ID_photo'] = $image->getClientOriginalName();
                $path = 'images/user/';
                $destinationPath = 'images/user';
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.time().$input['front_ID_photo']);
                $name = $path.time().$input['front_ID_photo'];
                
               $data['front_ID_photo'] =  $name;
            }
            if($request->file('back_ID_photo')){
                $image=$request->file('back_ID_photo');
                $input['back_ID_photo'] = $image->getClientOriginalName();
                $path = 'images/user/';
                $destinationPath = 'images/user';
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.time().$input['back_ID_photo']);
                $name = $path.time().$input['back_ID_photo'];
                
               $data['back_ID_photo'] =  $name;
            }
            if($request->file('back_craft_card_photo')){
                $image=$request->file('back_craft_card_photo');
                $input['back_craft_card_photo'] = $image->getClientOriginalName();
                $path = 'images/user/';
                $destinationPath = 'images/user';
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.time().$input['back_craft_card_photo']);
                $name = $path.time().$input['back_craft_card_photo'];
                
               $data['back_craft_card_photo'] =  $name;
            }
            if($request->file('front_craft_card_photo')){
                $image=$request->file('front_craft_card_photo');
                $input['front_craft_card_photo'] = $image->getClientOriginalName();
                $path = 'images/user/';
                $destinationPath = 'images/user';
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.time().$input['front_craft_card_photo']);
                $name = $path.time().$input['front_craft_card_photo'];
                
               $data['front_craft_card_photo'] =  $name;
            }
            ProviderImage::insert( [
                'front_ID_photo'        =>  $data['front_ID_photo'],
                'back_ID_photo'         =>  $data['back_ID_photo'],
                'back_craft_card_photo' =>  $data['back_craft_card_photo'],
                'front_craft_card_photo'=>  $data['front_craft_card_photo'],
                'provider_id'=> $user->id
            ]);

            $data = [
                'notification' => "طلب ($user->name) التسجيل كمزود خدمة ",
                'user_id'      => $user->id,
                'lan'          => '1',
                'status'       => '0',
            ];
            $notification_ar = Notification::create($data);
            $data = [
                'notification' => "Request ($user->name) to register as a service provider",
                'user_id'      => $user->id,
                'lan'          => '2',
                'status'       => '0',
                'ar_id'        => $notification_ar->id
            ];
            Notification::create($data);
        }
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 200);

    }
    
    public function login(Request $request){
        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 20,
            'user' => auth('api')->user()
        ]);
    }  

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'logout successfully']);
    }

}
