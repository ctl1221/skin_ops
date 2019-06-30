    <template>
    <tr>
        <td>
            <select v-model="sel_sellable_type" class="form-control-sm">
                <option value="App\Product">Products</option>
                <option value="App\Service">Services</option>
                <option value="App\Package">Packages</option>
                <option value="App\Membership">Memberships</option>
            </select>
        </td>

        <td>
            <select v-model="sel_sellable_id" class="form-control-sm">
                <option v-for="(x, index) in sellables" 
                        v-if="x.sellable_type == sel_sellable_type && x.sellable.is_active == 1" 
                        :value="x.sellable_id">{{x.sellable.name}}
                </option>
            </select>
        </td>

        <td>
            <vue-numeric v-model="sel_price" :disabled="sel_price_disabled" class="text-center"></vue-numeric>
        </td>

        <td>
            <select v-model="sel_sold_by_id" class="form-control-sm">
                <option value="">----------------------</option>
                <option v-for="(x, index) in employees" 
                        :value="x.id">{{x.last_name + ', ' + x.first_name }}
                </option>
            </select>
        </td>

        <template v-if="sel_sellable_type == 'App\\Service'">
            <td>
                <select v-model="sel_treated_by_id" class="form-control-sm"> 
                    <option value="">----------------------</option>
                    <option v-for="(x, index) in employees" 
                            v-if="x.is_aesthetician == 1 || x.is_doctor == 1"
                            :value="x.id">{{x.last_name + ', ' + x.first_name }}
                    </option>
                </select>
            </td>

            <td>
                <select v-model="sel_assisted_by_id" class="form-control-sm">
                    <option value="">----------------------</option>
                    <option v-for="(x, index) in employees" 
                            v-if="x.is_aesthetician == 1"
                            :value="x.id">{{x.last_name + ', ' + x.first_name }}
                    </option>
                </select>
            </td>
        </template>

        <template v-else>

            <td>

            </td>

            <td>

            </td>
        </template>

        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" 
                @click="$emit('linedeleted')">
                <i class="fas fa-trash-alt"></i>
            </button>
            
        </td>

    </tr>
</template>

<script>

    export default {
        props: ['sellables','employees'],
        
        data() {
            return {
                sel_sellable_type: this.sellables[0].sellable_type,
                sel_sellable_id: this.sellables[0].sellable_id,
                sel_price: this.sellables[0].price,
                sel_sold_by_id: '',
                sel_treated_by_id: '',
                sel_assisted_by_id: '',
                sel_price_disabled: true,
            };
        },

        computed: {
            selecteds: function ()
            {
                return `${this.sel_sellable_type}|${this.sel_sellable_id}|${this.sel_price}|${this.sel_sold_by_id}|${this.sel_treated_by_id}|${this.sel_assisted_by_id}`;
            },
        },

        watch: {
            sel_sellable_type: function(newVal, oldVal)
            {
                for(let i = 0; i < this.sellables.length; i++)
                {
                    if(this.sellables[i].sellable_type == newVal && this.sellables[i].sellable.is_active == 1)
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
                        this.sel_price_disabled = this.sellables[i].sellable.price_edit_enabled ? false : true;
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
                    sold_by_id: this.sel_sold_by_id,
                    treated_by_id: this.sel_treated_by_id,
                    assisted_by_id: this.sel_assisted_by_id,
                });
            },
        },
        
        mounted() {
            for(let i = 0; i < this.sellables.length; i++)
            {
                if(this.sellables[i].sellable.is_active == 1)
                {
                    this.sel_sellable_type = this.sellables[i].sellable_type;
                    this.sel_sellable_id = this.sellables[i].sellable_id;
                    this.sel_price = this.sellables[i].price;
                    return;
                }
            }
        }
    }
</script>
