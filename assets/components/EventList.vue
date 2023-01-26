<template>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>City</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="event in events">
            <td>{{ event.id }}</td>
            <td>{{ event.title }}</td>
            <td>{{ event.date }}</td>
            <td>{{ event.city }}</td>
            <button @click="seeDetails($event, event.id)" :key="event.id" type="button " data-bs-target="#detailsModal" data-bs-toggle="modal" class="btn btn-outline-primary">details</button>
        </tr>
        <tr>
            <td> - </td>
            <td><input type="text" v-model="newTitle" class="form-control"/></td>
            <td><datepicker v-model="newDate" /></td>
            <td><input type="text" v-model="newCity" class="form-control"/></td>
            <input @click="addEvent" type="submit" value="add" class="btn btn-outline-success"/>
        </tr>
        </tbody>
    </table>
    <div>
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ eventDetails.title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ticket-list :tickets="eventDetails.tickets" :event-id="eventDetails.id"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TicketList from "./TicketList";
import Datepicker from '@vuepic/vue-datepicker';

export default {
    name: "EventList",
    components: {TicketList, Datepicker},
    data: function () {
        return {
            newTitle: '',
            newDate: '',
            newCity: '',
            eventDetails: {}
        };
    },
    props: {
        events: Array
    },
    methods: {
        addEvent: async function(){
            const newEvent = {
                title: this.newTitle,
                date: this.newDate,
                city: this.newCity
            };

            const request = new Request(
                'https://localhost/api/v1/events',
                {method: "POST", body: JSON.stringify(newEvent)}
            );

            const response = await fetch(request);
            const data = await response.json()
            this.events.push(data);

            this.newTitle = '';
            this.newDate = '';
            this.newCity = '';
        },
        seeDetails: async function (event, id) {
            const response = await fetch('https://localhost/api/v1/events/' + id);
            const data = await response.json()
            this.eventDetails = data;
        }
    }
}
</script>

<style scoped>
</style>
