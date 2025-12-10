import { Component, OnInit, inject, signal } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { CreatureService } from '../../services/creature.service';

@Component({
  selector: 'app-creature-gallery',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './creature-gallery.component.html',
  styleUrl: './creature-gallery.component.css'
})
export class CreatureGalleryComponent implements OnInit {
  private route = inject(ActivatedRoute);
  private creatureService = inject(CreatureService);

  private readonly MAX_FILE_SIZE_MB = 5;
  private readonly MAX_FILE_SIZE_BYTES = this.MAX_FILE_SIZE_MB * 1024 * 1024;

  creatureId: number | null = null;
  creatureName = signal<string>('');
  gallery = signal<any[]>([]);
  isLoading = signal(false);
  isUploading = signal(false);
  errorMessage = signal<string | null>(null);
  selectedImage = signal<any | null>(null);

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    if (id) {
      this.creatureId = +id;
      this.loadCreature();
      this.loadGallery();
    }
  }

  loadCreature(): void {
    if (this.creatureId) {
      this.creatureService.getById(this.creatureId).subscribe({
        next: (creature) => {
          this.creatureName.set(creature.name);
        },
        error: (error) => {
          console.error('Error loading creature:', error);
        }
      });
    }
  }

  loadGallery(): void {
    if (this.creatureId) {
      this.isLoading.set(true);
      this.creatureService.getGallery(this.creatureId).subscribe({
        next: (gallery) => {
          this.gallery.set(gallery);
          this.isLoading.set(false);
        },
        error: (error) => {
          this.errorMessage.set('Hiba történt a galéria betöltése során.');
          this.isLoading.set(false);
          console.error('Error loading gallery:', error);
        }
      });
    }
  }

  onFileSelected(event: Event): void {
    const input = event.target as HTMLInputElement;
    if (input.files && input.files.length > 0) {
      const file = input.files[0];
      
      if (!file.type.startsWith('image/')) {
        alert('Kérjük, csak képfájlt töltsön fel!');
        return;
      }

      if (file.size > this.MAX_FILE_SIZE_BYTES) {
        alert(`A fájl mérete nem haladhatja meg a ${this.MAX_FILE_SIZE_MB}MB-ot!`);
        return;
      }

      this.uploadImage(file);
    }
  }

  uploadImage(file: File): void {
    if (this.creatureId) {
      this.isUploading.set(true);
      this.errorMessage.set(null);

      this.creatureService.uploadImage(this.creatureId, file).subscribe({
        next: () => {
          this.isUploading.set(false);
          this.loadGallery();
        },
        error: (error) => {
          this.isUploading.set(false);
          this.errorMessage.set('Hiba történt a kép feltöltése során.');
          console.error('Error uploading image:', error);
        }
      });
    }
  }

  openImage(image: any): void {
    this.selectedImage.set(image);
  }

  closeImage(): void {
    this.selectedImage.set(null);
  }
}
