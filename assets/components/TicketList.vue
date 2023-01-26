<template>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Barcode</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="ticket in tickets">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.barcode }}</td>
            <td>{{ ticket.firstname }}</td>
            <td>{{ ticket.lastname }}</td>
        </tr>
        <tr>
            <td> - </td>
            <td><input type="text" v-model="newBarcode" class="form-control"/></td>
            <td><input type="text" v-model="newFirstname" class="form-control"/></td>
            <td><input type="text" v-model="newLastname" class="form-control"/></td>
            <input @click="addTicket" type="submit" value="add" class="btn btn-outline-success"/>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "TicketList",
    props: {
        tickets: [],
        eventId: ''
    },
    data: function () {
        return {
            newBarcode: '',
            newFirstname: '',
            newLastname: ''
        }
    },
    methods: {
        addTicket: async function() {
            const newTicket = {
                barcode: this.newBarcode,
                name: this.newFirstname,
                lastname: this.newLastname
            };

            const request = new Request(
                `https://localhost/api/v1/events/${this.eventId}/tickets`,
                {method: "POST", body: JSON.stringify(newTicket)}
            );

            const response = await fetch(request);
            const data = await response.json()
            this.tickets.push(data);

            this.newBarcode = '';
            this.newFirstname = '';
            this.newLastname = '';
        }
    }
}
</script>

<style scoped>

</style>
