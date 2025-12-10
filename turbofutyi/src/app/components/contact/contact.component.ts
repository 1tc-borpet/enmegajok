import { Component, inject, signal } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { ContactService } from '../../services/contact.service';

@Component({
  selector: 'app-contact',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './contact.component.html',
  styleUrl: './contact.component.css'
})
export class ContactComponent {
  private fb = inject(FormBuilder);
  private contactService = inject(ContactService);

  private readonly SUCCESS_MESSAGE_TIMEOUT_MS = 5000;

  contactForm: FormGroup;
  isLoading = signal(false);
  isSuccess = signal(false);
  errorMessage = signal<string | null>(null);

  constructor() {
    this.contactForm = this.fb.group({
      name: ['', [Validators.required, Validators.minLength(3)]],
      email: ['', [Validators.required, Validators.email]],
      subject: ['', [Validators.required, Validators.minLength(5)]],
      message: ['', [Validators.required, Validators.minLength(20)]]
    });
  }

  onSubmit(): void {
    if (this.contactForm.valid) {
      this.isLoading.set(true);
      this.errorMessage.set(null);
      this.isSuccess.set(false);

      this.contactService.sendMessage(this.contactForm.value).subscribe({
        next: () => {
          this.isLoading.set(false);
          this.isSuccess.set(true);
          this.contactForm.reset();
          
          setTimeout(() => {
            this.isSuccess.set(false);
          }, this.SUCCESS_MESSAGE_TIMEOUT_MS);
        },
        error: (error) => {
          this.isLoading.set(false);
          this.errorMessage.set('Hiba történt az üzenet küldése során. Kérjük, próbálja újra később.');
          console.error('Error sending message:', error);
        }
      });
    }
  }

  get name() {
    return this.contactForm.get('name');
  }

  get email() {
    return this.contactForm.get('email');
  }

  get subject() {
    return this.contactForm.get('subject');
  }

  get message() {
    return this.contactForm.get('message');
  }
}
