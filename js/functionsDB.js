var flag = 1;

function toggleFlag() {
  if (flag == 0)
    flag = 1;
  else
    flag = 0;
  return flag;
}

$(document).ready(function() {
  initialise();
 
  

  if ($(".tableGiocatori").length) {
    td = $(".tableGiocatori").find(".squadra");
    td.each(function(a, i) {
      squadra = this.text.trim().toLowerCase();
      this.text =  " ASD "
      $(this).css('background-image', 'url(img/squadre/' + squadra + '.png)');
      $(this).css('background-repeat', 'no-repeat');
      $(this).css('background-position', 'center');
      $(this).css('background-size', '30px 30px');
      $(this).css('font-size', '30px');
      $(this).css('color', 'rgba(1, 1, 1, 0)');
    });

  }

  if ($("#tableGiocatoriSchedaTeam").length) {
    
    td = $("#tableGiocatoriSchedaTeam").find(".squadra");
    td.each(function(a, i) {
      squadra = this.text.trim().toLowerCase();
      this.text =  " ASD "
      $(this).css('background-image', 'url(img/squadre/' + squadra + '.png)');
      $(this).css('background-repeat', 'no-repeat');
      $(this).css('background-position', 'center');
      $(this).css('background-size', '30px 30px');
      $(this).css('font-size', '30px');
      $(this).css('color', 'rgba(1, 1, 1, 0)');
    });

    $("#switchSchedaTeam").click(function() {
      
      if ($('#votiTeam').hasClass('invisible')) {
        $('#votiTeam').removeClass('invisible');
        $('#teamPlayers').addClass('invisible');
        $(this).text("Formazione");
      } else {
        $('#teamPlayers').removeClass('invisible');
        $('#votiTeam').addClass('invisible');
        $(this).text("Voti Ultima Giornata");
      }
      
    });

  }

  if ($("#divSearch").length) {
    count = 0;
    player_input = $("#searchPlayer");
    player_input.keyup(function() {
      count ++;
      if (count > 2) {

        if ($("#allPlayers").length) {
          $("#allPlayers").addClass("invisible");
        }
        
        playerlist = "";
        $.ajax({
          method: "POST",
          url: "php/player_functions.php",
          data: {fun:'autocomplete',playername:player_input.val()},
          success: function(jsondata) {

            playerlist = JSON.parse(jsondata);
            if ($('#tableSearchPlayer').length) {
              $('#tableSearchPlayer tr').remove();
              tableth = "<tr>";
              tableth += '<th id="playerName" onclick="ordinaGiocatoriPer(\'nome\')" ordine="asc">Nome</td>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'ruolo\')">Ruolo</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'valore\')">Valore</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'squadra\')">Squadra</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'presenze\')">Pres</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'goal\')">Goal</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'ammonizioni\')">Amm</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'espulsioni\')">Esp</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'media\')">Media</th>';
              tableth += '<th onclick="ordinaGiocatoriPer(\'fantamedia\')">FantaMedia</th>';
              tableth += '</tr>';
              $('#tableSearchPlayer').append(tableth);
              $('#tableSearchPlayer').append(playerlist);
              $('#tableSearchPlayer').addClass("tableGiocatori");
              $('#tableSearchPlayer').css('display', 'block');
              $('#tableSearchPlayer').find('a').removeAttr("href");
              $('#tableSearchPlayer tr').addClass("selectPlayer");
              initialise();
            }
          }
        });

      }
    });
  }

  // appende alla fine di ogni riga il tasto vendi
  if ($('#tableGiocatoriSchedaTeam').length) {
    table = $('#tableGiocatoriSchedaTeam');
    tr = table.find('tr');
    tr.each(function(key, value) {
      if (key == 0) {
        console.log();
      } else {
        id = $(this).find("td:first").text();
        $(this).append("<td><a onclick='vendiGiocatore(" + id + ")'>VENDI</a></td>");
      }
    });
  }

  // setta l'altezza del menu in modo che sia uguale a quella del div centrale
  /*if ($("#main_content").length && $("#menu").length) {
    mainHeight = $("#main_content").css("height");
    $("#menu").css("height", mainHeight);
  }*/

});

function initialise() {
  $('#tableSearchPlayer tr').click(function() {
    nome = $(this).find('a:first').text().trim();
    $('#playerinput').val(nome);

  });

}

function vendiGiocatore(id_giocatore) {
  
  $.ajax({
    method: "POST",
    url: "php/player_functions.php",
    data: {fun:'vendi',playerid:id_giocatore},
    success: function(jsondata) {
      location.reload();
    }
  });
}

function ordinaGiocatoriPer(ord) {

  flag = toggleFlag();

  $.ajax({
    method: "POST",
    url: "php/player_functions.php",
    data: {fun:"getPlayers", ord:ord, asc:flag},
    success: function(data) {
      table = $("#allPlayers");
      trs = table.find("tr");

      for (i=1; i<trs.length; i++) {
        trs[i].remove();
      }
      table.append(data);
    }
  });
}
