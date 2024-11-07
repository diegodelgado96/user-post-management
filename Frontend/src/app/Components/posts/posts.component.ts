import { Component, OnInit } from '@angular/core';
import { PostService } from '../../Services/post.service'; // Importa el servicio de posts
import { SharedModule } from '../../Modules/shared/shared.module';
import { RouterOutlet } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

@Component({
	selector: 'app-posts',
	standalone: true,
	imports: [HttpClientModule, RouterOutlet, SharedModule],
	templateUrl: './posts.component.html',
	styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
	posts: any[] = []; // Aquí se almacenarán los posts
	categoryId: number = 1; // ID de la categoría, por ejemplo

	constructor(private postService: PostService) { }

	ngOnInit(): void {
		// Llamar al servicio para obtener los posts de la categoría al inicializar
		this.getPostsByCategory(this.categoryId);
	}

	getPostsByCategory(categoryId: number): void {
		this.postService.getPostsByCategory(categoryId).subscribe(
			(data: any[]) => {
				this.posts = data; // Asignar los datos de la respuesta a la variable posts
			},
			(error) => {
				console.error('Error fetching posts:', error);
			}
		);
	}
}
