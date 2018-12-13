import { Component } from '@angular/core';
import {HttpClient} from '@angular/common/http';


interface Media{
  title;
  type;
  author;
}
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Mon application';
  url='';
  type=0;

  medias:Media[]=[];


  constructor(private http: HttpClient){
    this.url='http://localhost:8000/media/json';
    this.http.get(this.url).subscribe((medias:Media[])=>{
      this.medias = medias;
    })
  }
  loan(){
    console.log('emprunter');
    
  }
}
