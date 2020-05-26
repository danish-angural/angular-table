import { User } from './../../models/user.models';
import { MatPaginator } from '@angular/material/paginator';
import { Component, OnInit, ViewChild } from '@angular/core';
import { UserService } from '../../services/user.service';
import { Observable } from 'rxjs';
import {DataSource} from '@angular/cdk/collections';
import { MatSort } from '@angular/material/sort';
import { style } from '@angular/animations';
@Component({
  selector: 'usertable',
  templateUrl: './usertable.component.html',
  styleUrls: ['./usertable.component.css']
})
export class UsertableComponent implements OnInit {
  name: String="";
  roll: number=0;
  id:String="";

  dataSource = new UserDataSource(this.userService);
  displayedColumns = ['name', '_id', 'roll'];
  @ViewChild(MatPaginator) paginator: MatPaginator;    
  constructor(private userService: UserService) { }
  
  ngOnInit() {
  }
  getRecord(user: User){
    let elem: HTMLElement = document.getElementById('modal');
    this.name=user.name;
    this.id=user._id;
    this.roll=user.roll;
    elem.setAttribute("style", "display: block;")
  }
}
export class UserDataSource extends DataSource<any> {
  constructor(private userService: UserService) {
    super();
  }
  connect(): Observable<User[]> {
    return this.userService.getUser();
  }
  disconnect() {}
}