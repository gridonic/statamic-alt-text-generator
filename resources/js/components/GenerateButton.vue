<template>
  <div>
    <button @click="sendData" id="generate_button" class="btn" type="button">Generate</button>
    <input
        class="text-field"
        ref="input"
        type="text"
        id="altText"
        :value="value"
        :id="fieldId"
        @input="inputUpdated"
        @focus="$emit('focus')"
        @blur="$emit('blur')"
    />
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
    inputUpdated(value) {
      if (! this.config.debounce) {
        return this.update(value)
      }

      this.updateDebounced(value)
    },

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
            this.value = response.altText;

          })
          .catch(error => {
            console.log(error)
          })
    }
  },
};
</script>
