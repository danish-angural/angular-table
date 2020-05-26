import { MatPaginator } from '@angular/material/paginator';
import { Component, OnInit, ViewChild } from '@angular/core';
import { UserService } from '../../services/user.service';
import { Observable } from 'rxjs';
import {DataSource} from '@angular/cdk/collections';
import { User } from '../../models/user.models';
import { MatSort } from '@angular/material/sort';
@Component({
  selector: 'usertable',
  templateUrl: './usertable.component.html',
  styleUrls: ['./usertable.component.css']
})
export class UsertableComponent implements OnInit {
  dataSource = new UserDataSource(this.userService);
  displayedColumns = ['name', '_id', 'roll'];
  @ViewChild(MatPaginator) paginator: MatPaginator;    
  constructor(private userService: UserService) { }
  
  ngOnInit() {
    this.dataSource.paginator = this.paginator;
  }
}export class UserDataSource extends DataSource<any> {
  constructor(private userService: UserService) {
    super();
  }
  connect(): Observable<User[]> {
    return this.userService.getUser();
  }
  disconnect() {}
}