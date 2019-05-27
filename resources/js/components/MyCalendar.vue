<template>

    <div class="container">

        <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Book an Appointment
        </button>

        <button type="button" class="btn btn-primary" @click="toggleTime = !toggleTime" v-model="toggleTime">
            <span v-if="toggleTime">Compress</span>
            <span v-else>Expand</span>
        </button>
    </div>
    
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label">Book an Appointment</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="start">Start:</label>
                        <input type="date" class="form-control" id="start" name="start">
                    </div>
                    <div class="form-group">
                        <label for="start">End:</label>
                        <input type="date" class="form-control" id="end" name="end">
                    </div>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="start">Content:</label>
                        <input type="text" class="form-control" id="content" name="content">
                    </div>
                    
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="createEvent">Save changes</button>
            </div>

        </div>
    </div>
    </div>

    <vue-cal style="height: 500px"
    :time="toggleTime"
    default-view="week"
    :disable-views="['years','year']"

    :time-from="12 * 60" 
    :time-to="22 * 60" 
    :time-step="30"

    :events="events"

    today-button
    :12Hour="true"

    editable-events
    class="vuecal--full-height-delete"

    :no-event-overlaps="true"

    @event-title-change="editEvent($event)"


    ></vue-cal>

    </div>

</template>

<script>
    import VueCal from 'vue-cal'
    import 'vue-cal/dist/vuecal.css'

    export default {
        components: { VueCal },
        data() {
            return {
                toggleTime: true,
                events: [],

            };
          },
        methods: {
            getAllEvents: function() {
                axios.post('/api/appointments').then(response=>{
                    this.events = response.data;
                });
            },
            createEvent: function() {
                axios.post('/appointments').then(response=>{
                    this.getAllEvents();
                }, this);
            },

            editEvent: function(event) {
                axios.post('/appointments/' + event.id + '/edit', event).then(response=>{
                    this.getAllEvents();
                }, this);
            },
        },
        mounted () {
            this.getAllEvents();
        },
    }
</script>

<style type="text/css">
    
    .vuecal__event.appointment {background-color: rgba(253, 156, 66, 0.9);border: 1px solid rgb(233, 136, 46);color: #fff;}
    .vuecal__event.dr_appointment {background-color: rgba(164, 230, 210, 0.9);border: 1px solid rgb(144, 210, 190);}
    .vuecal__event.dt_appointment {background-color: rgba(255, 102, 102, 0.9);border: 1px solid rgb(235, 82, 82);color: #fff;}

</style>
