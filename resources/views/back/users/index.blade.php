
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
        @media (min-width: 768px){

            .modal-xl {
                max-width: 95%;
            }
        }
        hr{
            border-top: 2px solid #4d5276;
            margin: 32px 0px 24px;
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
            document.querySelector("#image_preview_form").src = `{{ url('back/images/users/df_image.png') }}`;
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



    {{-- add, edit, delete => script --}}
    @include('back.users.add')
    @include('back.users.edit')
    @include('back.users.delete')


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

        @include('back.users.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0" style="width: 20%;">الإسم</th>
                                        <th class="wd-20p border-bottom-0" style="width: 20%;">الإيميل</th>
                                        <th class="wd-20p border-bottom-0">النوع</th>
                                        <th class="wd-15p border-bottom-0" style="width: 35%;">العنوان</th>
                                        <th class="wd-10p border-bottom-0">الحالة</th>
                                        <th class="wd-25p border-bottom-0">التحكم</th>
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

