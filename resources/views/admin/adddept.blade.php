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
					<div class="">
						<input type="text" name="dept_name" placeholder="Department Shortname" />
					</div>
					<textarea name="description" placeholder="Department Description" /></textarea>
					<div class="checkbox">
						<label><strong> Is the department member of CCB?</strong></label>
  						<label><input type="checkbox" value="1" id="1" name ="is_national">Yes</label>
 	 					<label><input type="checkbox" value="0" id ="2" name ="is_national">No</label>
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
				<div id="this-semail">
					<input type="email" name="email" placeholder="Department representative's email" id="email"/>
				</div>		
				<input type="button" id="previous" name="previous" class="previous action-button btndesign" value="Previous" />
				<input type="submit" id="submit" name="submit" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
@stop
@section('scripts')
<script type="text/javascript">
//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches

	$(".next").click(function(){
		if(animating) return false;
		animating = true;
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
			next_fs.show(100); 
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

$(".submit").click(function(){
	return true;
})

</script>
@stop
