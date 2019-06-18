@extends ('master')

@section('heading')
	Edit Payment Type: {{ $payment_type->name }}
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/payment_types/{{ $payment_type->id }}/update">
			@method('patch')
			@csrf

		<form class = "form-horizontal">

		<div class="form-group">
			<label for="payment_type">Name:</label>
			<input type="text" class="form-control" name="name" value="{{ $payment_type->name }}" required>
		</div>

		<br>

		Tick all that applies:

		<br/><br/>

		<div class="form-check">
			<label class="form-check-label">
			    <input type="checkbox" class="form-check-input" name ="is_direct" value="1" {{ $payment_type->is_direct ? "checked": ""}}>Direct
			</label>
		</div>

		<div class="form-check">
			<label class="form-check-label">
			    <input type="checkbox" class="form-check-input" name ="is_external" value="1" {{ $payment_type->is_external ? "checked": ""}}>External
			</label>
		</div>

		<div class="form-check">
			<label class="form-check-label">
			    <input type="checkbox" class="form-check-input" name ="is_addable" value="1" {{ $payment_type->is_addable ? "checked": ""}}>Addable
			</label>
		</div>

		<div class="form-check">
			<label class="form-check-label">
			    <input type="checkbox" class="form-check-input" name ="is_subtractable" value="1" {{ $payment_type->is_subtractable ? "checked": ""}}>Subtractable
			</label>
		</div>

		<br/>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/payment_types"><button type="button" class="btn btn-danger">Cancel</button>
		
		</form>

	</div>

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