import { Component, OnInit } from '@angular/core';
import { interval } from 'rxjs';
import { map, filter} from 'rxjs/operators';

@Component({
  selector: 'app-test',
  templateUrl: './test.component.html',
  styleUrls: ['./test.component.css']
})
export class TestComponent implements OnInit {
 notes : number[];

  constructor() { }

  ngOnInit() {
    //déclaration de variable
    //this.notes = [1,2,3,4,5];
    // let notesObs = Observable.from(this.notes);
    //console.log(notesObs);
    let source= interval(1000);
    source
    .pipe(

      map(val => val + 10),
      //map(val => val * 2),
      filter(val => val % 2 != 0)
    )
    .subscribe(val=>console.log(val));
  }

}
