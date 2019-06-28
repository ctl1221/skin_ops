<template>

  <div>

    <input type="hidden" name="sales_order_lines" :value="JSON.stringify(sales_order_lines)">
    <input type="hidden" name="client_id" v-model="client_id">

    <div class="table-responsive">
      <table class="table table-bordered table-sm mb-4">

        <thead>

          <tr>
            <th colspan="7" class="text-center bg-secondary text-white">
              <h5 class="mt-1 mb-1">Item Details</h5>
            </th>
          </tr>

          <tr>
            <th>Type</th>
            <th>Item</th>
            <th>Price</th>
            <th>Sold By</th>
            <th>Treated By</th>
            <th>Assisted By</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <gridline 
            v-for="(x, index) in sales_order_lines"
            :sellables="sellables" 
            :employees="employees"
            :key="x.id"
            :price_disable="price_disable"
            @lineupdated="updateLine(index, $event)"
            @linedeleted="deleteLine(index)">
          </gridline>

          <tr>
            <td colspan="7" class="text-center">
              <button type="button" class="btn btn-info btn-sm" @click.prevent="addLine">Add Item</button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
</div>

</template>

<script>

import gridline from './SalesOrderGridLine.vue'

export default {
  components: { gridline },
  props: ['u_sellables','employees','client_id','price_disable','ordered_ids'],
  data() {
    return {
      sellables:[],
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

  watch: {
    totalPrice: function(newVal, oldVal)
    {
      this.$emit('totalpricechanged', {totalPrice: newVal});
    }
  },

  methods: {
    addLine: function(){
      this.sales_order_lines.push({
        id: this.next_id++,
        sellable_type : this.sellables[0].sellable_type,
        sellable_id : this.sellables[0].sellable_id,
        price: this.sellables[0].price,
        sold_by_id: '',
        treated_by_id: '',
        assisted_by_id: '',
      });

      this.$emit('nonzeroed');
    },

    deleteLine: function(index){
      this.sales_order_lines.splice(index,1);

      if(this.sales_order_lines.length == 0)
      {
        this.$emit('zeroed');
      }
    },

    updateLine: function(index, event)
    {
      this.sales_order_lines[index].sellable_type = event.sellable_type;
      this.sales_order_lines[index].sellable_id = event.sellable_id;
      this.sales_order_lines[index].price = parseFloat(event.price);
      this.sales_order_lines[index].sold_by_id = event.sold_by_id;
      this.sales_order_lines[index].treated_by_id = event.treated_by_id;
      this.sales_order_lines[index].assisted_by_id = event.assisted_by_id;
    },
  },

  created() {
    let type = ['App\\Service','App\\Product','App\\Package','App\\Membership'];
    for(var i = 0; i < type.length; i++)
    {
      for(var j = 0; j < this.ordered_ids[type[i]].length; j++)
      {
        for(var k = 0; k < this.u_sellables.length; k++)
        {
          if(this.u_sellables[k].sellable_type == type[i])
          {
            if(this.ordered_ids[type[i]][j] == this.u_sellables[k].sellable_id)
            {
              this.sellables.push(this.u_sellables[k]);
              break;
            }
          }
        }
      }
    }
    this.addLine();
  }
}
</script>
