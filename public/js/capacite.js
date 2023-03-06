'use strict';

window.onload = function () {
  let dateReservation = document.getElementById('reservation_date');
  let nbConvives = document.getElementById('reservation_nombreDePersonnes');
  let placesRestantes = document.getElementById('placesRestantes');
  let jourReservation;
  let capaciteMidi;
  let capaciteSoir;
  let horaires = [];
  let reservations;
  let nbResaAvecClient;
  let nbResaSansClient;
  let placesRestantesAffiche;
  let placesRestantesHorsResaClient;
  let capaciteTotale;
  const options = { weekday: 'long' };
  let tableauHoraires;
  let tableauReservations;
  let horaireOuvertureMidi;
  let horaireFermetureMidi;
  let horaireOuvertureSoir;
  let horaireFermetureSoir;
  let plageMidi;
  let plageSoir;

  function init() {
    tableauReservations = [];
    nbConvives.value = '';
    placesRestantes.innerHTML = `Merci de saisir une date et un nombre de convives pour connaître le nombre de places disponibles.`;
  }

  function calculDesCapacitesSiPasAutreResa(nb) {
    console.log(`le nombre de convives est de ${nb}`);
    capaciteTotale = capaciteMidi + capaciteSoir;
    placesRestantesHorsResaClient = capaciteTotale; //que je dois aller chercher en fonction du jour souhaite par le client
    console.log(`Hors resa client il reste ${placesRestantesHorsResaClient}`);
    placesRestantesAffiche = placesRestantesHorsResaClient - nb; //que je dois aller chercher en fonction du jour souhaite par le client
    console.log(placesRestantesAffiche);

    affichageDesPlacesRestantes(placesRestantesAffiche);
  }

  function affichageDesPlacesRestantes() {
    switch (true) {
      case isNaN(placesRestantesAffiche):
        console.log('Nan ici');
        placesRestantes.innerHTML = `Veuillez sélectionner une date et un nombre de personnes valide.`;
        break;
      case placesRestantesAffiche <= 0:
        console.log('plus de places');
        placesRestantes.innerHTML = `Actuellement pour la date sélectionnée il n'y a plus de places disponibles.`;
        break;
      case placesRestantesAffiche > 0:
        console.log('il reste des places');
        placesRestantes.innerHTML = `Actuellement pour la date sélectionnée il reste ${placesRestantesAffiche} places disponibles.`;
        break;
      default:
        console.log('il faut vérifier');
        placesRestantes.innerHTML = `Merci de saisir une date et un nombre de convives pour connaître le nombre de places disponibles.`;
        break;
    }
  }

  //EventListener sur date souhaitée par le client
  dateReservation.addEventListener('change', (dateReservation) => {
    init();
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
            CalculDesCreneauxDisponible(horaires[i]);
            if (horaires[i].capaciteMidi === undefined) {
              console.log(`il n'y a pas de capacité midi`);
              capaciteMidi = 0;
            } else {
              capaciteMidi = horaires[i].capaciteMidi;
              console.log(`la capacité midi est de ${capaciteMidi}`);
            }
            if (horaires[i].capaciteSoir === undefined) {
              console.log(`il n'y a pas de capacité soir`);
              capaciteSoir = 0;
            } else {
              capaciteSoir = horaires[i].capaciteSoir;
              console.log(`la capacité soir est de ${capaciteSoir}`);
            }
            console.log(
              `la valeur de horaires ouverture midi est ${horaires[i].ouvertureMidi}`
            );
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

        calculDesCapacitesSiPasAutreResa(nbConvives);
        //catch datas to calculate places restantes from dateReservation
        tableauReservations = [];
        for (let i = 0; i < reservations.length; i++) {
          reservations[i].date = dayjs(reservations[i].date).format(
            'YYYY-MM-DD'
          );
          //je push les reservations dans un tableau
          tableauReservations.push([
            reservations[i].date,
            reservations[i].nombreDePersonnes,
          ]);
          console.log(tableauReservations);
        }
        if (tableauReservations.length > 0) {
          tableauReservations.forEach((tableau) => {
            if (tableau[0] == dateReservation.value) {
              nbResaSansClient = tableau[1];
              nbResaAvecClient =
                parseInt(nbConvives) + parseInt(nbResaSansClient);
              console.log(nbResaAvecClient);
              console.log(nbResaSansClient);

              //calculer les places restantes avant réservation
              capaciteTotale = capaciteMidi + capaciteSoir;
              console.log(
                'la capacité totale est de ' + capaciteTotale + ' places'
              );
              placesRestantesHorsResaClient = capaciteTotale - nbResaSansClient; //que je dois aller chercher en fonction du jour souhaite par le client
              console.log(
                `Hors resa client il reste ${placesRestantesHorsResaClient}`
              );
              placesRestantesAffiche =
                placesRestantesHorsResaClient - nbConvives; //que je dois aller chercher en fonction du jour souhaite par le client
              console.log(placesRestantesAffiche);
              //appeler la fonction d'affichage des places restantes
              affichageDesPlacesRestantes(placesRestantesAffiche);
            }
            console.table(tableauReservations);
          });
        } else {
          capaciteMidi != NULL ? capaciteMidi : 0;
          capaciteSoir != NULL ? capaciteSoir : 0;
          //calculer les places restantes avant réservation
          console.log(
            'la capacité totale dans le else est de ' +
              capaciteTotale +
              ' places'
          );
          calculDesCapacitesSiPasAutreResa(nbConvives);
        }
      });
  });
  function CalculDesCreneauxDisponible(horaires) {
    //récupérer les horaires correspondant à l'index du jour de réservation dans le tableau horaires
    console.log(horaires);
    horaireOuvertureMidi = parseInt(
      dayjs(horaires.ouvertureMidi).format('HH:mm')
    );
    horaireFermetureMidi = parseInt(
      dayjs(horaires.fermetureMidi).format('HH:mm')
    );
    horaireOuvertureSoir = parseInt(
      dayjs(horaires.ouvertureSoir).format('HH:mm')
    );
    horaireFermetureSoir = parseInt(
      dayjs(horaires.fermetureSoir).format('HH:mm')
    );
    console.log('horaires ouverture midi ' + horaireOuvertureMidi);
    console.log('horaires fermeture midi ' + horaireFermetureMidi);
    console.log('horaires ouverture soir ' + horaireOuvertureSoir);
    console.log('horaires fermeture soir ' + horaireFermetureSoir);

    plageMidi = horaireFermetureMidi - horaireOuvertureMidi;
    console.log(`la plage du midi en heures est ${plageMidi}`);
    plageSoir = horaireFermetureSoir - horaireOuvertureSoir;
    console.log(`la plage du soir en heure est ${plageSoir}`);
    //calculer les créneaux disponibles

    let creneauxMidi = Math.floor((plageMidi * 60) / 30);
    console.log(`il faut ${creneauxMidi} créneaux le midi`);
    let creneauxSoir = Math.floor((plageSoir * 60) / 30);
    console.log(`il faut ${creneauxSoir} créneaux le soir`);
  }
  // function CalculCreneauxDispo() {
  //   const creneauxGlobale = creneauxMidi + creneauxSoir;

  //   foreach(creneau && !reservations);
  //   {
  //     return; // Checkbox displaying créneaux
  //   }
  // }
};
