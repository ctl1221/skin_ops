@extends ('master')

@section('heading')
	Edit Branches
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/branches/{{$branch->id}}">

		@csrf

		<form class = "form-horizontal">

			<div class="form-group">
			    <label for="name">Name:</label>
			    <input type="text" class="form-control" id="name" name="name" value="{{ $branch->name }}" required>
			</div>

			<div class="form-group">
			    <label for="quota">Quota:</label>
			    <input type="number" class="form-control" id="quota" name="quota" value="{{ $branch->quota }}" required>
			</div>

			<color-picker v-model="colors"></color-picker>
			<input type="hidden" name="color" v-model="colors.hex">

		<br>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/branches" class="btn btn-danger">Cancel</a>

		</form>



	</div>

@endsection

@section('scripts')

<script type="text/javascript">
	var app = new Vue({
		el: '#app', 
		
		data: {
			colors: {
			  hex: '{{ $branch->color }}',
			}
		}
	})
</script>

@endsection