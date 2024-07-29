
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        .flatpickr-am-pm{
            display: none !important;
        }
        .ajs-error{
            width: 320px !important;
        }
    </style>
@endsection

@section('footer')
    <script>
        flatpickr(".datePicker", {
        });
    </script>

    <script>     
        // selectize
        $('.selectize').selectize();

        // open modal when click button (insert)
        document.addEventListener('keydown', function(event){
            if( event.which === 45 ){
                $('.modal').modal('show');
                document.querySelector('.modal .modal-header .modal-title').innerText = 'إضافة';
                document.querySelector('.modal .modal-footer #save').setAttribute('style', 'display: inline;');
                document.querySelector('.modal .modal-footer #update').setAttribute('style', 'display: none;');
                $('.dataInput').val('');
            }
        });

        

        // remove all errors and inputs data when close modal
        $('.modal').on('hidden.bs.modal', function(){
            $('form [id^=errors]').text('');
            $(this).find("input").not("[name='_token']").val('');
        });
        


        // cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });
        
        // $(document).ready(function () {
        //     $('#example1').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: `{{ url('/students_rates/datatable') }}`,
        //         dataType: 'json',
        //         columns: [
        //             {data: 'time', name: 'time'},
        //             {data: 'order', name: 'order'},
        //             {data: 'action', name: 'action', orderable: false},
        //         ],
        //         "bDestroy": true,
        //         language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
        //         lengthMenu: [[50, 100, -1], [50, 100, "الكل"]]
        //     });
        // });
    </script>


    <script>
        const fromtDate = document.querySelector('#fromDate');
        const toDate = document.querySelector('#toDate');
        const teacher = document.querySelector('#teacher');
        const table = document.querySelector('#table');
        const searchBtn = document.querySelector('#groups_to_teacher #search');

        fromtDate.addEventListener('input', function(){
            table.style.display = 'none';
        });

        searchBtn.addEventListener('click', function(){           
            if(fromtDate.value == '' || toDate.value == '' || teacher.value == ''){
                alertify.set('notifier','position', 'bottom-center');
                alertify.set('notifier','delay', 4);
                alertify.error("يجب إختيار قيمة لجميع العناصر الموجودة");
            }else{
                $.ajax({
                    url: `{{ url($pageNameEn) }}/get_groups_by_teacher_date/${fromtDate.value}/${toDate.value}/${teacher}`,
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    beforeSend:function () {
                        $('form [id^=errors]').text('');
                    },
                    error: function(res){
                        $.each(res.responseJSON.errors, function (index , value) {
                            $(`form #errors-${index}`).css('display' , 'block').text(value);
                        });               
                        
                        $('.dataInput:first').select().focus();
                        document.querySelector('.modal #save').disabled = false;
                        document.querySelector('.spinner_request').style.display = 'none';                
    
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.error("هناك شيئ ما خطأ");
                    },
                    success: function(res){
                        alert(res);
    
    
    
                        $('#example1').DataTable().ajax.reload( null, false );
                        $(".modal form bold[class=text-danger]").css('display', 'none');
                
                        $(".dataInput").val('');
                        $("#order").val(res.responseLastId);
                        $('.dataInput:first').select().focus();
    
                        document.querySelector('.modal #save').disabled = false;
                        document.querySelector('.spinner_request').style.display = 'none';
    
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 3);
                        alertify.success("تمت الإضافة بنجاح");
                    }
                });
            }
        });
    </script>


    {{-- add, edit, delete => script --}}
    @include('back.students_rates.add')
    @include('back.students_rates.edit')
    @include('back.students_rates.delete')
@endsection






@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ $pageNameAr }}</h4>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-xl-0">
                    <button type="button" class="btn btn-danger btn-icon ml-2 add" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter"><i class="mdi mdi-plus"></i></button>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        @include('back.students_rates.form')

        <div class="card" id="groups_to_teacher">
            <div class="card-body">
                <div class="bg-info-gradient" style="padding: 10px 20px 20px;">
                    <div class="row row-xs">
                        <div class="col-lg-12">
                            <label for="teacher">المدرسين</label>
                            <select class="selectize" name="teacher" id="teacher">
                                <option value="" disabled selected>المدرسين</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->ID }}">{{ $teacher->TheName }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label for="fromDate">من</label>
                            <input type="text" class="form-control datePicker" id="fromDate" placeholder="من" value="{{ Carbon\Carbon::now()->startOfYear()->format('Y-m-d') }}">
                        </div>
                        <div class="col-lg-5">
                            <label for="toDate">الي</label>
                            <input type="text" class="form-control datePicker" id="toDate" placeholder="الي" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-lg-2">
                            <label for="">بحث</label>
                            <button class="btn btn-warning-gradient btn-block" id="search">بحث
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- style="display: none;" --}}
        <div class="row row-sm" id="table">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap"> {{-- id="example1" --}}
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">المجموعة</th>
                                        <th class="border-bottom-0">ت الإضافة</th>
                                        <th class="border-bottom-0">الصف والمادة</th>
                                        <th class="border-bottom-0">نوع الحصة</th>
                                        <th class="border-bottom-0">المدرس</th>
                                        <th class="border-bottom-0">نظام التعليم</th>
                                        <th class="border-bottom-0">نظام الإختبارات</th>
                                        <th class="border-bottom-0">حصص متوقفة</th>
                                        <th class="border-bottom-0">حصص تمت</th>
                                        <th class="border-bottom-0">التحكم</th>
                                    </tr>
                                </thead>                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

