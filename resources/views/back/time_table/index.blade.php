
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

        // when close modal either add modal or edit
        $('#exampleModalCenter, #editModal').on('hidden.bs.modal', function () {
            var hasDisabledOption = $('#addForm option:disabled').length > 0;
            if(!hasDisabledOption){
                $("#addForm #times option").remove();
            }

            $("#editForm #times option").remove();
        });

        // when change any option off day or room or user or class_type off any modal either add or edit
        $('#addForm #day, #addForm #room_id, #addForm #user, #editForm #day, #editForm #room_id, #editForm #user').on('change', function(){
            $("#addForm #times option").remove();
            $("#editForm #times option").remove();
        });
    </script>


    {{-- start when click to dbclick open modal + send ajax req to get the info to this course --}}
    <script>
        const selectAllTh = document.querySelectorAll('tbody th');
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));

        selectAllTh.forEach(element=> {
            element.addEventListener('dblclick', function(){
                const thtInnerText = this.innerText;
                const group_id = this.dataset.group_id;
                const group_to_colspan = this.dataset.group_to_colspan;

                if(thtInnerText){
                    editModal.show();
                    
                    const displayModalBody = document.querySelector('#editModal .modal-body');
                    displayModalBody.style.display = 'none';
                    
                    $.ajax({
                        url: `{{ url($pageNameEn) }}/edit/${group_id}/${group_to_colspan}`,
                        type: 'GET',
                        processData: false,
                        contentType: false,
                        beforeSend:function () {
                            $('form [id^=errors]').text('');
                            $('#editModal #recorded_times option').remove();
                        },
                        error: function(res){
                            
                        },
                        success: function(res){
                            console.log(res.findTimesTimeTable);
                            displayModalBody.style.display = 'block';
                            
                            const resFindTimesTimeTable = res.findTimesTimeTable;

                            const groupId = $('#editModal #group_id')[0].selectize;
                            groupId.setValue(resFindTimesTimeTable[0]['group_id']);
                            
                            $('#editModal #day').val(resFindTimesTimeTable[0]['day']);
                            $('#editModal #room_id').val(resFindTimesTimeTable[0]['room_id']);
                            $('#editModal #class_type').val(resFindTimesTimeTable[0]['class_type']);
                            $('#editModal #user').val(resFindTimesTimeTable[0]['user']);
                            $('#editModal #notes').val(resFindTimesTimeTable[0]['notes']);


                            // These results are specific hidden inputs
                                $('#editModal #day_res').val(resFindTimesTimeTable[0]['day']);
                                $('#editModal #room_res').val(resFindTimesTimeTable[0]['room_id']);
                                $('#editModal #user_res').val(resFindTimesTimeTable[0]['user']);
                                $('#editModal #group_to_colspan_res').val(resFindTimesTimeTable[0]['group_to_colspan']);
                            // These results are specific hidden inputs


                            resFindTimesTimeTable.forEach(element => {
                                const recorded_times = $('#editModal #recorded_times');
                                recorded_times.append(`
                                    <option value="${element.times}">${element.times}</option>
                                `);
                            })


                            alertify.set('notifier','position', 'top-center');
                            alertify.set('notifier','delay', 3);
                            alertify.success("تم جلب بيانات الحصة بنجاح");
                        }
                    });
                }
            });
        })
    </script>
    {{-- end when click to dbclick open modal + send ajax req to get the info to this course --}}



    {{-- start get available times after select day + room + user in ADD FORM --}}
    <script>
        const times = document.querySelector('#addForm #times');
        const btn_get_available_times = document.querySelector('#addForm .btn_get_available_times');

        $(btn_get_available_times).click(function(e){
            e.preventDefault();

            $.ajax({
                url: `{{ url($pageNameEn) }}/get_available_times_to_add_form`,
                type: 'GET',
                processData: false,
                contentType: false,    
                data: $("#addForm").serialize(),
                beforeSend:function () {
                    $("#addForm #times option").remove();

                    document.querySelector('#addForm .btn_get_available_times').disabled = true;
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
                            $("#addForm #times").append(`
                                <option value="${time.time}-${time.am_pm}">${time.time}-${time.am_pm}</option>
                            `)
                        }
                    });

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.success("تمت جلب مواعيد الحصص المتاحة");

                    document.querySelector('#addForm .btn_get_available_times').disabled = false;
                    
                }
            });
        });
    </script>
    {{-- end get available times after select day + room + user in ADD FORM --}}



    {{-- start get available times after select day + room + user in Edit FORM --}}
    <script>
        $(document).ready(function () {
            const times = document.querySelector('#editForm #times');
            const btn_get_available_times = $("#editForm .btn_get_available_times");
            
            $(btn_get_available_times).click(function(e){
                e.preventDefault();
                
                $.ajax({
                    url: `{{ url($pageNameEn) }}/get_available_times_to_edit_form`,
                    type: 'GET',
                    processData: false,
                    contentType: false,    
                    data: $("#editForm").serialize(),
                    beforeSend:function () {
                        $("#editForm #times option").remove();
                        document.querySelector('#editForm .btn_get_available_times').disabled = true;
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
                                $("#editForm #times").append(`
                                    <option value="${time.time}-${time.am_pm}">${time.time}-${time.am_pm}</option>
                                `)
                            }
                        });
    
                        alertify.set('notifier','position', 'top-center');
                        alertify.set('notifier','delay', 4);
                        alertify.success("تمت جلب مواعيد الحصص المتاحة");
    
                        document.querySelector('#editForm .btn_get_available_times').disabled = false;
                        
                    }
                });
            });
            
        });
    </script>
    {{-- end get available times after select day + room + user in Edit FORM --}}


    {{-- start remove recorded times from database --}}
    <script>
        $(document).ready(function () {
            const removeRecordedTimes = document.querySelector('#editForm #remove_recorded_times');

            removeRecordedTimes.addEventListener('click', function(){

                if($('#editForm #recorded_times').val().length > 0){
                    alertify.confirm(
                        'هل انت متأكد من الحذف ؟ <i class="fas fa-exclamation-triangle text-warning" style="margin: 0px 3px;"></i>', 
                        '<span class="text-center">عند التأكيد ب نعم سيتم حذف هذة المواعيد المختارة لهذا الجروب من قاعدة البيانات</span>', 
                    function(){ 
                        alert('yes');
                    }, function(){ 
                        alert("no");
                    }).set({
                        labels:{
                            ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                            cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                        }
                    });                    
                }else{
                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 4);
                    alertify.error("اختر موعد أو أكثر لإتمام الحذف");
                }


            });

            // selectRecordedTimes.forEach(element => {
            //     element.addEventListener('click', function() {
            // });

        });
    </script>

    {{-- end remove recorded times from database --}}

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


        {{-- <button class="btn btn-secondary" data-placement="top" data-toggle="tooltip" title="Tooltip on top" type="button">Hover me</button> --}}


        @include('back.time_table.form')
        @include('back.time_table.edit_form')

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
                                                        <th style="background: #364261;color: #fff;">غ الدراسية</th>
                                                        @foreach ($times as $time)
                                                            {{-- <th>{{ $time->time }} {{ $time->am_pm }}</th> --}}
                                                            <th>
                                                                {{ $time->time }} 
                                                                {{-- <br/> 
                                                                {{ $time->am_pm }} --}}
                                                            </th>                                        
                                                        @endforeach
                                                    </tr>
                                                </thead>
                
                                                <tbody>
                                                    @foreach ($rooms as $room)  {{-- start loop to rooms  --}}
                                                        <tr>
                                                            <td style="background: #364261;color: #fff;max-width: 115px;min-width: 115px;font-size: 10px !important;">* {{ $room->roomName }}</td>

                                                            {{-- start loop to times  --}}
                                                            @foreach ($times as $time)                                                                  
                                                                @php $printedTime = false; @endphp
                                                                {{-- @php
                                                                    $currentGroup = null;
                                                                    $rowspan = 0;
                                                                @endphp --}}

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
                                                                                        "
                                                                                {{-- rowspan="{{ $satClassesUserOne->count() }}" --}}
                                                                                data-group_id="{{ $satOne->group_id }}"
                                                                                data-group_to_colspan="{{ $satOne->group_to_colspan }}"
                                                                                class="myTooltip"
                                                                                data-html="true"
                                                                                data-placement="top" 
                                                                                data-toggle="tooltip" 
                                                                                title="
                                                                                    من: {{ $time->time }}{{ $time->am_pm }}
                                                                                    <br />
                                                                                    إلى: {{ $time->time }}{{ $time->am_pm }}
                                                                                    <br />
                                                                                    {{ $satOne->teacherName }}    
                                                                                "
                                                                            >
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
                                                            <td style="background: #c25710;color: #ffffff96;max-width: 115px;min-width: 115px;font-size: 10px !important;"># {{ $room->roomName }}</td>

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

