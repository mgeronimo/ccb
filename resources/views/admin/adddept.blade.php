@extends('template.dashboard')

@section('title')
	Add Group
@stop

@section('heads')
    <link rel="stylesheet" href="assets/css/styleadmin.css">
@stop

@section('page-title')
    Add Department
@stop

@section('breadcrumb')
    <li class="active">Add Department</li>
@stop

@section('content')
	<div class="row">

		<form id="fdesign" method="POST" action="{{url('adddept')}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<ul id="progressbar" class="col-md-12 col-md-push-2">
					<li class="active">Department Name</li>
					<li>Department's representative Details</li>
				</ul>
				<fieldset>
					<h2 class="fs-title">Department name</h2>
					<div id="this-dept">
						<input type="text" name="dept_name" placeholder="Department Shortname" required>
					</div>
					<input type="text" name="description" placeholder="Department Description" required></textarea>
					<div class="checkbox">
						<label class="radio-inline"><strong> Is the department member of CCB?</strong></label>
  						<label class="radio-inline"><input type="radio" value="1" id="1" name ="is_member" checked>Yes</label>
 	 					<label class="radio-inline"><input type="radio" value="0" id ="2" name ="is_member">No</label>

					</div>
					<a href="/cancel-adddept" class="action-button btndesign" style="padding: 10px 25px">Cancel</a>
					<input type="button" id="next" name="next" class="next action-button " value="Next" />
				</fieldset>
			<fieldset>
				<h2 class="fs-title">Deparment representative details</h2>
				<div id="this-sfirstname">
					<input type="text"	name="firstname" placeholder="Department representative's firstname" required>
				</div>
				<div id="this-slastname">
					<input type="text" name="lastname" placeholder="Department representative's lastname" required/>
				</div>
				<div id="this-email">
					<input type="email" name="email" placeholder="Department representative's email" id="email"/>
				</div>		
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />
<<<<<<< HEAD
				<input type="button" id="submit" name="submit" class="submit action-button" value="Submit" />
=======
				<input type="submit" id="submit" name="submit" class="submit action-button" value="Submit" />
>>>>>>> 3b54227745792d14b25a631e350f9f00edb50e13
			</fieldset>
		</form>
	</div>
@stop
<<<<<<< HEAD
@include('admin.department.add-dept-js')

=======
@section('scripts')
<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
<script type="text/javascript">
//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
	var fcounter = 0 ;
		$('#fdesign fieldset').eq(0).keydown(function (e) {
			    if (e.keyCode == 13) {
			        e.preventDefault();
			        $('#next').click();    
			        return false;
			    }
			});
		

	$.validator.addMethod("nowhitespace", function(value, element) {
				//console.log('annyeong');
				return this.optional(element)|| /^[a-zA-Z]+/i.test(value);
			}, "Please enter a value.");

	var form = $('#fdesign');
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
						dept_name: 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,
						},
						description: 
						{
							required: true,
							maxlength: 45,
							nowhitespace: true,


						},
						is_national: 
						{
							required: true,
							maxlength: 45,

						},
						firstname: 
						{
							required: true,
							maxlength: 45,
						},
						lastname: 
						{
							required: true,
							maxlength: 45,
						},
						email: 
						{
							required: true,
							maxlength: 45,
						},
			},
				messages: 
					{
						dept_name: 
						{
							required: "Department name is required.",
						},
						description:
						{
							required: "Description is required."
						},
						is_national:
						{
							required: "This is required."
						},
						firstname:
						{
							required: "Department representative's name is required."
						},
						lastname:
						{
							required: "Department representative's lastname is required."
						},
						email:
						{
							required: "Department representative's email is required."
						},
					},
		});
	$(".next").click(function(e){
		e.preventDefault();
		
		if(form.valid()==true)
		{
			a = $(this);
			if(fcounter==0){
				$.get( "/validateDepartment?dept_name="+document.getElementsByName('dept_name')[0].value, function( data ) {
						if(data == 'passed'){
							console.log('data');
							if(animating) return false;
							animating = true;
				

							current_fs = a.parent();
							next_fs = a.parent().next();
	
							$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
							next_fs.show(100); 
								fcounter++;
							current_fs.animate({opacity: 0}, {
								step: function(now, mx) {
		
									scale = 1 - (1 - now) * 0.2;
									left = (now * 50)+"%";
									opacity = 1 - now;
									current_fs.css({'transform': 'scale('+scale+')'});
									next_fs.css({'left': left, 'opacity': opacity});
								}, 
								duration: 800, 
								complete: function(){
									current_fs.hide();
									animating = false;
								}, 
		//this comes from the custom easing plugin
								easing: 'easeInOutBack'
							
							});

						}
						else {
						 		var span = document.createElement("span");
						 		span.className = "error-block";
						 		console.log('data' +data);
								var text = document.createTextNode("Group name already existing.");			
								span.appendChild(text);
								var element = document.getElementById('this-dept');
								element.appendChild(span);
						 	} 
				});
		}
	}


	});

	$(".previous").click(function(){
		if(animating) return false;
		animating = true;
	
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
		previous_fs.show(); 
		fcounter--;

	//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
		});
	});

$("#fdesign").on("submit", function(e){
	e.preventDefault();
	if(form.valid()==true)
		{	
			if(fcounter==1){
				$.get( "/validateDeptRep?email="+document.getElementsByName('email')[0].value, function( data ) { 
					if(data == 'passed'){
/*					
  					var formObj = document.getElementById('#fdesign');
  					console.log(formObj)
 				 // formObj.submit();*/
						$("fdesign").submit();
						return true;

					
        		  	console.log('data' +fdesign);
				}
					else if(data=='failed')
					{	
							console.log('data' + data);
							var span = document.createElement("span");
						 	span.className = "error-block";
						 	var text = document.createTextNode("Email already existing.");
							var element = document.getElementById('this-email');
							element.appendChild(span);


					}

				});
			}
	}
	



});


</script>

@stop
>>>>>>> 3b54227745792d14b25a631e350f9f00edb50e13
