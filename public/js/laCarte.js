'use strict';

let plats;
let categories;
let categoriePlatAffiche;
let nomDuPlat;
let descriptionDuPlat;
let prixDuPlat;

categoriePlatAffiche = document.querySelector('.category');
nomDuPlat = document.querySelector('.name');
descriptionDuPlat = document.querySelector('.description');
prixDuPlat = document.querySelector('.price');

//récupérer les différents plats via l'API
fetch('http://localhost:8000/api/plats.json')
  .then((res) => res.json())
  .then((data) => {
    plats = data;
    console.log(plats);
  });
