@section('scripts')
<script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>
	<script src='{{ url("assets/bower_components/jquery-validation-1.14.0/dist/jquery.validate.js") }}'></script>
	<script src='{{ url("assets/js/jquery.easing-82496a9/jquery.easing.1.3.js") }}'></script>
	<script type="text/javascript">

$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#fields" + next;
   		console.log('iadd'+ next);
        next = next + 1;
        var addRemove = "#fields" + (next) ;
        var newIn = '<div id="fields'+next+'"><input type="text" name="first_name[]" placeholder="First Name" id="fname'+next+'" required/><input type="text" name="last_name[]" placeholder="Last Name" id="lname'+next+'" required/><input type="email" name="email[]" id="email'+next+'"placeholder="Email" required/><a href="#" id="remove' + (next) + '" class=" btn-danger remove-me" ><i class="fa fa-fw fa-times-circle"></i></a>';
        var newInput = $(newIn);
        $(addto).after(newInput);
        $("#fields" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
            $('.remove-me').click(function(e){

                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#fields" + fieldNum;
                next--;
                console.log('iremo'+ next+'fieldNum'+fieldID);
                if(next<=0){
                	next=1;
                }

                $(this).remove();
                $(fieldID).remove();
            });
    });
    

    
});
jQuery(document).ready(function() {
			//jQuery time
			var form = $('#msform');
			 	form.validate({
			 	 	framework: 'bootstrap',
		        	icon: {
			            valid: 'glyphicon glyphicon-ok',
			            invalid: 'glyphicon glyphicon-remove',
			            validating: 'glyphicon glyphicon-refresh'
		        	},
			 		errorElement: 'span',
						errorClass: 'error-block',
						highlight: function(element, errorClass, validClass) {
							$(element).closest('.form-group').addClass("has-error");
						},
						unhighlight: function(element, errorClass, validClass) {
							$(element).closest('.form-group').removeClass("has-error");
						},
					rules: {
						
						"agentfname[]": 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,
						},
						"agentlname[]": 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,
						},
						"agentemail[]": 
						{
							required: true,
							maxlength: 45,
						}
					},
					messages: 
					{
						"first_name[]":
						{
							required: "Agent's firstname is required."
						},
						"last_name[]":
						{
							required: "Agent's lastname is required."
						},
						"email[]":
						{
							required: "Agent's email is required."
						},
					},
				});
	$.validator.addMethod("nowhitespace", function(value, element) {
				//console.log('annyeong');
				return this.optional(element)|| /^[a-zA-Z]+/i.test(value);
			}, "Please enter a value.");
	$("#submit-additional-agent").click( function(e){
				e.preventDefault();
				if(form.valid())
				{
					var emailerrors = 0;
					var inputs = document.querySelectorAll("#msform input[name='email[]']");
					var span = document.createElement("span");
					span.className = "error-block";

					function doCheck(i){
						var fcounter=2;
							$.get( "/validateSupervisorAgent/"+fcounter+"?&agentemail="+inputs[i].value).done(function( data ) {
						console.log('data'+ data + 'error'+ emailerrors + 'i' + i + inputs.length);
							
							if(data == 'failed'){

									emailerrors++;
									var text = document.createTextNode("Agent email already existing.");
									console.log('i'+i)
									var element = document.getElementById('this-aemail-'+(i+1));
									console.log('i'+i)
									
									span.appendChild(text);
									element.appendChild(span);

							}
							else if(data=='passed' && emailerrors==0 && i+1 >= inputs.length)
							{
							console.log('data'+ data + 'error'+ emailerrors + 'i' + i );

								$('#msform').submit();
								return false;
							}

					});
				
				}
				for (var i = 0; i <=inputs.length; i++) 
   				{	 
   					doCheck(i);
   				}
				
			}
		});

});
</script>
@stop
