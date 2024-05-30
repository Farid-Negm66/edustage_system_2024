<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="parent_id" name="parent_id" value="" />               

                @foreach ($crmCategories as $crmCategory)
                    <div id="crmCateg_{{ $crmCategory->id }}">
                      
                      <div style="border: 1px dotted;width: 50%;padding: 10px;margin: 10px auto 20px;box-shadow: 7px 7px 5px 0px rgb(182 182 182 / 75%);font-weight: bold;text-align: center;">
                        {{ $crmCategory->name }}
                      </div>
                      
                    </div>


                @endforeach

                <div class="container pd-30 pd-sm-40 bg-gray-100">




                    <div class="row row-xs">
                        
                    </div>                
                </div>


                <div class="modal-footer">                                               
                    <button type="button" class="btn btn-primary btn-rounded save">
                      حفظ
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>

                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div>

            </form>            
        </div>
      </div>
    </div>
</div>
