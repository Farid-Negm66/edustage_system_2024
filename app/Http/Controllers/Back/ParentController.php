<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\CrmCategories;
use App\Models\Back\CrmColumnsNames;
use App\Models\Back\CrmColumnsValues;
use App\Models\Back\Parents;
use App\Models\Back\RolesPermissions;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    public function index()
    {
        $pageNameAr = 'أولياء الأمور';
        $pageNameEn = 'parents';
        $crmCategories = CrmCategories::all();  
        $crmNamesEmpty = CrmColumnsNames::orderBy('category', 'asc')
                                        ->orderBy('order', 'asc')
                                        ->get();

        // $crmColumnsNames = CrmColumnsNames::leftJoin('crm_categories', 'crm_categories.id', 'crm_columns_names.category')
        //                                     ->select(
        //                                         'crm_categories.id as crmCategoyId', 
        //                                         'crm_categories.name as crmCategoyName', 

        //                                         'crm_columns_names.id as crmColumn_id', 
        //                                         'crm_columns_names.order as crmColumnOrder', 
        //                                         'crm_columns_names.name_ar as crmColumnName',
        //                                         'crm_columns_names.category as crmColumnCategory', 
        //                                         'crm_columns_names.status as crmColumnStatus', 
        //                                     )
        //                                     ->get();



        return view('back.parents.index' , compact('pageNameAr' , 'pageNameEn', 'crmCategories', 'crmNamesEmpty'));
    }



    public function crm_info($id)
    {
        if (request()->ajax()){
            $parent = Parents::where('ID', $id)->first();
            $crmNames = CrmColumnsNames::orderBy('category', 'asc')
                                        ->orderBy('order', 'asc')
                                        ->leftJoin('crm_columns_values', 'crm_columns_values.column_id', 'crm_columns_names.id')
                                        ->where('crm_columns_values.parent_id', $id)
                                        ->select(
                                            'crm_columns_names.id as crmColumnNameId', 
                                            'crm_columns_names.name_ar as crmColumnName', 
                                            'crm_columns_names.category as crmColumnNameCategory', 
                                            'crm_columns_names.order as crmColumnNameOrder', 

                                            'crm_columns_values.column_id as crmColumnValuesId', 
                                            'crm_columns_values.value as crmColumnValuesValue', 
                                            'crm_columns_values.parent_id as crmColumnValuesParentID', 
                                        )
                                        ->get();

            $crmNamesEmpty = CrmColumnsNames::orderBy('category', 'asc')
                                            ->orderBy('order', 'asc')
                                            ->get();
                                                        
                                            // dd($crmNames);
                            
            // $crmCategories = CrmCategories::all();  

        

            return response()->json([
                'parent' => $parent,
                'crmNames' => $crmNames,
                'crmNamesEmpty' => $crmNamesEmpty,
                // 'crmCategories' => $crmCategories,
            ]);
        }
        return response()->json(['failed' => 'Access Denied']);
    }

    public function crm_info_update(Request $request, $id)
    {
        // dd(request('columnValue'));

        // for($i = 0; $i < count( request('columnValue') ); $i++){
        //     $data[] = [
        //         'parent_id' => request('parent_id'),
        //         'column_id' => ($i+1),
        //         'value' => request('columnValue')[$i],

        //     ];  
        // }

        // CrmColumnsValues::insert($data);



        $columnValue = request('columnValue');
        $parentId = request('parent_id');
        
        for ($i = 0; $i < count($columnValue); $i++) {
            $data = [
                'parent_id' => $parentId,
                'column_id' => ($i + 1),
                'value' => $columnValue[$i],
            ];
        
            CrmColumnsValues::updateOrInsert(
                ['parent_id' => $parentId, 'column_id' => ($i + 1)],
                $data
            );
        }

    }



    public function update(Request $request, $id)
    {
        if (request()->ajax()){
            $find = Parents::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string',
                'email' => 'required|unique:parents,email,'.$id,
                'birth_date' => 'nullable|date' ,
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'nat_id' => 'nullable|min:14|numeric|unique:parents,nat_id,'.$id,    
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
                $path = public_path('back/images/parents');
                $file->move($path , $name);
                
                if(request("image_hidden") != "df_image.png"){
                    File::delete(public_path('back/images/parents/'.$find['image']));
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
        $all = Parents::all();
        return DataTables::of($all)
            ->addColumn('TheStatus', function($res){
                if($res->TheStatus == 'مفعل'){
                    return '<span class="label text-success" style="position: relative;"><div class="dot-label bg-success ml-1" style="position: absolute;right: -17px;top: 7px;"></div>نشط</span>';
                }
                else{
                    return '<span class="label text-danger" style="position: relative;"><div class="dot-label bg-danger ml-1" style="position: absolute;right: -15px;top: 7px;"></div>معطل</span>';
                }
            })
            ->addColumn('action', function($res){
                // if (auth()->user()->role_relation->parents_update == 1 ){
                // }
                return '
                            <button class="btn btn-sm btn-outline-primary crm_info" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="معلومات crm" parent_id="'.$res->ID.'">
                                <i class="fas fa-info-circle"></i>
                            </button>                        
                            
                            <a href="'.url('parents/report/crm_pdf/'.$res->ID).'" class="btn btn-sm btn-outline-dark print" data-effect="effect-scale" data-placement="top" data-toggle="tooltip" title="طباعة crm" parent_id="'.$res->ID.'">
                                <i class="fas fa-print"></i>
                            </a>                        
                        ';
                            // <button class="btn btn-sm btn-outline-success edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="معلومات crm" parent_id="'.$res->ID.'">
                            //     <i class="fa fa-pen"></i>
                            // </button>                        

                            // <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                            //     <i class="fa fa-trash"></i>
                            // </button>


            })
            ->rawColumns(['TheStatus', 'gender', 'action'])
            ->toJson();
    }













    ///////////////////////////////////////////////  reports  ///////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function crm_pdf($id)
    {

        $parentDetails = Parents::where('ID', $id)->first();
        
        $nameAr = 'تقرير بيانات ولي أمر'.' - '.$parentDetails->TheName0;
        
        $studentDetails = DB::table('tbl_students')
                            ->leftJoin('tbl_groups_students', 'tbl_groups_students.StudentID', 'tbl_students.ID')
                            ->leftJoin('tbl_groups', 'tbl_groups.ID', 'tbl_groups_students.GroupID')
                            ->leftJoin('tbl_teachers', 'tbl_teachers.ID', 'tbl_groups_students.TeacherValue')
                            ->select(
                                'tbl_students.TheName as studentName', 'tbl_students.TheEmail as studentEmail', 'tbl_students.TheEduType as eduType', 'tbl_students.TheTestType as testType',
                                'tbl_groups.GroupName as groupName',
                                'tbl_teachers.TheName as teacherName'
                            )
                            ->where('ParentID', $parentDetails->ID)
                            ->get();
        
        $crmCategoriesDetails = DB::table('crm_categories')->get();

        $crmColumnsNamesDetails = DB::table('crm_columns_names')
                                    ->orderBy('category', 'asc')
                                    ->orderBy('order', 'asc')
                                    ->where('status', 1)
                                    ->get();

        $crmColumnsValues = DB::table('crm_columns_values')->where('parent_id', $parentDetails->ID)
                            ->leftJoin('crm_columns_names', 'crm_columns_names.id', 'crm_columns_values.column_id')
                            ->select(
                                'crm_columns_values.column_id as columnId', 'crm_columns_values.value',
                                'crm_columns_names.id as columnNameId', 'crm_columns_names.name_ar as nameAr'
                            )
                            ->get();

        // dd($crmColumnsValues);
        
        return view('back.parents.report_crm.pdf', compact('nameAr', 'parentDetails', 'studentDetails', 'crmCategoriesDetails', 'crmColumnsNamesDetails', 'crmColumnsValues'));
    }

}
