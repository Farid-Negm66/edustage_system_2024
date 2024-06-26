
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
            background: #0967b3 !important;
            color: #fff;
        }

        .main_hour{
            background: #0967b3 !important;
            color: #fff !important;
        }

        table.dataTable thead th, table.dataTable thead td{
            padding: 5px 10px !important;
            border: 1px solid #0967b3 !important;
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



        // datatable
        $(document).ready(function () {
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
                var newRow = `<tr>
                                <td><input type="date" class="form-control" placeholder="اليوم"></td>
                                <td>
                                    <select class="form-control">
                                        <option value="1">أساسية</option>
                                        <option value="0">تعوضية</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control timeSelect"></select>
                                </td>
                                <td><input type="time" class="form-control"></td>
                                <td><input type="time" class="form-control"></td>
                                <td>
                                    <select class="form-control">
                                        <option value="1">غرفه 1</option>
                                        <option value="0">غرفة 2</option>
                                        <option value="0">غرفة 2</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="d-inline-block">
                                        <button class="btn btn-sm btn-outline-success add-row"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-sm btn-outline-danger delete-row"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>`;

                $('#scheduleTableBody').append(newRow);
            });

            $(document).on('click', '.delete-row', function(){
                $(this).closest('tr').remove();
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var timeSelect = document.querySelector(".timeSelect");
            var startTime = 30;
            var endTime = 200;
            var increment = 5;

            for (var i = startTime; i <= endTime; i += increment) {
                var option = document.createElement("option");
                option.value = i;
                option.text = i + " دقيقة";
                timeSelect.appendChild(option);
            }
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
                                {{-- <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0" style="width: 20%;">الإسم</th>
                                        <th class="wd-20p border-bottom-0" style="width: 20%;">الإيميل</th>
                                        <th class="wd-20p border-bottom-0">النوع</th>
                                        <th class="wd-15p border-bottom-0" style="width: 35%;">العنوان</th>
                                        <th class="wd-10p border-bottom-0">الحالة</th>
                                        <th class="wd-25p border-bottom-0">التحكم</th>
                                    </tr>
                                </thead> --}}



                                {{-- @php
                                    $times = [
                                        'ص' => '8:00',
                                        'ص' => '8:15',
                                        'ص' => '8:30',
                                        'ص' => '8:45',
                                        
                                        'ص' => '9:00',
                                        'ص' => '9:15',
                                        'ص' => '9:30',
                                        'ص' => '9:45',
                                        
                                        'ص' => '10:00',
                                        'ص' => '10:15',
                                        'ص' => '10:30',
                                        'ص' => '10:45',
                                        
                                        'ص' => '11:00',
                                        'ص' => '11:15',
                                        'ص' => '11:30',
                                        'ص' => '11:45',
                                        
                                        'م' => '12:00',
                                        'م' => '12:15',
                                        'م' => '12:30',
                                        'م' => '12:45',
                                        
                                        'م' => '1:00',
                                        'م' => '1:15',
                                        'م' => '1:30',
                                        'م' => '1:45',
                                        
                                        'م' => '2:00',
                                        'م' => '2:15',
                                        'م' => '2:30',
                                        'م' => '2:45',
                                        
                                        'م' => '3:00',
                                        'م' => '3:15',
                                        'م' => '3:30',
                                        'م' => '3:45',
                                        
                                        'م' => '4:00',
                                        'م' => '4:15',
                                        'م' => '4:30',
                                        'م' => '4:45',
                                        
                                        'م' => '5:00',
                                        'م' => '5:15',
                                        'م' => '5:30',
                                        'م' => '5:45',
                                        
                                        'م' => '6:00',
                                        'م' => '6:15',
                                        'م' => '6:30',
                                        'م' => '6:45',
                                        
                                        'م' => '7:00',
                                        'م' => '7:15',
                                        'م' => '7:30',
                                        'م' => '7:45',
                                        
                                        'م' => '8:00',
                                        'م' => '8:15',
                                        'م' => '8:30',
                                        'م' => '8:45',
                                        
                                        'م' => '9:00',
                                        'م' => '9:15',
                                        'م' => '9:30',
                                        'م' => '9:45',
                                        
                                        'م' => '10:00',
                                        'م' => '10:15',
                                        'م' => '10:30',
                                        'م' => '10:45',
                                        
                                        'م' => '11:00',
                                        'م' => '11:15',
                                        'م' => '11:30',
                                        'م' => '11:45',
                                        
                                        'ص' => '12:00',                                        
                                    ];  
                                @endphp  --}}





                                <thead>
                                    <tr>
                                        <th>يوم الأسبوع</th>
                                        <th class="main_hour">8:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>8:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>8:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>8:45   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">9:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>9:45   <span style="font-size: 10px;">ص</span>  </th>

                                        <th class="main_hour">10:00   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:15   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:30   <span style="font-size: 10px;">ص</span>  </th>
                                        <th>10:45   <span style="font-size: 10px;">ص</span>  </th>

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
                                        $days = [
                                            'Saturday' => 'السبت',
                                            'Sunday' => 'الأحد',
                                            'Monday' => 'الإثنين',
                                            'Tuesday' => 'الثلاثاء',
                                            'Wednesday' => 'الأربعاء',
                                            'Thursday' => 'الخميس',
                                            'Friday' => 'الجمعة',
                                        ];

                                        $time_table = [
                                            '1' => 'م 1',
                                            '2' => 'م 2',
                                            '3' => 'م 3',
                                            '4' => 'م 4',
                                            '5' => 'م 5',
                                            '6' => 'م 6',
                                            '7' => 'م 7',
                                        ];
                                    @endphp 

                                        @foreach ($days as $dayKey => $dayValue)
                                            <tr class="main_tr_day">
                                                <td>{{ $dayValue }}</td>
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
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            @foreach ($time_table as $userKey => $userValue)
                                                <tr>
                                                    <td>{{ $userValue }}</td>                                                    
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
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

