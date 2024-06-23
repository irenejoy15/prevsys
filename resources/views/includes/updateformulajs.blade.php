<script>
    function updateFormula(){
        let kpi_id = document.getElementById('kra_id_edit').value;
        let field_formula = document.getElementById('field_edit_formula').value;
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
                url:"{{ route('formula_update') }}",
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