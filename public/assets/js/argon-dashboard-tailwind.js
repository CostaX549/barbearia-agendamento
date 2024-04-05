var page = window.location.pathname.split("/").pop().split(".")[0];
var aux = window.location.pathname.split("/");
var to_build = (aux.includes('pages') || aux.includes('docs') ? '../' : '/');
var root = window.location.pathname.split("/");
if (!aux.includes("pages")) {
  page = "dashboard";
}

loadStylesheet(to_build + "assets/css/perfect-scrollbar.css");
loadJS(to_build + "assets/js/perfect-scrollbar.js", true);

if (document.querySelector("[slider]")) {
  loadJS(to_build + "assets/js/carousel.js", true);
}

if (document.querySelector("nav [navbar-trigger]")) {
  loadJS(to_build + "assets/js/navbar-collapse.js", true);
}

if (document.querySelector("[data-target='tooltip']")) {
  loadJS(to_build + "assets/js/tooltips.js", true);
  loadStylesheet(to_build + "assets/css/tooltips.css");
}

if (document.querySelector("[nav-pills]")) {
  loadJS(to_build + "assets/js/nav-pills.js", true);
}

if (document.querySelector("[dropdown-trigger]")) {
  loadJS(to_build + "assets/js/dropdown.js", true);
}

if (document.querySelector("[fixed-plugin]")) {
  loadJS(to_build + "assets/js/fixed-plugin.js", true);
}

if (document.querySelector("[navbar-main]") || document.querySelector("[navbar-profile]")) {
  if(document.querySelector("[navbar-main]")){
    loadJS(to_build + "assets/js/navbar-sticky.js", true);
  }
  if (document.querySelector("aside")) {
    loadJS(to_build + "assets/js/sidenav-burger.js", true);
  }
}

// Modifique a função loadJS para aceitar um segundo parâmetro, que será o response
function loadJS3(FILE_URL, async, response) {
  let dynamicScript = document.createElement("script");

  dynamicScript.setAttribute("src", FILE_URL);
  dynamicScript.setAttribute("type", "text/javascript");
  dynamicScript.setAttribute("async", async);

  // Adicione um atributo de data ao script para passar os dados
  dynamicScript.setAttribute("data-response", JSON.stringify(response));

  document.head.appendChild(dynamicScript);
}

if (document.querySelector("canvas")) {
  var slug = window.location.pathname.split("gerenciar/")[1].split("/")[0]; // Captura o slug do URL
  var xhr = new XMLHttpRequest();
  var url = '/barbearia/' + slug;

  xhr.open('GET', url, true);

  xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
          // Requisição bem-sucedida
          var response = JSON.parse(xhr.responseText);
          console.log(response);
          
          // Chama a função loadJS passando o response como parâmetro
          loadJS3(to_build + "assets/js/charts.js", true, response);
      } else {
          // Ocorreu um erro na requisição
          console.error('Erro na requisição: ' + xhr.status);
      }
  };

  xhr.onerror = function () {
      // Ocorreu um erro de rede
      console.error('Erro de rede');
  };

  xhr.send();
}

if (document.querySelector(".github-button")) {
  loadJS("https://buttons.github.io/buttons.js", true);
}

function loadJS(FILE_URL, async) {
  let dynamicScript = document.createElement("script");

  dynamicScript.setAttribute("src", FILE_URL);
  dynamicScript.setAttribute("type", "text/javascript");
  dynamicScript.setAttribute("async", async);

  document.head.appendChild(dynamicScript);
}

function loadStylesheet(FILE_URL) {
  let dynamicStylesheet = document.createElement("link");

  dynamicStylesheet.setAttribute("href", FILE_URL);
  dynamicStylesheet.setAttribute("type", "text/css");
  dynamicStylesheet.setAttribute("rel", "stylesheet");

  document.head.appendChild(dynamicStylesheet);
}
