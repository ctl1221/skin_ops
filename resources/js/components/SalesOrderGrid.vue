<template>

  <div>

    <form method="post" action="/sales_orders">

      <slot></slot>

      <input type="hidden" name="sales_order_lines" :value="JSON.stringify(sales_order_lines)">
      <input type="hidden" name="client_id" v-model="client_id">

      <table class="table table-bordered">

        <thead>
          <tr>
            <th>Type</th>
            <th>Item</th>
            <th>Price</th>
            <th></th>
         </tr>
       </thead>

        <tbody>
        <gridline 
           v-for="(x, index) in sales_order_lines"
           :sellables="sellables" 
           :key="x.id"
           :price_disable="price_disable"
           @lineupdated="updateLine(index, $event)"
           @linedeleted="deleteLine(index)"
        ></gridline>
        </tbody>

      </table>

      <h4>Total Amount: {{ totalPrice | currencyFormat }}</h4> 

      <button @click.prevent="addLine">Add Item</button>

      <br><br>

      <button>Submit</button>

      <br><br>

    </form>

  </div>

</template>

<script>

  import gridline from './SalesOrderGridLine.vue'

  export default {
    components: { gridline },
    props: ['sellables','client_id','price_disable'],
    data() {
      return {
        sales_order_lines: [],
        next_id: 1,
      };
    },

    computed: {
      totalPrice: function()
      {
        let total = 0;
        this.sales_order_lines.forEach(function (line, index) {
          total += line.price ? line.price : 0;
        });

        return total;
      }
    },

    methods: {
      addLine: function(){
        this.sales_order_lines.push({
          id: this.next_id++,
          sellable_type : this.sellables[0].sellable_type,
          sellable_id : this.sellables[0].sellable_id,
          price: this.sellables[0].price,
        });
      },
      
      deleteLine: function(index){
        this.sales_order_lines.splice(index,1);
      },

      updateLine: function(index, event)
      {
        this.sales_order_lines[index].sellable_type = event.sellable_type;
        this.sales_order_lines[index].sellable_id = event.sellable_id;
        this.sales_order_lines[index].price = parseFloat(event.price);
      },
    },

    mounted() {
      this.addLine();
    }
  }
</script>
