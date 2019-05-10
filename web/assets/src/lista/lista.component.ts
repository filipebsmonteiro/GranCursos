import {Component, ElementRef, Input} from '@angular/core';

@Component({
  selector: 'app-lista',
  templateUrl: './lista.component.html',
  styleUrls: ['./lista.component.css']
})
export class ListaComponent {

  // Declara Variaveis do componente
  @Input('items') items;
  @Input('acoes') acoes;
  @Input('attributes') attributes;

  constructor(elm: ElementRef) {
    // Pega Dados informados como atributos
    this.items      = elm.nativeElement.getAttribute('items');
    this.acoes      = elm.nativeElement.getAttribute('acoes');
    this.attributes = elm.nativeElement.getAttribute('attributes');
  }

  ngOnInit(){
    // Converte as Strings
    this.items      = JSON.parse(this.items);
    this.acoes      = JSON.parse(this.acoes);
    this.attributes = JSON.parse(this.attributes);

    // Ajusta Itens
    for (let i = 0; i < this.items.length; i++) {
      this.items[i] = JSON.parse(this.items[i]);
    }
  }

  montaLink(link, item){
    // Pega o atributo Ex. ID
    var atributo  = link.substring(link.lastIndexOf('{') + 1, link.lastIndexOf('}'));

    // Seleciona o atributo no item e subistitui
    var retorno   = link.replace('{'+atributo+'}', item[atributo]);

    // Adiciona o dominio
    retorno = window.location.origin + retorno;

    return retorno;
  }
}
