@extends ('master')

@section('heading')

List of Products
<a href="/products/create"><button type="button" class="btn btn-outline-success">+ New</button></a> 

@endsection

@section ('contents')

	<table class="table table-bordered table-sm">
	    <thead class="thead-light">
	      <tr>
	        <th>Name</th>
	        <th>Status</th>
	      </tr>
	    </thead>

	      @foreach($products as $x)
	      <tr>
	        <td><a class="text-secondary" href="/products/{{ $x->id }}"> {{ $x->name }} </a></td>
	        @if($x->is_active)
	        <td><span class="badge badge-success">Active</span></td>
	        @else
	        <td><span class="badge badge-danger">Inactive</span></td>
	        @endif

	      </tr>
	      @endforeach

	  </table>

	  {{ $products->links() }}	

@endsection
