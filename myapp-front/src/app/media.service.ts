import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MediaService {
  endMediaLoaning(media_id: any, user: string): any {
    throw new Error("Method not implemented.");
  }

  private urlServer:string=
  'http://localhost:8000/';
  constructor(private http: HttpClient) { }

  getMedias(){
    //on renvoie un observable donc la promesse (premier partie du traitement asyncrhone)
    //le service sera traité ensuite coté composant
    return  this.http.get(this.urlServer + 'media/json');
  }

  newMediaLoaning(media_id:number, user:string)
  {
    return this.http.post(this.urlServer + 'loaning/api',
      {media_id: media_id, user: user} );
  }
  //Anciens emprunts

  getPastLoaning(){
    return this.http.get(this.urlServer + 'loaning/history');
  }
}
