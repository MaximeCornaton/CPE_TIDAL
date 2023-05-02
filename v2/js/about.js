  // Détecter la pression de la touche "h"
  document.addEventListener('keydown', function(event) {
    if (event.key === 'h') {
        // Créer un nouvel élément audio
      var audio = new Audio();
      audio.src = './ee/ouais-cest-greg.mp3';
      
      // Jouer la musique
      audio.play();
      window.location.href = 'ee/ee.html';
    }
  });