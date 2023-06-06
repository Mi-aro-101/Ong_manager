<link rel="stylesheet" href=<?php echo base_url("css/Nouvelle_ONG.css");?> >
<div class="content">
    <center><h1>Fiche de renseignement sur l'ONG mere</h1></center>
    <form action="" method="post">
        <p>Denomination : <input type="text" name="Denomination"></p>
        <p>Date de creation : <input type="date" name="Date_de_creation"></p>

        <p>
            Nationalite : <input type="text" name="Nationalite" class="country" autocomplete="off" data-suggestions=".country-suggestions">
            <ul class="suggestions country-suggestions"></ul>
        </p>
        
        <p>Numero d'enregistrement : <input type="text" name="Numero_d_enregistrement" list="a"></p>
        <p>Objectifs statuaires : <input type="text" name="Objectifs_statuaires"></p>
        <p>Domaine d'activites : <input type="text" name="Domaine_d_activites"></p>

        <fieldset class="partenaire">
            <legend><h2>Autres pays intervenants</h2></legend>
            <button type="button" onclick="cloneRow()">+</button>
            <p class="intervenants">
                Autres pays d'intervention : <input type="text" name="Autres_pays_d_intervention" class="intervenant" data-suggestions=".intervenant-suggestions">
                <ul class="suggestions intervenant-suggestions"></ul>
            </p>
    </fieldset>

        <p>Effectifs des membres : <input type="text" name="Effectif_des_membres"></p>
        <p>Mode de donations financieres : <input type="text" name="Mode_de_donations_financieres"></p>
        <p>Organigramme de l'organisation : <input type="text" name="Organigramme_de_l_organisation"></p>
        <center><button type="submit">Valider</button></center><br>
        <p id="huhu"></p>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src=<?php echo base_url("Js/cloneLine.js");?>></script>
<script>
jQuery(document).ready(function() {
  $("form").on("input", ".country, .intervenant", function() {
    var input = $(this);
    var query = input.val(); // Get the value of the input field
    var suggestionList = $(input.data('suggestions'));

    // Make an AJAX request to the server to retrieve the suggestions
    $.ajax({
      url: "<?php echo site_url('Ong_mere/suggestCountry'); ?>",
      method: "POST",
      data: { query: query },
      dataType: "json",
      success: function(response) {
        var suggestions = response.suggestions;
        suggestionList.empty();

        suggestions.forEach(function(suggestion) {
          var listItem = $("<li>").text(suggestion.nameCountry);
          listItem.on("click", function() {
            input.val(suggestion.nameCountry);
            suggestionList.empty();
          });
          suggestionList.append(listItem);
        });
      },
      error: function(xhr, status, error) {
        console.log("Error:", error);
      }
    });
  });
});


</script>
