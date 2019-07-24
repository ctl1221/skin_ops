<template>
    <div class="card mt-3">
        <div class="card-header">
            {{ date_string }} - {{ total_sales | currencyFormat }}
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
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
                    <td>Skin Consultation</td>
                    <td class="text-right">{{ skin_consultation_sales | currencyFormat }}</td>
                </tr>
                <tr>
                    <td>Dental Consultation</td>
                    <td class="text-right">{{ dental_consultation_sales | currencyFormat}}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['date_string','date'],
        data(){
            return {
                skin_consultation_sales:'',
                dental_consultation_sales:'',
            }
        },
        computed: {
            total_sales: function()
            {
                var total = 0;
                total += this.skin_consultation_sales;
                total += this.dental_consultation_sales;
                return total;
            },
        },
        created() {
            axios.post('/api/daily/total_sales').then(  response=>{
                this.total_sales = response.data;
            });

            //Skin 
            axios.post('/api/daily/skin_consultation', {
                date: this.date,
            }).then(  response=>{
                this.skin_consultation_sales = response.data;
            });

            axios.post('/api/daily/dental_consultation', {
                date: this.date,
            }).then(  response=>{
                this.dental_consultation_sales = response.data;
            });
        }
    }
</script>
