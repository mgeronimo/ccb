@extends('template.dashboardadmin')

@section('title')
  Dashboard - Contact Center ng Bayan
@stop
@section('content')
	<div class="content-wrapper">
		 <div class="container">

		<section class="content">
    	<div class="row">
					<form id="msform" method="POST" action="{{url('/addgroup')}}">
							<ul id="progressbar">
								<li class="active">Group Name</li>
								<li>Supervisor's Details</li>
								<li>Agents' Details</li>
							</ul>
							<fieldset>
								<h2 class="fs-title">Enter group name</h2>
								<input type="text" name="groupname" placeholder="Group Name" class="form-control"required />
								<input type="button" id="next" name="next" class="next action-button" value="Next" />
							</fieldset>
						<fieldset>
							<h2 class="fs-title">Supervisor's details</h2>
							<input type="text"	name="sfirstname" placeholder="Supervisor's firstname" required>
							<input type="text" name="slastname" placeholder="Supervisor's lastname" required/>
							<input type="email" name="sEmail" placeholder="Email" />
							<input type="button" id="previous" name="previous" class="previous action-button" value="Previous" />
							<input type="button" id="next2" name="next" class="next action-button" value="Next" />
						</fieldset>
						<fieldset class="formgroup">
							<h2 class="fs-title">Agent Details</h2>
								<div id="addagent" class="addagent">
									<p>
										<input type="text" name="agentfname[]" placeholder="First Name" required />
										<input type="text" name="agentlname[]" placeholder="Last Name" required />
										<input type="email" name="agentemail[]" placeholder="Email" required/>
									</p>
								</div>
							<h3><a href="#" id="addBtn" class="addButton"> Add agent </a></h3>
						<input type="button" id="previous" name="previous" class="previous action-button" value="Previous" />
						<input type="submit" id="submit" id="submit" name="submit" class="submit action-button" value="Submit" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>

</section>


@stop


@section('scripts')

 <script src="assets/js/jquery-1.11.1.min.js"></script>
 <script src="assets/bower_components/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
 <script src="assets/js/jquery.easing-82496a9/jquery.easing.1.3.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	
	var wrap = $('.addagent');
	var addBtn = ('.addButton');
	i=1;
	$(addBtn).click( function(e){
		e.preventDefault();
		i++;
		$(wrap).append('<p><input type="text" name="agentfname[]" placeholder="First Name" /><input type="text" name="agentlname[]" placeholder="Last Name" /><input type="email" name="agentemail[]" placeholder="Email" /><a href="#" id="removeBtn">Remove</a></p></div>')
		
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
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
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
					errorClass: 'help-block',
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

					},
					sfirstname: 
					{
						required: true,
					},
					slastname: 
					{
						required: true,
					},
					sEmail: 
					{
						required: true,
					},


				},
				messages: 
				{
					groupname: 
					{
						required: "Groupname required",
					},
					sfirstname:
					{
						required: "Supervisor's name is required"
					},
					slastname:
					{
						required: "Supervisor's name is required"
					},
					sEmail:
					{
						required: "Supervisor's email is required"
					},
				},
	});
	 if(form.valid()==true)
	 {
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
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

$("#submit").click(function(){
	return true;
})
});
</script>




