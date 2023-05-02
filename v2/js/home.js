// Description: Script pour la recherche de la page d'accueil

const searchInput = document.querySelector("input[name='search']");
let template = document.querySelector("#list-results");
let list_ = document.querySelector(".sctn-search-bar-find");

let results = [];

searchInput.addEventListener("input", function () {
  const searchQuery = searchInput.value.trim();

  if (searchQuery.length > 0) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search-diseases.php?q=" + encodeURIComponent(searchQuery));
    xhr.onload = function () {
      if (xhr.status === 200) {
        results = JSON.parse(xhr.responseText);
        displayResults(results);
      }
    };
    xhr.send();
  } else {
    results = [];
    displayResults(results);
  }
});

searchInput.addEventListener("focus", function () {
  //searchInput.value = '';
  displayResults(results);
});

document.addEventListener("click", function (event) {
  var isClickInsideList = list_.contains(event.target);
  if (!isClickInsideList) {
    displayResults([]);
  }
});

function displayResults(results) {
  list_.innerHTML = ""; // On vide la liste

  for (const r of results) {
    // itère sur le tableau
    let clone = document.importNode(template.content, true); // clone le template

    newContent = clone.firstElementChild.innerHTML // remplace {{...}}
      .replace(/{{id}}/g, r["id_symp"])
      .replace(/{{description}}/g, r["desc"]);

    clone.firstElementChild.innerHTML = newContent;

    list_.appendChild(clone); // On ajoute le clone créé
  }
}
