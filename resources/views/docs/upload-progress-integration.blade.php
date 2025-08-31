@extends('docs.layout')

@section('title', 'Integrazione Upload Progress')

@section('content')
<div class="container">
    <h1>Integrazione Upload Progress con Angular</h1>
    
    <div class="section">
        <h2>Panoramica</h2>
        <p>
            Questo documento descrive come integrare il sistema di tracking del progresso degli upload implementato nel backend Laravel con il frontend Angular.
            Il sistema permette di monitorare lo stato degli upload di file (immagini, video, trailer) e visualizzare una barra di progresso in tempo reale.
        </p>
    </div>

    <div class="section">
        <h2>Flusso di Funzionamento</h2>
        <ol>
            <li>Il frontend invia un file al backend tramite una richiesta HTTP</li>
            <li>Il backend genera un ID univoco per l'upload e inizia a tracciare il progresso</li>
            <li>Il backend restituisce l'ID dell'upload nella risposta</li>
            <li>Il frontend utilizza questo ID per interrogare periodicamente il backend sullo stato dell'upload</li>
            <li>Il backend risponde con informazioni sul progresso (percentuale, stato, ecc.)</li>
            <li>Il frontend aggiorna la UI in base alle informazioni ricevute</li>
        </ol>
    </div>

    <div class="section">
        <h2>Endpoint API</h2>
        <h3>Upload File</h3>
        <pre><code>POST /api/v1/upload/image
POST /api/v1/upload/video
POST /api/v1/upload/trailer</code></pre>
        
        <p>Questi endpoint accettano file tramite FormData e restituiscono un <code>upload_id</code> nella risposta.</p>
        
        <h4>Esempio di risposta:</h4>
        <pre><code>{
    "success": true,
    "data": {
        "message": "Image uploaded successfully",
        "image": { ... },
        "full_url": "https://api.example.com/storage/images/poster/file.jpg",
        "available_sizes": ["w92", "w154", "w185", "w342", "w500", "w780", "original"],
        "upload_id": "img_1630500000_abcdef123456"
    }
}</code></pre>

        <h3>Verifica Progresso</h3>
        <pre><code>GET /api/v1/upload/progress?upload_id=img_1630500000_abcdef123456</code></pre>
        
        <p>Questo endpoint restituisce informazioni sul progresso dell'upload.</p>
        
        <h4>Esempio di risposta:</h4>
        <pre><code>{
    "success": true,
    "data": {
        "upload_id": "img_1630500000_abcdef123456",
        "progress": 75.5,
        "status": "in_progress",
        "error": null
    }
}</code></pre>

        <p>Possibili valori per <code>status</code>:</p>
        <ul>
            <li><code>pending</code>: Upload in attesa di iniziare</li>
            <li><code>in_progress</code>: Upload in corso</li>
            <li><code>completed</code>: Upload completato con successo</li>
            <li><code>failed</code>: Upload fallito</li>
        </ul>
    </div>

    <div class="section">
        <h2>Integrazione con Angular</h2>
        
        <h3>Servizio Upload</h3>
        <p>Ecco un esempio di servizio Angular per gestire gli upload con tracking del progresso:</p>
        
        <pre><code>// upload.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, interval } from 'rxjs';
import { takeWhile, switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class UploadService {
  private apiUrl = 'https://api.example.com/api/v1';

  constructor(private http: HttpClient) {}

  uploadImage(file: File, type: string): Observable<any> {
    const formData = new FormData();
    formData.append('image', file);
    formData.append('type', type);
    
    return this.http.post(`${this.apiUrl}/upload/image`, formData);
  }

  uploadVideo(file: File): Observable<any> {
    const formData = new FormData();
    formData.append('video', file);
    
    return this.http.post(`${this.apiUrl}/upload/video`, formData);
  }

  uploadTrailer(file: File, title?: string): Observable<any> {
    const formData = new FormData();
    formData.append('video', file);
    if (title) {
      formData.append('title', title);
    }
    
    return this.http.post(`${this.apiUrl}/upload/trailer`, formData);
  }

  getUploadProgress(uploadId: string): Observable<any> {
    return this.http.get(`${this.apiUrl}/upload/progress?upload_id=${uploadId}`);
  }

  // Polling del progresso ogni 2 secondi fino al completamento
  pollUploadProgress(uploadId: string): Observable<any> {
    return interval(2000).pipe(
      switchMap(() => this.getUploadProgress(uploadId)),
      takeWhile(response => {
        // Continua il polling finché lo stato non è 'completed' o 'failed'
        return response.data.status !== 'completed' && response.data.status !== 'failed';
      }, true) // 'true' per includere l'ultimo valore che ha causato la fine del polling
    );
  }
}</code></pre>

        <h3>Componente Upload con Progress Bar</h3>
        <p>Ecco un esempio di componente Angular che utilizza il servizio di upload e mostra una barra di progresso:</p>
        
        <pre><code>// upload.component.ts
import { Component } from '@angular/core';
import { UploadService } from './upload.service';

@Component({
  selector: 'app-upload',
  template: `
    <div class="upload-container">
      <input type="file" (change)="onFileSelected($event)" [accept]="acceptedTypes">
      
      <button [disabled]="!selectedFile || uploading" (click)="uploadFile()">
        Upload {{ uploadType }}
      </button>
      
      <div *ngIf="uploading" class="progress-container">
        <div class="progress-bar" [style.width.%]="progress"></div>
        <div class="progress-text">{{ progress }}%</div>
        <div class="status">Status: {{ status }}</div>
      </div>
      
      <div *ngIf="errorMessage" class="error">
        {{ errorMessage }}
      </div>
    </div>
  `,
  styles: [`
    .progress-container {
      width: 100%;
      height: 20px;
      background-color: #f0f0f0;
      border-radius: 4px;
      margin: 10px 0;
      position: relative;
    }
    .progress-bar {
      height: 100%;
      background-color: #4CAF50;
      border-radius: 4px;
      transition: width 0.3s ease;
    }
    .progress-text {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      text-align: center;
      line-height: 20px;
      color: #000;
    }
    .error {
      color: red;
      margin-top: 10px;
    }
  `]
})
export class UploadComponent {
  uploadType = 'image'; // 'image', 'video', o 'trailer'
  acceptedTypes = 'image/*'; // Modificare in base al tipo di upload
  selectedFile: File | null = null;
  uploading = false;
  progress = 0;
  status = '';
  errorMessage = '';
  uploadId = '';

  constructor(private uploadService: UploadService) {}

  onFileSelected(event: any): void {
    this.selectedFile = event.target.files[0] || null;
    this.errorMessage = '';
  }

  uploadFile(): void {
    if (!this.selectedFile) return;
    
    this.uploading = true;
    this.progress = 0;
    this.status = 'pending';
    
    let uploadObservable;
    
    switch (this.uploadType) {
      case 'image':
        uploadObservable = this.uploadService.uploadImage(this.selectedFile, 'poster');
        break;
      case 'video':
        uploadObservable = this.uploadService.uploadVideo(this.selectedFile);
        break;
      case 'trailer':
        uploadObservable = this.uploadService.uploadTrailer(this.selectedFile);
        break;
      default:
        this.errorMessage = 'Tipo di upload non valido';
        this.uploading = false;
        return;
    }
    
    uploadObservable.subscribe({
      next: (response) => {
        if (response.success && response.data.upload_id) {
          this.uploadId = response.data.upload_id;
          this.startProgressPolling();
        } else {
          this.handleError('Upload iniziato ma ID non ricevuto');
        }
      },
      error: (error) => this.handleError('Errore durante l\'upload: ' + error.message)
    });
  }

  startProgressPolling(): void {
    this.uploadService.pollUploadProgress(this.uploadId).subscribe({
      next: (response) => {
        if (response.success) {
          this.progress = response.data.progress;
          this.status = response.data.status;
          
          if (response.data.status === 'completed') {
            this.uploading = false;
          } else if (response.data.status === 'failed') {
            this.handleError('Upload fallito: ' + (response.data.error || 'Errore sconosciuto'));
          }
        } else {
          this.handleError('Errore nel recupero del progresso');
        }
      },
      error: (error) => this.handleError('Errore nel polling del progresso: ' + error.message),
      complete: () => {
        // Il polling è terminato (lo stato è 'completed' o 'failed')
        if (this.status !== 'completed') {
          this.uploading = false;
        }
      }
    });
  }

  handleError(message: string): void {
    this.errorMessage = message;
    this.uploading = false;
  }
}</code></pre>
    </div>

    <div class="section">
        <h2>Note Importanti</h2>
        <ul>
            <li>Il sistema di tracking del progresso è basato su database e cache, quindi il progresso reale durante l'upload potrebbe non essere disponibile in tempo reale a causa delle limitazioni di PHP/Laravel.</li>
            <li>Per upload di file di grandi dimensioni, considera l'implementazione di un sistema di upload chunked per un tracking più preciso.</li>
            <li>Per una soluzione più reattiva, considera l'integrazione con WebSockets o Server-Sent Events.</li>
        </ul>
    </div>

    <div class="section">
        <h2>Troubleshooting</h2>
        <h3>Problemi comuni</h3>
        <ul>
            <li>
                <strong>Upload ID non ricevuto</strong>
                <p>Verifica che la migrazione della tabella upload_progress sia stata eseguita e che il FileUploadHelper sia configurato correttamente.</p>
            </li>
            <li>
                <strong>Progresso sempre a 0%</strong>
                <p>Il progresso potrebbe essere aggiornato solo alla fine dell'upload a causa delle limitazioni di PHP. Considera l'implementazione di un sistema di upload chunked.</p>
            </li>
            <li>
                <strong>Errori 404 sull'endpoint di progresso</strong>
                <p>Verifica che la rotta /api/v1/upload/progress sia definita correttamente in routes/api.php.</p>
            </li>
        </ul>
    </div>
</div>
@endsection
