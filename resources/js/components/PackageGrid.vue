<template>

    <div>
        
        <input type="hidden" name="package_grid_lines" :value="JSON.stringify(package_grid_lines)">

        <table class="table table-sm table-bordered text-center">
            
            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Quantity</th>
                <th></th>
            </tr>

            <slot name="insert"></slot>

            <gridline 
            v-for="(x,index) in package_grid_lines"
            :sellables="sellables" 
            :key="x.id"
            @lineupdated="updateLine(index, $event)"
            @linedeleted="deleteLine(index)"
            ></gridline>

            <tr>
                <td colspan="4" class="justify-content-center">
                    <button class="btn btn-info btn-sm" @click.prevent="addLine">Add Item</button>
                </td>
            </tr>

        </table>

        
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
                next_id: 1,
            };
        },

        methods: {
            addLine: function(){
                this.package_grid_lines.push({
                    id: this.next_id++,
                    sellable_type : this.sellables[0].sellable_type,
                    sellable_id : this.sellables[0].sellable_id,
                    quantity: 1,
              });
            },

            deleteLine: function(index){
                this.package_grid_lines.splice(index,1);
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
