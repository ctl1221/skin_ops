<template>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Reference</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="x in payment_types">
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cash" value="1">{{x.name}}
                            </label>
                        </div>
                    </td>

                    <td>
                        <input type="text" class="form-control" name="amount" required>
                    </td>

                    <td>
                        <input type="text" class="form-control" name="reference" required>
                    </td>  

                </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
    export default {
        props: ['payment_types'],

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
