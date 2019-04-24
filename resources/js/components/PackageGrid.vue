<template>

    <div>
        
        <input type="hidden" name="package_grid_lines" :value="JSON.stringify(package_grid_lines)">

        <table class="table table-bordered">
            <gridline 
            v-for="(x,index) in package_grid_lines"
            :sellables="sellables" 
            :key="index"
            @lineupdated="updateLine(index, $event)"
            @linedeleted="deleteLine(index)"
            ></gridline>
        </table>

        <button @click.prevent="addLine">Add Item</button>

    </div>

</template>

<script>
    import gridline from './PackageGridLine.vue'

    export default {
        components: { gridline },
        props: ['sellables'],
        data() {
            return {
                package_grid_lines: [],
            };
        },

        methods: {
            addLine: function(){
                this.package_grid_lines.push({
                  sellable_type : this.sellables[0].sellable_type,
                  sellable_id : this.sellables[0].sellable_id,
                  quantity: 1,
              });
            },

            deleteLine: function(index){
                this.package_grid_lines.splice(index,1);

                for(let i = 0; i < this.package_grid_lines.length; i++)
                {
                  this.$children[i].sel_sellable_type = this.package_grid_lines[i].sellable_type;
                  this.$children[i].sel_sellable_id = this.package_grid_lines[i].sellable_id;
                  this.$children[i].sel_quantity = this.package_grid_lines[i].quantity;
                }
            },

            updateLine: function(index, event){
                this.package_grid_lines[index].sellable_type = event.sellable_type;
                this.package_grid_lines[index].sellable_id = event.sellable_id;
                this.package_grid_lines[index].quantity = parseFloat(event.quantity);
            },
        },

mounted() {
    this.addLine();
}
}
</script>
