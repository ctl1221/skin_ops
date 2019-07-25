<template>
    <div class="card mt-3">
        <div class="card-header">
            {{ date_string }} 
            <span class="float-right">{{ total_sales | currencyFormat }}</span>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <tr>
                    <td>Non-Products</td>
                    <td class="text-right">{{ service_sales | currencyFormat }}</td>
                    <td class="text-right align-middle" rowspan=3>{{ branch_sales | currencyFormat }}</td>
                </tr>
                <tr>
                    <td>Products</td>
                    <td class="text-right">{{ product_sales | currencyFormat }}</td>
                </tr>
                <tr>
                    <td>Probeauty Sales</td>
                    <td class="text-right">{{ probeauty_sales | currencyFormat }}</td>
                </tr>
                <tr>
                    <td>Booky Sales</td>
                    <td class="text-right">{{ booky_sales | currencyFormat }}</td>
                    <td class="bg-light"></td>
                </tr>

                <tr>
                    <td>Skin Consultation</td>
                    <td class="text-right">{{ skin_consultation_sales | currencyFormat }}</td>
                    <td class="bg-light"></td>
                </tr>
                 <tr>
                    <td>Dental Consultation</td>
                    <td class="text-right">{{ dental_consultation_sales | currencyFormat}}</td>
                    <td class="text-right align-middle" rowspan=2>{{ total_dental_sales | currencyFormat}}</td>
                </tr>
                <tr>
                    <td>Dental Sales</td>
                    <td class="text-right">{{ dental_sales | currencyFormat}}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['date_string','date','branch_id'],
        data(){
            return {
                total_services_sales:'',
                total_products_sales:'',
                probeauty_sales:'',
                booky_sales:'',
                dental_sales:'',
                skin_consultation_sales:'',
                dental_consultation_sales:'',
            }
        },
        computed: {

            service_sales: function()
            {
                var remain = this.total_services_sales;

                remain -= this.skin_consultation_sales;
                remain -= this.dental_consultation_sales;
                remain -= this.booky_sales;
                remain -= this.dental_sales;

                return remain;
            },

            product_sales: function()
            {
                return this.total_products_sales - this.probeauty_sales;
            },

            branch_sales: function()
            {
                var total = 0;
                total += this.service_sales;
                total += this.product_sales;
                total += this.probeauty_sales;
                return total;
            },

            total_dental_sales: function()
            {
                var total = 0;
                total += this.dental_sales;
                total += this.dental_consultation_sales;
                return total;
            },

            total_sales: function()
            {
                var total = 0;
                total += this.service_sales;
                total += this.product_sales;
                total += this.probeauty_sales;
                total += this.booky_sales;
                total += this.skin_consultation_sales;
                total += this.dental_consultation_sales;
                total += this.dental_sales;
                return total;
            },
        },
        created() {

            axios.post('/api/daily/services', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.total_services_sales = response.data;
            });

            axios.post('/api/daily/products', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.total_products_sales = response.data;
            });

            axios.post('/api/daily/probeauty', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.probeauty_sales = response.data;
            });

            axios.post('/api/daily/booky_sales', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.booky_sales = response.data;
            });

            //Skin 
            axios.post('/api/daily/skin_consultation', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.skin_consultation_sales = response.data;
            });

            axios.post('/api/daily/dental_consultation', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.dental_consultation_sales = response.data;
            });

            axios.post('/api/daily/dental_sales', {
                date: this.date,
                branch_id: this.branch_id,
            }).then(  response=>{
                this.dental_sales = response.data;
            });
        }
    }
</script>
