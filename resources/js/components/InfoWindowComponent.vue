<template>
    <gmap-info-window :options="infoOptions"
                      :position="position"
                      :opened="open" 
                      v-if="place"
                      @closeclick="closeInfoWindow">
        <div>
            <input v-model="place.name" class="form-control mb-3">
        </div>
        <div class="controls">
            <button type="button" class="btn btn-success btn-sm" v-if="isNew" @click="create">Create</button>
            <button type="button" class="btn btn-primary btn-sm" v-if="!isNew" @click="update">Update</button>
            <button type="button" class="btn btn-danger btn-sm"  v-if="!isNew" @click="destroy">Delete</button>                   
        </div>
    </gmap-info-window>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            place: Object,
            open: Boolean,
        },
        data() {
            return {
                infoContent: '',
                infoWinOpen: false,
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                },
            }
        },

        mounted() {
            console.log('here');
            this.infoWinOpen = true;
        },
        methods: {
            create() {
              axios.post('/place', this.place).then((res) => {
                this.$emit('onCreatePlace', res.data);
              });  
            },
            update() {
              axios.put('/place/' + this.place.id, this.place).then((res) => {
                this.$emit('onUpdatePlace');
              });  
            },
            destroy() {
              axios.delete('/place/' + this.place.id).then((res) => {
                this.$emit('onDeletePlace', this.place);
              }); 
            },
            closeInfoWindow() {
                this.$emit('onCloseInfoWindow');
            }
        },
        computed:{
            position() {
                return { lat: this.place.lat, lng: this.place.lng };
            },
            isNew() {
                return !this.place.hasOwnProperty('id');
            },
        }
    }
</script>
