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
    //récupérer les plats en fonction de la catégorie
    const entrees = plats.filter((plats) => plats.categoriePlat == 'Entrées');
    console.log(entrees);
    const platsPrincipaux = plats.filter(
      (plats) => plats.categoriePlat === 'plats'
    );
    const desserts = plats.filter(
      (plats) => plats.categoriePlat === 'desserts'
    );

    const ul = document.createElement('ul');
    // Ajouter le titre de la catégorie
    const h2 = document.createElement('h2');
    h2.innerHTML = 'Entrées';

    entrees.forEach((plat) => {
      const li = document.createElement('li');
      const nom = document.createElement('h3');
      const description = document.createElement('p');
      const prix = document.createElement('span');
      nom.innerText = plat.nom;
      description.innerText = plat.description;
      prix.innerText = plat.prix / 100 + ' €';
      li.appendChild(nom);
      li.appendChild(description);
      li.appendChild(prix);
      ul.appendChild(li);
      console.log(li);
    });

    document.querySelector('.wrapper.mt-5').appendChild(ul);
  });
