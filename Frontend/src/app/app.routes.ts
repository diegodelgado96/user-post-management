import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { RegisterComponent } from './Components/register/register.component';
import { LoginComponent } from './Components/login/login.component';
import { PostsComponent } from './Components/posts/posts.component'; 

export const routes: Routes = [
	{ path: 'register', component: RegisterComponent },
	{ path: 'login', component: LoginComponent },
	{ path: 'posts', component: PostsComponent },
	{ path: '', redirectTo: '/login', pathMatch: 'full' }
];

