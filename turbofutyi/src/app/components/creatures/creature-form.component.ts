import { Component, OnInit, inject, signal } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { CreatureService } from '../../services/creature.service';
import { CategoryService } from '../../services/category.service';
import { Category } from '../../models/category.model';

@Component({
  selector: 'app-creature-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterLink],
  templateUrl: './creature-form.component.html',
  styleUrl: './creature-form.component.css'
})
export class CreatureFormComponent implements OnInit {
  private fb = inject(FormBuilder);
  private route = inject(ActivatedRoute);
  private router = inject(Router);
  private creatureService = inject(CreatureService);
  private categoryService = inject(CategoryService);

  // Form validation constraints
  private readonly VALIDATION_RULES = {
    name: { minLength: 3, maxLength: 100 },
    description: { minLength: 10, maxLength: 1000 }
  };

  creatureForm: FormGroup;
  categories = signal<Category[]>([]);
  isEditMode = signal(false);
  isLoading = signal(false);
  errorMessage = signal<string | null>(null);
  creatureId: number | null = null;

  constructor() {
    this.creatureForm = this.fb.group({
      name: ['', [
        Validators.required, 
        Validators.minLength(this.VALIDATION_RULES.name.minLength), 
        Validators.maxLength(this.VALIDATION_RULES.name.maxLength)
      ]],
      description: ['', [
        Validators.required, 
        Validators.minLength(this.VALIDATION_RULES.description.minLength), 
        Validators.maxLength(this.VALIDATION_RULES.description.maxLength)
      ]],
      category_id: ['', Validators.required]
    });
  }

  ngOnInit(): void {
    this.loadCategories();
    
    const id = this.route.snapshot.params['id'];
    if (id) {
      this.isEditMode.set(true);
      this.creatureId = +id;
      this.loadCreature(this.creatureId);
    }
  }

  loadCategories(): void {
    this.categoryService.getAll().subscribe({
      next: (categories) => {
        this.categories.set(categories);
      },
      error: (error) => {
        console.error('Error loading categories:', error);
        this.errorMessage.set('Hiba történt a kategóriák betöltése során.');
      }
    });
  }

  loadCreature(id: number): void {
    this.isLoading.set(true);
    this.creatureService.getById(id).subscribe({
      next: (creature) => {
        this.creatureForm.patchValue({
          name: creature.name,
          description: creature.description,
          category_id: creature.category_id
        });
        this.isLoading.set(false);
      },
      error: (error) => {
        this.errorMessage.set('Hiba történt a lény betöltése során.');
        this.isLoading.set(false);
        console.error('Error loading creature:', error);
      }
    });
  }

  onSubmit(): void {
    if (this.creatureForm.valid) {
      this.isLoading.set(true);
      this.errorMessage.set(null);

      const formData = this.creatureForm.value;

      if (this.isEditMode() && this.creatureId) {
        this.creatureService.update(this.creatureId, formData).subscribe({
          next: (creature) => {
            this.router.navigate(['/creatures', creature.id]);
          },
          error: (error) => {
            this.isLoading.set(false);
            this.errorMessage.set('Hiba történt a mentés során.');
            console.error('Error updating creature:', error);
          }
        });
      } else {
        this.creatureService.create(formData).subscribe({
          next: (creature) => {
            this.router.navigate(['/creatures', creature.id]);
          },
          error: (error) => {
            this.isLoading.set(false);
            this.errorMessage.set('Hiba történt a létrehozás során.');
            console.error('Error creating creature:', error);
          }
        });
      }
    }
  }

  get name() {
    return this.creatureForm.get('name');
  }

  get description() {
    return this.creatureForm.get('description');
  }

  get category_id() {
    return this.creatureForm.get('category_id');
  }
}
