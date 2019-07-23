<template>
    <div class="card mt-3">
        <div class="card-body">
            <table>
                <tr>
                    <th>{{ date }}</th>
                </tr>
                <tr>
                    <td>Total Sales</td>
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
