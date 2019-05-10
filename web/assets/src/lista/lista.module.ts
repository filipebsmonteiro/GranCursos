import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';

import {ListaComponent} from './lista.component';

@NgModule({
  declarations: [
    ListaComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [ListaComponent]
})
export class ListaModule { }
