<script>
 function saveDetail(){
        let user_id = document.getElementById('user_id_post').value;
        let company_id = document.getElementById('ajax_company').value;
        let year_post = document.getElementById('year_post').value;
        let department_id = document.getElementById('ajax_department').value;
        
        let vision = document.getElementById('vision').value;
        let mission1 = document.getElementById('mission1').value;
        let mission2 = document.getElementById('mission2').value;
        let department_vision = document.getElementById('department_vision').value;
        let strategy = document.getElementById('strategy').value;
        let objectives = document.getElementById('objectives').value; 
       
        if(!vision && !strategy && !objectives){
            setTimeout(() => {
                document.getElementById('error3').style.display = 'block';
            }, "500");

            setTimeout(() => {
                document.getElementById('error3').style.display = 'none';
            }, "4500");
        }

        $.ajax({
            type:'POST',
            url:"{{ route('post_details') }}",
            data:{
                _token: CSRF_TOKEN,
                user_id:user_id,
                vision:vision,
                mission1:mission1,
                mission2: mission2,
                department_vision:department_vision,
                strategy:strategy,
                objectives:objectives,
                company_id:company_id,
                department_id:department_id,
                year_post:year_post
            },
            success:function(data){
                if(data ==='CREATED'){
                    $('#modalManual2').modal('show');
                    setTimeout(() => {
                        document.getElementById('created').style.display = 'block';
                    }, "3500");

                    setTimeout(() => {
                        document.getElementById('created').style.display = 'none';
                    }, "8000");

                    setTimeout(() => {
                      
                        $('#modalKpi').modal('show');
                        document.getElementById('vision').value = '';
                        document.getElementById('vision').value = '';
                        document.getElementById('mission1').value = ''; 
                        document.getElementById('mission2').value = '';
                        document.getElementById('department_vision').value = '';
                        document.getElementById('strategy').value = '';
                        document.getElementById('objectives').value = '';
                        $('#modalManual2').modal('hide');
                        location.reload();
                    }, "10000");
                }
                if(data ==='UPDATED'){
                    $('#modalManual2').modal('show');
                    setTimeout(() => {
                        document.getElementById('updated').style.display = 'block';
                    }, "3500");

                    setTimeout(() => {
                        document.getElementById('updated').style.display = 'none';
                    }, "8000");
                    setTimeout(() => {
                        $('#modalKpi').modal('show');
                        document.getElementById('vision').value = '';
                        document.getElementById('vision').value = '';
                        document.getElementById('mission1').value = ''; 
                        document.getElementById('mission2').value = '';
                        document.getElementById('department_vision').value = '';
                        document.getElementById('strategy').value = '';
                        document.getElementById('objectives').value = '';
                        $('#modalManual2').modal('hide');
                        location.reload();
                    }, "10000");
                }
            }
        });
    }

</script>