<template>
  <div disabled="this.isLoading">
    <button
      id="requestButton"
      class="btn"
      type="button"
      @click="handleButtonClick"
    >
      Generate
    </button>
    <div v-if="isLoading" class="loading-indicator">
      Generating alt text...
    </div>
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
      responseData: this.responseData,
      data: this.value,
    };
  },

  watch: {
    data(data) {
      this.update(data);
    },
  },

  methods: {

    handleButtonClick() {
      this.isLoading = true;
      this.sendDataToBackend();
    },

    async sendDataToBackend() {
      const bodyData = {
        imageUrl: window.location.href,
        textLanguage: this.meta.language,
      };

      const jsonBody = JSON.stringify(bodyData);
      const response = await fetch('/api/altTextGeneratorEndpoint', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: jsonBody,
      });

      const responseData = await response.text();

      try {
        const data = JSON.parse(responseData);
        console.log(data);
        const altText = data.altText;
        localStorage.setItem('altTextToStore', altText);
        const textField = document.querySelector('input[name="alt_de"]');
        this.update(textField, { elementId: altText });
        this.isLoading = false;
      } catch (error) {
        console.log(error);
      }
    },

  },
};
</script>
