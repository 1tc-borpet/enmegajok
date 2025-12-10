import { Routes } from '@angular/router';
import { authGuard } from './guards/auth.guard';

export const routes: Routes = [
  {
    path: 'login',
    loadComponent: () => import('./components/auth/login.component').then(m => m.LoginComponent)
  },
  {
    path: '',
    loadComponent: () => import('./components/layout/layout.component').then(m => m.LayoutComponent),
    canActivate: [authGuard],
    children: [
      {
        path: '',
        redirectTo: 'creatures',
        pathMatch: 'full'
      },
      {
        path: 'creatures',
        loadComponent: () => import('./components/creatures/creatures-list.component').then(m => m.CreaturesListComponent)
      },
      {
        path: 'creatures/new',
        loadComponent: () => import('./components/creatures/creature-form.component').then(m => m.CreatureFormComponent)
      },
      {
        path: 'creatures/:id',
        loadComponent: () => import('./components/creatures/creature-detail.component').then(m => m.CreatureDetailComponent)
      },
      {
        path: 'creatures/:id/edit',
        loadComponent: () => import('./components/creatures/creature-form.component').then(m => m.CreatureFormComponent)
      },
      {
        path: 'creatures/:id/gallery',
        loadComponent: () => import('./components/creatures/creature-gallery.component').then(m => m.CreatureGalleryComponent)
      },
      {
        path: 'contact',
        loadComponent: () => import('./components/contact/contact.component').then(m => m.ContactComponent)
      }
    ]
  },
  {
    path: '**',
    redirectTo: 'creatures'
  }
];
