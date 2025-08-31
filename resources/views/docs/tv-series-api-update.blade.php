@extends('docs.layout')

@section('content')
<div class="container">
    <h1>Aggiornamento API TV Series</h1>
    <p class="lead">Documentazione sulle modifiche al formato della risposta API per TV Series</p>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Modifiche al formato della risposta API</h2>
        </div>
        <div class="card-body">
            <h3>Problema risolto</h3>
            <p>È stato risolto un problema di incompatibilità tra il formato della risposta API del backend Laravel e le aspettative del frontend Angular per le operazioni di update delle TV Series.</p>
            
            <h3>Dettagli del problema</h3>
            <p>Il frontend Angular si aspettava che i dati aggiornati fossero restituiti nella chiave <code>data</code> della risposta, ma il backend restituiva i dati nella chiave <code>message.tv_series</code>.</p>
            
            <div class="alert alert-danger">
                <h4>Formato precedente (problematico)</h4>
                <pre><code>{
    "status": "success",
    "message": {
        "tv_series": { ... dati aggiornati ... }
    }
}</code></pre>
            </div>

            <div class="alert alert-success">
                <h4>Nuovo formato (corretto)</h4>
                <pre><code>{
    "status": "success",
    "message": "TV Series updated successfully",
    "data": { ... dati aggiornati ... }
}</code></pre>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Metodi API aggiornati</h2>
        </div>
        <div class="card-body">
            <p>I seguenti metodi del <code>TvSerieController</code> sono stati aggiornati per utilizzare il nuovo formato di risposta:</p>
            
            <ul>
                <li><code>store()</code> - Creazione di una nuova TV Series</li>
                <li><code>storeComplete()</code> - Creazione completa con stagioni ed episodi</li>
                <li><code>update()</code> - Aggiornamento di una TV Series esistente</li>
                <li><code>updateComplete()</code> - Aggiornamento completo con stagioni ed episodi</li>
            </ul>

            <h3>Esempio di utilizzo nel frontend</h3>
            <pre><code>// Esempio di codice Angular per gestire la risposta API
this.tvSeriesService.update(id, formData).subscribe(
    (response) => {
        if (response.status === 'success') {
            // Ora i dati aggiornati sono disponibili direttamente in response.data
            this.tvSeries = response.data;
            
            // Aggiornare l'UI con i dati aggiornati
            this.updateUIWithNewData(response.data);
            
            // Mostrare un messaggio di successo
            this.toastr.success(response.message);
        }
    },
    (error) => {
        // Gestione errori
        this.toastr.error('Si è verificato un errore durante l\'aggiornamento');
    }
);</code></pre>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Vantaggi della modifica</h2>
        </div>
        <div class="card-body">
            <ul>
                <li>Coerenza con le convenzioni API REST standard</li>
                <li>Compatibilità diretta con il frontend Angular</li>
                <li>Aggiornamento automatico dell'UI dopo le operazioni di update</li>
                <li>Nessuna necessità di aggiornare manualmente lo stato dopo le operazioni</li>
                <li>Eliminazione del problema di "perdita" delle modifiche nell'interfaccia utente</li>
            </ul>
        </div>
    </div>
</div>
@endsection
