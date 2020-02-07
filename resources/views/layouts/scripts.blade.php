<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
<script src="/js/jquery.mask.min.js"></script>


<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

    function recordType() {
        text = $('#record_type').find(":selected").text();

		if(text == 'A'){
			$('#value').attr('placeholder','___.___.___.___');
		 	$('#value').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
			    translation: {
			      'Z': {
			        pattern: /[0-9]/, optional: true
			      },
			    }
		  	});
		}else{
            $('#value').unmask();
            $('#value').attr('placeholder','Endereço');
        }

        if(text == 'MX' || text == 'SRV'){
            $('#priority_div').show();
        }
        else{
            $('#priority_div').hide();
        }
    }

	$(document).ready(function(){

        recordType();

        $('#record_type').on('change', function() {
            recordType();
        });


        //filtro das tabelas
        $("#filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#recordTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

	});

</script>
