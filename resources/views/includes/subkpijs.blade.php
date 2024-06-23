<script>
    function subFKpi(kpi_id,kra_id){
        document.getElementById('kra_id_create').value = kra_id;
        document.getElementById('kpi_id_create').value = kpi_id;
        $('#modalSubKpiCreate').modal('show');
    }   

    function insertSubKpi(){
        kpi_id = document.getElementById('kpi_id_create').value;
        kra_id = document.getElementById('kra_id_create').value;
        measure = document.getElementById('subkpi_measure').value;
        target = document.getElementById('subkpi_target').value;
        goal_weighted = document.getElementById('subkpi_goal_weighted').value;
        ajax_frequency = document.getElementById('subkpi_ajax_frequency').value;

        target_on_number = document.getElementById('subkpi_target_on_number').value;
        activities = document.getElementById('subkpi_activities').value;
        resource_needed = document.getElementById('subkpi_resource_needed').value;
        ajax_measure = document.getElementById('subkpi_ajax_measure').value;

        if(document.getElementById("subkpi_is_average_true").checked == true){
            is_average = 1;
        }

        if(document.getElementById("subkpi_is_average_false").checked == true){
            is_average = 0;
        }

        if( measure === '' || target === '' || goal_weighted === '' || ajax_frequency === '' || target_on_number === '' || activities === '' || resource_needed === '' || ajax_measure === ''){
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "PLEASE INPUT ALL THE REQUIRED FIELD!",
            footer: ''
            });

        }else{
            $.ajax({
                type:'POST',
                url:"{{ route('subkpi_create') }}",
                data:{
                    _token: CSRF_TOKEN,
                    kpi_id:kpi_id,
                    kra_id:kra_id,
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
                },
                success:function(response){
                    console.log(response);
                    Swal.fire({
                        position: "CENTER",
                        icon: "success",
                        title: "SUBKPI SUCCESSFULLY CREATED...",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    location.reload(); 
                }
            });
        }
    }

    function kpiSubDetail(id){
        $('#modalSubKpiEdit').modal('show');
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("/get_subkpi")}}'+'/'+id,
            success: function (responsedata) {
                document.getElementById('kpi_id_edit').value = responsedata.data.id;
                document.getElementById('subkpi_measure_edit').value = responsedata.data.measure;
                document.getElementById('subkpi_goal_weighted_edit').value = responsedata.data.weighted_goals;
                document.getElementById('subkpi_ajax_frequency_edit').value = responsedata.data.frequency_id;
                document.getElementById('subkpi_target_edit').value = responsedata.data.target;
                document.getElementById('subkpi_target_on_number_edit').value = responsedata.data.target_on_number;
                document.getElementById('subkpi_activities_edit').value = responsedata.data.activities;
                document.getElementById('subkpi_resource_needed_edit').value = responsedata.data.resource_needed;
                document.getElementById('subkpi_edit_ajax_measure').value = responsedata.data.measure_id;
                var url = "{{URL::to('/')}}";
                document.getElementById("delete_subkpi").href=url+'/delete_subkpi/'+responsedata.data.id; 

                if(responsedata.data.is_average==1){
                    document.getElementById('subkpi_edit_is_average_true').checked = true;
                }

                if(responsedata.data.is_average==0){
                    document.getElementById('subkpi_edit_is_average_false').checked = true;
                }
            },
            error: function() { 
                
            }
        });
    }

    function editSubKpi(){
        kpi_id = document.getElementById('kpi_id_edit').value;
        measure = document.getElementById('subkpi_measure_edit').value;
        target = document.getElementById('subkpi_target_edit').value;
        goal_weighted = document.getElementById('subkpi_goal_weighted_edit').value;
        ajax_frequency = document.getElementById('subkpi_ajax_frequency_edit').value;

        target_on_number = document.getElementById('subkpi_target_on_number_edit').value;
        activities = document.getElementById('subkpi_activities_edit').value;
        resource_needed = document.getElementById('subkpi_resource_needed_edit').value;
        ajax_measure = document.getElementById('subkpi_edit_ajax_measure').value;

        if(document.getElementById("subkpi_edit_is_average_true").checked == true){
            is_average = 1;
        }

        if(document.getElementById("subkpi_edit_is_average_false").checked == true){
            is_average = 0;
        }

        if( measure === '' || target === '' || goal_weighted === '' || target_on_number === '' || activities === '' || resource_needed === ''){
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "PLEASE INPUT ALL THE REQUIRED FIELD!",
            footer: ''
            });

        }else{
            $.ajax({
                type:'POST',
                url:"{{ route('subkpi_edit') }}",
                data:{
                    _token: CSRF_TOKEN,
                    kpi_id:kpi_id,
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
                },
                success:function(response){
                    console.log(response);
                    Swal.fire({
                        position: "CENTER",
                        icon: "success",
                        title: "SUBKPI SUCCESSFULLY UPDATED...",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    location.reload(); 
                }
            });
        }
    }
</script>