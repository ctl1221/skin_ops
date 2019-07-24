<template>
    <div class="card mt-3">
        <div class="card-body">
            <table>
                <tr>
                    <th colspan="2">{{ date }}</th>
                </tr>
                <tr>
                    <td>Total Sales</td>
                    <td>{{ total_sales }}</td>
                </tr>
                <tr>
                    <td>Products</td>
                </tr>
                <tr>
                    <td>Services</td>
                </tr>
                <tr>
                    <td>Dental Sales</td>
                </tr>
                <tr>
                    <td>Consultation</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['date'],
        data(){
            return {
                total_sales:'',
            }
        },
        created() {
            axios.post('/api/daily/total_sales').then(  response=>{
                this.total_sales = response.data;
            });
        }
    }
</script>
