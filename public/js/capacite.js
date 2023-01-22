'use strict';

window.onload = function placesRestantes() {
  //Ajouter un event listener sur champs date du formulaire de réservation
  const dateReservation = document.getElementById('reservation_date');
  dateReservation.addEventListener('change', (dateReservation) => {
    console.log(dateReservation.target.value);
    //Ajouter un event listener sur champs nombre de personnes du formulaire de réservation
    const nbPersonnes = document.getElementById(
      'reservation_nombreDePersonnes'
    );
    nbPersonnes.addEventListener('input', (nbPersonnes) => {
      console.log(nbPersonnes.target.value);
      //Récupérer le nombre de places réservées pour la date sélectionnée
      const placesReservees = 15 + parseInt(nbPersonnes.target.value);
      console.log(placesReservees);
      // Récupérer la capacité de la totale de la salle

      //on récupère les capacités du restaurant par jour
      const capaciteMidi = 50;
      const capaciteSoir = 100;
      const capaciteTotale = capaciteMidi + capaciteSoir;
      console.log(capaciteTotale);
      //Calculer le nombre de places restantes
      const placesRestantes = capaciteTotale - placesReservees;
      console.log(placesRestantes);
      //Afficher le nombre de places restantes
      const placesRestantesAffiche = document.getElementById('placesRestantes');
      console.log(placesRestantesAffiche);

      //for null value show places restantes

      if (placesRestantes <= 0) {
        placesRestantesAffiche.innerHTML = `Actuellement pour la date sélectionnée il n'y a plus de places disponibles.`;
      } else {
        placesRestantesAffiche.innerHTML = `Actuellement pour la date sélectionnée il reste ${placesRestantes} de places disponibles.`;
      }
    });
  });
};

placesRestantes();
