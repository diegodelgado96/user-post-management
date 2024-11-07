import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from "../../environments/environment";
import { ResponseApi } from "../Interfaces/responseApiInterface";

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private apiUrl: string = environment.endpoint;  

  constructor(private http: HttpClient) { }

  // Registrar un nuevo usuario
  registerUser(name: string, email: string, password: string): Observable<ResponseApi> {
    const data = { name, email, password };
    return this.http.post(`${this.apiUrl}/register`, data);
  }

  // Login de un usuario
  loginUser(email: string, password: string): Observable<ResponseApi> {
    const data = { email, password };
    return this.http.post(`${this.apiUrl}/login`, data);
	}
}
