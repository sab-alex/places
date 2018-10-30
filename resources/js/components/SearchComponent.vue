<template>
    <div class="search-wrapper">
        <input class="form-control"
                v-model="search"
                @input="onSearch"
                placeholder="Enter a city"/>
        <ul v-show="isOpen"
            class="autocomplete-results">
            <li v-for="(result, i) in results"
                :key="i"
                @click="selectPlace(result)"

                class="autocomplete-result">
                    {{ result.formatted_address }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                geocoder: null,
                search: '',
                isOpen: false,
                results: []
            }
        },
        mounted() {
            this.$gmapApiPromiseLazy().then(() => {
                this.geocoder = new google.maps.Geocoder(); 
            }); 
        },
        methods: {
            onSearch() {
                if(!this.geocoder) {
                    return false;
                }
                if (this.search.length > 2) {
                    this.geocoder.geocode({address: this.search}, (results, status) => {
                        console.log('results', results);
                        if (status == google.maps.GeocoderStatus.OK) {
                            this.results = results;
                            this.isOpen = true;
                            const place = {};
                            place.name = results[0].formatted_address;
                            place.lat = results[0].geometry.location.lat();
                            place.lng = results[0].geometry.location.lng();
                            this.$emit('onFind', place);
                        } else {
                            this.results = [];
                            this.isOpen = false;
                            this.$emit('onFind', null);
                        }
                    });
                } else {
                    this.results = [];
                    this.isOpen = false;
                    this.$emit('onFind', null);
                }
            },
            selectPlace(placeGoogle) {
               this.isOpen = false;
               this.search = placeGoogle.formatted_address;
               const place = {
                    name: placeGoogle.formatted_address,
                    lat: placeGoogle.geometry.location.lat(),
                    lng: placeGoogle.geometry.location.lng()
               }; 
               this.$emit('onSelectPlace', place);
            },
        },
    }
</script>
<style scoped>
   .autocomplete-results {
    background-color: whitesmoke;   
    position: relative;
    z-index: 1;
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    height: auto;
    overflow: auto;
    width: 100%;
  }

  .autocomplete-result {
    list-style: none;
    text-align: left;
    padding: 4px 2px;
    cursor: pointer;
  }

  .autocomplete-result.is-active,
  .autocomplete-result:hover {
    background-color: #4AAE9B;
    color: white;
  }
</style>
