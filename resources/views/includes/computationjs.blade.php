<script>
    let field_name_create = document.getElementById('field_name_create').value;
    let company_field_post = document.getElementById('ajax_company').value;
    let department_field_post = document.getElementById('ajax_department').value;
   
    $( ".ajax_fields" ).wrap("<div class=\"position-relative\"></div>").select2({
        dropdownParent: $("#modalFormula"),
        dropdownPosition: 'above',
        ajax: { 
            url: '{{route("ajax_fields")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                department_id: department_field_post,
                company_id: company_field_post
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

    $( ".ajax_fields_edit" ).select2({
        dropdownParent: $("#modalKpiEdit"),
        ajax: { 
            url: '{{route("ajax_fields")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                department_id: department_field_post,
                company_id: company_field_post
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

    $( ".ajax_formula_edit" ).select2({
        dropdownParent: $("#modalEditFormula"),
        ajax: { 
            url: '{{route("ajax_fields")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                department_id: department_field_post,
                company_id: company_field_post
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

    function fields(company_field_post,department_field_post){
        $( ".ajax_fields" ).wrap("<div class=\"position-relative\"></div>").select2({
            dropdownParent: $("#modalFormula"),
            dropdownPosition: 'above',
            ajax: { 
                url: '{{route("ajax_fields")}}',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term,
                    department_id: department_field_post,
                    company_id: company_field_post
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
    }

    function createField(){
        let field_name_create = document.getElementById('field_name_create').value;
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;
        if(field_name_create){
            $.ajax({
                type:'POST',
                url:"{{ route('fields.store') }}",
                data:{
                    _token: CSRF_TOKEN,
                    company_id: company_field_post,
                    department_id: department_field_post,
                    field_name: field_name_create
                
                },
                success:function(response){
                    if(response[0] === 'CREATED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "success",
                            title: "FIELD SUCCESSFULLY CREATED",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        let data = response[1];
                        
                        $('#ajax_fields').append($('<option>', {
                            value: data.field_variable_desc,
                            text: data.field_name
                        }));
                    }
                    else if(response[0] === 'EXISTED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "danger",
                            title: "FIELD ALREADY EXIST",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    document.getElementById('field_name_create').value = '';
                }
            });
        }
    }

    function updateField(){
        let field_name_create = document.getElementById('field_name_edit').value;
        let company_field_post = document.getElementById('ajax_company').value;
        let department_field_post = document.getElementById('ajax_department').value;
        if(field_name_create){
            $.ajax({
                type:'POST',
                url:"{{ route('fields.store') }}",
                data:{
                    _token: CSRF_TOKEN,
                    company_id: company_field_post,
                    department_id: department_field_post,
                    field_name: field_name_create
                
                },
                success:function(response){
                    if(response[0] === 'CREATED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "success",
                            title: "FIELD SUCCESSFULLY CREATED",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        let data = response[1];
                        
                        $('#ajax_fields').append($('<option>', {
                            value: data.field_variable_desc,
                            text: data.field_name
                        }));
                    }
                    else if(response[0] === 'EXISTED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "danger",
                            title: "FIELD ALREADY EXIST",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    document.getElementById('field_name_edit').value = '';
                }
            });
        }
    }

    function resetField(){
        document.getElementById('field_formula').value = '';
    }

    function resetFieldEdit(){
        document.getElementById('field_formula_edit').value = '';
    }

    function insertField(){
        field_name = $("#ajax_fields").val();
        if(field_name){
            let formula_textarea = document.getElementById('field_formula').value;
            document.getElementById('field_formula').value = formula_textarea + field_name;
                
        }     
    }

    function editField(){
        field_name = $("#ajax_formula_edit").val();
        if(field_name){
            let formula_textarea = document.getElementById('field_edit_formula').value;
            document.getElementById('field_edit_formula').value = formula_textarea + field_name;
                
        }     
    }

   function saveFormula(){
        let kpi_id = document.getElementById('kpi_id_formula').value;
        let field_formula = document.getElementById('field_formula').value;
        if(field_formula === '' || kpi_id === ''){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "PLEASE INPUT THE FORMULA FIELD!",
                footer: ''
            });
        }
        else{
            $.ajax({
                type:'POST',
                url:"{{ route('formula_post') }}",
                data:{
                    _token: CSRF_TOKEN,
                    kpi_id:kpi_id,
                    formula_details:field_formula,
                },
                success:function(response){
                    location.reload(); 
                }
            });
        }
   }
</script>
