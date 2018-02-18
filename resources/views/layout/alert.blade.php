@if(Session::has('message-success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('message-success') }}
	</div>
@endif

@if(Session::has('message-alert'))
	<div class="alert alert-error alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('message-alert') }}
	</div>
@endif