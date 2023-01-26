<template>
    <div>Events</div>
    <EventList :events="events" />
</template>

<script>
import EventList from "./EventList";

export default {
    name: 'App',
    components: { EventList },
    data: function () {
        return {
            events: []
        }
    },
    mounted: async function() {
        const response = await fetch('https://localhost/api/v1/events');
        const data = await response.json()
        this.events = data;
    }
}
</script>

<style lang="less">

</style>
