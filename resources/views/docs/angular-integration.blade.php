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
            <h3 class="text-xl font-semibold mb-4">Login e Token Management</h3>
            
            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">Endpoint Login</h4>
                <div class="bg-gray-100 p-3 rounded">
                    <code>POST /api/login</code>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">Request Body</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "email": "user@example.com",
  "password": "password123"
}</code></pre>
            </div>

            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">Response</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "token": "1|abc123...",
  "role": "admin",
  "user_id": 1,
  "success": true
}</code></pre>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <h4 class="text-lg font-medium mb-2">Angular Service Example</h4>
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

            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">GET /api/v1/movies/{id} (Dettaglio)</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  // ... dati base della lista +
  "description": "Movie description...",
  "backdrop": {
    "url": "https://api.dobridobrev.com/storage/images/backdrop/def456.jpg",
    "sizes": {
      "w300": "https://api.dobridobrev.com/storage/images/backdrop/def456.jpg",
      "w780": "https://api.dobridobrev.com/storage/images/backdrop/def456.jpg",
      "w1280": "https://api.dobridobrev.com/storage/images/backdrop/def456.jpg",
      "original": "https://api.dobridobrev.com/storage/images/backdrop/def456.jpg"
    },
    "width": 1920,
    "height": 1080,
    "format": "jpg"
  },
  "persons": [...],
  "trailers": [...],
  "video_files": [
    {
      "video_file_id": 1,
      "title": "Example Movie - Full Movie",
      "format": "mp4",
      "resolution": "720p",
      "stream_url": "https://api.dobridobrev.com/api/v1/stream-video/movie123.mp4",
      "public_stream_url": "https://api.dobridobrev.com/api/v1/public-video/movie123.mp4"
    }
  ]
}</code></pre>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular Movies Service</h3>
            
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
        </div>
    </section>

    <!-- Video Streaming Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">🎥 Video Streaming per Angular</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Endpoint Streaming</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-red-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Streaming Protetto</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>GET /api/v1/stream-video/{filename}</code>
                    </div>
                    <p class="text-sm text-gray-600">Richiede autenticazione Bearer token</p>
                    <p class="text-sm text-gray-600">Supporta HTTP Range requests per seeking</p>
                </div>
                
                <div class="bg-green-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Streaming Pubblico</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>GET /api/v1/public-video/{filename}</code>
                    </div>
                    <p class="text-sm text-gray-600">Accesso pubblico senza autenticazione</p>
                    <p class="text-sm text-gray-600">Ideale per trailer e anteprime</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular Video Player Component</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// video-player.component.ts
import { Component, Input } from '@angular/core';
import { AuthService } from './auth.service';

@Component({
  selector: 'app-video-player',
  template: `
    <video 
      #videoPlayer
      [src]="getVideoUrl()"
      controls
      preload="metadata"
      [poster]="posterUrl"
      class="w-full h-auto">
      Your browser does not support the video tag.
    </video>
  `
})
export class VideoPlayerComponent {
  @Input() videoFile: any;
  @Input() posterUrl: string = '';
  @Input() usePublicStream: boolean = false;

  constructor(private auth: AuthService) {}

  getVideoUrl(): string {
    if (!this.videoFile) return '';
    
    const baseUrl = this.usePublicStream 
      ? this.videoFile.public_stream_url 
      : this.videoFile.stream_url;
    
    // Add auth token for protected streams
    if (!this.usePublicStream && this.auth.token) {
      return `${baseUrl}?token=${this.auth.token}`;
    }
    
    return baseUrl;
  }
}</code></pre>
        </div>
    </section>

    <!-- Error Handling Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">⚠️ Gestione Errori</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Codici di Errore Comuni</h3>
            
            <div class="space-y-4">
                <div class="border-l-4 border-red-400 pl-4">
                    <h4 class="font-medium">401 - Unauthorized</h4>
                    <p class="text-sm text-gray-600">Token mancante o scaduto. Reindirizzare al login.</p>
                </div>
                
                <div class="border-l-4 border-yellow-400 pl-4">
                    <h4 class="font-medium">403 - Forbidden</h4>
                    <p class="text-sm text-gray-600">Ruolo insufficiente. L'utente non ha i permessi necessari.</p>
                </div>
                
                <div class="border-l-4 border-blue-400 pl-4">
                    <h4 class="font-medium">422 - Validation Error</h4>
                    <p class="text-sm text-gray-600">Errori di validazione. Controllare i campi del form.</p>
                </div>
                
                <div class="border-l-4 border-gray-400 pl-4">
                    <h4 class="font-medium">500 - Server Error</h4>
                    <p class="text-sm text-gray-600">Errore interno del server. Riprovare più tardi.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular Error Interceptor</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// error.interceptor.ts
import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpErrorResponse } from '@angular/common/http';
import { catchError } from 'rxjs/operators';
import { throwError } from 'rxjs';
import { Router } from '@angular/router';

@Injectable()
export class ErrorInterceptor implements HttpInterceptor {
  constructor(private router: Router) {}

  intercept(req: HttpRequest<any>, next: HttpHandler) {
    return next.handle(req).pipe(
      catchError((error: HttpErrorResponse) => {
        if (error.status === 401) {
          // Token scaduto, reindirizza al login
          localStorage.removeItem('auth_token');
          this.router.navigate(['/login']);
        } else if (error.status === 403) {
          // Permessi insufficienti
          console.error('Access denied');
        } else if (error.status === 422) {
          // Errori di validazione
          console.error('Validation errors:', error.error.errors);
        }
        
        return throwError(error);
      })
    );
  }
}</code></pre>
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
