import { Component } from '@angular/core';
import { UserService } from '../../Services/user.service';
import { SharedModule } from '../../Modules/shared/shared.module';
import { HttpClientModule } from '@angular/common/http';
import { RouterOutlet } from '@angular/router';


@Component({
    selector: 'app-login',
    standalone: true,
    imports: [HttpClientModule, RouterOutlet, SharedModule],
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent {
    email: string = '';
    password: string = '';

    constructor(private apiService: UserService) { }

    login() {
        this.apiService.loginUser(this.email, this.password).subscribe(response => {
            console.log('Login successful', response);
        }, error => {
            console.error('Error during login', error);
        });
    }
}
