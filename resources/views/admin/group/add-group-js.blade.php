
@section('scripts')
	<script src='{{ url("assets/js/jquery-1.11.1.min.js") }}'></script>
	<script src='{{ url("assets/bower_components/jquery-validation-1.14.0/dist/jquery.validate.js") }}'></script>
	<script src='{{ url("assets/js/jquery.easing-82496a9/jquery.easing.1.3.js") }}'></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			
			var wrap = $('.addagent');
			var addBtn = ('.addButton');
			i=1;
			$(addBtn).click( function(e){
				e.preventDefault();
				i++;
				$(wrap).append('<p><input type="text" name="agentfname[]" placeholder="First Name" required/><input type="text" name="agentlname[]" placeholder="Last Name" required/><div id="this-aemail-'+i+'"><input type="email" name="agentemail[]" placeholder="Email" id="aEmail'+i+'" class="agentEmail" required/></div><a href="#" id="removeBtn">Remove</a></p>')
				
			});
			$(wrap).on("click", "#removeBtn", function(e){
					 e.preventDefault();			
					$(this).parent('p').remove();

					i--;
				
				
			});
		});
	</script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			//jQuery time
			var fcounter = 0;
			var d1 = $.Deferred();
			var current_fs, next_fs, previous_fs; //fieldsets
			var left, opacity, scale; //fieldset properties which we will animate
			var animating; //flag to prevent quick multi-click glitches
			$.validator.addMethod("nowhitespace", function(value, element) {
				//console.log('annyeong');
				return this.optional(element)|| /^[a-zA-Z]+/i.test(value);
			}, "Please enter a value.");

				$.validator.addMethod("notEqualSupervisor", function(value, element, param) {
				return this.optional(element)|| value !=$(param).val();
			}, "This email address is already taken.");


			$.validator.addMethod("notEqualAgent", function(value, element) {
  					var $element = $(element);	
  					var $emails = $('.agentEmail').not($element);
  					var emailsArray = $.map($emails, function(email) {
        				return $(email).val();
    					});		
  					  if ($.inArray($element.val(), emailsArray) >= 0) {
  					  	return false;
  					  }
  					  else{
  					  	return  true;
  					  }
    			
				}, "This email address is already taken by another agent");

				$.validator.addMethod("agentExisiting", function(element, value, options) {
  					var emailerrors = 0;
					var a = 0;
					var check = false;
								//span.id = "hello";

					var inputs = document.querySelectorAll("#msform input[name='agentemail[]']");
					    
					for(i=0; i < inputs.length; i++){
					//console.log('i: '+ (i+1) + ' ' + inputs.length);
							$.get( "/validateSupervisorAgent/"+fcounter+"?&agentemail="+inputs[i].value, function( data ) {
							console.log('imcondition' + data);							
							if(data == 'failed'){
								a++;
								emailerrors++;
								console.log('error' + emailerrors);
								return false;
							}
							else if (i => inputs.length && data =='passed' && emailerrors==0)
							{
								console.log('is?' + data);
								return true;
								
							}
	
					});
					 
					
				 }

				 
    			
			}, "This email address is already taken ");

	
			$('#msform fieldset').eq(0).keydown(function (e) {
			    if (e.keyCode == 13) {
			        e.preventDefault();
			        $('#next').click();    
			        return false;
			    }
			});
			$('#msform fieldset').eq(1).keydown(function (e) {
			    if (e.keyCode == 13) {
			        e.preventDefault();
			        $('#next2').click();
			        return false;
			    }
			});
			$('#msform fieldset').eq(2).keydown(function (e) {
			    if (e.keyCode == 13) {
			     	  $('#submit').click();
			    }
			});
			$(".next").click(function(e){
				e.preventDefault();
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
						groupname: 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,
						},
						sfirstname: 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,


						},
						slastname: 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,

						},
						sEmail: 
						{
							required: true,
							maxlength: 45,
						},
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
							notEqualSupervisor: "#sEmail",
							notEqualAgent:true,
							agentExisiting: true
						}
					},
					messages: 
					{
						groupname: 
						{
							required: "Group name is required.",
						},
						sfirstname:
						{
							required: "Supervisor's firstname is required."
						},
						slastname:
						{
							required: "Supervisor's lastname is required."
						},
						sEmail:
						{
							required: "Supervisor's email is required."
						},
						"agentfname[]":
						{
							required: "Agent's firstname is required."
						},
						"agentlname[]":
						{
							required: "Agent's lastname is required."
						},
						"agentemail[]":
						{
							required: "Agent's email is required."
						},
					},
				});
			  	if(form.valid()==true)
				{
					a = $(this);
					emailCheck = false;
					if(fcounter==0){
						$.get( "/validateGroup?groupname="+document.getElementsByName('groupname')[0].value, function( data ) {
						 	if(data == 'passed'){
						 		current_fs = a.parent();
								next_fs = a.parent().next();
								//activate next step on progressbar using the index of next_fs
								$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
							
								//show the next fieldset
								next_fs.show("slow"); 
								current_fs.hide();
								fcounter++;
							}
						 	else{
						 		var span = document.createElement("span");
						 		span.className = "error-block";
						 		if(data == 'failed')
									var text = document.createTextNode("Group name already existing.");
								else if(data == 'whitespace')
									var text = document.createTextNode("Please enter valid group name.");
								span.appendChild(text);
								var element = document.getElementById('this-group');
								element.appendChild(span);
						 	}
						});
					}
					//console.log(a.parent());
					//console.log(fcounter);
					else if(fcounter==1){
						/*
						$.get( "/validateSupervisor?sfirstname="+document.getElementsByName('sfirstname')[0].value+
							"&slastname="+document.getElementsByName('slastname')[0].value+
							"&sEmail="+document.getElementsByName('sEmail')[0].value, function( data )*/
						$.get( "/validateSupervisorAgent/"+fcounter+"?&sEmail="+document.getElementsByName('sEmail')[0].value, function( data ) {
						 	if(data == 'passed'){
						 		current_fs = a.parent();
								next_fs = a.parent().next();


								//activate next step on progressbar using the index of next_fs
								$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
							
								//show the next fieldset
								next_fs.show("slow"); 
								current_fs.hide();

								fcounter++;
							}
						 	else{
						 		var span = document.createElement("span");
						 		span.className = "error-block";
						 		if(data == 'failed'){
									var text = document.createTextNode("Email already existing.");
									var element = document.getElementById('this-semail');
						 		}
						 		/*
								 if(data == 'spacefirst'){
									var text = document.createTextNode("Please enter valid first name.");
									var element = document.getElementById('this-sfirstname');
								}
								 if(data == 'spacelast'){
									var text = document.createTextNode("Please enter valid last name.");
									var element = document.getElementById('this-slastname');
								}
								 if(data == 'spaceemail'){
									var text = document.createTextNode("Please enter valid email address.");
									var element = document.getElementById('this-semail');
								}*/
								span.appendChild(text);
									
								element.appendChild(span);
						 	}
						});
					}
			

			$("#submit").click(function(e){			  
					return true;
				
			});					//endsss submit
				
					//this comes from the custom easing plugin
	}
			});

			$(".previous").click(function(){	
				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();
				
				//de-activate current step on progressbar
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
				
				//show the previous fieldset
				current_fs.hide(); 
				previous_fs.show("slow");
				fcounter--;

			});
		
			$("#submit-additional-agent").click(function(e){
				$.validator.addMethod("nowhitespace", function(value, element) {
					//console.log('annyeong');
					return this.optional(element)|| /^[a-zA-Z]+/i.test(value);
				}, "Please enter a value.");
				if(form.valid()==true)
					return true;
			});
		});
	</script>
@stop
