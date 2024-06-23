<script>
    function kraDetail(id,kra,weighted_score,frequency_id,is_average){
        document.getElementById('kra_id').value=id;
        document.getElementById('kra_name_update').value=kra;
        document.getElementById('kra_weighted_score_update').value =weighted_score;
        var url = "{{URL::to('/')}}";
        document.getElementById("delete_kra").href=url+'/delete_kra/'+id; 
       
            
        if(is_average == 1){
            document.getElementById("kra_is_average_true").checked = true;
        }

        if(is_average == 0){
            document.getElementById("kra_is_average_false").checked = true;
        }
    }

    function CheckCheckboxes1(chk){
     
        if(chk.checked == true)
        {
            document.getElementById('field_formula_edit').readOnly = false;
            document.getElementById('resetField').style.display = 'block';
        }
        else
        {
            document.getElementById('field_formula_edit').readOnly = true;
            document.getElementById('resetField').style.display = 'none';
        }

    }

    function loadFormulaCreate(flag){
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;
        let field_formula = document.getElementById('field_formula').value;

        if(flag == 'create'){
            let template = $("#ajax_template").val()
            Swal.fire({
                position: "CENTER",
                icon: "success",
                title: "TEMPLATE SUCCESSFULLY LOAD",
                showConfirmButton: false,
                timer: 2500
            });
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '{{url("/template_row")}}'+'/'+template+'/'+department_field_post+'/'+company_field_post,
                success: function (responsedata) {
                    document.getElementById('field_formula').value = responsedata;
                },
                error: function() { 
                    
                }
            });

        }
        else{
            let template = $("#ajax_template_edit").val()
            Swal.fire({
                position: "CENTER",
                icon: "success",
                title: "TEMPLATE SUCCESSFULLY LOAD",
                showConfirmButton: false,
                timer: 2500
            });
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '{{url("/template_row")}}'+'/'+template+'/'+department_field_post+'/'+company_field_post,
                success: function (responsedata) {
                    document.getElementById('field_edit_formula').value = responsedata;
                },
                error: function() { 
                    
                }
            });
        }

    }

    function formulaSaveEdit(){
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;
        let formula_name = document.getElementById('formula_edit_name').value;
        let field_formula = document.getElementById('field_edit_formula').value;

        $.ajax({
            type:'POST',
            url:"{{ route('insert_template') }}",
            data:{
                _token: CSRF_TOKEN,
                company_id:company_field_post,
                department_id:department_field_post,
                formula_name:formula_name,
                field_formula:field_formula
            },
            success:function(response){
                if(response=='CREATED'){
                    Swal.fire({
                        position: "CENTER",
                        icon: "success",
                        title: "TEMPLATE SUCCESSFULLY SAVED",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                if(response=='EMPTY'){
                    Swal.fire({
                        position: "CENTER",
                        icon: "danger",
                        title: "FORMULA IS EMPTY PLEASE INSERT A FORMULA",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                if(response=='EXIST'){
                    Swal.fire({
                        position: "CENTER",
                        icon: "danger",
                        title: "FORMULA IS ALREADY EXIST",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }

    function formulaSave(){
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;
        let formula_name = document.getElementById('formula_name').value;
        let field_formula = document.getElementById('field_formula').value;

        $.ajax({
            type:'POST',
            url:"{{ route('insert_template') }}",
            data:{
                _token: CSRF_TOKEN,
                company_id:company_field_post,
                department_id:department_field_post,
                formula_name:formula_name,
                field_formula:field_formula
            },
            success:function(response){
                if(response=='CREATED'){
                    Swal.fire({
                        position: "CENTER",
                        icon: "success",
                        title: "TEMPLATE SUCCESSFULLY SAVED",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                if(response=='EMPTY'){
                    Swal.fire({
                        position: "CENTER",
                        icon: "danger",
                        title: "FORMULA IS EMPTY PLEASE INSERT A FORMULA",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                if(response=='EXIST'){
                    Swal.fire({
                        position: "CENTER",
                        icon: "danger",
                        title: "FORMULA IS ALREADY EXIST",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });

    }

    function kpiCreation(id){
        $('#modalManual2').modal('show');
        document.getElementById('kra_id_post').value = id;
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("/all_field")}}'+'/'+department_field_post+'/'+company_field_post,
            success: function (responsedata) {
                var options = "";
                for (var i = 0; i < responsedata.data.length; i++) {
                    options += "<option value="+responsedata.data[i].id+">" + responsedata.data[i].text + "</option>";
                }
                $("#ajax_fields").html(options);
            },
            error: function() { 
                
            }
        });

        setTimeout(() => {
            $('#modalManual2').modal('hide');
        }, "3000");

    }

    function kpiFormulaEdit(){
        document.getElementById('kra_id_post').value = id;
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;
       
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("/all_field")}}'+'/'+department_field_post+'/'+company_field_post,
            success: function (responsedata) {
                var options = "";
                for (var i = 0; i < responsedata.data.length; i++) {
                    options += "<option value="+responsedata.data[i].id+">" + responsedata.data[i].text + "</option>";
                }
                $("#ajax_fields").html(options);
            },
            error: function() { 
                
            }
        });

        setTimeout(() => {
            $('#modalManual2').modal('hide');
        }, "3000");
    }

    $( ".ajax_frequency" ).select2({
        dropdownParent: $("#modalKpiCreate"),
        ajax: { 
            url: '{{route("ajax_frequency")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });

    $( ".ajax_frequency_ver_two" ).select2({
        dropdownParent: $("#modalKpiEdit"),
        ajax: { 
            url: '{{route("ajax_frequency")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });

    $( "#subkpi_ajax_frequency" ).select2({
        dropdownParent: $("#modalSubKpiCreate"),
        ajax: { 
            url: '{{route("ajax_frequency")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });

    $( "#subkpi_ajax_frequency_edit" ).select2({
        dropdownParent: $("#modalSubKpiEdit"),
        ajax: { 
            url: '{{route("ajax_frequency")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });

    $( "#ajax_frequency_kra" ).select2({
        dropdownParent: $("#modalKra2"),
        ajax: { 
            url: '{{route("ajax_frequency")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });
    
    let company_field_template = document.getElementById('ajax_company').value;
    let department_field_template = document.getElementById('ajax_department').value;
    $( "#ajax_template" ).select2({
        dropdownParent: $("#modalFormula"),
        ajax: { 
            url: '{{route("ajax_template")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                company_field_template: company_field_template,
                department_field_template: department_field_template
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });

    $( "#ajax_template_edit" ).select2({
        dropdownParent: $("#modalEditFormula"),
        ajax: { 
            url: '{{route("ajax_template")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                company_field_template: company_field_template,
                department_field_template: department_field_template
                };
            },
            processResults: function (response) {
            return {
                results: response.data
                };
            },
            cache: true
        }
    });


    function computeKpi(id,date){
        let kpi_value = document.getElementById(date+'-'+id).value;
        let date_post = date;
        let kpi_id = id;
        
        $.ajax({
            type:'POST',
            url:"{{ route('compute_kpi') }}",
            data:{
                _token: CSRF_TOKEN,
                kpi_id:kpi_id,
                kpi_value:kpi_value,
                date_post:date_post
            },
            success:function(response){
                console.log(response);
                $('#modalManual2').modal('show');
                setTimeout(() => {
                    document.getElementById('total-'+id).innerHTML = response;
                }, "1000");

                setTimeout(() => {
                    $('#modalManual2').modal('hide');
                }, "3000");
            }
        });
    }
</script>