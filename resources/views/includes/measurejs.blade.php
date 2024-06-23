<script>
    let company_id_measure = document.getElementById('ajax_company').value;
    let department_id_measure = document.getElementById('ajax_department').value;
    let year_post_measure = document.getElementById('selected_year').value;
    $( ".ajax_measure" ).wrap("<div class=\"position-relative\"></div>").select2({
        dropdownParent: $("#modalKpiCreate"),
        dropdownPosition: 'above',
        ajax: { 
            url: '{{route("ajax_measure")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
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

    $( ".ajax_measure_sub_create" ).wrap("<div class=\"position-relative\"></div>").select2({
        dropdownParent: $("#modalSubKpiCreate"),
        dropdownPosition: 'above',
        ajax: { 
            url: '{{route("ajax_measure")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
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

    $( "#subkpi_edit_ajax_measure" ).wrap("<div class=\"position-relative\"></div>").select2({
        dropdownParent: $("#modalSubKpiEdit"),
        dropdownPosition: 'above',
        ajax: { 
            url: '{{route("ajax_measure")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
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
    
    $( "#ajax_measure_edit" ).wrap("<div class=\"position-relative\"></div>").select2({
        dropdownParent: $("#modalKpiEdit"),
        dropdownPosition: 'above',
        ajax: { 
            url: '{{route("ajax_measure")}}',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
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


    $( "#ajax_user_2" ).select2({
        dropdownParent: $("#modalKpiCreate"),
        ajax: { 
            url: '{{url("/ajax_user_measure")}}',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                department_id: department_id_measure,
                company_id:company_id_measure,
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

    $( "#ajax_user_2_edit" ).select2({
        dropdownParent: $("#modalKpiEdit"),
        ajax: { 
            url: '{{url("/ajax_user_measure")}}',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                department_id: department_id_measure,
                company_id:company_id_measure,
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

    $( "#kra_ajax" ).select2({
        dropdownParent: $("#modalKpiCreate"),
        ajax: { 
            url: '{{url("/ajax_user_kra")}}',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                company_id:company_id_measure,
                year_post:year_post_measure,
                user_id:$("#ajax_user_2").val()
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

    $( "#kra_ajax_edit" ).select2({
        dropdownParent: $("#modalKpiEdit"),
        ajax: { 
            url: '{{url("/ajax_user_kra")}}',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                company_id:company_id_measure,
                year_post:year_post_measure,
                user_id:$("#ajax_user_2_edit").val()
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
    
    function changeUser(){
        $('#kra_ajax').val(null).trigger("change")
        let data = $('#ajax_user_2').select2('data');
      
        document.getElementById('user_now').innerHTML = data[0].text;
    }

    function changeUserEdit(){
        $('#kra_ajax_edit').val(null).trigger("change")
        let data = $('#ajax_user_2_edit').select2('data');
      
        document.getElementById('user_now_edit').innerHTML = data[0].text;
    }

    function addMeasurePost(){
        let measure_name = document.getElementById('measure_name').value;

        if(measure_name){
            $.ajax({
                type:'POST',
                url:"{{ route('add_measure') }}",
                data:{
                    _token: CSRF_TOKEN,
                    measure_name: measure_name,                
                },
                success:function(response){
                    if(response === 'CREATED'){
                        $('#modalManual2').modal('show');
                        setTimeout(() => {
                            document.getElementById('added_field_edit').style.display = 'block';
                        }, "1000");

                        setTimeout(() => {
                            $('#modalManual2').modal('hide');
                        }, "3000");

                        setTimeout(() => {
                            document.getElementById('added_field_edit').style.display = 'none';
                        }, "4000");
                    }
                    else if(response === 'EXISTED'){
                        $('#modalManual2').modal('show');
                        setTimeout(() => {
                            document.getElementById('existed_field_edit').style.display = 'block';
                        }, "1000");

                        setTimeout(() => {
                            $('#modalManual2').modal('hide');
                        }, "3000");

                        setTimeout(() => {
                            document.getElementById('existed_field').style.display = 'none';
                        }, "4000");
                    }
                    document.getElementById('field_name_create').value = '';
                }
            });
        }

        
    }

    function addMeasurePostEdit(){
        let measure_name = document.getElementById('measure_name_edit').value;

        if(measure_name){
            $.ajax({
                type:'POST',
                url:"{{ route('add_measure') }}",
                data:{
                    _token: CSRF_TOKEN,
                    measure_name: measure_name,                
                },
                success:function(response){
                    if(response === 'CREATED'){
                        $('#modalManual2').modal('show');
                        setTimeout(() => {
                            document.getElementById('added_field_edit').style.display = 'block';
                        }, "1000");

                        setTimeout(() => {
                            $('#modalManual2').modal('hide');
                        }, "3000");

                        setTimeout(() => {
                            document.getElementById('added_field_edit').style.display = 'none';
                        }, "4000");
                    }
                    else if(response === 'EXISTED'){
                        $('#modalManual2').modal('show');
                        setTimeout(() => {
                            document.getElementById('existed_field_edit').style.display = 'block';
                        }, "1000");

                        setTimeout(() => {
                            $('#modalManual2').modal('hide');
                        }, "3000");

                        setTimeout(() => {
                            document.getElementById('existed_field_edit').style.display = 'none';
                        }, "4000");
                    }
                    document.getElementById('field_name_create').value = '';
                }
            });
        }

        
    }

    function addKRA(){
        let kra_name = document.getElementById('kra_create').value;
        let kra_goal_weight = document.getElementById('kra_goal_weight').value;
        if(kra_name === '' || kra_goal_weight==='' || $("#ajax_user_2").val() === ''){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "PLEASE INPUT THE REQUIRED FIELD!",
                footer: ''
            });
        }
        else{
            $.ajax({
                type:'POST',
                url:"{{ url('post_kra_measure') }}",
                data:{
                    _token: CSRF_TOKEN,
                    kra_name: kra_name,        
                    company_id:company_id_measure,
                    year_post:year_post_measure,
                    kra_goal_weight:kra_goal_weight,
                    user_id:$("#ajax_user_2").val()        
                },
                success:function(response){
                    if(response === 'CREATED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "success",
                            title: "KRA SUCCESSFULLY CREATED",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    else if(response === 'EXISTED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "danger",
                            title: "KRA ALREADY EXIST",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    document.getElementById('kra_create').value = '';
                    document.getElementById('kra_goal_weight').value = '';
                }
            });
        }
    }

    function addKRAEdit(){
        let kra_name = document.getElementById('kra_edit').value;
        let kra_goal_weight = document.getElementById('kra_goal_edit_weight').value;
        console.log(kra_goal_weight);
        if(kra_name === '' || kra_goal_weight==='' || $("#ajax_user_2_edit").val() ===''){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "PLEASE INPUT THE REQUIRED FIELD!",
                footer: ''
            });
        }
        else{
            $.ajax({
                type:'POST',
                url:"{{ url('post_kra_measure') }}",
                data:{
                    _token: CSRF_TOKEN,
                    kra_name: kra_name,        
                    company_id:company_id_measure,
                    year_post:year_post_measure,
                    kra_goal_weight:kra_goal_weight,
                    user_id:$("#ajax_user_2_edit").val()        
                },
                success:function(response){
                    if(response === 'CREATED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "success",
                            title: "KRA SUCCESSFULLY CREATED",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    else if(response === 'EXISTED'){
                        Swal.fire({
                            position: "CENTER",
                            icon: "danger",
                            title: "KRA ALREADY EXIST",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    document.getElementById('kra_create').value = '';
                    document.getElementById('kra_goal_weight').value = '';
                }
            });
        }
    }

</script>