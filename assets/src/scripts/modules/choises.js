import Choices from 'choices.js'
export default class ClientChoises {
  constructor() {
    this.init()
  }
  init() {
    const $choices = $('.wv-select-js-choice-orderby')
    for (let i = 0; i < $choices.length; i++) {
      const el = $choices[i];
      new Choices(el,
        { searchEnabled: false }
      );
    }
  }
}