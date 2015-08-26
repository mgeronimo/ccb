@extends('template.dashboardadmin')

@section('title')
  Dashboard - Contact Center ng Bayan
@stop
@section('content')
<div class="content-wrapper">
  <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="container">
    		<div class="col-md-8">
    			<form id="addgroup" action="#">
  					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3> Add group </h3>
						</div>
						<div class="container">
						<div class="panel-body col-md-6">
							<div class="form-group">
								<fieldset>
									<label for="group">Group Name </label>
									<input id="group" name="group" class="form-control required" type="text">
								</fieldset>
							</div>
							<fieldset>	
								<div clas="form-group">
									<label for="sup"> First name of Supervisor  </label>
									<input id="supervisor" name="firstNameSupervisor" class="form-control" type="text">
								</div>
								<div clas="form-group">
									<label for="sup"> Last name of Supervisor  </label>
									<input id="supervisor" name="lastNameSupervisor" class="form-control" type="text">
								</div>
								<div class="form-group">
									<label for="sup"> Email address of Supervisor  </label>
									<input id="supervisor" name="EmailNameSupervisor" class="form-control" type="email">
								</div>
								
						</div>
				
				</form>
					</div>
			</div>
	</section>		

</div>




@stop