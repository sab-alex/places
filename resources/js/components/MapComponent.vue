<template>
    <div class="container">
        <app-search @onFind="onFindPlace"
                    @onSelectPlace="onSelectPlace"/>

        <gmap-map :center="center"
                  :zoom="9"
                  style="width:100%;  height: 400px;"
                  ref="map"
                  class="map-container">

            <app-marker v-for="(place, index) in markers"
                        :key="index"
                        :place="place"
                        @onMarkerClick="onMarkerClick"/>
                        
            <app-marker v-if="currentPlace"
                        :place="currentPlace"
                        @onMarkerClick="onMarkerClick"/>          

            <app-info-window    v-if="selectedMarker"
                                :place="selectedMarker" 
                                :open="infoWindowOpen"
                                @onCloseInfoWindow="closeInfoWindow"
                                @onCreatePlace="onCreatePlace"
                                @onDeletePlace="onDeletePlace"/>
        </gmap-map>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                center: { lat: 55.768479, lng: 37.566148 },
                markers: [],
                currentPlace: null,
                selectedMarker: null,
                infoWindowOpen: false
            }
        },

        mounted() {
            axios.get('/place').then( response => (this.markers = response.data) );   
        },
        methods: {
            onMarkerClick(place) {
                this.selectedMarker = place;
                this.infoWindowOpen = true;    
            },
            closeInfoWindow(){
                this.infoWindowOpen = false;  
            },
            onFindPlace(place) {
               if(this.currentPlace == this.selectedMarker) {
                   this.infoWindowOpen = false;
               } 
               this.currentPlace = place;
               if (place) {
                   this.center = { lat: place.lat, lng: place.lng };
               } else {
                   this.center = { lat: 55.768479, lng: 37.566148 };
               }    
            },
            onSelectPlace(place) {
                if( this.currentPlace != place) {
                    this.onFindPlace(place);
                } 
                this.onMarkerClick(place);    
            },
            onCreatePlace(place) {
                console.log(place);
                this.markers.push(place);
                this.selectedMarker = place;  
            },
            onDeletePlace(place) {
                this.infoWindowOpen = false;
                this.selectedMarker = null;
                this.markers = this.markers.filter( m => m.id != place.id); 
            }
        },
    }
</script>
<style scoped>
    .map-containerr{
        top: -20px;
    }
</style>
