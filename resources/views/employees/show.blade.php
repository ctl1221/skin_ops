@extends ('master')

@section ('heading')

	{{ $employee->display_name() }}
	
	<a href="/employees"><button type="button" class="btn btn-outline-primary">Back</button></a> 

	<a href="/employees/{{$employee->id}}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	@if($employee->is_active)
	<a href="/employees/{{$employee->id}}/deactivate"><button type="button" class="btn btn-outline-danger">Deactivate</button></a> 
	
	@else
	<a href="/employees/{{$employee->id}}/activate"><button type="button" class="btn btn-outline-success">Activate</button></a> 

	@endif

@endsection

@section ('contents')

	<div class="container">

		<table class="table table-sm table-bordered">
			
			<thead>
				<th>Branch</th>
				<th>Receptionist</th>
		        <th>Aesthetician</th>
		        <th>Administrator</th>
		        <th>Doctor</th>
			</thead>

			<tr>
				<td>{{ $employee->branch->name }}</td>

				@if ($employee->is_receptionist) 
			    <td><span class="badge badge-warning">Yes</span></td>
			    @else
			    <td><span class="badge badge-info">No</span></td>
			    @endif

			    @if($employee->is_aesthetician)
			    <td><span class="badge badge-warning">Yes</span></td>
			    @else
			    <td><span class="badge badge-info">No</span></td>
			    @endif

			    @if($employee->is_administrator)
			    <td><span class="badge badge-warning">Yes</span></td>
			    @else
			    <td><span class="badge badge-info">No</span></td>
			    @endif

			    @if($employee->is_doctor)
			    <td><span class="badge badge-warning">Yes</span></td>
			    @else
			    <td><span class="badge badge-info">No</span></td>
			    @endif
			</tr>

		</table>
		
	</div>

@endsection
