<link rel="stylesheet" href=<?php echo base_url("css/Nouvelle_ONG.css");?> >
<title>Inscription ONG</title>
<div class="content">
    <center><h1>Fiche de renseignement sur l'ONG mere</h1></center>
    <form action=<?php echo site_url("Ong_mere/inserereOngMere");?> method="post">
        <p>Denomination : <input type="text" name="denomination"></p>
        <p>Date de creation : <input type="date" name="dateDeCreation"></p>

        <p>
            Nationalite : <input type="text" name="nationalite" class="country" autocomplete="off" data-suggestions=".country-suggestions">
            <ul class="suggestions country-suggestions"></ul>
        </p>
        
        <p>Numero d'enregistrement : <input type="text" name="numeroEnregistrement" list="a"></p>
        <p>Objectifs statuaires : <textarea name="objectifStatuaire" id="" cols="30" rows="1"></textarea></p>
        <p>Domaine d'activites : <input type="text" name="domaineActivite"></p>

        <fieldset class="partenaire">
            <legend><h2>Autres pays intervenants</h2></legend>
            <button type="button" onclick="cloneRow()">+</button>
            <p class="intervenants">
                Autres pays d'intervention : <input type="text" name="Autres_pays_d_intervention[]" class="intervenant" data-suggestions=".intervenant-suggestions">
                <ul class="suggestions intervenant-suggestions"></ul>
            </p>
    </fieldset>

        <p>Effectifs des membres : <input type="text" name="effectifMembres"></p>
        <p>Mode de donations financieres : <input type="text" name="modeDonationFinanciere"></p>
        <p>Organigramme de l'organisation : <input type="text" name="organigramme"></p>
        <center><button type="submit">Suivant</button></center><br>
        <p id="huhu"></p>
    </form>
</div>
<script src=<?php echo base_url("Js/jquery.js");?>></script>
<script src=<?php echo base_url("Js/cloneLine.js");?>></script>
<script>
jQuery(document).ready(function() {
  $("form").on("input", ".country, .intervenant", function() {
    var input = $(this);
    var query = input.val(); // Get the value of the input field
    var suggestionList = $(input.data('suggestions'));
    var inputParent = input.parent(); // Get the parent element of the input field

    // Make an AJAX request to the server to retrieve the suggestions
    $.ajax({
      url: "<?php echo site_url('Ong_mere/suggestCountry'); ?>",
      method: "POST",
      data: { query: query },
      dataType: "json",
      success: function(response) {
        var suggestions = response.suggestions;

        // Empty the suggestion list for the specific input's parent element
        suggestionList.empty();

        suggestions.forEach(function(suggestion) {
          var listItem = $("<li>").text(suggestion.nameCountry);
          listItem.on("click", function() {
            input.val(suggestion.nameCountry);
            suggestionList.empty();
          });
          suggestionList.append(listItem);
        });

        // Append the suggestion list to the specific input's parent element
        inputParent.append(suggestionList);
      },
      error: function(xhr, status, error) {
        console.log("Error:", error);
      }
    });
  });
});



</script>
