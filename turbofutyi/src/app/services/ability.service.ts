import { Injectable, inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';
import { Ability } from '../models/ability.model';

@Injectable({
  providedIn: 'root'
})
export class AbilityService {
  private http = inject(HttpClient);
  private apiUrl = `${environment.apiUrl}/abilities`;

  getAll(): Observable<Ability[]> {
    return this.http.get<Ability[]>(this.apiUrl);
  }
}
