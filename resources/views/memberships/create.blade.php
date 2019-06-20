@extends ('master')

@section('heading')
	Add New Membership
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/memberships">

		 @csrf

		  <div class="form-group">
		    <label for="membership_name">Name:</label>
		    <input type="text" class="form-control" id="membership_name" name="membership_name" required>
		  </div>

		  <package-grid :sellables="{{ $sellables }}">
		  	<template v-slot:insert>
				<tr>
				  	<td class="text-left">&nbsp;&nbsp;Product</td>
				  	<td class="text-left">&nbsp;&nbsp;{{ $membership_product }}</td>
				  	<td class="text-left">&nbsp;&nbsp;&nbsp;1</td>
				  	<td class="text-left"></td>
				</tr>
			</template>
		  </package-grid>

		  <br/>
		  
		  <div class="form-group">
		    <label for="days_valid">Days Valid:</label>
		    <input type="text" class="form-control" id="days_valid" name="days_valid" required>
		  </div>

		  <div class="form-group">
		    <label for="price">Price:</label>
		    <input type="text" class="form-control" id="price" name="price" required>
		  </div>

		  <button type="submit" class="btn btn-primary">Create</button>
		  
		  <a href="/memberships"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

@endsection

@section('scripts')

<script type="text/javascript">

var app = new Vue({
  el: '#app', 
  data: {},
})

</script>

@endsection