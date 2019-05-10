import {Component, ElementRef, Input} from '@angular/core';

@Component({
  selector: 'app-create-contato',
  templateUrl: './createContato.component.html',
  styleUrls: ['./createContato.component.css']
})
export class CreateContatoComponent {

  // Declara Variaveis do componente
  @Input('csrf') csrf;

  constructor(elm: ElementRef) {
    // Pega o CSRF informado como atributo
    this.csrf = elm.nativeElement.getAttribute('csrf');
  }
}
