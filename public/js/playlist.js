// Gestion du modal
function openModal(playlist = null) {
    const modal = document.getElementById('modalOverlay');
    const form = document.getElementById('playlistForm');
    const title = document.getElementById('modalTitle');

    if (playlist) {
        title.textContent = 'Modifier la playlist';
        form.elements['name'].value = playlist.name;
        form.elements['description'].value = playlist.description;
        form.dataset.playlistId = playlist.id;
    } else {
        title.textContent = 'Créer une playlist';
        form.reset();
        delete form.dataset.playlistId;
    }

    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('modalOverlay').style.display = 'none';
}

// Gestion des formulaires
async function handleSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const playlistId = form.dataset.playlistId;

    try {
        const url = playlistId 
            ? `/playlist/update/${playlistId}`
            : '/playlist/create';

        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            // Recharger la page ou mettre à jour la grille
            window.location.reload();
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    }
}

// Suppression d'une playlist
async function deletePlaylist(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette playlist ?')) {
        try {
            const response = await fetch(`/playlist/delete/${id}`, {
                method: 'POST'
            });

            const result = await response.json();

            if (result.success) {
                // Supprimer la carte de la playlist
                document.querySelector(`[data-id="${id}"]`).remove();
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        }
    }
}

// Initialisation des événements
document.addEventListener('DOMContentLoaded', () => {
    const playlistForm = document.getElementById('playlistForm');
    if (playlistForm) {
        playlistForm.addEventListener('submit', handleSubmit);
    }
});