<template>
    <div class="container">

        <input type="hidden" name="payment_lines" :value="JSON.stringify(payments)">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Reference</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(x, index) in payment_types">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" 
                                class="form-check-input" 
                                v-model="payments[index].checked">
                            <label class="form-check-label">
                                {{x.name}}
                            </label>    
                        </div>
                    </td>

                    <td>
                        <input type="number" 
                            class="form-control" 
                            v-model="payments[index].amount"
                            :disabled="!payments[index].checked"
                            required>
                    </td>

                    <td>
                        <input type="text" 
                            class="form-control" 
                            v-model="payments[index].reference"
                            :disabled="!payments[index].checked">
                    </td>  

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
