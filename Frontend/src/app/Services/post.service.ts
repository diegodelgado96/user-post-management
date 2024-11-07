import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from "../../environments/environment";
import { ResponseApi } from "../Interfaces/responseApiInterface";

@Injectable({
	providedIn: 'root'
})
export class PostService {

	private apiUrl: string = environment.endpoint;

	constructor(private http: HttpClient) { }

	// Obtener posts por categoría
  getPostsByCategory(categoryId: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/posts/${categoryId}`);
  }

  // Crear un nuevo post
  createPost(userId: number, title: string, content: string, categoryId: number): Observable<any> {
    const data = { user_id: userId, title, content, category_id: categoryId };
    return this.http.post(`${this.apiUrl}/posts`, data);
  }
}
