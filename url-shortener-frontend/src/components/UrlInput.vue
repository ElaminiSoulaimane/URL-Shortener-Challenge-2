<template>
  <div class="row g-0">
    

    

    <div class="input-group mb-3" >
      <input type="url" style="width: 500px;" class="form-control " v-model="longUrl"  placeholder="Enter a long URL" >
      <button class="btn btn-outline-secondary" type="button" @click="shortenUrl">Button</button>
      
    </div>
    <div v-if="error" class="" style="position: fixed; top: 75px; color: brown;">
      {{ error }}
    </div>

    
  </div>
 
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      longUrl: '',
      error: null
    };
  },
  methods: {
    shortenUrl() {
      axios.post('http://localhost:8000/api/urls', { long_url: this.longUrl })
        .then(response => {
          console.log(response.data);
         
          location.reload();
        })
        .catch(error => {
          console.error(error.response.data);
          this.error = error.response.data.error;
        });
    },
  },
};
</script>
