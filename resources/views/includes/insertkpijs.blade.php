<script>
     function insertKpi(){
        kra_id_post = document.getElementById('kra_id_post').value;
        measure = document.getElementById('measure').value;
        target = document.getElementById('target').value;
        goal_weighted = document.getElementById('goal_weighted').value;
        ajax_frequency = document.getElementById('ajax_frequency').value;
        formula = document.getElementById('formula_create').value;
        target_on_number = document.getElementById('target_on_number').value;
        activities = document.getElementById('activities').value;
        resource_needed = document.getElementById('resource_needed').value;

        ajax_measure = document.getElementById('ajax_measure').value;
    
        if(document.getElementById("is_average_true").checked == true){
            is_average = 1;
        }

        if(document.getElementById("is_average_false").checked == true){
            is_average = 0;
        }

        if(document.getElementById("is_formula_true").checked == true){
            is_formula = 1;
        }

        if(document.getElementById("is_formula_false").checked == true){
            is_formula = 0;
        }

        if(document.getElementById("share1_true").checked == true){
            share1 = 1;
        }

        if(document.getElementById("share1_false").checked == true){
            share1 = 0;
        }

        
        ajax_measure = document.getElementById('ajax_measure').value;

        if(share1 === 1){
            ajax_user_2  = document.getElementById('ajax_user_2').value;
            kra_ajax = document.getElementById('kra_ajax').value;
            shared_goal_weight = document.getElementById('shared_goal_weight').value;
        }else{
            ajax_user_2 = '';
            kra_ajax = '';
            shared_goal_weight = '';
        }

        if( measure === '' || target === '' || goal_weighted === '' || ajax_frequency === '' || formula === '' || target_on_number === '' || activities === '' || resource_needed === '' || ajax_measure === '' || ajax_measure === ''){
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "PLEASE INPUT ALL THE REQUIRED FIELD!",
            footer: ''
            });

        }else{
            $.ajax({
                type:'POST',
                url:"{{ route('kpi_create') }}",
                data:{
                    _token: CSRF_TOKEN,
                    kra_id_post:kra_id_post,
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
                    data = response[0];
                    kpiCreation(data.kra_id);
                    if(data.is_formula == 1){
                        document.getElementById('kpi_id_formula').value = data.id
                        Swal.fire({
                            position: "CENTER",
                            icon: "success",
                            title: "KPI SUCCESSFULLY CREATED.. PLEASE INSERT A FORMULA",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        $('#modalFormula').modal('show');
                        $('#modalKpiCreate').modal('hide');
                    }else{
                        location.reload(); 
                    }
                }
            });
        }

       

     }
</script>