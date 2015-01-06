var opisPlanszy;
var opisPlanszyRozw;
var aktualnePole;
var aktualnaWartosc;
var cofanieTab = [];
var ponawianieTab = [];
var timer;
var nrPlanszy;
var plansze = new Array();
var planszeRozw = new Array(); //rozwiazane plansze (aby dalo sie podpowiadac)

//plansze latwe
plansze[0] =
	"020730001" +
	"009010047" +
	"000208900" +
	"000600802" +
	"207853406" +
	"804007000" +
	"003405000" +
	"640080700" +
	"100072090";
	
planszeRozw[0] = 
	"426739581" +
	"389516247" +
	"715248963" +
	"531694872" +
	"297853416" +
	"864127359" +
	"973465128" +
	"642981735" +
	"158372694";

plansze[1] =
	"030206780" +
	"002008004" +
	"000000005" +
	"301005800" +
	"000704000" +
	"006300907" +
	"800000000" +
	"700100400" +
	"095803070";

planszeRozw[1] =
	"439256781" +
	"152978634" +
	"687431295" +
	"371695842" +
	"928714563" +
	"546382917" +
	"814567329" +
	"763129458" +
	"295843176";	
	
plansze[2] =
	"040060200" +
	"020543008" +
	"007020590" +
	"406000010" +
	"000639000" +
	"050000906" +
	"079050800" +
	"100396050" +
	"002070060";

planszeRozw[2] =
	"845967231" +
	"921543678" +
	"367821594" +
	"496285317" +
	"718639425" +
	"253714986" +
	"679152843" +
	"184396752" +
	"532478169";

//plansze srednie
plansze[3] =
	"003092000" +
	"400030010" +
	"270000000" +
	"010300008" +
	"050167030" +
	"300008060" +
	"000000053" +
	"030080009" +
	"000620100";

planszeRozw[3] =
	"163792845" +
	"489536712" +
	"275814396" +
	"612349578" +
	"958167234" +
	"347258961" +
	"826971453" +
	"731485629" +
	"594623187";

plansze[4] =
	"390002006" +
	"050086000" +
	"200000003" +
	"030700000" +
	"001060800" +
	"000001090" +
	"400000007" +
	"000430050" +
	"800600032";

planszeRozw[4] =
	"394172586" +
	"157386249" +
	"286945713" +
	"538794621" +
	"941263875" +
	"762851394" +
	"413528967" +
	"629437158" +
	"875619432";

plansze[5] =
	"020001580" +
	"700003200" +
	"050000004" +
	"000090003" +
	"300102006" +
	"400050000" +
	"500000040" +
	"009700002" +
	"068400070";

planszeRozw[5] =
	"623941587" +
	"784563219" +
	"951278634" +
	"812694753" +
	"375182496" +
	"496357128" +
	"537826941" +
	"149735862" +
	"268419375";

//plansze trudne

plansze[6] =
	"000000400" +
	"000908000" +
	"082000710" +
	"700401000" +
	"051000680" +
	"000306002" +
	"018000290" +
	"000509000" +
	"004000000";

planszeRozw[6] = 
	"963172458" +
	"175948326" +
	"482635719" +
	"726481935" +
	"351297684" +
	"849356172" +
	"518764293" +
	"637529841" +
	"294813567";

plansze[7] =
	"060000200" +
	"300050700" +
	"000100069" +
	"002400000" +
	"090000050" +
	"000002300" +
	"810007000" +
	"009030006" +
	"004000090";

planszeRozw[7] =
	"965748231" +
	"321659784" +
	"748123569" +
	"532476918" +
	"497381652" +
	"186592347" +
	"813967425" +
	"259834176" +
	"674215893";

plansze[8] =
	"061007003" +
	"092003000" +
	"000000000" +
	"008530000" +
	"000000504" +
	"500008000" +
	"040000001" +
	"000160800" +
	"600000000";

planszeRozw[8] =
	"461987253" +
	"792453168" +
	"385216479" +
	"128534796" +
	"936721584" +
	"574698312" +
	"849375621" +
	"253169847" +
	"617842935";

plansze[9] =
	"000840009" +
	"001000005" +
	"800021460" +
	"708000090" +
	"000000000" +
	"050000301" +
	"024910007" +
	"900000500" +
	"300084000";

planszeRozw[9] =
	"632845179" +
	"471369285" +
	"895721463" +
	"748153692" +
	"163492758" +
	"259678341" +
	"524916837" +
	"986237514" +
	"317584926";

// Manipulacja plansza do gry

// Funkcja tworzaca nowa plansze
function Plansza(opis)
{
    var i;
    plansza = "<table class='table'><tbody>";
    for(i = 0; i < opis.length; i++)
    {
        if (i % 9 == 0) plansza += "<tr>";
        plansza += "<td class='field' id='td"+ wspolrzedne(i) +"'>";
        if (opis[i] == '0') {
            plansza += "<input type='text' class='input-mini' maxlength='1' id='i" + wspolrzedne(i) + "' onFocus='ustawId(this)' onkeypress='return isNumberKey(event)'>";
        } else {
            plansza += "<input type='text' class='input-mini' maxlength='1' readonly= '' id='i" + wspolrzedne(i) + "' value='"+opis[i]+"'>";
        }
        plansza += "</td>";
        if (i % 9 == 8) plansza += "</tr>";
    }
    return plansza+"</tbody></table>";
};

// Funkcja sprawdza, czy wpisany znak jest liczb¹
function isNumberKey(event){
    var charCode = event.which;
    if ((charCode < 49) || (charCode > 57))
        return false;
    return true;
}

// Funkcja ustawiajaca adres oraz wartosc wskazanego pola
function ustawId(pole) {
    aktualnePole = pole.id;   
    aktualnaWartosc = pole.value;
}


// Funkcja pomocnicza do obliczania wspólrzednych pola 
function wspolrzedne(i)
{
    if (i < 0 || i > 80) alert("wspolrzedne: zle dane");    
    return Math.floor(i/9) + 10 * (i % 9) + 11;
}


// Funkcja pomocnicza rysujaca ramkê wokol planszy
function rysujKrawedzie()
{
    var i;
    for(i = 0; i < 81; i++)
    {
        if ((i + 1) % 3 == 0)
            $('#td'+wspolrzedne(i)).css('border-right', '3px solid');
        if (i % 9 == 0)
            $('#td'+wspolrzedne(i)).css('border-left', '3px solid');
        if (Math.floor(i / 9) % 3 == 0)
            $('#td'+wspolrzedne(i)).css('border-top', '3px solid');
        if (i > 71)
            $('#td'+wspolrzedne(i)).css('border-bottom', '3px solid');
    }
}

// Funkcja pomocnicza zwracajaca numery pól w danym wierszu
function wiersz(i)
{
    if (i < 1 || i > 9) alert("wiersz: Zly wiersz");
    w = new Array();
    for(k = 10; k <= 90; k+=10)
        w.push(k+i);
    return w;
}

// Funkcja pomocnicza zwracajaca numery pól w danej kolumnie
function kolumna(i)
{
    if (i < 1 || i > 9) alert("kolumna: Zly argument");
    w = new Array();
    for(k = 1; k <= 9; k++)
        w.push(i*10 + k);
    return w;
}

// Funkcja pomocnicza zwracajaca numery pól w danym kwadracie
function kwadrat(i)
{
    if (i < 1 || i > 9) alert("kwadrat: Zly argument");
    w = new Array();
    x = ((i - 1) % 3) * 3 + 1;
    y = (Math.floor((i - 1) / 3)) * 3 + 1;
    for(dx = 0; dx <= 2; dx++)
        for(dy = 0; dy <= 2; dy++)
            w.push((x + dx) * 10 + dy + y);
    return w;
}

// Funkcja pomocnicza podswietlajaca zadane pola
function podswietlTablice(t)
{
    for(i = 0; i < 9; i++) {
        $('#td'+t[i]).css('background-color', '#48ca3b');
    }
}

// Funkcja do podswietlania wiersza, kolumny oraz kwadratu
function podswietl(i)
{
    podswietlTablice(wiersz(i % 10));
    podswietlTablice(kolumna(Math.floor(i/10)));
    podswietlTablice(kwadrat(1 + Math.floor((i-10)/30) + 3 * Math.floor(((i % 10)-1)/3)));
}

// Funkcja uruchamiana przy opuszczeniu pola z edycja
function wygas()
{
    $(".field").css('background-color', '#debb27');
}

// Funkcja pomocnicza sprawdzajaca czy w zadanym zakresie sa prawidlowe wartosci
function poprawnaTablica(t)
{
    var o = "";
    for(i = 0; i < 9; i++)
    {
        var v = $('#i' + t[i]).val();
        if (!(v >= '1' && v <= '9') || o.indexOf(v) != -1) 
        	return false;        
        o += v;
    }
    return true;
}

// Funkcja oceniajaca poprawnosc wypelnienia calej planszy
function poprawneRozwiazanie()
{
    var i;
    for(i = 1; i <= 9; i++)
    {
        if (!poprawnaTablica(wiersz(i))) return false;
        if (!poprawnaTablica(kolumna(i))) return false;
        if (!poprawnaTablica(kwadrat(i))) return false;
    }
    return true;
}

// Funkcja oceniajaca czy nie ma konfliktów w danym wierszu, kolumnie, kwadracie
function bezKonfliktow(w, k, nowaWartosc){
	var niepoprawne = false;
	var w2 = parseInt(w);
	var k2 = parseInt(k);
	var i = 1;	
	while ((i <= 9) && (!niepoprawne)){
		if (((document.getElementById("i"+i+w).value == nowaWartosc) && (i != k2))|| ((document.getElementById("i"+k+i).value == nowaWartosc) && (i != w2))){
			niepoprawne = true;    			
		}
		i++;    		
	}
	var w3, k3, w4, k4;
	switch(w2 % 3){
		case 0: w3 = w2 - 2; break;
		case 1: w3 = w2; break;
		case 2: w3 = w2 - 1;
	}
	switch(k2 % 3){
		case 0: k3 = k2 - 2; break;
		case 1: k3 = k2; break;
		case 2: k3 = k2 - 1;
	}
	i = 0;
	var j = 0;
	while ((i <= 2) && (!niepoprawne)){
		w4 = w3 + i;
		while (j <= 2){	    			
			k4 = k3 + j;
    		if ((document.getElementById("i"+k4+w4).value == nowaWartosc) && (k4 != k2 || w4 != w2)){	    			
    			niepoprawne = true;    			
    		}
    		j++;
		}
		j = 0; i++;    		
	}    
	return !niepoprawne;
}

// Funkcje obslugujace ciasteczka
function check_cookies() {
	var zapisana_plansza = getCookie("stan_planszy");
	var numer = getCookie("numer_planszy");
	$('#timer').text(getCookie("stan_licznika"));
	switch (true){
		case (numer > 5): document.getElementById("radio3").checked = true; break;
		case (numer > 2): document.getElementById("radio2").checked = true; break;
		default: document.getElementById("radio1").checked = true;
	}
	nrPlanszy = numer;
	if (zapisana_plansza != null){
		opisPlanszy = plansze[numer];
		opisPlanszyRozw = planszeRozw[numer];
		nowa_plansza();
	    for (i = 0; i < 81; i++){
	    	var pozycja = wspolrzedne(i).toString();
	    	var pole = document.getElementById('i' + pozycja);
	    	if (!pole.readOnly){
	    		ciasteczko = zapisana_plansza[i];
	    		if (ciasteczko != '0'){
	    			pole.value = ciasteczko;
	    			if (bezKonfliktow(pozycja.substr(1,1),pozycja.substr(0,1), parseInt(pole.value))){
	    				pole.style.background = "white";
	    			}
	    			else{
	    				pole.style.background = "#ff2727";
	    			}
	    		}
	    	}
	    }
	    if (poprawneRozwiazanie()){
	    	guzik_sprawdz();
	    }
	    else{
	    	start_timer(timer);
	    }
	}
 }

function save_cookies() {
	var plansza_do_zapisania = "";
	for(i = 0; i < 81; i++){
		var pole = document.getElementById('i' + wspolrzedne(i));
		if (pole.value != ""){
			plansza_do_zapisania += pole.value;
		}
		else plansza_do_zapisania += "0";
	}		
	setCookie("stan_planszy", plansza_do_zapisania, 365);
	setCookie("numer_planszy", nrPlanszy, 365);
	setCookie("stan_licznika", $('#timer').text(), 365);
}

// Funkcja losujaca plansze
function wybierz_plansze(){			
	var dodaj, mnoz;
	if(document.getElementById("radio1").checked) {
		dodaj = 0;
		mnoz = 3;
	} else if(document.getElementById("radio2").checked) {
		dodaj = 3;
		mnoz = 3;
	} else{
		dodaj = 6;
		mnoz = 4;
	}
	nrPlanszy = Math.floor(Math.random()*mnoz) + dodaj;	
	opisPlanszy = plansze[nrPlanszy];
	opisPlanszyRozw = planszeRozw[nrPlanszy];	
}

//Funkcja tworzaca pusta plansze
function nowa_plansza0(){
    opisPlanszy =
		"000000000" +
		"000000000" +
		"000000000" +
		"000000000" +
		"000000000" +
		"000000000" +
		"000000000" +
		"000000000" +
		"000000000";
    $("#plansza").html(Plansza(opisPlanszy));
    rysujKrawedzie();
    przelacz_inputy(true);
    document.getElementById("stop_timer").disabled = true;
	document.getElementById("cofnij").disabled = true;
	document.getElementById("ponow").disabled = true;
	document.getElementById("zapisz").disabled = true;
	document.getElementById("hint").disabled = true;
	document.getElementById("sprawdz").disabled = true;
}

// Inicjalizacja nowej planszy
function nowa_plansza(){	
    $("#plansza").html(Plansza(opisPlanszy));
    rysujKrawedzie();
    
	cofanieTab = [];
	ponawianieTab = [];
	
	przelacz_inputy(false);
	document.getElementById("cofnij").disabled = true;
	document.getElementById("ponow").disabled = true;
	document.getElementById("stop_timer").disabled = false;
	document.getElementById("zapisz").disabled = false;
	document.getElementById("hint").disabled = false;
	document.getElementById("sprawdz").disabled = false;
	
    $(".field input").mouseover(function(){
        podswietl($(this).parent().attr('id').substr(2,2));
    });
    
    $(".field input").mouseout(function(){
        wygas();
    }); 
    
    $(".field input").keyup(function(event){
    	var pozycja = cofanieTab.length;
    	var w = aktualnePole.substr(2,2);
    	var k = aktualnePole.substr(1,1);
    	var pole = document.getElementById("i"+k+w);
    	if (!isNumberKey(event)){
    		pole.style.background = "white";
    	}
    	else{
    		cofanieTab[pozycja] = k + w + aktualnaWartosc;
        	if (cofanieTab.length > 0){
        		document.getElementById("cofnij").disabled = false;
        	}
	    	var nowaWartosc = event.keyCode - 48;
	    	ponawianieTab = [];		    	
	    	if (!bezKonfliktow(w, k, nowaWartosc)){	
	    		pole.style.background = "#ff2727";
	    	}
	    	else{
	        	pole.style.background = "white";
	        }
    	}
    });    
}

function przelacz_inputy(value) {
    var inputs = document.getElementsByTagName('input');
    for (var i = inputs.length, n = 0; n < i; n++) {
        inputs[n].disabled = value;
    }
}

// Funkcje dotyczace timera
function change_timer() {
    var time = parseInt($('#timer').text(), 0);    
    time++;
    $('#timer').text(time.toString());
}

function start_timer() {
    timer = setInterval(change_timer, 1000);
}

function stop_timer() {
    clearInterval(timer);
    $("#okienko").modal('show');
}

function reset_timer() {
	clearInterval(timer);
	$('#timer').text('0');
	start_timer(timer);
}

function guzik_nowapl(){
        przelacz_inputy(false);
        wybierz_plansze();
        nowa_plansza();
        reset_timer(timer);
}

function guzik_cofnij(){
	var elemCof = cofanieTab.pop();
	var numer = elemCof.substr(0,2);
	var pole = document.getElementById('i' + numer);
	if (pole.value == ""){
		ponawianieTab.push(elemCof);
	}
	else {
		ponawianieTab.push(elemCof.substr(0,2) + pole.value);
	}    		
	if (elemCof.length > 2){
		pole.value = elemCof.substr(2,2);
	}
	else {
		pole.value = "";
	}
	if (cofanieTab.length == 0){
		document.getElementById("cofnij").disabled = true;
	}
	if (ponawianieTab.length > 0){
		document.getElementById("ponow").disabled = false;
	}
	if (bezKonfliktow(elemCof.substr(1,1),elemCof.substr(0,1), parseInt(pole.value))){
		pole.style.background = "white";
	}
	else{
		pole.style.background = "#ff2727";
	}
}

function guzik_ponow(){    	
	var elemPon = ponawianieTab.pop();
	var numer = elemPon.substr(0,2);
	var pole = document.getElementById('i' + numer);
	if (aktualnePole.value == ""){
		cofanieTab.push(numer);
	}
	else {
		cofanieTab.push(numer + pole.value);
	}
	if (elemPon.length > 2){
		pole.value = elemPon.substr(2,2);
	}
	else{
		pole.value = "";
	}
	if (ponawianieTab.length == 0){
		document.getElementById("ponow").disabled = true;
	}
	if (cofanieTab.length > 0){
		document.getElementById("cofnij").disabled = false;
	}
	if (bezKonfliktow(elemPon.substr(1,1), elemPon.substr(0,1), parseInt(pole.value))){
		pole.style.background = "white";
	}
	else{
		pole.style.background = "#ff2727";
	}
}

function guzik_podpowiedz(){
	var w = aktualnePole.substr(2,2);
	var k = aktualnePole.substr(1,1);
	var numer = parseInt(k-1)+parseInt((w-1)*9);
	var pole = document.getElementById(aktualnePole);
	pole.value = opisPlanszyRozw[numer];    	
	pole.disabled = true;
	pole.style.border = "2px solid";
}

function zablokuj(){
	document.getElementById("stop_timer").disabled = true;
	document.getElementById("cofnij").disabled = true;
	document.getElementById("ponow").disabled = true;
	document.getElementById("hint").disabled = true;
}

function guzik_sprawdz(){
    if (poprawneRozwiazanie()){
        $("#niedobrze").hide();
        $("#dobrze").show();
        przelacz_inputy(true);
        stop_timer;
        zablokuj();
    }
    else{
        $("#dobrze").hide();
        $("#niedobrze").show();
    }
}

//document.ready

$(document).ready(function(){
    nowa_plansza0();
    check_cookies();
    
    document.getElementById("radio1").disabled = false;
    document.getElementById("radio2").disabled = false;
    document.getElementById("radio3").disabled = false;
	
    $("#nowapl").click(guzik_nowapl);
    $("#ponow").click(guzik_ponow);    
    $("#cofnij").click(guzik_cofnij);
    $("#zapisz").click(save_cookies);
	$("#hint").click(guzik_podpowiedz);
    $("#sprawdz").click(guzik_sprawdz);
    
    $("#stop_timer").click(stop_timer);
    $("#stop_timer").button();
    $('.alert').hide();
       
    $("#okienko").on("show", function() {
        $("#okienko a.btn").on("click", function(e) {
        	start_timer(timer);
            $("#okienko").modal('hide');
        });
    });
 
    $("#okienko").on("hide", function() { 
        $("#okienko a.btn").off("click");
    });
    
    $("#okienko").modal({
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : false
    });    
})
