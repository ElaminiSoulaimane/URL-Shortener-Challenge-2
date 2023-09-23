<template>
  <div class="container">
    <div style="margin-top: 100px;">
      <div class="container d-flex justify-content-center align-items-center">
        <url-input />
      </div>

      <url-list :urls="urls" />
    </div>
  </div>
</template>

<script>
import UrlInput from './components/UrlInput.vue';
import UrlList from './components/UrlList.vue';

export default {
  data() {
    return {
      urls: [],
    };
  },
  components: {
    UrlInput,
    UrlList,
  },
};
</script>
