
@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
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
        
        // cancel enter button 
        $(document).keypress(function (e) {
            if(e.which == 13){
                e.preventDefault();  
            }
        });

        // selectize
        $('.selectize').selectize();

        // datatable
        $('#satDataTable').DataTable({
            ordering: false,
            paging: false,
            info: false,            
        });
    </script>


    {{-- start get available times after select day + room + user --}}
    <script>
        const times = document.querySelector('form #times');
        const btn_get_available_times = document.querySelector('form #btn_get_available_times');

        $(btn_get_available_times).click(function(e){
            e.preventDefault();

            $.ajax({
                url: `{{ url($pageNameEn) }}/get_available_times`,
                type: 'POST',
                processData: false,
                contentType: false,    
                data: new FormData($('.modal #form')[0]),
                beforeSend:function () {
                    $("form #times option").remove();

                    document.querySelector('.modal #btn_get_available_times').disabled = true;
                },
                error: function(res){                    
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error("هناك شيئ ما خطأ");
                },
                success: function(res){
                    let times = res.times;
                    let timesToTimeTable = res.timesToTimeTable;

                    times.forEach(time => {
                        let isDuplicated = false;

                        timesToTimeTable.forEach(timeTimeTable => {
                            if((time.time+'-'+time.am_pm) == timeTimeTable.times){
                                isDuplicated = true;
                            }
                        });

                        if(!isDuplicated){
                            $("form #times").append(`
                                <option value="${time.time}-${time.am_pm}">${time.time}-${time.am_pm}</option>
                            `)
                        }
                    });

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.success("تمت جلب مواعيد الحصص المتاحة");

                    document.querySelector('.modal #btn_get_available_times').disabled = false;
                    
                }
            });
        });
    </script>
    {{-- end get available times after select day + room + user --}}


    {{-- start get current day to open tab = current day --}}
    <script>
        var date = new Date();
        var dayIndex = date.getDay();
        var daysOfWeek = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
        var dayName = daysOfWeek[dayIndex];        
    </script>
    {{-- end get current day to open tab = current day --}}



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

        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="panel-group1" id="accordion11">
                    {{-- start sat table --}}
                    <div class="panel panel-default  mb-4">
                        <div class="panel-heading1 bg-primary ">
                            <h4 class="panel-title1">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion11" href="#satAccord" aria-expanded="false">جدول السبت</a>
                            </h4>
                        </div>
                        <div id="satAccord" class="panel-collapse collapse show" role="tabpanel" aria-expanded="true" style="">
                            <div class="panel-body border">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover text-center text-md-nowrap" id="satDataTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th style="background: #364261;color: #fff;">الغرف الدراسية</th>
                                                        @foreach ($times as $time)
                                                            {{-- <th>{{ $time->time }} {{ $time->am_pm }}</th> --}}
                                                            <th>
                                                                {{ $time->time }} <br/> {{ $time->am_pm }}
                                                            </th>                                        
                                                        @endforeach
                                                    </tr>
                                                </thead>
                
                                                <tbody>
                                                    @foreach ($rooms as $room)  {{-- start loop to rooms  --}}
                                                        <tr>
                                                            <td style="background: #364261;color: #fff;">(1) {{ $room->roomName }}</td>

                                                            {{-- start loop to times  --}}
                                                            @foreach ($times as $time)                                                                  
                                                                @php $printedTime = false; @endphp
                
                                                                @foreach ($satClassesUserOne as $satOne)
                                                                    @if ($room->roomId == $satOne->room_id)
                
                                                                        @if (($time->time.'-'.$time->am_pm) == $satOne->times)
                                                                            <th style="
                                                                                        background: {{ $satOne->matColor }};
                                                                                        color: #222;
                                                                                        font-size: 10px !important;
                                                                                        min-width: 60px;
                                                                                        max-width: 60px;
                                                                                        padding: 2px 0 0 !important;
                                                                                        ">
                                                                                {{-- {{ $time->time }}{{ $time->am_pm }}
                                                                                <br /> --}}
                                                                                {{ $satOne->groupName }}
                                                                                {{-- <br />
                                                                                {{ $satOne->teacherName }} --}}
                                                                            </th>  
                                                                            @php $printedTime = true; @endphp
                                                                            @break                             
                                                                        @endif   
                
                                                                    @endif                                                                            
                                                                @endforeach
                                                                
                                                                @if ($printedTime == false)
                                                                    <th>
                                                                        {{-- {{ $time->time }} <br /> {{ $time->am_pm }} --}}
                                                                    </th>
                                                                @endif
                                                                
                                                            @endforeach 
                                                            {{-- end loop to times  --}}
                
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td style="background: #c25710;color: #fff;">(2) {{ $room->roomName }}</td>

                                                            {{-- start loop to times  --}}
                                                            @foreach ($times as $time)                                                                  
                                                                @php $printedTime = false; @endphp
                
                                                                @foreach ($satClassesUserTwo as $satOne)
                                                                    @if ($room->roomId == $satOne->room_id)
                
                                                                        @if (($time->time.'-'.$time->am_pm) == $satOne->times)
                                                                            <th style="
                                                                                        background: {{ $satOne->matColor }};
                                                                                        color: #222;
                                                                                        font-size: 10px !important;
                                                                                        min-width: 60px;
                                                                                        max-width: 60px;
                                                                                        padding: 2px 0 0 !important;
                                                                                        ">
                                                                                {{-- {{ $time->time }}{{ $time->am_pm }}
                                                                                <br /> --}}
                                                                                {{ $satOne->groupName }}
                                                                                {{-- <br />
                                                                                {{ $satOne->teacherName }} --}}
                                                                            </th>  
                                                                            @php $printedTime = true; @endphp
                                                                            @break                             
                                                                        @endif   
                
                                                                    @endif                                                                            
                                                                @endforeach
                                                                
                                                                @if ($printedTime == false)
                                                                    <th>
                                                                        {{-- {{ $time->time }} <br /> {{ $time->am_pm }} --}}
                                                                    </th>
                                                                @endif
                                                                
                                                            @endforeach 
                                                            {{-- end loop to times  --}}
                
                                                        </tr>
                                                    @endforeach {{-- end loop to rooms  --}}
                
                                                </tbody>
                
                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end sat table --}}
                    


                    {{-- start sun table --}}
                    <div class="panel panel-default mb-4">
                        <div class="panel-heading1  bg-primary">
                            <h4 class="panel-title1">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#sunAccord" aria-expanded="false">جدول الأحد</a>
                            </h4>
                        </div>
                        <div id="sunAccord" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                            <div class="panel-body border">
                                <p>sund</p>
                            </div>
                        </div>
                    </div>
                    {{-- end sun table --}}
                    
                    
                    {{-- start mon table --}}
                    <div class="panel panel-default mb-4">
                        <div class="panel-heading1  bg-primary">
                            <h4 class="panel-title1">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#monAccord" aria-expanded="false">جدول الإثنين</a>
                            </h4>
                        </div>
                        <div id="monAccord" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                            <div class="panel-body border">
                                <p>mond</p>
                            </div>
                        </div>
                    </div>
                    {{-- end sun table --}}
                </div>
            </div>
        </div>
        
        
    </div>
@endsection

