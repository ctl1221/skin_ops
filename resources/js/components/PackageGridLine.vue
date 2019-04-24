<template>

        <tr>
            <td>
                <select class="form-control" v-model="sel_sellable_type">
                    <option value="Product">Product</option>
                    <option value="Service">Service</option>
                </select>
    
            </td>

            <td>
                <select class="form-control" v-model="sel_sellable_id">
                    <option v-for="x in sellables" v-if="x.sellable_type == sel_sellable_type" :value="x.sellable_id">{{ x.name }}</option>
                </select>
            </td>

            <td>
                <input class="form-control" v-model="sel_quantity" type="number" min="1">
            </td>

            <td>
                <i @click="$emit('linedeleted')" class="fas fa-trash-alt"></i>
            </td>

        </tr>
    
</template>

<script>
    export default {
        props: ['sellables'],
        
        data() {
            return {
                sel_sellable_type: this.sellables[0].sellable_type,
                sel_sellable_id: this.sellables[0].sellable_id,
                sel_quantity: 1,
            };
        },

        computed: {
            selecteds: function ()
            {
                return `${this.sel_sellable_type}|${this.sel_sellable_id}|${this.sel_quantity}`;
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
                        this.sel_quantity = 1;
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
                        this.sel_quantity = 1;
                        return;
                    }
                }
            },

            sel_quantity: function(newVal, oldVal)
            {
                if(newVal == '')
                {
                    this.sel_quantity = 1;
                }
            },

            selecteds: function(newVal, oldVal)
            {
                this.$emit('lineupdated',{
                    sellable_type : this.sel_sellable_type,
                    sellable_id : this.sel_sellable_id,
                    quantity: this.sel_quantity,
                });
            },
        },

        mounted() {
            
        }
    }
</script>
