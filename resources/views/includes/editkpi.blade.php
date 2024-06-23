<script>
    function kpiDetail(id){
        $('#modalManual2').modal('show');
        $.ajax({
            async: false,
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("/single_kpi")}}'+'/'+id,
            success: function (responsedata) {
                $('#modalKpiEdit').modal('show');

                document.getElementById('kra_id_edit').value = responsedata.data.id;
                document.getElementById('measure_edit').value = responsedata.data.measure;
                document.getElementById('target_edit').value = responsedata.data.target;
                document.getElementById('goal_weighted_edit').value = responsedata.data.weighted_goals;
              
                document.getElementById('formula_edit').value = responsedata.data.formula;
                document.getElementById('target_on_number_edit').value = responsedata.data.target_on_number;
                
                document.getElementById('activities_edit').value = responsedata.data.activities;
                document.getElementById('shared_user_edit').innerHTML = responsedata.data.shared_user;

                document.getElementById('resource_needed_edit').value = responsedata.data.resource_needed;
                if(responsedata.data.is_average==1){
                    document.getElementById("average_edit_true").checked = true;
                    document.getElementById("average_edit_false").checked = false;
                }else{
                    document.getElementById("average_edit_true").checked = false;
                    document.getElementById("average_edit_false").checked = true;
                }

                if(responsedata.data.is_formula==1){
                    document.getElementById("is_formula_edit_true").checked = true;
                    document.getElementById("is_formula_edit_false").checked = false;
                }else{
                    document.getElementById("is_formula_edit_true").checked = false;
                    document.getElementById("is_formula_edit_false").checked = true;
                }
                document.getElementById('formula_kpi_show').value = responsedata.data.formula_kpi
                var url = "{{URL::to('/')}}";
                document.getElementById("delete_kpi").href=url+'/delete_kpi/'+id; 

            },
            error: function() { 
                
            }
        });

        

        setTimeout(() => {
            $('#modalManual2').modal('hide');
        }, "3000");
    }
</script>

