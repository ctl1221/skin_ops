@extends ('master')

@section('heading')

  My Dashboard

@endsection


@section ('contents')
	
  <div class="container">
    <div class="row">
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            Under Construction
            <br/>
            <br/>
            <br/>
            <br/>
          </div>
        </div>
      </div>
      <div class="col-3">

        <table class="table table-bordered table-fullwidth table-striped">
          <tr>
            <th class="text-center">Appointments for Today</th>
          </tr>
          <tr>
            <td class="text-center">
              Charles Licup<br/>Time<br/>BasicFacial
            </td>
          </tr>
        </table>
      </div>
    </div>
</div>

  
@endsection

@section('scripts')
  
  <script type="text/javascript">
	var app = new Vue({
  		
  		el: '#app',
  		data: {			  				
  		},
	});
  </script>

@endsection
