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

    <div class="form-group">
      <label>Sales Color</label>
      <color-picker v-model="salesColors"></color-picker>
      <input type="hidden" name="sales_color" v-model="salesColors.hex">
    </div>

    <div class="form-group">
      <label>Payment Color</label>
      <color-picker v-model="paymentColors"></color-picker>
      <input type="hidden" name="payment_color" v-model="paymentColors.hex">
    </div>

    <div class="form-group">
      <label>Claim Color</label>
      <color-picker v-model="claimColors"></color-picker>
      <input type="hidden" name="claim_color" v-model="claimColors.hex">
    </div>

    <div class="form-group">
      <label>Gave Color</label>
      <color-picker v-model="gaveColors"></color-picker>
      <input type="hidden" name="gave_color" v-model="gaveColors.hex">
    </div>

    <div class="form-group">
      <label>Received Color</label>
      <color-picker v-model="receivedColors"></color-picker>
      <input type="hidden" name="received_color" v-model="receivedColors.hex">
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
      message_type: "{{ session('message_type') }}",

      salesColors: {
        hex: '{{ $salesColor }}',
      },

      paymentColors: {
        hex: '{{ $paymentColor }}',
      },

      claimColors: {
        hex: '{{ $claimColor }}',
      },

      gaveColors: {
        hex: '{{ $gaveColor }}',
      },

      receivedColors: {
        hex: '{{ $receivedColor }}',
      },


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
