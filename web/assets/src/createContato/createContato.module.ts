import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';

import {CreateContatoComponent} from './createContato.component';

@NgModule({
  declarations: [
    CreateContatoComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [CreateContatoComponent]
})
export class CreateContatoModule { }
