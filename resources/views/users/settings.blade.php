@extends ('master')

@section('heading')

  My Settings

@endsection


@section ('contents')
	
<form method="POST" action="/settings">

  @csrf

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}">
    </div>

    <div class="form-group">
      <label for="user_branch">Current User Branch:</label>
      <select class="form-control" id="user_branch" name="branch_id">
         @foreach($branches as $x)
            <option value="{{ $x->id }}" {{ $x->id == auth()->user()->branch_id ? 'selected' : '' }}>{{ $x->name }}</option>
          @endforeach
      </select>
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
