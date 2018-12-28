import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {HttpClientModule} from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { MediaComponent } from './media/media.component';
import { AppComponent } from './app.component';
import { TestComponent } from './test/test.component';
// import { HistoryComponent } from './history/history.component';


@NgModule({
  declarations: [
    AppComponent,
    TestComponent,

    MediaComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
