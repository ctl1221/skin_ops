<template>
    
    <div class="container">
        <div class="form-group-row mb-4">
            <input v-show="mode == 'claim'" type="text" class="form-control" name="selected_give_others_id" v-model="selected_give_others" disabled>
        </div>

        <table class= "table table-bordered table-fullwidth table-sm" v-show="mode == 'claim'">
            <tr>
                <th class="text-center bg-secondary text-white"><h5 class="mb-1 mt-1">Search for a Client</h5></th>
            </tr>
        </table>
        
        <div class="form-group">
          <label for="usr">First Name:</label>
          <input ref="first" type="text" class="form-control" id="first_name" name="first_name" v-model="first_name">
        </div>

        <div class="form-group">
          <label for="usr">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name ="last_name" v-model="last_name">
        </div>

    <br/>

    <button type="submit" class="btn btn-block btn-primary" :disabled="searchDisabled" @click.prevent="clientSearch">Search</button>
    <button type="submit" class="btn btn-block btn-primary" @click.prevent="clearResults">Clear Results</button>

    <br/>

    <input type="hidden" name="selected_give_others_id" v-model="selected_give_others_id">
    
    <table class="table table-bordered" v-if="search_results.length">
        <tr>
            <td colspan="2">Results:</td>
        </tr>

        <tr v-for="x in search_results">
            <td v-if="mode == 'search'"><a :href="'/clients/' + x.id">
                {{ x.last_name + ', ' + x.first_name }}</a>
            </td>
            <td v-if="mode == 'claim'"><button class="btn btn-link" @click.prevent="selectClient(x)">
                {{ x.last_name + ', ' + x.first_name }}</button>
            </td>
        </tr>
    </table>

    </div>

</template>

<script>
    export default {
        props:['min_char_first_name', 'min_char_last_name', 'mode'],
        data() {
            return {
                selected_give_others_id: '',
                selected_give_others: '',
                first_name:'',
                last_name:'',
                search_results:[],
            };
        },

        computed: {
            searchDisabled: function () {
                if(this.first_name.length >= parseInt(this.min_char_first_name) && this.last_name.length >= parseInt(this.min_char_last_name))
                {
                    return false;
                }
                return true;
            }
        },

        methods:{
            clientSearch: function () {
                axios.post("/api/clients/search",{
                    first_name: this.first_name,
                    last_name: this.last_name,
                })
                .then(response => {
                    this.search_results = response.data;
                });
            },
            clearResults: function () {
               this.first_name = '';
               this.last_name = '';
                this.selected_give_others_id = '';
                this.selected_give_others = '';
               this.search_results = [];
               this.$emit('clear_search');
            },

            selectClient: function(client)
            {
                this.selected_give_others = client.last_name + ', ' + client.first_name;
                this.selected_give_others_id = client.id;
                this.$emit('clientselected');
            }
        },
        mounted() {
            this.$refs.first.focus();
        }
    }
</script>
