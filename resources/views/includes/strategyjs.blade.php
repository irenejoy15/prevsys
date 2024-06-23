<script>
    function saveStrategy(){
        let user_id = document.getElementById('user_id_post').value;
        let company_id = document.getElementById('ajax_company').value;
        let year_post = document.getElementById('year_post').value;
        let department_id = document.getElementById('ajax_department').value;
        
        let strategy_name = document.getElementById('strategy_name').value;

        if(!strategy_name){
            setTimeout(() => {
                document.getElementById('error_strategy').style.display = 'block';
            }, "500");

            setTimeout(() => {
                document.getElementById('error_strategy').style.display = 'none';
            }, "4500");
        }
        else{
            $.ajax({
                type:'POST',
                url:"{{ route('post_strategy') }}",
                data:{
                    _token: CSRF_TOKEN,
                    user_id:user_id,
                    strategy_name:strategy_name,
                    company_id:company_id,
                    year_post:year_post
                },
                success:function(data){
                    console.log(data);
                    if(data ==='CREATED'){
                        $('#modalManual2').modal('show');
                        setTimeout(() => {
                            document.getElementById('created').style.display = 'block';
                        }, "3500");

                        setTimeout(() => {
                            document.getElementById('created').style.display = 'none';
                        }, "6000");

                        setTimeout(() => {
                            $('#modalStrategy').modal('hide');
                            $('#modalKpi').modal('show');
                            // INPUT LOAD AJAX 
                            document.getElementById('strategy_name').value = '';
                            location.reload();
                        }, "8000");
                    }
                }
            });
        }

    }
    function backStrategy(){

    }
</script>