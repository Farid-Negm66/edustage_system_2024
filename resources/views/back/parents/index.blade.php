@extends('back.layouts.app')

@section('title')
    {{ $pageNameAr }}
@endsection

@section('header')
    <style>
        .crm_categories{
            padding: 10px;
            border: 1px dotted #9d9d9d;
            border-radius: 4px;
            width: 30%;
            margin: 30px auto;
            box-shadow: 10px 7px 23px -8px rgb(151 156 209);
        }

        .categName{
            border: 1px dotted;
            width: 35%;
            padding: 10px;
            margin: 10px auto 20px;
            box-shadow: 7px 7px 5px 0px rgb(182 182 182 / 75%);
            font-weight: bold;text-align: center;
            background: linear-gradient(135deg, hsla(0, 0%, 69%, 1) 0%, hsla(227, 50%, 47%, 1) 51%);
            color: #FFF !important;

        }
        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 95%;
            }
        }
        textarea{
            box-shadow: 10px 7px 23px -8px rgb(151 156 209);
        }
    </style>
@endsection

@section('footer')  
    <script>
        // remove all errors and inputs data when close modal
        $('.modal').on('hidden.bs.modal', function(){
            $('form [id^=errors]').text('');
            $(this).find("input").not("[name='_token']").val('');
            document.querySelector("#image_preview_form").src = `{{ url('back/images/parents/df_image.png') }}`;
        });
        
        
        


        // datatable
        $(document).ready(function () {
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ url($pageNameEn.'/datatable') }}`,
                dataType: 'json',
                columns: [
                    {data: 'ID', name: 'ID'},
                    {data: 'TheName0', name: 'TheName0'},
                    {data: 'TheEmail', name: 'TheEmail'},
                    {data: 'ThePhone1', name: 'ThePhone1'},
                    {data: 'ThePhone2', name: 'ThePhone2'},
                    {data: 'TheStatus', name: 'TheStatus'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "bDestroy": true,
                language: {sUrl: '{{ asset("back/assets/js/ar_dt.json") }}'},
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "الكل"]]
            });
        });
    </script>



    {{-- add, edit, delete => script --}}
    @include('back.parents.add')
    @include('back.parents.crm_info')


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
        </div>
        <!-- breadcrumb -->

        @include('back.parents.form')

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0" style="width: 10%;">#</th>
                                        <th class="wd-15p border-bottom-0" style="width: 20%;">الإسم</th>
                                        <th class="wd-20p border-bottom-0" style="width: 20%;">الإيميل</th>
                                        <th class="wd-10p border-bottom-0">تلفون 1</th>
                                        <th class="wd-10p border-bottom-0">تلفون 2</th>
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

