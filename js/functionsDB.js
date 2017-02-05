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

});

function initialise() {
  $('#tableSearchPlayer tr').click(function() {
    nome = $(this).find('a:first').text().trim();
    $('#playerinput').val(nome);
  });

}

function setIcons() {
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

function reloadPlayerTable(num) {

  if ($("#allPlayers").length) {
    
    $.ajax({
      method: "POST",
      url: "php/player_functions.php",
      data: {fun:"getPlayers", ord:"", asc:"1",  range:num*20},
      success: function(data) {
        table = $("#allPlayers");
        trs = table.find("tr");

        for (i=1; i<trs.length; i++) {
          trs[i].remove();
        }
        table.append(data); 
        setIcons();
        console.log(data);
      }
    });
  }
}

function switchSearchMode(mode) {
  if ($('#searchHeader').length) {
    
    $('#cercaPerNome').removeClass("invisible");
    $('#cercaPerRuolo').removeClass("invisible");
    $('#cercaPerSquadra').removeClass("invisible");

    $('.searchByNome').removeClass("divSearchSelected");
    $('.searchByRuolo').removeClass("divSearchSelected");
    $('.searchBySquadra').removeClass("divSearchSelected");

    $('#cercaPerNome').removeClass("searchSelected");
    $('#cercaPerRuolo').removeClass("searchSelected");
    $('#cercaPerSquadra').removeClass("searchSelected");

    if (mode == 'nome') {
      $('.searchByNome').addClass("divSearchSelected");
      $('#cercaPerNome').addClass("searchSelected");
      $('#cercaPerRuolo').addClass("invisible");
      $('#cercaPerSquadra').addClass("invisible");
    }
    if (mode == 'ruolo') {
      $('.searchByRuolo').addClass("divSearchSelected");
      $('#cercaPerRuolo').addClass("searchSelected");
      $('#cercaPerNome').addClass("invisible");
      $('#cercaPerSquadra').addClass("invisible");
    }
    if (mode == 'squadra') {
      $('.searchBySquadra').addClass("divSearchSelected");
      $('#cercaPerSquadra').addClass("searchSelected");
      $('#cercaPerRuolo').addClass("invisible");
      $('#cercaPerNome').addClass("invisible");
    }
    
  } 
}

function cercaGiocatori() {
  
  if ($('.scrollTable').length) {
    $('.scrollTable').addClass("invisible");
  }
  if ($("#divSearch").length) {
  
    if ($("#cercaPerNome").hasClass("searchSelected")) {
      n = $("#searchPlayer").val();
      $.ajax({
        method: "POST",
        url: "php/player_functions.php",
        data: {fun:"searchPlayerByName", nome:n},
        success: function(data) {
          appendResultToTable(data);
        }
      });
    }
    if ($("#cercaPerRuolo").hasClass("searchSelected")) {
      n = $("#searchRuolo").val();
      $.ajax({
        method: "POST",
        url: "php/player_functions.php",
        data: {fun:"searchPlayerByRuolo", ruolo:n},
        success: function(data) {
          appendResultToTable(data);
        }
      });
    }
    if ($("#cercaPerSquadra").hasClass("searchSelected")) {
      n = $("#searchSquadra").val();
      $.ajax({
        method: "POST",
        url: "php/player_functions.php",
        data: {fun:"searchPlayerBySquadra", squadra:n},
        success: function(data) {
          appendResultToTable(data);
        }
      });
    }
  }
}

function appendResultToTable(data) {

  if ($(".tableGiocatori").length) {
    th = $(".tableGiocatori tr:first");
    $(".tableGiocatori tr").remove();
    $(".tableGiocatori").append(th);
    $(".tableGiocatori").append(data);
    setIcons();

  }
}

function switchTeamSection(section) {
  
  $("#headerTeamGenerale").removeClass("selected");
  $("#headerTeamFormazione").removeClass("selected");
  $("#headerTeamVoti").removeClass("selected");

  $('.schedaTeamGenerale').removeClass("invisible");
  $('.schedaTeamFormazione').removeClass("invisible");
  $('.schedaTeamVoti').removeClass("invisible");
  $('.schedaTeamGenerale').removeClass("selected");
  $('.schedaTeamFormazione').removeClass("selected");
  $('.schedaTeamVoti').removeClass("selected");

  if (section == "generale") {
    $(".schedaTeamGenerale").addClass("selected");
    $('.schedaTeamFormazione').addClass("invisible");
    $('.schedaTeamVoti').addClass("invisible");
  }
  if (section == "formazione") {
    $("#headerTeamFormazione").addClass("selected");
    $('.schedaTeamGenerale').addClass("invisible");
    $('.schedaTeamVoti').addClass("invisible");
  }
  if (section == "voti") {
    $("#headerTeamVoti").addClass("selected");
    $('.schedaTeamFormazione').addClass("invisible");
    $('.schedaTeamGenerale').addClass("invisible");
  }
}
