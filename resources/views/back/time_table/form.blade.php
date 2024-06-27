<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="res_id" value="" />               

                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div class="row row-xs">
                        <div class="col-md-4">
                            <label for="class_date">تاريخ الحصة</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="date" class="form-control dataInput" id="class_date" name="class_date">
                            </div>
                            <bold class="text-danger" id="errors-class_date" style="display: none;"></bold>
                        </div>

                        <div class="col-md-4">
                            <label for="group">المجموعة</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <select id="group" name="group"  class="form-control dataInput">
                                    <option value="" selected disabled>---</option>
                                    <option value="1">gr 1</option>
                                    <option value="1">gr 2</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-group" style="display: none;"></bold>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher">المدرس</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" readonly class="form-control dataInput" id="teacher" name="teacher" placeholder="المدرس">
                            </div>
                            <bold class="text-danger" id="errors-teacher" style="display: none;"></bold>
                        </div>

                    </div>
                    
                    <hr>

                    <div class="container mt-5">
                        <div class="card" style="padding: 10px 5px;">
                            <h4 class="mb-4">جدول الحصص</h4>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>اليوم</th>
                                        <th>نوع الحصة</th>
                                        <th>زمن الحصة</th>
                                        <th>بداية الحصة</th>
                                        <th>نهاية الحصة</th>
                                        <th>الغرف الدراسية</th>
                                        <th style="width: 12%;">إضافة/حذف</th>
                                    </tr>
                                </thead>
                                <tbody id="scheduleTableBody">
                                    <tr>
                                        <td>
                                            <select class="form-control">
                                                <option value="saturday">السبت</option>
                                                <option value="sunday">الأحد</option>
                                                <option value="monday">الاثنين</option>
                                                <option value="tuesday">الثلاثاء</option>
                                                <option value="wednesday">الأربعاء</option>
                                                <option value="thursday">الخميس</option>
                                                <option value="friday">الجمعة</option>
                                            </select>        
                                        </td>
                                        <td>
                                            <select class="form-control">
                                                <option value="1">أساسية</option>
                                                <option value="0">تعوضية</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control timeSelect">
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
                                                <button class="btn btn-sm btn-success add-row" style="padding: 5px 10px !important"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">                                               
                    <button type="button" id="save" class="btn btn-primary btn-rounded" style="display: none;">
                      حفظ
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>

                    <button type="button" id="update" class="btn btn-success btn-rounded" style="display: none;">
                      تعديل
                      <span class="spinner-border spinner-border-sm spinner_request2" role="status" aria-hidden="true"></span>
                    </button>
                    
                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div>

            </form>            
        </div>
      </div>
    </div>
</div>
