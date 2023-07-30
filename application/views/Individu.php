<title>Individu</title>
<link rel="stylesheet" href=<?php echo base_url("css/Nouvelle_ONG.css");?> >
<div class="content">
    <center><h1>President ou representant de l'ONG</h1></center>
    <form action=<?php echo site_url("Ong_mere/inserereOngMere");?> method="post">
    <p>Etes-vous ?</p>
            <?php for($i =0 ; $i < count($fonction); $i++) { ?>
                <p><input type="radio" name="role" value="<?php echo $fonction[$i];?>"><?php echo $fonctionString[$i];?></p>
            <?php } ?>
            <p>Nom : <input type="text" name="nom" id=""></p>
            <p>Prenom : <input type="text" name="prenom" id=""></p>
            <p>Date de naissance : <input type="date" name="dateNaissance" id=""></p>
            <p>Lieu de naissance : <input type="text" name="lieuNaissance" id=""></p>
            <p>
                Nationalite : <input type="text" name="nationalite" class="country" autocomplete="off" data-suggestions=".country-suggestions">
                <ul class="suggestions country-suggestions"></ul>
            </p>
            <fieldset><legend>Situation matrimoniale</legend>
                <?php foreach($situationMatrimoniale as $sm) { ?>
                    <p><input type="radio" name="situationMatrimoniale" value="<?php echo $sm->idSituationMatrimoniale;?>"><?php echo $sm->designation;?></p>
                <?php } ?>
            </fieldset>
            <p>Adresse personelle : <input type="text" name="adressePersonelle" id=""></p>
            <p>Emploi : <input type="text" name="emploi" id=""></p>
            <p>Societe employeur : <input type="text" name="societeEmployeur" id=""></p>
            <p>Experience dans le domaine humanitaire : <textarea name="experienceHumanitaire" id="" cols="30" rows="1"></textarea></p>
            <p>Telephone : <input type="number" name="telephone" id=""></p>
            <p>Mail : <input type="mail" name="mail" id=""></p>
            <center><button type="submit">Suivant</button></center><br>
    </form>
</div>
<script src=<?php echo base_url("Js/jquery.js");?>></script>
<script>
jQuery(document).ready(function() {
  $("form").on("input", ".country", function() {
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