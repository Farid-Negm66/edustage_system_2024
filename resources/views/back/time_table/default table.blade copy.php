
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    {{-- sweetalert --}}
    <link href="{{ url('back') }}/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
    {{-- fileupload --}}
    <link href="{{ asset('back/assets/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .main_tr_day{
            background: #838080 !important;
            color: #fff;
        }

        .main_hour{
            background: #838080 !important;
            color: #fff !important;
        }

        table.dataTable thead th, table.dataTable thead td{
            padding: 5px 10px !important;
            border: 1px solid #838080 !important;
            font-size: 12px !important;
            width: 25px !important;
        }

    </style>
@endsection

@section('footer')  
    <script src="{{ url('back') }}/assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>
    <script src="{{ url('back') }}/assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="{{ url('back') }}/assets/js/sweet-alert.js"></script>

    <!-- fileupload -->
    <script src="{{ asset('back/assets/file-upload-with-preview.min.js') }}"></script>
    <script> new FileUploadWithPreview('file_upload') </script>

    <script>
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
            document.querySelector("#image_preview_form").src = `{{ url('back/images/time_table/df_image.png') }}`;
        });
        
        
        

        // cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });



        $(document).ready(function () {
            // selectize
            $('.selectize').selectize();


            // datatable
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'gender', name: 'gender'},
                    {data: 'address', name: 'address'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>



    <script>
        $(document).ready(function(){
            $(document).on('click', '.add-row', function(e){
                e.preventDefault();
                let trLength = $('#scheduleTableBody tr').length;
                var newRow = `
                                <tr>
                                        <td>
                                            <select class="form-control" name="day[]">
                                                <option value="السبت">السبت</option>
                                                <option value="الأحد">الأحد</option>
                                                <option value="الاثنين">الاثنين</option>
                                                <option value="الثلاثاء">الثلاثاء</option>
                                                <option value="الأربعاء">الأربعاء</option>
                                                <option value="الخميس">الخميس</option>
                                                <option value="الجمعة">الجمعة</option>
                                            </select>    
                                            <bold class="text-danger" id="errors-day" style="display: none;"></bold>    
                                        </td>
                                        <td>
                                            <select class="form-control" name="class_type[]">
                                                <option value="أساسية">أساسية</option>
                                                <option value="تعوضية">تعوضية</option>
                                            </select>
                                            <bold class="text-danger" id="errors-class_type" style="display: none;"></bold>
                                        </td>
                                        <td>
                                            <select class="form-control timeSelect" name="class_time[]">
                                                <option value="" selected>زمن الحصة</option>
                                                <option value="15">15 دقيقة</option>
                                                <option value="20">20 دقيقة</option>
                                                <option value="25">25 دقيقة</option>
                                                <option value="30">30 دقيقة</option>
                                                <option value="35">35 دقيقة</option>
                                                <option value="40">40 دقيقة</option>
                                                <option value="45">45 دقيقة</option>
                                                <option value="50">50 دقيقة</option>
                                                <option value="55">55 دقيقة</option>
                                                <option value="60">60 دقيقة</option>
                                                <option value="65">65 دقيقة</option>
                                                <option value="70">70 دقيقة</option>
                                                <option value="75">75 دقيقة</option>
                                                <option value="80">80 دقيقة</option>
                                                <option value="85">85 دقيقة</option>
                                                <option value="90">90 دقيقة</option>
                                                <option value="95">95 دقيقة</option>
                                                <option value="100">100 دقيقة</option>
                                                <option value="105">105 دقيقة</option>
                                                <option value="110">110 دقيقة</option>
                                                <option value="115">115 دقيقة</option>
                                                <option value="120">120 دقيقة</option>
                                                <option value="125">125 دقيقة</option>
                                                <option value="130">130 دقيقة</option>
                                                <option value="135">135 دقيقة</option>
                                                <option value="140">140 دقيقة</option>
                                                <option value="145">145 دقيقة</option>
                                                <option value="150">150 دقيقة</option>
                                                <option value="155">155 دقيقة</option>
                                                <option value="160">160 دقيقة</option>
                                                <option value="165">165 دقيقة</option>
                                                <option value="170">170 دقيقة</option>
                                                <option value="175">175 دقيقة</option>
                                                <option value="180">180 دقيقة</option>
                                                <option value="185">185 دقيقة</option>
                                                <option value="190">190 دقيقة</option>
                                                <option value="195">195 دقيقة</option>
                                                <option value="200">200 دقيقة</option>
                                            </select>
                                            <bold class="text-danger" id="errors-class_time" style="display: none;"></bold>
                                        </td>
                                        <td class="time_field">
                                            <input type="time" class="form-control from1" name="time_from[]">
                                            <bold class="text-danger" id="errors-time_from" style="display: none;"></bold>
                                        </td>
                                        <td class="time_field">
                                            <input type="time" class="form-control to1" name="time_to[]">
                                            <bold class="text-danger" id="errors-time_to" style="display: none;"></bold>
                                        </td>
                                        <td>
                                            <select class="form-control" name="room_id[]">
                                                <option value="" selected disabled>الغرف الدراسية</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->RoomID }}">{{ $room->RoomName }}</option>                                            
                                                @endforeach
                                            </select>
                                            <bold class="text-danger" id="errors-room_id" style="display: none;"></bold>
                                        </td>
                                        <td>
                                            <div class="d-inline-block">
                                                <button class="btn btn-sm btn-success add-row" style="padding: 5px 10px !important"><i class="fa fa-plus"></i></button>
                                                <button class="btn btn-sm btn-danger delete-row" style="padding: 5px 10px !important"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    `;

                $('#scheduleTableBody').append(newRow);
            });

            $(document).on('click', '.delete-row', function(){
                $(this).closest('tr').remove();
            });
        });
    </script>



    <script>
        $(document).ready(function () {

            $('.inputTime1').on('input', function() {
            let time1 = $(this).val();

            if (time1) {
                let [hours, minutes] = time1.split(':').map(Number);
                let date = new Date();
                date.setHours(hours);
                date.setMinutes(minutes);

                date.setMinutes(date.getMinutes() + 60);

                let newHours = String(date.getHours()).padStart(2, '0');
                let newMinutes = String(date.getMinutes()).padStart(2, '0');
                let newTime = `${newHours}:${newMinutes}`;

                // استخدم closest للعثور على الصف الحالي وتحديث inputTime2 الخاص به
                $(this).closest('tr').find('.inputTime2').val(newTime);
            } else {
                $(this).closest('tr').find('.inputTime2').val('');
            }
        });






            // $('.inputTime1').change(function(){
            //     let inputTime1 = $(this).val();
            //     let inputTime2 = new Date(inputTime1);
            //     inputTime2.addMinutes(60);

            //     // $('.inputTime2').val(inputTime2.toTimeString());
            //     // alert($('.inputTime2').val(inputTime2.toTimeString()));
            //     console.log(inputTime2.toTimeString());
            // })
        });
    </script>







    {{-- add, edit, delete => script --}}
    @include('back.time_table.add')
    @include('back.time_table.edit')
    @include('back.time_table.delete')


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

        @include('back.time_table.form')

        
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        {{-- <div class="" id="accordion11">
                            <div class="panel panel-default  mb-4">
                                <div class="panel-heading1 bg-primary ">
                                    <h4 class="panel-title1">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion11" href="#collapseFour1" aria-expanded="true">Section 1<i class="fe fe-arrow-left ml-2"></i></a>
                                    </h4>
                                </div>
                                <div id="collapseFour1" class="panel-collapse collapse show" role="tabpanel" aria-expanded="false" style="">
                                    <div class="panel-body border">
                                        <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default mb-0">
                                <div class="panel-heading1  bg-primary">
                                    <h4 class="panel-title1">
                                        <a class="accordion-toggle mb-0 collapsed" data-toggle="collapse" data-parent="#accordion11" href="#collapseFive2" aria-expanded="false">Section 2 <i class="fe fe-arrow-left ml-2"></i></a>
                                    </h4>
                                </div>
                                <div id="collapseFive2" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                                    <div class="panel-body border">
                                        <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words </p>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}



                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th>يوم الأسبوع</th>
                                        <th class="main_hour">8:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>8:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>8:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>8:45   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:00   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">9:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:45   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:00   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">10:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:45   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>11:00   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">11:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>11:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>11:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>11:45   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">12:00   <span style="font-size: 10px;">م</span>  </th>
                                        <th>12:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>12:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>12:45   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">1:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>1:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>1:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>1:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">2:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>2:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>2:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>2:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">3:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>3:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>3:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>3:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">4:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>4:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>4:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>4:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">5:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>5:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>5:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>5:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">6:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>6:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>6:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>6:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">7:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>7:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>7:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>7:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">8:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>8:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>8:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>8:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">9:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>9:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>9:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>9:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">10:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>10:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>10:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>10:45    <span style="font-size: 10px;">م</span>  </th>

                                        <th class="main_hour">11:00    <span style="font-size: 10px;">م</span>  </th>
                                        <th>11:15    <span style="font-size: 10px;">م</span>  </th>
                                        <th>11:30    <span style="font-size: 10px;">م</span>  </th>
                                        <th>11:45    <span style="font-size: 10px;">م</span>  </th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $days = ['السبت','الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'];
                                    @endphp 

                                    @foreach ($days as $dayValue)
                                        {{-- start السبت --}}
                                        @if ($dayValue == 'السبت')
                                            
                                            <tr class="main_tr_day">
                                                <td>السبت</td>
                                            </tr>                                     
                                        
                                            @foreach ($rooms as $room)
                                                @foreach ($satClasses as $class)
                                                    <tr>
                                                        <td style="background: #d93939;color: #fff;">{{ $room->RoomName }}</td>                                                    
                                                        <td class="bg-primary-gradient" colspan="5"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach





                                        {{-- start الأحد --}}
                                        @elseif($dayValue == 'الأحد')
                                            <tr class="main_tr_day">
                                                <td>الأحد</td>
                                            </tr>                                     

                                            @foreach ($rooms as $room)
                                                <tr>
                                                    <td style="background: #d93939;color: #fff;">{{ $room->RoomName }}</td>                                                    
                                                    <td style="background: rebeccapurple;color: #fff;">8:00</td>
                                                    <td style="background: rebeccapurple;color: #fff;">8:15</td>
                                                    <td style="background: rebeccapurple;color: #fff;">8:30</td>
                                                    <td style="background: rebeccapurple;color: #fff;">8:45</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        
                                        
                                        {{-- start الاثنين --}}
                                        @elseif($dayValue == 'الاثنين')
                                            <tr class="main_tr_day">
                                                <td>الاثنين</td>
                                            </tr>                                     

                                            @foreach ($rooms as $room)
                                                <tr>
                                                    <td style="background: #d93939;color: #fff;">{{ $room->RoomName }}</td>                                                    
                                                    <td style="background: greenyellow;color: #000;">8:00</td>
                                                    <td style="background: greenyellow;color: #000;">8:15</td>
                                                    <td style="background: greenyellow;color: #000;">8:30</td>
                                                    <td style="background: greenyellow;color: #000;">8:45</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

