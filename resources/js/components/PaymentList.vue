<template>
    <div>

        <input type="hidden" name="payment_lines" :value="JSON.stringify(payments)">

        <table class="table table-bordered table-sm mb-4 mt-2">
            <thead>

                <tr>
                    <th colspan="3" class="text-center bg-secondary text-white">
                        <h5 class="mt-1 mb-1">Discounts and Freebies</h5>
                    </th>
                </tr>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Reference</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(x, index) in payment_types">
                   
                    <template v-if="x.is_subtractable">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" 
                                class="form-check-input form-control-sm" 
                                v-model="payments[index].checked">
                            <label class="form-check-label form-control-sm">
                                {{x.name}}
                            </label>    
                        </div>
                    </td>

                    <td>
                        <input type="number" 
                            class="form-control form-control-sm" 
                            v-model="payments[index].amount"
                            :disabled="!payments[index].checked"
                            required>
                    </td>

                    <td>
                        <input type="text" 
                            class="form-control form-control-sm" 
                            v-model="payments[index].reference"
                            :disabled="!payments[index].checked">
                    </td>  
                    </template>

                </tr>
            </tbody>

        </table>

        <table class="table table-bordered table-sm mb-4">
            <thead>

                <tr>
                    <th colspan="3" class="text-center bg-secondary text-white">
                        <h5 class="mt-1 mb-1">Payment Modes</h5>
                    </th>
                </tr>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Reference</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(x, index) in payment_types">
                   
                    <template v-if="x.is_direct || x.is_external">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" 
                                class="form-check-input form-control-sm" 
                                v-model="payments[index].checked">
                            <label class="form-check-label form-control-sm">
                                {{x.name}}
                            </label>    
                        </div>
                    </td>

                    <td>
                        <input type="number" 
                            class="form-control form-control-sm" 
                            v-model="payments[index].amount"
                            :disabled="!payments[index].checked"
                            required>
                    </td>

                    <td>
                        <input type="text" 
                            class="form-control form-control-sm" 
                            v-model="payments[index].reference"
                            :disabled="!payments[index].checked">
                    </td>  
                    </template>

                </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
    export default {
        props: ['payment_types'],
        data() {
            return {
                payments: [],
            }
        },

        computed: {
            checkString: function()
            {
                let string = '';
                for(let i = 0; i < this.payments.length; i++)
                {
                    string += this.payments[i].checked ? '1' : '0';
                }
                return string;
            },

            totalPay: function()
            {
              let total = 0;

              this.payments.forEach(function (line, index) {
                total += line.amount ? parseFloat(line.amount) : 0;
                console.log(total);
              });

              return total;
            }
        },

        watch: {
            checkString: function(newVal, oldVal)
            {
                this.payments.forEach(function (line, index) {
                    if(!line.checked)
                    {
                        line.amount = '';
                        line.reference = '';
                    } 
                });
            },    

            totalPay: function(newVal, oldVal)
            {
                this.$emit('totalpayingchanged', {totalPay: newVal});
            }        
        },

        created() {
            for(let i = 0; i < this.payment_types.length; i++)
            {
                this.payments.push(
                    {
                        id: this.payment_types[i].id,
                        name: this.payment_types[i].name,
                        checked: false,
                        amount: '',
                        reference: '',
                     }
                );
            }
        }
    }
</script>
