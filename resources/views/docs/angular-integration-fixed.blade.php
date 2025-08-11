@extends('docs.layout')

@section('title', 'Angular Integration Guide')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Angular Integration Guide</h1>
    
    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-8">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    <strong>Importante:</strong> Questa guida è specifica per l'integrazione con Angular e include i nuovi endpoint dedicati per upload file e streaming video.
                </p>
            </div>
        </div>
    </div>

    <!-- Authentication Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">🔐 Autenticazione per Angular</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Endpoint di Autenticazione</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-green-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Login</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>POST /api/login</code>
                    </div>
                    <p class="text-sm text-gray-600">Restituisce token Bearer e informazioni utente</p>
                </div>
                
                <div class="bg-blue-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Registrazione</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>POST /api/register</code>
                    </div>
                    <p class="text-sm text-gray-600">Crea nuovo utente con ruolo 'user'</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Risposta Login</h3>
            
            <div class="bg-gray-50 p-4 rounded">
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "token": "1|abc123def456...",
  "token_type": "Bearer",
  "role": "admin",
  "user_id": 1,
  "success": true
}</code></pre>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <h4 class="text-lg font-medium mb-2">Angular Service Example</h4>
@verbatim
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// auth.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = 'https://api.dobridobrev.com/api';
  private token: string | null = null;

  constructor(private http: HttpClient) {
    this.token = localStorage.getItem('auth_token');
  }

  login(email: string, password: string) {
    return this.http.post(`${this.apiUrl}/login`, { email, password })
      .subscribe((response: any) => {
        this.token = response.token;
        localStorage.setItem('auth_token', response.token);
        localStorage.setItem('user_role', response.role);
        localStorage.setItem('user_id', response.user_id.toString());
      });
  }

  getAuthHeaders(): HttpHeaders {
    return new HttpHeaders({
      'Authorization': `Bearer ${this.token}`,
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    });
  }
}</code></pre>
@endverbatim
            </div>
        </div>
    </section>

    <!-- File Upload Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">📁 Upload File Dedicati per Angular</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Nuovi Endpoint Dedicati</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Upload Immagini</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>POST /api/v1/upload/image</code>
                    </div>
                    <p class="text-sm text-gray-600">Formati: jpg, jpeg, png, webp, gif (max 10MB)</p>
                    <p class="text-sm text-gray-600">Tipi: poster, backdrop, still, persons</p>
                </div>
                
                <div class="bg-green-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Upload Video</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>POST /api/v1/upload/video</code>
                    </div>
                    <p class="text-sm text-gray-600">Formati: mp4, webm, ogg, mov, avi, mkv (max 500MB)</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular Upload Service</h3>
            
@verbatim
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// file-upload.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpEventType } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class FileUploadService {
  private apiUrl = 'https://api.dobridobrev.com/api/v1';

  constructor(private http: HttpClient, private auth: AuthService) {}

  uploadImage(file: File, type: string, title?: string, description?: string): Observable<any> {
    const formData = new FormData();
    formData.append('image', file);
    formData.append('type', type);
    if (title) formData.append('title', title);
    if (description) formData.append('description', description);

    return this.http.post(`${this.apiUrl}/upload/image`, formData, {
      headers: this.auth.getAuthHeaders().delete('Content-Type'), // Remove Content-Type for FormData
      reportProgress: true,
      observe: 'events'
    }).pipe(
      map(event => {
        if (event.type === HttpEventType.UploadProgress) {
          const progress = Math.round(100 * event.loaded / event.total!);
          return { type: 'progress', progress };
        } else if (event.type === HttpEventType.Response) {
          return { type: 'complete', data: event.body };
        }
        return { type: 'other', event };
      })
    );
  }

  uploadVideo(file: File, title?: string): Observable<any> {
    const formData = new FormData();
    formData.append('video', file);
    if (title) formData.append('title', title);

    return this.http.post(`${this.apiUrl}/upload/video`, formData, {
      headers: this.auth.getAuthHeaders().delete('Content-Type'),
      reportProgress: true,
      observe: 'events'
    }).pipe(
      map(event => {
        if (event.type === HttpEventType.UploadProgress) {
          const progress = Math.round(100 * event.loaded / event.total!);
          return { type: 'progress', progress };
        } else if (event.type === HttpEventType.Response) {
          return { type: 'complete', data: event.body };
        }
        return { type: 'other', event };
      })
    );
  }

  getSupportedFormats(): Observable<any> {
    return this.http.get(`${this.apiUrl}/upload/formats`, {
      headers: this.auth.getAuthHeaders()
    });
  }
}</code></pre>
@endverbatim
        </div>
    </section>

    <!-- Movies API Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">🎬 Movies API Migliorata</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Struttura Dati Migliorata</h3>
            
            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">GET /api/v1/movies (Lista)</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "data": [
    {
      "movie_id": 1,
      "title": "Example Movie",
      "year": 2024,
      "duration": 120,
      "imdb_rating": 8.5,
      "status": "published",
      "category": {
        "id": 1,
        "name": "Action"
      },
      "poster": {
        "url": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
        "sizes": {
          "w92": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
          "w154": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
          "w185": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
          "w342": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
          "w500": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
          "w780": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg",
          "original": "https://api.dobridobrev.com/storage/images/poster/abc123.jpg"
        },
        "width": 500,
        "height": 750,
        "format": "jpg"
      }
    }
  ],
  "links": { ... },
  "meta": { ... }
}</code></pre>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular Movies Service</h3>
            
@verbatim
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// movies.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Movie {
  movie_id: number;
  title: string;
  year: number;
  duration: number;
  imdb_rating: number;
  status: string;
  category: {
    id: number;
    name: string;
  };
  poster: {
    url: string;
    sizes: {
      w92: string;
      w154: string;
      w185: string;
      w342: string;
      w500: string;
      w780: string;
      original: string;
    };
    width: number;
    height: number;
    format: string;
  };
  description?: string;
  backdrop?: any;
  persons?: any[];
  trailers?: any[];
  video_files?: any[];
}

@Injectable({
  providedIn: 'root'
})
export class MoviesService {
  private apiUrl = 'https://api.dobridobrev.com/api/v1';

  constructor(private http: HttpClient, private auth: AuthService) {}

  getMovies(page: number = 1, filters?: any): Observable<any> {
    let params = `?page=${page}`;
    if (filters) {
      Object.keys(filters).forEach(key => {
        if (filters[key]) {
          params += `&${key}=${encodeURIComponent(filters[key])}`;
        }
      });
    }

    return this.http.get(`${this.apiUrl}/movies${params}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  getMovie(id: number): Observable<Movie> {
    return this.http.get<Movie>(`${this.apiUrl}/movies/${id}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  createMovie(movieData: FormData): Observable<any> {
    return this.http.post(`${this.apiUrl}/movies`, movieData, {
      headers: this.auth.getAuthHeaders().delete('Content-Type')
    });
  }
}</code></pre>
@endverbatim
        </div>
    </section>

    <!-- Best Practices Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">✅ Best Practices</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold mb-2">1. Gestione Token</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Salva il token in localStorage o sessionStorage</li>
                        <li>Includi sempre il token nelle richieste autenticate</li>
                        <li>Gestisci la scadenza del token automaticamente</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2">2. Upload File</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Usa FormData per upload multipart</li>
                        <li>Implementa progress bar per file grandi</li>
                        <li>Valida dimensioni e formati lato client</li>
                        <li>Gestisci errori di upload gracefully</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2">3. Streaming Video</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Usa streaming pubblico per trailer</li>
                        <li>Usa streaming protetto per contenuti premium</li>
                        <li>Implementa lazy loading per video</li>
                        <li>Gestisci errori di caricamento video</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2">4. Immagini Responsive</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Usa le dimensioni appropriate per ogni contesto</li>
                        <li>Implementa lazy loading per immagini</li>
                        <li>Usa placeholder durante il caricamento</li>
                        <li>Gestisci fallback per immagini mancanti</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
