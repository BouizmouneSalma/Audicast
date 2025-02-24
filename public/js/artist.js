// Gestion du modal
let uploadModal;

function openUploadModal() {
    uploadModal = document.getElementById('uploadModal');
    uploadModal.style.display = 'flex';
}

function closeUploadModal() {
    uploadModal.style.display = 'none';
    resetUploadForm();
}

// Upload de fichiers
async function handleUpload(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    try {
        showProgress();
        
        const response = await fetch('/artist/upload-song', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Ajouter la nouvelle chanson à la grille
            addSongToGrid(result.song);
            closeUploadModal();
        } else {
            alert(result.error);
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    } finally {
        hideProgress();
    }
}

// Gestion de la progression
function showProgress() {
    const progress = document.getElementById('uploadProgress');
    progress.style.display = 'block';
    simulateProgress();
}

function hideProgress() {
    const progress = document.getElementById('uploadProgress');
    progress.style.display = 'none';
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = '0%';
}

function simulateProgress() {
    const progressBar = document.getElementById('progressBar');
    let width = 0;
    const interval = setInterval(() => {
        if (width >= 90) {
            clearInterval(interval);
        } else {
            width++;
            progressBar.style.width = width + '%';
        }
    }, 50);
}

// Gestion des chansons
async function deleteSong(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette chanson ?')) {
        try {
            const response = await fetch(`/artist/delete-song/${id}`, {
                method: 'POST'
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Supprimer la carte de la chanson
                const songCard = document.querySelector(`[data-id="${id}"]`);
                songCard.remove();
            } else {
                alert(result.error);
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        }
    }
}

function playSong(id) {
    // Implémenter la lecture de la chanson
    console.log('Lecture de la chanson:', id);
}

// Drag and drop
const dropZone = document.getElementById('dropZone');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('dragover');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('dragover');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    handleFiles(e.dataTransfer.files);
});

function handleFiles(files) {
    // Traiter les fichiers déposés
    const audioInput = document.getElementById('audioFile');
    const coverInput = document.getElementById('coverImage');
    
    Array.from(files).forEach(file => {
        if (file.type.startsWith('audio/')) {
            audioInput.files = new FileList([file]);
        } else if (file.type.startsWith('image/')) {
            coverInput.files = new FileList([file]);
        }
    });
}