<template>
  <div>
    <button @click="sendData">Generate</button>
    <input type="text" :id="altText" v-model="responseData" />
  </div>
</template>

<script>

export default {
  mixins: [Fieldtype],
  props: {
    meta: Array,
    value: String,
  },

  data() {
    return {
      isLoading: false,
      responseData: '',
    };
  },

  methods: {
    sendData() {
      let jsonBody = JSON.stringify(
          {
            imageUrl: window.location.href,
            textLanguage: this.meta.language
          }
      )
      const response = fetch('/api/altTextGeneratorEndpoint', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: jsonBody,
      })
          .then(response => {
            this.responseData = response.data;
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
};
</script>
