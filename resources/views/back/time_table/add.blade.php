<script>
    $(document).ready(function () {
        $("#exampleModalCenter #save").click(function(e){
            e.preventDefault();

            document.querySelector('#exampleModalCenter #save').disabled = true;        
            document.querySelector('#exampleModalCenter .spinner_request').setAttribute("style", "display: inline-block;");

            $.ajax({
                url: "{{ url($pageNameEn) }}/store",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#exampleModalCenter form')[0]),
                beforeSend:function () {
                    $('form [id^=errors]').text('');
                },
                error: function(res){
                    $.each(res.responseJSON.errors, function(index, error) {
                        $(`form #errors-${index}`).css('display' , 'block').text(error);
                    });
                    
                    document.querySelector('#exampleModalCenter #save').disabled = false;
                    document.querySelector('#exampleModalCenter .spinner_request').style.display = 'none';                

                    alertify.set('notifier','position', 'top-center');
                    alertify.set('notifier','delay', 3);
                    alertify.error("هناك شيئ ما خطأ أثناء حفظ الحصة");
                },
                success: function(res){
                    
                    // start after success remove all times and append this
                    $("#exampleModalCenter form #times option").remove();

                    $("#exampleModalCenter form #times").append(`
                        <option class="text-center text-danger" disabled style="margin-top: 60px;font-size: 13px;">اختر أولا الغرفة الدراسية واليوم والمستخدم</option>
                        <option class="text-center text-danger" disabled style="font-size: 13px;">لإظهار المواعيد المتاحة</option>
                    `)
                    // start after success remove all times and append this

                    
                    $("#exampleModalCenter #group_id")[0].selectize.clear();


                    // $('#satDataTable').DataTable().ajax.reload();                
                    $("#exampleModalCenter form bold[class=text-danger]").css('display', 'none');
            
                    document.querySelector('#exampleModalCenter #save').disabled = false;
                    document.querySelector('#exampleModalCenter .spinner_request').style.display = 'none';

                    alertify.confirm('تم حفظ الحصة بنجاح <i class="fas fa-check text-success" style="margin: 0px 3px;"></i>', 'هل تريد إضافة مواعيد لحصة جديدة ؟', 
                    function(){ 

                    }, function(){ 
                        $('#exampleModalCenter').modal('hide');
                    }).set({
                        labels:{
                            ok:"نعم <i class='fas fa-check text-success' style='margin: 0px 3px;'></i>",
                            cancel: "لاء <i class='fa fa-times text-light' style='margin: 0px 3px;'></i>"
                        }
                    });

                }
            });
        });
    });
</script>