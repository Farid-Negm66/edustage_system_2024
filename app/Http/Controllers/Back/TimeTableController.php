<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Back\TimeTable;
use App\Models\Back\Times;

class TimeTableController extends Controller
{
    
    public function daysClasses($dayAr, $userNum){
        $daysClasses = DB::table('time_tables')
                                ->where('day', $dayAr)
                                ->where('user', $userNum)
                                ->leftJoin('tbl_groups', 'tbl_groups.ID', 'time_tables.group_id')
                                ->leftJoin('tbl_years_mat', 'tbl_years_mat.ID', 'tbl_groups.YearID')
                                ->leftJoin('tbl_rooms', 'tbl_rooms.RoomID', 'time_tables.room_id')      
                                ->leftJoin('tbl_teachers', 'tbl_teachers.ID', 'tbl_groups.TeacherID')      
                                ->select(
                                    'time_tables.*', 
                                    'tbl_groups.GroupName as groupName',
                                    'tbl_years_mat.TheColor as matColor',
                                    'tbl_teachers.TheName as teacherName',
                                    'tbl_rooms.RoomName as roomName',
                                ) 
                                ->orderBy('time_tables.room_id', 'ASC')
                                ->get();

        return $daysClasses;
    }

    public function index()
    {
        $pageNameAr = 'جدول الحصص للمدرسين';
        $pageNameEn = 'time_table';

        $groups = DB::table('tbl_groups')
                            ->leftJoin('tbl_years_mat', 'tbl_years_mat.ID', 'tbl_groups.YearID')      
                            ->leftJoin('tbl_teachers', 'tbl_teachers.ID', 'tbl_groups.TeacherID')      
                            ->select(
                                'tbl_groups.ID as groupId', 
                                'tbl_groups.TeacherID as teacherId', 
                                'tbl_groups.GroupName as groupName',
                                
                                'tbl_years_mat.TheFullName as matName',
                                'tbl_years_mat.TheColor as matColor',

                                'tbl_teachers.TheName as teacherName',
                            )      
                            ->distinct('tbl_groups.YearID')
                            ->orderBy('tbl_teachers.TheName', 'ASC')
                            ->get();

        // dd($groups[0]->matColor);



        $rooms = DB::table('tbl_rooms')
                    ->select('tbl_rooms.RoomID as roomId', 'tbl_rooms.RoomName as roomName')
                    ->orderBy('tbl_rooms.RoomName', 'DESC')
                    ->get();
        
        


        $satClassesUserOne = $this->daysClasses('السبت', 1);
        $satClassesUserTwo = $this->daysClasses('السبت', 2);




                                
                                // dd($satClassesUserOne);
                                
        $times = Times::orderBy('am_pm', 'asc')->orderBy('order', 'asc')->get();


                                // dd($times);




        // $filtered = $satUserOne->filter(function ($item) {
        //     dd($item->day);
        // });
        // dd(collect($satUserOne));

        return view('back.time_table.index' , compact('pageNameAr' , 'pageNameEn', 'groups', 'rooms', 'times', 'satClassesUserOne', 'satClassesUserTwo'));
    }

    public function get_available_times(Request $request)
    {
        $timesToTimeTable = DB::table('time_tables')
                                ->where('day', request('day'))
                                ->where('room_id', request('room_id'))
                                ->where('user', request('user'))
                                ->get();

        $times = Times::orderBy('am_pm', 'asc')->orderBy('order', 'asc')->get();

        return response()->json([
            'timesToTimeTable' => $timesToTimeTable,
            'times' => $times,
        ]);
    }



    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'group_id' => 'required',
                'times' => 'required',
            ],[
                'required' => ':attribute مطلوب.',
            ],[
                'group_id' => 'إختيار المجموعة',
                'times' => 'إختيار وقت واحد ع الأقل',
            ]);
    
            for($i = 0; $i < count(request('times')); $i++){
                $data[] = [
                    'group_id' => request('group_id'),
                    'notes' => request('notes'),
                    'date' => !request()->has('date') ? null : request('date'),
                    'day' => request('day'),
                    'class_type' => request('class_type'),
                    'times' => request('times')[$i],
                    'room_id' => request('room_id'),
                    'user' => request('user'),
                    'group_to_colspan' => 2,
                    'user_add' => 1,
                    'user_edit' => 2,
                    'created_at' => Carbon::now(),
                ];
            }
            
            TimeTable::insert($data);

            
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
