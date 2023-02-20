'use strict';
window.onload = function () {
  let dateReservation = document.getElementById('reservation_date');
  let nbConvives = document.getElementById('reservation_nombreDePersonnes');
  let jourReservation;
  let capaciteMidi;
  let capaciteSoir;
  let horaires;
  let reservations;
  let placesRestantesAffiche;
  let placesRestantesHorsResaClient;
  let capaciteTotale;
  const options = { weekday: 'long' };

  //EventListener sur date souhaitée par le client
  dateReservation.addEventListener('change', (dateReservation) => {
    console.log(`la date est le ${dateReservation.target.value}`);
    dateReservation = dateReservation.target.value;
    jourReservation = new Date(dateReservation).toLocaleDateString(
      'fr-FR',
      options
    );
    console.log(`la date de réservation est le ${jourReservation}`);
    //récupérer les horaires via l'API
    fetch('http://localhost:8000/api/horaires.json')
      .then((res) => res.json())
      .then((data) => {
        horaires = data;
        console.log(horaires);
        //comparer jourReservation avec horaires.jour et console.log(horaires.jour)
        for (let i = 0; i < horaires.length; i++) {
          const jourCapitalized =
            jourReservation.charAt(0).toUpperCase() + jourReservation.slice(1);
          //gestion des capacités si undefined le matin ou le soir (est-ce que je devrais commencer le calcul de la capacité totale ici ou le faire séparemment après?)
          if (horaires[i].jour === jourCapitalized) {
            console.log(jourCapitalized);
            if (horaires[i].capaciteMidi === undefined) {
              console.log(`il n'y a pas de capacité midi`);
            } else {
              capaciteMidi = horaires[i].capaciteMidi;
              console.log(`la capacité midi est de ${capaciteMidi}`);
            }
            if (horaires[i].capaciteSoir === undefined) {
              console.log(`il n'y a pas de capacité soir`);
            } else {
              capaciteSoir = horaires[i].capaciteSoir;
              console.log(`la capacité soir est de ${capaciteSoir}`);
            }
          }
        }
      });
  });

  //EventListener sur nombre de convives souhaité par le client
  nbConvives.addEventListener('input', (nbConvives) => {
    console.log(
      `le client souhaite réserver pour ${nbConvives.target.value} personnes et la capacite midi est de ${capaciteMidi} et la capacite soir est de ${capaciteSoir}`
    );
    nbConvives = nbConvives.target.value;
    //récupérer les réservations via l'API
    fetch('http://localhost:8000/api/reservations.json')
      .then((res) => res.json())
      .then((data) => {
        reservations = data;
        console.log(reservations);

        //catch datas to calculate places restantes from dateReservation
        for (let i = 0; i < reservations.length; i++) {
          if (reservations[i].date === dateReservation) {
            console.log(reservations.date);
            console.log(reservations[i].date);
            console.log(reservations[i].nombreDePersonnes);
            //calculer les places restantes avant réservation
            placesRestantesHorsResaClient = //que je dois aller chercher en fonction du jour souhaite par le client
              capaciteTotale - reservations[i].nombreDePersonnes;
            console.log(placesRestantesHorsResaClient);
            placesRestantesAffiche = placesRestantesHorsResaClient - nbConvives; //que je dois aller chercher en fonction du jour souhaite par le client
            console.log(placesRestantesAffiche);
          }
        }
      });
  });

  //Places restantes Avec client

  switch (true) {
    case isNaN(placesRestantes):
      placesRestantesAffiche.innerHTML = `Veuillez sélectionner une date et un nombre de personnes valide.`;
      break;
    case placesRestantes <= 0:
      placesRestantesAffiche.innerHTML = `Actuellement pour la date sélectionnée il n'y a plus de places disponibles.`;
      break;
    case placesRestantes > 0:
      placesRestantesAffiche.innerHTML = `Actuellement pour la date sélectionnée il reste ${placesRestantes} de places disponibles.`;
      break;
    default:
      placesRestantesAffiche.innerHTML = `Merci de saisir une date et un nombre de convives pour connaître le nombre de places disponibles.`;
      break;
  }
  console.log(placesRestantes);

  //calculer les créneaux disponibles
  const ouvertureMidi = horaireFermetureMidi - horaireOuvertureMidi; //que je dois aller chercher en fonction du jour souhaite
  const ouvertureSoir = horaireFermeturSoir - horaireOuvertureSoir; //que je dois aller chercher en fonction du jour souhaite
  const creneauxMidi = math.floor((ouvertureMidi * 60) / 30);
  const creneauxSoir = math.floor((ouvertureSoir * 60) / 30);

  // function CalculCreneauxDispo() {
  //   const creneauxGlobale = creneauxMidi + creneauxSoir;

  //   foreach(creneau && !reservations);
  //   {
  //     return; // Checkbox displaying créneaux
  //   }
  // }
};
