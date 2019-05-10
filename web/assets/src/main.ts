import {enableProdMode} from '@angular/core';
import {platformBrowserDynamic} from '@angular/platform-browser-dynamic';

import {ListaModule} from './lista/lista.module';
import {CreateContatoModule} from './createContato/createContato.module';
import {environment} from './environments/environment';

if (environment.production) {
  enableProdMode();
}

platformBrowserDynamic().bootstrapModule(ListaModule)
    .catch(err => console.error(err));

platformBrowserDynamic().bootstrapModule(CreateContatoModule)
    .catch(err => console.error(err));
