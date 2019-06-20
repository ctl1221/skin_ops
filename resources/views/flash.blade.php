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
