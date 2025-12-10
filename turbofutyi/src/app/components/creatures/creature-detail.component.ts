import { Component, OnInit, inject, signal } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { CreatureService } from '../../services/creature.service';
import { AbilityService } from '../../services/ability.service';
import { Creature } from '../../models/creature.model';
import { Ability } from '../../models/ability.model';

@Component({
  selector: 'app-creature-detail',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './creature-detail.component.html',
  styleUrl: './creature-detail.component.css'
})
export class CreatureDetailComponent implements OnInit {
  private route = inject(ActivatedRoute);
  private router = inject(Router);
  private creatureService = inject(CreatureService);
  private abilityService = inject(AbilityService);

  creature = signal<Creature | null>(null);
  allAbilities = signal<Ability[]>([]);
  isLoading = signal(true);
  errorMessage = signal<string | null>(null);
  showAbilityModal = signal(false);

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    this.loadCreature(id);
    this.loadAbilities();
  }

  loadCreature(id: number): void {
    this.isLoading.set(true);
    this.creatureService.getById(id).subscribe({
      next: (creature) => {
        this.creature.set(creature);
        this.isLoading.set(false);
      },
      error: (error) => {
        this.errorMessage.set('Hiba történt a lény betöltése során.');
        this.isLoading.set(false);
        console.error('Error loading creature:', error);
      }
    });
  }

  loadAbilities(): void {
    this.abilityService.getAll().subscribe({
      next: (abilities) => {
        this.allAbilities.set(abilities);
      },
      error: (error) => {
        console.error('Error loading abilities:', error);
      }
    });
  }

  deleteCreature(): void {
    const creature = this.creature();
    if (creature && confirm('Biztosan törölni szeretné ezt a lényt?')) {
      this.creatureService.delete(creature.id).subscribe({
        next: () => {
          this.router.navigate(['/creatures']);
        },
        error: (error) => {
          alert('Hiba történt a törlés során.');
          console.error('Error deleting creature:', error);
        }
      });
    }
  }

  openAbilityModal(): void {
    this.showAbilityModal.set(true);
  }

  closeAbilityModal(): void {
    this.showAbilityModal.set(false);
  }

  addAbility(abilityId: number): void {
    const creature = this.creature();
    if (creature) {
      this.creatureService.addAbility(creature.id, abilityId).subscribe({
        next: () => {
          this.loadCreature(creature.id);
          this.closeAbilityModal();
        },
        error: (error) => {
          alert('Hiba történt a képesség hozzáadása során.');
          console.error('Error adding ability:', error);
        }
      });
    }
  }

  removeAbility(abilityId: number): void {
    const creature = this.creature();
    if (creature && confirm('Biztosan el szeretné távolítani ezt a képességet?')) {
      this.creatureService.removeAbility(creature.id, abilityId).subscribe({
        next: () => {
          this.loadCreature(creature.id);
        },
        error: (error) => {
          alert('Hiba történt a képesség eltávolítása során.');
          console.error('Error removing ability:', error);
        }
      });
    }
  }

  hasAbility(abilityId: number): boolean {
    const creature = this.creature();
    return creature?.abilities?.some(a => a.id === abilityId) || false;
  }
}
