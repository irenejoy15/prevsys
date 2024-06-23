<script>
    function updateKpi(){
       kra_id_edit = document.getElementById('kra_id_edit').value;
       measure = document.getElementById('measure_edit').value;
       target = document.getElementById('target_edit').value;
       goal_weighted = document.getElementById('goal_weighted_edit').value;
       ajax_frequency = document.getElementById('ajax_frequency_edit').value;
       formula = document.getElementById('formula_edit').value;
       target_on_number = document.getElementById('target_on_number_edit').value;
       activities = document.getElementById('activities_edit').value;
       resource_needed = document.getElementById('resource_needed_edit').value;
       ajax_measure = document.getElementById('ajax_measure_edit').value;
   
       if(document.getElementById("average_edit_true").checked == true){
           is_average = 1;
       }

       if(document.getElementById("average_edit_false").checked == true){
           is_average = 0;
       }

       if(document.getElementById("is_formula_edit_true").checked == true){
           is_formula = 1;
       }

       if(document.getElementById("is_formula_edit_false").checked == true){
           is_formula = 0;
       }

       if(document.getElementById("share1_edit_true").checked == true){
           share1 = 1;
       }

       if(document.getElementById("share1_edit_false").checked == true){
           share1 = 0;
       }

       
       ajax_measure = document.getElementById('ajax_measure_edit').value;

       if(share1 === 1){
           ajax_user_2  = document.getElementById('ajax_user_2_edit').value;
           kra_ajax = document.getElementById('kra_ajax_edit').value;
           shared_goal_weight = document.getElementById('shared_goal_weight_edit').value;
       }else{
           ajax_user_2 = '';
           kra_ajax = '';
           shared_goal_weight = '';
       }
      
       if( measure === '' || target === '' || goal_weighted === '' || formula === '' || target_on_number === '' || activities === '' || resource_needed === ''){
           Swal.fire({
           icon: "error",
           title: "Oops...",
           text: "PLEASE INPUT ALL THE REQUIRED FIELD!",
           footer: ''
           });

       }else{
           $.ajax({
               type:'POST',
               url:"{{ route('kpi_edit') }}",
               data:{
                   _token: CSRF_TOKEN,
                   kra_id_edit:kra_id_edit,
                   measure:measure,
                   target:target,
                   activities:activities,
                   is_average:is_average,
                   resource_needed:resource_needed,
                   is_average:is_average,
                   frequency_id:ajax_frequency,
                   goal_weighted:goal_weighted,
                   target_on_number: target_on_number,
                   ajax_measure:ajax_measure,
                   shared_id:ajax_user_2,
                   kra_ajax:kra_ajax,
                   same:share1,
                   shared_goal_weight:shared_goal_weight,
                   is_formula:is_formula,
                   formula:formula


               },
               success:function(response){
                    // data = response[0];
                    console.log(response);
                    Swal.fire({
                        position: "CENTER",
                        icon: "success",
                        title: "KPI SUCCESSFULLY UPDATED",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    location.reload(); 
               }
           });
       }

      

    }
</script>