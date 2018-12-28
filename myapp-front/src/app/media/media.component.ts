import { Component, OnInit } from '@angular/core';
import { MediaService } from '../media.service';
import { delay } from 'rxjs/operators';
interface Media{
  id: number;
  title: string;
  type: string;
  author: string;
  start: string;
  end:string;
  user: string;
}
interface PastLoaning{
  start: string;
  end:string;
  user:string;
}
@Component({
  selector: 'app-media',
  templateUrl: './media.component.html',
  styleUrls: ['./media.component.css']
})
export class MediaComponent implements OnInit{

  title = 'Mon application';
  url='';
  type=0;
  mediasInit : Media[]= [];
  medias:Media[]=[];
  user:string='';
  end:string='';
  private filterTypeValue:string ='';
  private filterAuteurValue:string ='';
  showAvailable: boolean = false;
  pastLoanings:PastLoaning[]=[];



  constructor(private mediaService: MediaService){


  }
  ngOnInit(){
    this.mediaService.getMedias().subscribe((res:Media[]) => {
      this.mediasInit = res;
      this.medias = res;
    })
    this.mediaService.getPastLoaning().subscribe((res:PastLoaning[])=>{
      this.pastLoanings = res;
      console.log(this.pastLoanings);
    })
  }
  saveLoaning(media_id:number, index:number){

    this.mediaService.
    newMediaLoaning(media_id, this.user).subscribe((res : string)=> {
      console.log(res);

      // mettre le DOM à jour (en mettant à jour this.medias)
      // index permet de récupérer le positionnement du media
      // dans le tableau this.medias
      this.medias[index].end = res;
      this.medias[index].user = this.user;
    })
    //envoye requete d'emprunt

  }
    nbLoaning(): number {
   if (this.user.length > 3) {
     let loaning: Media[] = [];
     loaning = this.medias
       .filter((media: Media) => media.user == this.user);
     return loaning.length;
   } else {
     return 0;
   }
  }
  filterType(val:string){
    this.filterTypeValue = (val === '0')
    ? ''
    : val;

  this.filter();
  }

  filterAuteur(val:string){
    if(val.length > 2 ){
      this.filterAuteurValue=val;
    }else{
      this.filterAuteurValue = '';
    }
    this.filter();
  }
  private filter(){
    this.medias = this.mediasInit.filter((media:Media) => {

      let type:boolean= (this.filterTypeValue === "")
        ? true
        : media.type.toLowerCase() ===
        this.filterTypeValue.toLowerCase();

      let auteur:boolean =(this.filterAuteurValue === "")
        ? true
        : media.author.toLowerCase()
        .indexOf(this.filterAuteurValue.toLowerCase()) !== -1;

          //on retourne l'intersection des 2 filtres(type et auteur)
          return type && auteur;
    })
  }

  getPastLoaningByUser(user: string): PastLoaning[]{
    let pastLoanings =
    this.pastLoanings.
    filter((loaning:PastLoaning) => loaning.user === user);
     return pastLoanings;
 }


}
