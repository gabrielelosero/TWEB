function ordinaGiocatoriPer(ord) {

  alert($(this).find("#playerName").val())

  $.ajax({
    method: "POST",
    url: "php/ajax_functions.php",
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
