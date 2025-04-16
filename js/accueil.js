
// Sélectionner l'icône du menu burger et le menu
const hamburger = document.querySelector('.hamburger');
const menu = document.querySelector('.menu');

// Ajouter un événement de clic sur l'icône burger
hamburger.addEventListener('click', () => {
  // Ajouter ou retirer la classe "open" pour afficher ou cacher le menu
  menu.classList.toggle('open');
});
