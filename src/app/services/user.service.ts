import { Injectable }   from '@angular/core';
import { HttpClient }   from '@angular/common/http';
import { Observable }   from 'rxjs';
import { map } from 'rxjs/operators';
import {User} from '../models/user.models';
@Injectable()
export class UserService {  private serviceUrl = 'https://myladder.app/api/assignment/tech';
  
  constructor(private http: HttpClient) { }
  
  getUser(): Observable<User[]> {
    return this.http.get<User[]>(this.serviceUrl);
  }
  
}