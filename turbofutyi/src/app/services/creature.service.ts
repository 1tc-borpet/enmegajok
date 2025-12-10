import { Injectable, inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';
import { Creature, CreateCreatureRequest, UpdateCreatureRequest } from '../models/creature.model';

@Injectable({
  providedIn: 'root'
})
export class CreatureService {
  private http = inject(HttpClient);
  private apiUrl = `${environment.apiUrl}/creatures`;

  getAll(): Observable<Creature[]> {
    return this.http.get<Creature[]>(this.apiUrl);
  }

  getById(id: number): Observable<Creature> {
    return this.http.get<Creature>(`${this.apiUrl}/${id}`);
  }

  create(creature: CreateCreatureRequest): Observable<Creature> {
    return this.http.post<Creature>(this.apiUrl, creature);
  }

  update(id: number, creature: UpdateCreatureRequest): Observable<Creature> {
    return this.http.put<Creature>(`${this.apiUrl}/${id}`, creature);
  }

  delete(id: number): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${id}`);
  }

  addAbility(creatureId: number, abilityId: number): Observable<any> {
    return this.http.post(`${this.apiUrl}/${creatureId}/abilities`, { ability_id: abilityId });
  }

  removeAbility(creatureId: number, abilityId: number): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${creatureId}/abilities/${abilityId}`);
  }

  getGallery(creatureId: number): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/${creatureId}/gallery`);
  }

  uploadImage(creatureId: number, file: File): Observable<any> {
    const formData = new FormData();
    formData.append('image', file);
    return this.http.post(`${this.apiUrl}/${creatureId}/gallery`, formData);
  }
}
