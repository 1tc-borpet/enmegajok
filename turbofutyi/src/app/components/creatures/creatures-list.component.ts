import { Component, OnInit, inject, signal } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { CreatureService } from '../../services/creature.service';
import { Creature } from '../../models/creature.model';

@Component({
  selector: 'app-creatures-list',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './creatures-list.component.html',
  styleUrl: './creatures-list.component.css'
})
export class CreaturesListComponent implements OnInit {
  private creatureService = inject(CreatureService);

  creatures = signal<Creature[]>([]);
  isLoading = signal(true);
  errorMessage = signal<string | null>(null);

  ngOnInit(): void {
    this.loadCreatures();
  }

  loadCreatures(): void {
    this.isLoading.set(true);
    this.errorMessage.set(null);

    this.creatureService.getAll().subscribe({
      next: (creatures) => {
        this.creatures.set(creatures);
        this.isLoading.set(false);
      },
      error: (error) => {
        this.errorMessage.set('Hiba történt a lények betöltése során.');
        this.isLoading.set(false);
        console.error('Error loading creatures:', error);
      }
    });
  }

  deleteCreature(id: number, event: Event): void {
    event.preventDefault();
    event.stopPropagation();

    if (confirm('Biztosan törölni szeretné ezt a lényt?')) {
      this.creatureService.delete(id).subscribe({
        next: () => {
          this.creatures.update(list => list.filter(c => c.id !== id));
        },
        error: (error) => {
          alert('Hiba történt a törlés során.');
          console.error('Error deleting creature:', error);
        }
      });
    }
  }
}
