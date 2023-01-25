<template>
    <div>Events</div>
    <EventList />
</template>

<script>
import EventList from "./EventList";

export default {
    name: 'App',
    components: {EventList},
    data: function () {
        return {
            events: []
        }
    },
    mounted() {
        const request = new Request('https://localhost/events', {method: 'GET'});

        fetch(request)
            .then((response) => {
                if (response.status === 200) {
                    console.log(response.json());
                } else {
                    throw new Error('Something went wrong on API server!');
                }
            })
            .then((response) => {
                console.debug(response);
                // …
            }).catch((error) => {
            console.error(error);
        });

    }
}
</script>

<style lang="less">

</style>
