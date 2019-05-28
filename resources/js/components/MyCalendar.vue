<template>

    <div class="container">

        <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Book an Appointment
        </button>

        <button type="button" class="btn btn-secondary" @click="toggleTime = !toggleTime" v-model="toggleTime">
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
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" v-model="date">
                    </div>
                    <div class="form-group">
                        <label for="time">Start:</label>
                        <input type="time" class="form-control" id="time" v-model="time">
                    </div>
                    <div class="form-group">
                        <label for="title">Client Name:</label>
                        <input type="text" class="form-control" id="title" v-model="title">
                    </div>
                    <div class="form-group">
                        <label for="start">Details:</label>
                        <input type="text" class="form-control" id="content" v-model="content">
                    </div>
                    <div>
                        <select v-model="color">
                            <option>Blue</option>
                            <option>Green</option>
                            <option>Orange</option>
                            <option>Yellow</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="createEvent" :disabled="! canCreateEvent">Save changes</button>
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

    class="vuecal--full-height-delete"

    editable-events
    :no-event-overlaps="false"
    :events-on-month-view="[true, 'short'][1]"

    @event-title-change="editEvent($event)"
    @event-content-change="editEvent($event)"
    @event-duration-change="editEvent($event)"
    @event-delete="deleteEvent($event)"


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
                toggleTime: false,
                events: [],
                date: '',
                time: '',
                title: '',
                content: '',
                color: 'Blue',
            };
          },
        computed: {
            canCreateEvent: function() {
                if(this.date && this.time && this.title && this.content)
                { return true; }
                return false;
            },
        },
        methods: {
            clearForm: function() {
                this.date = '';
                this.time = '';
                this.title = '';
                this.content = '';
            },

            getAllEvents: function() {
                axios.post('/api/appointments').then(response=>{
                    this.events = response.data;
                });
            },
            createEvent: function() {
                axios.post('/appointments', {
                    'date': this.date,
                    'time': this.time,
                    'title': this.title,
                    'content': this.content,
                    'color': this.color,
                }).then(response=>{
                    this.getAllEvents();
                    this.clearForm();
                }, this);
            },

            editEvent: function(event) {
                console.log(event);
                axios.post('/appointments/' + event.id + '/edit', event).then(response=>{
                    this.getAllEvents();
                }, this);
            },
            deleteEvent: function(event) {
                axios.post('/appointments/' + event.id + '/delete').then(response=>{
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

    /*//Theme Main*/
    .vuecal__menu, .vuecal__cell-events-count {background-color: #42b983;}
    .vuecal__menu li {border-bottom-color: #fff;color: #fff;}
    .vuecal__menu li.active {background-color: rgba(255, 255, 255, 0.15);}
    .vuecal__title-bar {background-color: #e4f5ef;}
    .vuecal__cell.today, .vuecal__cell.current {background-color: rgba(240, 240, 255, 0.4);}
    .vuecal:not(.vuecal--day-view) .vuecal__cell.selected {background-color: rgba(235, 255, 245, 0.4);}
    .vuecal__cell.selected:before {border-color: rgba(66, 185, 131, 0.5);}
    
    /*//Event Colors*/
    .vuecal__event.Blue {background-color: rgba(51, 153, 255, 0.9);border: 1px solid rgb(233, 136, 46);color: #fff;}
    .vuecal__event.Green {background-color: rgba(142, 232, 211, 0.9);border: 1px solid rgb(144, 210, 190);}
    .vuecal__event.Orange {background-color: rgba(255, 161, 77, 0.9);border: 1px solid rgb(235, 82, 82);color: #fff;}
    .vuecal__event.Yellow {background-color: rgba(254, 234, 158, 0.9);border: 1px solid rgb(235, 82, 82);}

</style>
