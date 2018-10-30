<template>
    <form action="/list" method="GET" ref="form">
        <div class="form-group">
            <select class="form-control mt-3" id="exampleFormControlSelect1" 
                    v-model="selectedPlace"
                    @change="onSelectPlace">
                <option class="form-control" value="">
                </option>    
                <option v-for="(place, i) in places"  class="form-control"
                        :value="place.id"
                        :key="i">
                    {{place.name}}
                </option>
            </select>
        </div>
        <input type="hidden" 
            name="order_by" 
            value="near_by"
            v-if="selectedPlace"/>

        <input type="hidden" 
            name="order_sort" 
            value="asc"
            v-if="selectedPlace"/>

        <input  type="hidden" 
            name="near_by_lat" 
            :value="near_by_lat"
            v-if="selectedPlace"/>

        <input  type="hidden" 
            name="near_by_lng" 
            :value="near_by_lng"
            v-if="selectedPlace"/>

         <input  type="hidden" 
            name="near_by_id" 
            :value="selectedPlace"
            v-if="selectedPlace"/>        
    </form>
</template>

<script>
    export default {
        props:{
            places: Array,
            id: String,
        },
        data() {
            return {
               selectedPlace: null,
            }
        },
        mounted() {
            if (this.id) {
                this.selectedPlace = this.id;
            }
        },
        methods: {
            onSelectPlace() {
                setTimeout(() => {
                    this.$refs.form.submit();
                }, 100);
            }
        },
        computed: {
            near_by_lat() {
                return this.places.find( (p) => { return  p.id == this.selectedPlace }).lat
            },
            near_by_lng() {
                return this.places.find( (p) => { return  p.id == this.selectedPlace }).lng
            },
        }
    }
</script>
