import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ['container', 'template'];

  add(event) {
    event.preventDefault();
    const content = this.templateTarget.innerHTML.replace(/__name__/g, Date.now());
    this.containerTarget.insertAdjacentHTML('beforeend', content);
  }
}
