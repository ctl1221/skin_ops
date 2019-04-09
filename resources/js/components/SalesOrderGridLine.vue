<template>
    <tr>
        <td>
            <select v-model="sel_sellable_type">
                <option value="App\Product">Products</option>
                <option value="App\Service">Services</option>
                <option>Packages</option>
            </select>
        </td>

        <td>
            <select v-model="sel_sellable_id">
                <option v-for="(x, index) in sellables" 
                        v-if="x.sellable_type == sel_sellable_type"
                        :value="x.sellable_id">{{x.sellable.name}}
                </option>
            </select>
        </td>

        <td>
            <input type="number" v-model="sel_price" min="0" :disabled="price_disable">
        </td>

        <td>
            <button @click="$emit('linedeleted')">X</button>
        </td>

    </tr>
</template>

<script>

    export default {
        props: ['sellables','price_disable'],
        data() {
            return {
                sel_sellable_type: this.sellables[0].sellable_type,
                sel_sellable_id: this.sellables[0].sellable_id,
                sel_price: this.sellables[0].price,
            };
        },

        computed: {
            selecteds: function ()
            {
                return `${this.sel_sellable_type}|${this.sel_sellable_id}|${this.sel_price}`;
            },



        },
        watch: {
            sel_sellable_type: function(newVal, oldVal)
            {
                for(let i = 0; i < this.sellables.length; i++)
                {
                    if(this.sellables[i].sellable_type == newVal)
                    {
                        this.sel_sellable_id = this.sellables[i].sellable_id;
                        this.sel_price = this.sellables[i].price;
                        return;
                    }
                }
            },

            sel_sellable_id: function(newVal, oldVal)
            {
                for(let i = 0; i < this.sellables.length; i++)
                {
                    if(this.sellables[i].sellable_type == this.sel_sellable_type &&
                        this.sellables[i].sellable_id == newVal)
                    {
                        this.sel_price = this.sellables[i].price;
                        return;
                    }
                }
            },

            sel_price: function(newVal, oldVal)
            {
                if(newVal == '')
                {
                    this.sel_price = 0;
                }
            },

            selecteds: function(newVal, oldVal)
            {
                this.$emit('lineupdated',{
                    sellable_type : this.sel_sellable_type,
                    sellable_id : this.sel_sellable_id,
                    price: this.sel_price,
                });
            },
        },
        mounted() {
            
        }
    }
</script>
