$(document).ready(function() {
  initialise();
  
  if ($("#divSearch").length) {
    count = 0;
    player_input = $("#searchPlayer");
    player_input.keyup(function() {
      count ++;
      if (count > 2) {
        
        playerlist = "";
        $.ajax({
          method: "POST",
          url: "php/player_functions.php",
          data: {fun:'autocomplete',playername:player_input.val()},
          success: function(jsondata) {

            playerlist = JSON.parse(jsondata);
            if ($('#tableSearchPlayer').length) {
              $('#tableSearchPlayer tr').remove()
              $('#tableSearchPlayer').append(playerlist);
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

  if ($('#tableGiocatoriSchedaTeam').length) {
    table = $('#tableGiocatoriSchedaTeam');
    tr = table.find('tr');
    tr.each(function(key, value) {
      id = $(this).find("td:first").text();
      a = document.createElement("a");
      a.setAttribute("onclick", "vendiGiocatore(" + id + ")");
      text = document.createTextNode("test");
      td = document.createElement("td");
      a.append(text);
      td.append(a);
      value.append(td);

    });
  }

  
});

function initialise() {
  $('#tableSearchPlayer tr').click(function() {
    nome = $(this).find('a:first').text().trim();
    $('#playerinput').val(nome)
    console.log(nome);
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

  alert($(this).find("#playerName").val())

  $.ajax({
    method: "POST",
    url: "php/player_functions.php",
    data: {fun:"getPlayers", ord:ord},
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
