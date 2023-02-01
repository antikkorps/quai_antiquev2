'use strict';
window.onload = function () {
  let dateReservation = document.getElementById('reservation_date');
  let nbConvives = document.getElementById('reservation_nombreDePersonnes');
  let jourReservation;
  let capaciteMidi;
  let capaciteSoir;

  //EventListener sur date souhaitée par le client
  dateReservation.addEventListener('change', (dateReservation) => {
    console.log(dateReservation.target.value);
    dateReservation = dateReservation.target.value;
    dateReservation = new Date(dateReservation);
    jourReservation = dateReservation.getDay();
    console.log(jourReservation);
    fetch('http://localhost:8000/api/horaires.json')
      .then((res) => res.json())
      .then((horaires) => {
        console.log(horaires);
        console.log(horaires[jourReservation].capaciteMidi);
        console.log(horaires[jourReservation].capaciteSoir);
        if (
          horaires[jourReservation].ouvertureMidi === null &&
          horaires[jourReservation].fermetureMidi === null
        ) {
          horaires[jourReservation].capaciteMidi = 0;
        }
        if (
          horaires[jourReservation].ouvertureSoir === null &&
          horaires[jourReservation].fermetureSoir === null
        ) {
          horaires[jourReservation].capaciteSoir = 0;
        }
        capaciteMidi = horaires[jourReservation].capaciteMidi;
        capaciteSoir = horaires[jourReservation].capaciteSoir;
        capaciteTotal = capaciteMidi + capaciteSoir;
        console.log(capaciteTotal);
      });
  });

  //EventListener sur nombre de convives souhaité par le client
  nbConvives.addEventListener('input', (nbPersonnes) => {
    console.log(nbPersonnes.target.value);
  });

  const placesRestantesHorsResaClient =
    capaciteMidi + capaciteSoir - reservations; //que je dois aller chercher en fonction du jour souhaite
  const placesRestantesAffiche = placesRestantesHorsResaClient - nbConvives; //que je dois aller chercher en fonction du jour souhaite
  const ouvertureMidi = horaireFermetureMidi - horaireOuvertureMidi; //que je dois aller chercher en fonction du jour souhaite
  const ouvertureSoir = horaireFermeturSoir - horaireOuvertureSoir; //que je dois aller chercher en fonction du jour souhaite
  const creneauxMidi = math.floor((ouvertureMidi * 60) / 30);
  const creneauxSoir = math.floor((ouvertureSoir * 60) / 30);

  function AffichageDuNombreDePlacesRestantes() {
    //Places restantes Avec client client
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
  }
  AffichageDuNombreDePlacesRestantes();
  console.log(placesRestantes);

  function CalculCreneauxDispo() {
    const creneauxGlobale = creneauxMidi + creneauxSoir;

    foreach(creneau && !reservations);
    {
      return; // Checkbox displaying créneaux
    }
  }
};
