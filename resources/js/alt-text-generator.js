import GenerateButton from './components/GenerateButton.vue';

Statamic.booting(() => {
  Statamic.$components.register('generate_button-fieldtype', GenerateButton);
});
