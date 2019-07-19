@extends('master')

@section ('heading')
	Slack Messages
@endsection

@section('contents')

<h5>Daily Sales</h5>

<form class="form-inline" method="post" action="/slacks/daily_sales">

	@csrf

  <input type="date" class="form-control mb-2 mr-sm-2" name="date" value="{{ Carbon\Carbon::now()->toDateString() }}" required>

  <button type="submit" class="btn btn-primary mb-2">Trigger</button>

</form>

@endsection

@section('scripts')

	<script type="text/javascript">

		var app = new Vue({

			el: '#app',
			data: {
				flash_message: "{{ session('message') }}",
				message_type: "{{ session('message_type') }}"
			},
			created: function () {

				if(this.flash_message)
				{
					Vue.toasted.show(this.flash_message, {
						type: this.message_type,
						duration: 3000,
						position: 'bottom-right',
						theme: 'outline',
					});
				}
			},
		});

	</script>

@endsection