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

    <!-- TV Series API Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">📺 TV Series API per Angular</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Endpoint TV Series</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-purple-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Lista Serie TV</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>GET /api/v1/tvseries</code>
                    </div>
                    <p class="text-sm text-gray-600">Paginazione, filtri per categoria, anno, rating</p>
                </div>
                
                <div class="bg-indigo-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Dettaglio Serie TV</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>GET /api/v1/tvseries/{id}</code>
                    </div>
                    <p class="text-sm text-gray-600">Include stagioni, episodi, cast, trailer</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Struttura Dati TV Series</h3>
            
            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">GET /api/v1/tvseries (Lista)</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "data": [
    {
      "tv_series_id": 1,
      "title": "Example TV Series",
      "year": 2024,
      "total_seasons": 3,
      "total_episodes": 30,
      "imdb_rating": 8.7,
      "status": "published",
      "category": {
        "id": 2,
        "name": "Drama"
      },
      "poster": {
        "url": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
        "sizes": {
          "w92": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
          "w154": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
          "w185": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
          "w342": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
          "w500": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
          "w780": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
          "original": "https://api.dobridobrev.com/storage/images/poster/series123.jpg"
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
                <h4 class="text-lg font-medium mb-2">GET /api/v1/tvseries/{id} (Dettaglio con Stagioni)</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  // ... dati base della lista +
  "description": "TV Series description...",
  "backdrop": {
    "url": "https://api.dobridobrev.com/storage/images/backdrop/series456.jpg",
    "sizes": {
      "w300": "https://api.dobridobrev.com/storage/images/backdrop/series456.jpg",
      "w780": "https://api.dobridobrev.com/storage/images/backdrop/series456.jpg",
      "w1280": "https://api.dobridobrev.com/storage/images/backdrop/series456.jpg",
      "original": "https://api.dobridobrev.com/storage/images/backdrop/series456.jpg"
    },
    "width": 1920,
    "height": 1080,
    "format": "jpg"
  },
  "persons": [...],
  "trailers": [...],
  "seasons": [
    {
      "season_id": 1,
      "season_number": 1,
      "title": "Season 1",
      "description": "First season...",
      "episodes_count": 10,
      "episodes": [
        {
          "episode_id": 1,
          "episode_number": 1,
          "title": "Pilot",
          "description": "First episode...",
          "duration": 45,
          "air_date": "2024-01-01",
          "status": "published",
          "video_files": [
            {
              "video_file_id": 1,
              "title": "Episode 1 - Pilot",
              "format": "mp4",
              "resolution": "720p",
              "stream_url": "https://api.dobridobrev.com/api/v1/stream-video/episode1.mp4",
              "public_stream_url": "https://api.dobridobrev.com/api/v1/public-video/episode1.mp4"
            }
          ],
          "still_images": [
            {
              "url": "https://api.dobridobrev.com/storage/images/still/ep1_still.jpg",
              "sizes": {
                "w92": "https://api.dobridobrev.com/storage/images/still/ep1_still.jpg",
                "w185": "https://api.dobridobrev.com/storage/images/still/ep1_still.jpg",
                "w300": "https://api.dobridobrev.com/storage/images/still/ep1_still.jpg",
                "original": "https://api.dobridobrev.com/storage/images/still/ep1_still.jpg"
              }
            }
          ]
        }
      ]
    }
  ]
}</code></pre>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular TV Series Service</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// tv-series.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface TvSeries {
  tv_series_id: number;
  title: string;
  year: number;
  total_seasons: number;
  total_episodes: number;
  imdb_rating: number;
  status: string;
  category: {
    id: number;
    name: string;
  };
  poster: {
    url: string;
    sizes: any;
    width: number;
    height: number;
    format: string;
  };
  description?: string;
  backdrop?: any;
  persons?: any[];
  trailers?: any[];
  seasons?: Season[];
}

export interface Season {
  season_id: number;
  season_number: number;
  title: string;
  description: string;
  episodes_count: number;
  episodes?: Episode[];
}

export interface Episode {
  episode_id: number;
  episode_number: number;
  title: string;
  description: string;
  duration: number;
  air_date: string;
  status: string;
  video_files?: any[];
  still_images?: any[];
}

@Injectable({
  providedIn: 'root'
})
export class TvSeriesService {
  private apiUrl = 'https://api.dobridobrev.com/api/v1';

  constructor(private http: HttpClient, private auth: AuthService) {}

  getTvSeries(page: number = 1, filters?: any): Observable<any> {
    let params = `?page=${page}`;
    if (filters) {
      Object.keys(filters).forEach(key => {
        if (filters[key]) {
          params += `&${key}=${encodeURIComponent(filters[key])}`;
        }
      });
    }

    return this.http.get(`${this.apiUrl}/tvseries${params}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  getTvSeries(id: number): Observable<TvSeries> {
    return this.http.get<TvSeries>(`${this.apiUrl}/tvseries/${id}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  getSeason(seriesId: number, seasonNumber: number): Observable<Season> {
    return this.http.get<Season>(`${this.apiUrl}/tvseries/${seriesId}/seasons/${seasonNumber}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  getEpisode(seriesId: number, seasonNumber: number, episodeNumber: number): Observable<Episode> {
    return this.http.get<Episode>(`${this.apiUrl}/tvseries/${seriesId}/seasons/${seasonNumber}/episodes/${episodeNumber}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  createTvSeries(seriesData: FormData): Observable<any> {
    return this.http.post(`${this.apiUrl}/tvseries`, seriesData, {
      headers: this.auth.getAuthHeaders().delete('Content-Type')
    });
  }
}</code></pre>
        </div>
    </section>

    <!-- Persons API Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">👥 Persons API per Angular</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Endpoint Persons</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-orange-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Lista Persone</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>GET /api/v1/persons</code>
                    </div>
                    <p class="text-sm text-gray-600">Attori, registi, produttori con paginazione</p>
                </div>
                
                <div class="bg-teal-50 p-4 rounded">
                    <h4 class="text-lg font-medium mb-2">Dettaglio Persona</h4>
                    <div class="bg-gray-100 p-2 rounded mb-2">
                        <code>GET /api/v1/persons/{id}</code>
                    </div>
                    <p class="text-sm text-gray-600">Include filmografia, immagini profilo</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Struttura Dati Persons</h3>
            
            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">GET /api/v1/persons (Lista)</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "data": [
    {
      "person_id": 1,
      "name": "John Doe",
      "profile_image": {
        "url": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
        "sizes": {
          "w45": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
          "w185": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
          "h632": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
          "original": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg"
        },
        "width": 300,
        "height": 450,
        "format": "jpg"
      }
    }
  ],
  "links": { ... },
  "meta": { ... }
}</code></pre>
            </div>

            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">GET /api/v1/persons/{id} (Dettaglio con Filmografia)</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>{
  "person_id": 1,
  "name": "John Doe",
  "profile_image": {
    "url": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
    "sizes": {
      "w45": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
      "w185": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
      "h632": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg",
      "original": "https://api.dobridobrev.com/storage/images/persons/john_doe.jpg"
    },
    "width": 300,
    "height": 450,
    "format": "jpg"
  },
  "movies": [
    {
      "movie_id": 1,
      "title": "Example Movie",
      "year": 2024,
      "poster": {
        "url": "https://api.dobridobrev.com/storage/images/poster/movie123.jpg",
        "sizes": { ... }
      },
      "pivot": {
        "role": "Actor",
        "character": "Main Character"
      }
    }
  ],
  "tv_series": [
    {
      "tv_series_id": 1,
      "title": "Example TV Series",
      "year": 2024,
      "poster": {
        "url": "https://api.dobridobrev.com/storage/images/poster/series123.jpg",
        "sizes": { ... }
      },
      "pivot": {
        "role": "Actor",
        "character": "Recurring Character"
      }
    }
  ]
}</code></pre>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Angular Persons Service</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// persons.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Person {
  person_id: number;
  name: string;
  profile_image: {
    url: string;
    sizes: {
      w45: string;
      w185: string;
      h632: string;
      original: string;
    };
    width: number;
    height: number;
    format: string;
  };
  movies?: MovieCredit[];
  tv_series?: TvSeriesCredit[];
}

export interface MovieCredit {
  movie_id: number;
  title: string;
  year: number;
  poster: any;
  pivot: {
    role: string;
    character: string;
  };
}

export interface TvSeriesCredit {
  tv_series_id: number;
  title: string;
  year: number;
  poster: any;
  pivot: {
    role: string;
    character: string;
  };
}

@Injectable({
  providedIn: 'root'
})
export class PersonsService {
  private apiUrl = 'https://api.dobridobrev.com/api/v1';

  constructor(private http: HttpClient, private auth: AuthService) {}

  getPersons(page: number = 1, search?: string): Observable<any> {
    let params = `?page=${page}`;
    if (search) {
      params += `&search=${encodeURIComponent(search)}`;
    }

    return this.http.get(`${this.apiUrl}/persons${params}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  getPerson(id: number): Observable<Person> {
    return this.http.get<Person>(`${this.apiUrl}/persons/${id}`, {
      headers: this.auth.getAuthHeaders()
    });
  }

  createPerson(personData: FormData): Observable<any> {
    return this.http.post(`${this.apiUrl}/persons`, personData, {
      headers: this.auth.getAuthHeaders().delete('Content-Type')
    });
  }

  updatePerson(id: number, personData: FormData): Observable<any> {
    return this.http.post(`${this.apiUrl}/persons/${id}`, personData, {
      headers: this.auth.getAuthHeaders().delete('Content-Type')
    });
  }

  // Helper method to get profile image by size
  getProfileImageUrl(person: Person, size: string = 'w185'): string {
    if (!person.profile_image || !person.profile_image.sizes) {
      return '/assets/images/default-person.jpg'; // fallback image
    }
    
    return person.profile_image.sizes[size] || person.profile_image.url;
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

    <!-- CORS Configuration Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">🌐 Configurazione CORS per Angular</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Configurazione Laravel CORS</h3>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <h4 class="text-lg font-medium mb-2">File: config/cors.php</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code><?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    
    'allowed_methods' => ['*'],
    
    'allowed_origins' => [
        'http://localhost:4200',     // Angular dev server
        'https://yourapp.com',       // Production Angular app
        'https://api.dobridobrev.com' // API domain
    ],
    
    'allowed_origins_patterns' => [],
    
    'allowed_headers' => ['*'],
    
    'exposed_headers' => [],
    
    'max_age' => 0,
    
    'supports_credentials' => true,
];
</code></pre>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                <h4 class="text-lg font-medium mb-2">Middleware CORS nel Kernel</h4>
                <p class="text-sm text-gray-600 mb-2">Assicurati che il middleware CORS sia attivo in <code>app/Http/Kernel.php</code>:</p>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// app/Http/Kernel.php
protected $middleware = [
    // ... altri middleware
    \Fruitcake\Cors\HandleCors::class,
];
</code></pre>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Configurazione Angular HttpClient</h3>
            
            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">Angular Interceptor per CORS</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// cors.interceptor.ts
import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler } from '@angular/common/http';

@Injectable()
export class CorsInterceptor implements HttpInterceptor {
  intercept(req: HttpRequest<any>, next: HttpHandler) {
    // Add CORS headers for API requests
    if (req.url.includes('api.dobridobrev.com')) {
      const corsRequest = req.clone({
        setHeaders: {
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
          'Access-Control-Allow-Headers': 'Content-Type, Authorization, Accept'
        }
      });
      return next.handle(corsRequest);
    }
    
    return next.handle(req);
  }
}

// app.module.ts
import { HTTP_INTERCEPTORS } from '@angular/common/http';

@NgModule({
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: CorsInterceptor,
      multi: true
    }
  ]
})
export class AppModule { }
</code></pre>
            </div>

            <div class="mb-4">
                <h4 class="text-lg font-medium mb-2">Angular Environment Configuration</h4>
                <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// environments/environment.ts
export const environment = {
  production: false,
  apiUrl: 'https://api.dobridobrev.com/api',
  storageUrl: 'https://api.dobridobrev.com/storage',
  corsEnabled: true
};

// environments/environment.prod.ts
export const environment = {
  production: true,
  apiUrl: 'https://api.dobridobrev.com/api',
  storageUrl: 'https://api.dobridobrev.com/storage',
  corsEnabled: true
};
</code></pre>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Test CORS Configuration</h3>
            
            <div class="space-y-4">
                <div class="border-l-4 border-green-400 pl-4">
                    <h4 class="font-medium">✅ Test con Browser DevTools</h4>
                    <p class="text-sm text-gray-600">Apri DevTools → Network → verifica che non ci siano errori CORS nelle richieste API</p>
                </div>
                
                <div class="border-l-4 border-blue-400 pl-4">
                    <h4 class="font-medium">🔧 Test con Postman</h4>
                    <p class="text-sm text-gray-600">Invia richieste OPTIONS alle tue API per verificare gli headers CORS</p>
                </div>
                
                <div class="border-l-4 border-yellow-400 pl-4">
                    <h4 class="font-medium">⚠️ Problemi Comuni</h4>
                    <ul class="text-sm text-gray-600 list-disc list-inside mt-1">
                        <li>Middleware CORS non attivo</li>
                        <li>Origins non configurati correttamente</li>
                        <li>Headers Authorization mancanti</li>
                        <li>Credenziali non supportate</li>
                    </ul>
                </div>
            </div>
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

    <!-- Practical Examples Section -->
    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">🚀 Esempi Pratici di Implementazione</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Esempio 1: Movie List Component</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// movie-list.component.ts
import { Component, OnInit } from '@angular/core';
import { MoviesService, Movie } from '../services/movies.service';

@Component({
  selector: 'app-movie-list',
  template: `
    <div class="movies-grid">
      <div *ngFor="let movie of movies" class="movie-card">
        <img 
          [src]="getPosterUrl(movie, 'w342')" 
          [alt]="movie.title"
          class="movie-poster"
          loading="lazy">
        <div class="movie-info">
          <h3>{{ movie.title }}</h3>
          <p>{{ movie.year }} • ⭐ {{ movie.imdb_rating }}</p>
          <button (click)="viewMovie(movie.movie_id)">
            Visualizza Dettagli
          </button>
        </div>
      </div>
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
      <button 
        *ngFor="let page of pages" 
        (click)="loadPage(page)"
        [class.active]="page === currentPage">
        {{ page }}
      </button>
    </div>
  `,
  styles: [`
    .movies-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
    }
    .movie-card {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .movie-poster {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
  `]
})
export class MovieListComponent implements OnInit {
  movies: Movie[] = [];
  currentPage = 1;
  pages: number[] = [];

  constructor(private moviesService: MoviesService) {}

  ngOnInit() {
    this.loadMovies();
  }

  loadMovies(page: number = 1) {
    this.moviesService.getMovies(page).subscribe(response => {
      this.movies = response.data;
      this.currentPage = page;
      this.generatePagination(response.meta);
    });
  }

  getPosterUrl(movie: Movie, size: string = 'w342'): string {
    return movie.poster?.sizes?.[size] || movie.poster?.url || '/assets/default-poster.jpg';
  }

  viewMovie(movieId: number) {
    // Navigate to movie detail page
  }

  loadPage(page: number) {
    this.loadMovies(page);
  }

  generatePagination(meta: any) {
    const totalPages = meta.last_page;
    this.pages = Array.from({length: Math.min(totalPages, 10)}, (_, i) => i + 1);
  }
}</code></pre>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Esempio 2: Video Player Component</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// video-player.component.ts
import { Component, Input, ViewChild, ElementRef } from '@angular/core';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-video-player',
  template: `
    <div class="video-container">
      <video 
        #videoPlayer
        [src]="getVideoUrl()"
        [poster]="posterUrl"
        controls
        preload="metadata"
        class="video-player"
        (loadstart)="onLoadStart()"
        (canplay)="onCanPlay()"
        (error)="onError($event)">
        Your browser does not support the video tag.
      </video>
      
      <!-- Loading indicator -->
      <div *ngIf="isLoading" class="loading-overlay">
        <div class="spinner"></div>
        <p>Caricamento video...</p>
      </div>
      
      <!-- Error message -->
      <div *ngIf="hasError" class="error-overlay">
        <p>Errore nel caricamento del video</p>
        <button (click)="retry()">Riprova</button>
      </div>
    </div>
  `,
  styles: [`
    .video-container {
      position: relative;
      width: 100%;
      background: #000;
    }
    .video-player {
      width: 100%;
      height: auto;
    }
    .loading-overlay, .error-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: rgba(0,0,0,0.8);
      color: white;
    }
    .spinner {
      border: 3px solid #f3f3f3;
      border-top: 3px solid #3498db;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  `]
})
export class VideoPlayerComponent {
  @Input() videoFile: any;
  @Input() posterUrl: string = '';
  @Input() usePublicStream: boolean = false;
  @ViewChild('videoPlayer') videoPlayer!: ElementRef<HTMLVideoElement>;

  isLoading = true;
  hasError = false;

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

  onLoadStart() {
    this.isLoading = true;
    this.hasError = false;
  }

  onCanPlay() {
    this.isLoading = false;
  }

  onError(event: any) {
    this.isLoading = false;
    this.hasError = true;
    console.error('Video loading error:', event);
  }

  retry() {
    this.hasError = false;
    this.isLoading = true;
    this.videoPlayer.nativeElement.load();
  }
}</code></pre>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Esempio 3: File Upload Component</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// file-upload.component.ts
import { Component } from '@angular/core';
import { FileUploadService } from '../services/file-upload.service';

@Component({
  selector: 'app-file-upload',
  template: `
    <div class="upload-container">
      <div class="upload-area" 
           (dragover)="onDragOver($event)"
           (dragleave)="onDragLeave($event)"
           (drop)="onDrop($event)"
           [class.drag-over]="isDragOver">
        
        <input #fileInput 
               type="file" 
               (change)="onFileSelected($event)"
               [accept]="acceptedTypes"
               style="display: none;">
        
        <div class="upload-content">
          <svg class="upload-icon" viewBox="0 0 24 24">
            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
          </svg>
          <p>Trascina i file qui o <button (click)="fileInput.click()">seleziona</button></p>
          <p class="upload-hint">{{ getUploadHint() }}</p>
        </div>
      </div>

      <!-- Upload progress -->
      <div *ngFor="let upload of uploads" class="upload-item">
        <div class="upload-info">
          <span class="filename">{{ upload.file.name }}</span>
          <span class="filesize">{{ formatFileSize(upload.file.size) }}</span>
        </div>
        
        <div class="progress-bar">
          <div class="progress-fill" [style.width.%]="upload.progress"></div>
        </div>
        
        <div class="upload-status">
          <span *ngIf="upload.status === 'uploading'">{{ upload.progress }}%</span>
          <span *ngIf="upload.status === 'completed'" class="success">✓ Completato</span>
          <span *ngIf="upload.status === 'error'" class="error">✗ Errore</span>
        </div>
      </div>
    </div>
  `,
  styles: [`
    .upload-area {
      border: 2px dashed #ccc;
      border-radius: 8px;
      padding: 40px;
      text-align: center;
      transition: all 0.3s ease;
    }
    .upload-area.drag-over {
      border-color: #007bff;
      background-color: #f8f9fa;
    }
    .upload-icon {
      width: 48px;
      height: 48px;
      fill: #6c757d;
      margin-bottom: 16px;
    }
    .upload-item {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 12px;
      border: 1px solid #dee2e6;
      border-radius: 4px;
      margin-top: 8px;
    }
    .progress-bar {
      flex: 1;
      height: 8px;
      background-color: #e9ecef;
      border-radius: 4px;
      overflow: hidden;
    }
    .progress-fill {
      height: 100%;
      background-color: #007bff;
      transition: width 0.3s ease;
    }
  `]
})
export class FileUploadComponent {
  uploads: any[] = [];
  isDragOver = false;
  uploadType: 'image' | 'video' = 'image';

  constructor(private fileUploadService: FileUploadService) {}

  get acceptedTypes(): string {
    return this.uploadType === 'image' 
      ? 'image/jpeg,image/jpg,image/png,image/webp,image/gif'
      : 'video/mp4,video/webm,video/ogg,video/mov,video/avi,video/mkv';
  }

  getUploadHint(): string {
    return this.uploadType === 'image'
      ? 'Immagini JPG, PNG, WebP, GIF (max 10MB)'
      : 'Video MP4, WebM, OGG, MOV, AVI, MKV (max 500MB)';
  }

  onDragOver(event: DragEvent) {
    event.preventDefault();
    this.isDragOver = true;
  }

  onDragLeave(event: DragEvent) {
    event.preventDefault();
    this.isDragOver = false;
  }

  onDrop(event: DragEvent) {
    event.preventDefault();
    this.isDragOver = false;
    
    const files = Array.from(event.dataTransfer?.files || []);
    this.processFiles(files);
  }

  onFileSelected(event: any) {
    const files = Array.from(event.target.files || []);
    this.processFiles(files);
  }

  processFiles(files: File[]) {
    files.forEach(file => {
      const upload = {
        file,
        progress: 0,
        status: 'uploading'
      };
      
      this.uploads.push(upload);
      
      const uploadObservable = this.uploadType === 'image'
        ? this.fileUploadService.uploadImage(file, 'poster')
        : this.fileUploadService.uploadVideo(file);
      
      uploadObservable.subscribe({
        next: (event) => {
          if (event.type === 'progress') {
            upload.progress = event.progress;
          } else if (event.type === 'complete') {
            upload.status = 'completed';
            upload.response = event.data;
          }
        },
        error: (error) => {
          upload.status = 'error';
          upload.error = error;
        }
      });
    });
  }

  formatFileSize(bytes: number): string {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  }
}</code></pre>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Esempio 4: Complete Angular Module</h3>
            
            <pre class="bg-gray-900 text-green-400 p-4 rounded overflow-x-auto"><code>// app.module.ts
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

// Services
import { AuthService } from './services/auth.service';
import { MoviesService } from './services/movies.service';
import { TvSeriesService } from './services/tv-series.service';
import { PersonsService } from './services/persons.service';
import { FileUploadService } from './services/file-upload.service';

// Interceptors
import { AuthInterceptor } from './interceptors/auth.interceptor';
import { ErrorInterceptor } from './interceptors/error.interceptor';
import { CorsInterceptor } from './interceptors/cors.interceptor';

// Components
import { MovieListComponent } from './components/movie-list.component';
import { VideoPlayerComponent } from './components/video-player.component';
import { FileUploadComponent } from './components/file-upload.component';

@NgModule({
  declarations: [
    AppComponent,
    MovieListComponent,
    VideoPlayerComponent,
    FileUploadComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [
    AuthService,
    MoviesService,
    TvSeriesService,
    PersonsService,
    FileUploadService,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: ErrorInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: CorsInterceptor,
      multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }

// app-routing.module.ts
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './guards/auth.guard';

const routes: Routes = [
  { path: '', redirectTo: '/movies', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { 
    path: 'movies', 
    component: MovieListComponent,
    canActivate: [AuthGuard]
  },
  { 
    path: 'movies/:id', 
    component: MovieDetailComponent,
    canActivate: [AuthGuard]
  },
  { 
    path: 'tv-series', 
    component: TvSeriesListComponent,
    canActivate: [AuthGuard]
  },
  { 
    path: 'upload', 
    component: FileUploadComponent,
    canActivate: [AuthGuard],
    data: { roles: ['admin'] }
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }</code></pre>
        </div>
    </section>
</div>
@endsection
