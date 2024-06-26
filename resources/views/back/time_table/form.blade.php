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
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
