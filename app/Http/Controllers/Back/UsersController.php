<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\User;
use App\Models\Back\RolesPermissions;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class UsersController extends Controller
{
    public function index()
    {
        $pageNameAr = 'المستخدمين';
        $pageNameEn = 'users';
        // $permissions = RolesPermissions::all();
        return view('back.users.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function store(Request $request)
    {

        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'birth_date' => 'nullable|date' ,
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'nat_id' => 'nullable|min:14|numeric|unique:users,nat_id',    
                'password' => 'required|min:6',
                'confirmed_password' => 'required|min:6|same:password',
                'role' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1500',
            ],[
                'required' => ':attribute مطلوب.',
                'string' => ':attribute غير صحيح.',
                'numeric' => ':attribute غير صحيح.',
                'date' => ':attribute يجب ان يكون تاريخ.',
                'email' => ':attribute البريد الإلكتروني.',
                'unique' => ':attribute مستخدم من قبل.',
                'min' => ':attribute أقل من القيمة المطلوبة.',
                'same' => ':attribute غير مطابقة مع كلمة المرور.',
                'mimes' => ':attribute يجب أن تكون من نوع JPG أو PNG أو JPEG أو GIF.',
                'max' => ':attribute حجمها كبير.',
                // 'numbers' => ':attribute القيمة المطلوبة رقم.',
                // 'symbols' => ':attribute القيمة المطلوبة رموز.',
            ],[
                'name' => 'إسم المستخدم',
                'email' => 'البريد الإلكتروني',
                'birth_date' => 'تاريخ الميلاد',
                'phone' => 'التليفون',
                'role' => 'تراخيص المستخدم',
                'address' => 'العنوان',
                'nat_id' => 'الرقم القومي',
                'password' => 'كلمة المرور',
                'confirmed_password' => 'تأكيد كلمة المرور',         
                'image' => 'الصورة',                
       
            ]);

            if($request->hasFile('image')){
                $file = request('image');
                $name = time() . '.' .$file->getClientOriginalExtension();
                $path = public_path('back/images/users');
                $file->move($path , $name);
            }
            else{
                $name = "df_image.png";
            }



            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $name = time() . '.' .$file->getClientOriginalExtension();
            //     $image_resize = Image::make($file->getRealPath());
            //     $image_resize->resize(300, 300);
            //     $path = public_path('back/images/users');
            //     $image_resize->save(public_path('back/images/users/' . $name));
            // }else{
            //     $name = "df_image.png";
            // }

            
            User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => Hash::make(request('password')),
                'phone' => request('phone'),
                'role' => request('role'),
                'address' => request('address'),
                'nat_id' => request('nat_id'),
                'birth_date' => request('birth_date'),
                'image' => $name,
                'gender' => request('gender'),
                'status' => request('status'),
                'user_status' => 1,
                'last_login_time' => request('last_login_time'),
                'note' => request('note')
            ]);
        }
    }

    public function edit($id)
    {
        if (request()->ajax()){
            $find = User::where('id', $id)->first();
            return response()->json($find);
        }
        return response()->json(['failed' => 'Access Denied']);
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = User::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string',
                'email' => 'required|unique:users,email,'.$id,
                'birth_date' => 'nullable|date' ,
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'nat_id' => 'nullable|min:14|numeric|unique:users,nat_id,'.$id,    
                'password' => 'nullable|min:6',
                'confirmed_password' => 'nullable|min:6|same:password',
                'role' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1500',

                // 'confirmed_password' => [
                //     'required',
                //     'same:password',
                    // Password::min(8)
                    //         ->numbers()
                    //         ->symbols()
                // ],
            ],[
                'required' => ':attribute مطلوب.',
                'string' => ':attribute غير صحيح.',
                'numeric' => ':attribute غير صحيح.',
                'date' => ':attribute يجب ان يكون تاريخ.',
                'email' => ':attribute البريد الإلكتروني.',
                'unique' => ':attribute مستخدم من قبل.',
                'min' => ':attribute أقل من القيمة المطلوبة.',
                'same' => ':attribute غير مطابقة مع كلمة المرور.',
                'mimes' => ':attribute يجب أن تكون من نوع JPG أو PNG أو JPEG أو GIF.',
                'max' => ':attribute حجمها كبير.'
                // 'numbers' => ':attribute القيمة المطلوبة رقم.',
                // 'symbols' => ':attribute القيمة المطلوبة رموز.',
            ],[
                'name' => 'إسم المستخدم',
                'email' => 'البريد الإلكتروني',
                'birth_date' => 'تاريخ الميلاد',
                'phone' => 'التليفون',
                'role' => 'تراخيص المستخدم',
                'address' => 'العنوان',
                'nat_id' => 'الرقم القومي',
                'password' => 'كلمة المرور',
                'confirmed_password' => 'تأكيد كلمة المرور',                
                'image' => 'الصورة',                
            ]);



            if(request('image') == ""){
                $name = request("image_hidden");
            }else{
                $file = request('image');
                $name = time() . '.' .$file->getClientOriginalExtension();
                $path = public_path('back/images/users');
                $file->move($path , $name);
                
                if(request("image_hidden") != "df_image.png"){
                    File::delete(public_path('back/images/users/'.$find['image']));
                }
            }

            $find->update([
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password') == null ? $find['password'] : Hash::make(request('password')),
                'phone' => request('phone'),
                'role' => request('role'),
                'address' => request('address'),
                'nat_id' => request('nat_id'),
                'birth_date' => request('birth_date'),
                'image' => $name,
                'gender' => request('gender'),
                'status' => request('status'),
                'last_login_time' => request('last_login_time'),
                'note' => request('note')
            ]);
        }
    }


    ///////////////////////////////////////////////  datatable  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datatable()
    {
        $all = User::where('user_status', 1)->get();
        return DataTables::of($all)
            ->addColumn('status', function($res){
                if($res->status == 1){
                    return '<span class="label text-success" style="position: relative;"><div class="dot-label bg-success ml-1" style="position: absolute;right: -17px;top: 7px;"></div>نشط</span>';
                }
                else{
                    return '<span class="label text-danger" style="position: relative;"><div class="dot-label bg-danger ml-1" style="position: absolute;right: -15px;top: 7px;"></div>معطل</span>';
                }
            })
            ->addColumn('gender', function($res){
                if($res->gender == 1){
                    return '<span class="badge badge-success" style="width: 40px;">ذكر</span>';
                }
                else{
                    return '<span class="badge badge-danger" style="width: 40px;">أنثي</span>';
                }
            })
            ->addColumn('action', function($res){
                // if (auth()->user()->role_relation->users_update == 1 ){
                // }
                return '
                            <button class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                                <i class="fas fa-marker"></i>
                            </button>                        
                        ';
                // <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                //     <i class="fa fa-trash"></i>
                // </button>

            })
            ->rawColumns(['status', 'gender', 'action'])
            ->toJson();
    }

}
