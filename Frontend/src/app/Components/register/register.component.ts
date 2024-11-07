import { Component } from '@angular/core';
import { SharedModule } from '../../Modules/shared/shared.module';
import { UserService } from '../../Services/user.service';
import { RouterOutlet } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-register',
	standalone: true,
	imports: [HttpClientModule, RouterOutlet, SharedModule],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
  name: string = '';
  email: string = '';
  password: string = '';

  constructor(private apiService: UserService) { }

  register() {
    this.apiService.registerUser(this.name, this.email, this.password).subscribe(response => {
      console.log('Registration successful', response);
    }, error => {
      console.error('Error during registration', error);
    });
  }
}