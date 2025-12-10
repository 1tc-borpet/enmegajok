import { Category } from './category.model';
import { Ability } from './ability.model';
import { GalleryImage } from './gallery.model';

export interface Creature {
  id: number;
  name: string;
  description: string;
  category_id: number;
  category?: Category;
  user_id?: number;
  abilities?: Ability[];
  gallery?: GalleryImage[];
  created_at?: string;
  updated_at?: string;
}

export interface CreateCreatureRequest {
  name: string;
  description: string;
  category_id: number;
}

export interface UpdateCreatureRequest {
  name?: string;
  description?: string;
  category_id?: number;
}
