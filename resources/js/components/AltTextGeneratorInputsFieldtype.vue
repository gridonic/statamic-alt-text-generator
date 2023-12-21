<template>
  <div ref="node"/>
</template>

<script>


export default {
  mixins: [Fieldtype],
  props: {
    meta: Array,
    altText: String,
  },

  data() {
    return {
      isLoading: false,
    };
  },

  mounted() {
    this.init();
    const parentNode = this.parentNode();
    parentNode.addEventListener('click', () => {
      setTimeout(this.init(), 500);
    });
  },

  methods: {
    init() {
      const parentNode = this.parentNode();
      const inputNodes = parentNode.querySelectorAll('.publish-field');
      inputNodes.forEach((node) => {
        const groupNode = node.closest('.form-group');
        const labelNode = groupNode.querySelector('.publish-field-label');
        const forAttr = labelNode.getAttribute('for');
        if (forAttr.endsWith('_section')) {
          return;
        }
        if (forAttr.endsWith('_inputs')) {
          return;
        }
        if (labelNode.querySelector('.generate-button')) {
          return;
        }

        const btn = document.createElement('button');
        btn.className = 'generate-button';
        btn.id = 'generate-button';
        btn.innerHTML = '&nbsp;';
        btn.type = 'button';
        btn.setAttribute('title', 'Generate Alt-Text');
        setTimeout(() => {
          btn.addEventListener('click', (e) => {
            this.sendData(e);
          }, false);
        }, 500);
        labelNode.appendChild(btn);
      });
    },

    parentNode() {
      return this.$refs.node.closest('.publish-sections');
    },

    sendData(e) {
      let language = '';
      const parent = e.currentTarget.closest('.form-group');
      const selectedInput = parent.querySelector('.input-group')
          .querySelector('.input-text');
      if (selectedInput.getAttribute('id') === 'field_alt_de') {
        language = 'de';
      } else if (selectedInput.getAttribute('id') === 'field_alt_fr') {
        language = 'fr';
      } else if (selectedInput.getAttribute('id') === 'field_alt_en') {
        language = 'en';
      }

      const dataToSend = JSON.stringify({
        imageUrl: window.location.href,
        textLanguage: language,
      });
      fetch('/api/altTextGeneratorEndpoint', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: dataToSend,
      })
          .then((response) => response.json())
          .then((data) => {
            selectedInput.value = data.altText;
            const inputEvent = new Event('input', {
              bubbles: true,
              cancelable: true,
            });
            selectedInput.dispatchEvent(inputEvent);
          })
          .catch((error) => {
            console.log(error);
          });
    },
  },
};
</script>
