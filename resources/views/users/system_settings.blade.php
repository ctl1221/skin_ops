@extends ('master')

@section('heading')

  System Settings

@endsection


@section ('contents')
	
<form method="POST" action="/system_settings">

  @csrf

    <div class="form-group">
      <label for="date">Data Entry Lock End Date</label>
      <input 
        type="date" 
        class="form-control" 
        name="date" id="date" 
        value="{{ $date }}">
    </div>

    <button type="submit" class="btn btn-warning">Update</button>

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
