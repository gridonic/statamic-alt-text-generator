import AltTextGeneratorInputsFieldtype from './components/AltTextGeneratorInputsFieldtype.vue';

Statamic.booting(() => {
  Statamic.$components.register('alt_text_generator_inputs-fieldtype', AltTextGeneratorInputsFieldtype);
});

