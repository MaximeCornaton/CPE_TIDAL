const searchInput = document.querySelector("input[name='search']");
const table_results = document.querySelector("#table-results");

const selct_filter = document.getElementsByClassName("select-filter");
const typeField = document.querySelector("#type");
const merField = document.querySelector("#mer");
const descField = document.querySelector("#desc");

const resetButton = document.querySelector(".reset-filters");

resetButton.addEventListener("click", function (e) {
  e.preventDefault(); // Empêcher le comportement par défaut du bouton (envoi de formulaire)

  typeField.selectedIndex = 0;
  merField.selectedIndex = 0;
  descField.selectedIndex = 0;
  searchInput.value = "";

  search();
});

for (let i = 0; i < selct_filter.length; i++) {
  selct_filter[i].addEventListener("change", function () {
    search();
  });
}

function update_fav(id) {
  const fav = document.getElementById(id);
  if(fav.classList.contains("far")){
    action = "add";
  }
  else {
    action = "remove";
  }
  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "add_fav.php?id=" + encodeURIComponent(id) + "&action=" + encodeURIComponent(action)
  );
  xhr.onload = function () {
    if (xhr.status === 200) {
      if(xhr.responseText == "added"){
        fav.classList.remove("far");
        fav.classList.add("fas");
      }
      else if(xhr.responseText == "removed"){
        fav.classList.remove("fas");
        fav.classList.add("far");
      }
    }
  };
  xhr.send();
}

let template = document.querySelector("#template-results-page");
let list_ = document.querySelector(".list-results-page");

let results = [];
search(100);

searchInput.addEventListener("input", function () {
  search();
});

function search(limit) {
  //console.log("search");
  const search_ = searchInput.value.trim();
  const type_ = document.querySelector("select[name='type']").value;
  const meridien_ = document.querySelector("select[name='meridien']").value;
  const caract_ = document.querySelector("select[name='caract']").value;
  if(limit === undefined) limit = "";

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "search-diseases.php?q=" +
      encodeURIComponent(search_) +
      "&type=" +
      encodeURIComponent(type_) +
      "&meridien=" +
      encodeURIComponent(meridien_) +
      "&caract=" +
      encodeURIComponent(caract_) +
      "&limit=" +
      encodeURIComponent(limit) +
      "&page=" +
      encodeURIComponent("diseases")
  );
  xhr.onload = function () {
    if (xhr.status === 200) {
      results = JSON.parse(xhr.responseText);
      //console.log(results);
      displayResults(results);
    }
  };
  xhr.send();
}

function displayResults(results) {
  //table_results.style.display = "table-header-group";
  list_.innerHTML = ""; // On vide la liste

  for (const r of results) {
    // itère sur le tableau
    let clone = document.importNode(template.content, true); // clone le template

    if(r["fav"] == false){
      newContent = clone.firstElementChild.innerHTML // remplace {{...}}
      .replace(/{{id}}/g, r["id_symp"])
      .replace(/{{desc}}/g, r["desc"])
      .replace(/{{merCode}}/g, r["merCode"])
      .replace(/{{type}}/g, r["type"])
      .replace(/{{desc2}}/g, r["desc2"])
      .replace(/{{merName}}/g, r["merName"])
      .replace(/{{merElem}}/g, r["merElem"])
      .replace(/{{fav}}/g, "far fa-star");
    }
    else {
      newContent = clone.firstElementChild.innerHTML // remplace {{...}}
      .replace(/{{id}}/g, r["id_symp"])
      .replace(/{{desc}}/g, r["desc"])
      .replace(/{{merCode}}/g, r["merCode"])
      .replace(/{{type}}/g, r["type"])
      .replace(/{{desc2}}/g, r["desc2"])
      .replace(/{{merName}}/g, r["merName"])
      .replace(/{{merElem}}/g, r["merElem"])
      .replace(/{{fav}}/g, "fas fa-star");
    }
    clone.firstElementChild.innerHTML = newContent;

    list_.appendChild(clone); // On ajoute le clone créé
  }

  if (results.length == 0) {
    list_.innerHTML = "Aucun résultat trouvé";
    //table_results.style.display = "none";
  }
}
