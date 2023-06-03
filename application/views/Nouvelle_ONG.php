
<div class="content">
    <center><h1>Fiche de renseignement sur l'ONG mere</h1></center>
    <form action="" method="post">
        <p>Denomination : <input type="text" name="Denomination"></p>
        <p>Date de creation : <input type="date" name="Date_de_creation"></p>

        <p>
            Nationalite : <input type="text" name="Nationalite" id="country" autocomplete=off>
            <ul id="suggestions"></ul>
        </p>
        
        <p>Numero d'enregistrement : <input type="text" name="Numero_d_enregistrement" list="a"></p>
        <p>Objectifs statuaires : <input type="text" name="Objectifs_statuaires"></p>
        <p>Domaine d'activites : <input type="text" name="Domaine_d_activites"></p>
        <p>Autres pays d'intervention : <input type="text" name="Autres_pays_d_intervention"></p>
        <p>Effectifs des membres : <input type="text" name="Effectif_des_membres"></p>
        <p>Mode de donations financieres : <input type="text" name="Mode_de_donations_financieres"></p>
        <p>Organigramme de l'organisation : <input type="text" name="Organigramme_de_l_organisation"></p>
        <center><button type="submit">Valider</button></center><br>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
jQuery(document).ready(function() {
  $("#country").on("input", function() {
    var query = $(this).val(); // Get the value of the input field

    // Make an AJAX request to the server to retrieve the suggestions
    $.ajax({
      url: "<?php echo base_url('index.php/Ong_mere/suggestCountry'); ?>",
      method: "POST",
      data: { query: query },
      dataType: "json",
      success: function(response) {
        var suggestions = response.suggestions;
        $("#suggestions").empty();

        suggestions.forEach(function(suggestion) {
          var listItem = $("<li>").text(suggestion);
          $("#suggestions").append(listItem);
        });
      },
      error: function(xhr, status, error) {
        console.log("Error:", error);
      }
    });
  });
});
</script>
