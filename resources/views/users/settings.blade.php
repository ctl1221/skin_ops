@extends ('master')

@section('heading')

  My Settings

@endsection


@section ('contents')
	
<form class="form-inline" method="POST" action="/settings">

  @csrf

    <div class="form-group mx-sm-3 mb-2">
      <label for="branch">Update Current User Branch:</label>
    </div>

    <div class="form-group mx-sm-3">
        <select class="form-control" name="branch_id">
          @foreach($branches as $x)
            <option value="{{ $x->id }}" {{ $x->id == auth()->user()->branch_id ? 'selected' : '' }}>{{ $x->name }}</option>
          @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>

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
