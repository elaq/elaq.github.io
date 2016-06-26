function dzisiaj() {
  var dzis = new Date();
  var dni = ['Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota'];
  var miesiace = ['stycznia','lutego','marca','kwietnia','maja','czerwca','lipca','sierpnia','września','października','listopada','grudnia'];
  var dzien = dni[dzis.getDay()];
  var miesiac = miesiace[dzis.getMonth()];
  var dzisDruk = dzien + ", " + dzis.getDate() + " " + miesiac + " " + dzis.getFullYear() + " r.";
  document.getElementById("data-styl").innerHTML = dzisDruk;
}

function zegar() {
  var dzis = new Date();
  var godzina = dzis.getHours();
  var min = dzis.getMinutes();
  var sek = dzis.getSeconds();
  var terazDruk = "| " + godzina + ((min<10)?":0":":") + min + ((sek<10)?":0":":")+sek;
  document.getElementById("zegar-styl").innerHTML = terazDruk;
  setTimeout("zegar()", 1000);
}

window.onload = function() {
  dzisiaj();
  zegar();
}
