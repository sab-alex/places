<template>
    <gmap-marker
            :clickable="true"
            :position="position"
            @click="clickMarker">
    </gmap-marker>   
</template>

<script>
    export default {
        props: {
            place: Object
        },
        data() {
            return {
               
            }
        },
        methods: {
            clickMarker() {
               this.$emit('onMarkerClick', this.place);
            },
        },
        computed:{
            position() {
                return { lat: this.place.lat, lng: this.place.lng };
            },
        }
    }
</script>
