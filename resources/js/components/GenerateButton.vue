<template>
  <div class="container">
    <input type="text" id="altText"  class="text-field" v-model="altText"/>
    <button @click="sendData" id="generate_button" class="btn" type="button">Generate</button>
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
      altText: '',
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
          .then(response => response.json())
          .then(data => {
            this.altText = data.altText;
          })
          .catch(error => {
            console.log(error)
          })
    }
  },
};
</script>
