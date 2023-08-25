
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription ONG</title>
</head>
<body>

<?php
  $error=explode("¨",urldecode($values['error']));
?>
<link rel="stylesheet" href=<?php echo base_url("css/Nouvelle_ONG.css");?> >
<title>Inscription ONG</title>
<center><h1>Inscription ONG</h1></center>
<div class="content">
  <?php if($error[0]!=="No error"){ ?>
      <fieldset class="error">
        <legend><h3>Error</h3></legend>
        <?php for ($i=0; $i < count($error); $i++) { ?>
          <p style='color: red;'><?php echo $error[$i]; ?></p>
        <?php } ?>
      </fieldset>
  <?php } ?>
  <!-- A propos de l'ONG -->
  <form action=<?php echo site_url("Ong_mere/inserereOngMere");?> method="post">
    <fieldset>
      <legend><h2>Fiche de renseignement sur l'ONG mere</h2></legend>
          Denomination : <input type="text" name="denomination" value="Papango">
          <p>Doit-etre de 2 a 40 caracteres et seulement de type alphanumerique</p>

          Date de creation : <input type="date" name="dateDeCreation" value="08/12/2000">
          <p>Ne doit pas depasser la date aujourd'hui</p>

          <p>
              Nationalite : <input type="text" name="nationaliteONG" class="country" data-suggestions=".country-suggestions" value="Madagascar">
              <ul class="resultContainer country-suggestions"></ul>
          </p>

          <p>Numero d'enregistrement : <input type="text" name="numeroEnregistrement" list="a" value="P67_MDG_2000"></p>
          Objectifs statuaires : <textarea name="objectifStatuaire" id="" cols="30" rows="1">Cultural game for Madagascar</textarea>
          <p>Domaine d'activites : <input type="text" name="domaineActivite" value="Informatiques"></p>

          <fieldset class="partenaire">
              <legend><h3>Autres pays intervenants</h3></legend>
              <button type="button" onclick="cloneRow('partenaire', 'intervenants')">+</button>
              <p class="intervenants">
                  Autres pays d'intervention : <input type="text" name="Autres_pays_d_intervention[]" class="intervenant" data-suggestions=".intervenant-suggestions">
                  <ul class="resultContainer intervenant-suggestions"></ul>
              </p>
      </fieldset><br>

          Effectifs des membres : <input type="number" name="effectifMembres" value="2"><p></p>
          Mode de donations financieres : <input type="text" name="modeDonationFinanciere" value="Ariary"><p></p>
          Organigramme de l'organisation : <input type="text" name="organigramme" value="None"><p></p>
          <p id="huhu"></p>
    </fieldset>

    <!-- President -->

    <fieldset>
      <legend><h2>President</h2></legend>
              <p>Nom : <input type="text" name="nom0" id="" value="RAMANANDRAITSIORY"></p>
              <p>Prenom : <input type="text" name="prenom0" id="" value="Mikajy"></p>
              Date de naissance : <input type="date" name="dateDeNaissance0" id="">
              <p>Date non valide</p>
              <p>Lieu de naissance : <input type="text" name="lieuNaissance0" id="" value="Antananarivo"></p>
              <p>
                  Nationalite : <input type="text" name="nationaliteIndividu0" class="country" autocomplete="off" data-suggestions=".country-suggestions" value="Madagascar">
                  <ul class="resultContainer country-suggestions"></ul>
              </p>
              <fieldset><legend>Situation matrimoniale</legend>
                  <?php foreach($values['situationMatrimoniale'] as $sm) { ?>
                      <p><input type="radio" name="idSituationMatrimoniale0" value="<?php echo $sm->idSituationMatrimoniale;?>"><?php echo $sm->designation;?></p>
                  <?php } ?>
              </fieldset>
              <p>Adresse personelle : <input type="text" name="adressePersonelle0" id="" value="IPJ 13 A Ambonisoa"></p>
              <p>Emploi : <input type="text" name="emploi0" id="" value="Etudiant"></p>
              <p>Societe employeur : <input type="text" name="societeEmployeur0" id="" value="None"></p>
              <p>Adresse employeur : <input type="text" name="adresseEmployeur0" id="" value="None"></p>
              <p>Experience dans le domaine humanitaire : <textarea name="experienceHumanitaire0" id="" cols="30" rows="1">None</textarea></p>
              Telephone : <input type="text" name="telephone0" id="" value="+261 32 65 779 09">
              <p>Numero de telephone invalide</p>
              Mail : <input type="mail" name="mail0" id="" value="mikajy@gmail.com">
              <p>Adresse email invalide</p>
    </fieldset>

    <!-- Representant -->

    <fieldset>
      <legend><h2>Representant</h2></legend>
              <p>Nom : <input type="text" name="nom1" id="" value="RAMANANDRAITSIORY"></p>
              <p>Prenom : <input type="text" name="prenom1" id="" value="Miaro"></p>
              Date de naissance : <input type="date" name="dateDeNaissance1" id="">
              <p>Date non valide</p>
              <p>Lieu de naissance : <input type="text" name="lieuNaissance1" id="" value="Antsirabe"></p>
              <p>
                  Nationalite : <input type="text" name="nationaliteIndividu1" class="country" autocomplete="off" data-suggestions=".country-suggestions" value="Madagascar">
                  <ul class="resultContainer country-suggestions"></ul>
              </p>
              <fieldset><legend>Situation matrimoniale</legend>
                  <?php foreach($values['situationMatrimoniale'] as $sm) { ?>
                      <p><input type="radio" name="idSituationMatrimoniale1" value="<?php echo $sm->idSituationMatrimoniale;?>"><?php echo $sm->designation;?></p>
                  <?php } ?>
              </fieldset>
              <p>Adresse personelle : <input type="text" name="adressePersonelle1" id="" value="IPJ 13 A Ambonisoa"></p>
              <p>Emploi : <input type="text" name="emploi1" id="" value="Etudiant"></p>
              <p>Societe employeur : <input type="text" name="societeEmployeur1" id="" value="None"></p>
              <p>Adresse employeur : <input type="text" name="adresseEmployeur1" id="" value="None"></p>
              <p>Experience dans le domaine humanitaire : <textarea name="experienceHumanitaire1" id="" cols="30" rows="1">None</textarea></p>
              Telephone : <input type="text" name="telephone1" id="" value="+261 34 51 161 11">
              <p>Numero de telephone invalide</p>
              Mail : <input type="mail" name="mail1" id="" value="miaro.rams@gmail.com">
              <p>Adresse email invalide</p>
    </fieldset>

    <!-- Objectifs -->

    <fieldset>
      <legend><h2>Projet</h2></legend>
              <p>Titre du projet: <input type="text" name="titre" value="Kalalaos"></p>
              <p>Objectif principal: <input type="text" name="objectifPrincipal" value="Mampifaly"></p>
              <p>Objectifs specifiques:</p><textarea name="objectifSpecifique" cols="30" rows="1">Fun</textarea>
              <p>Activite: <input type="text" name="activite" value="Tsy misy"></p>
              <p>Resultats attendues:</p><textarea name="resultatAttendu" cols="30" rows="1">People have fun</textarea>
              <p class='region'>province: <input type='text' name='province' value="Antananarivo"></input></p>
                  <div class="resultContainer suggestprovince">
                    <ul>
                        <?php for ($i=0; $i < count($values["province"]); $i++) { ?>
                            <li>
                                <?php echo $values["province"][$i]["des_province"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p class='region'>region: <input type='text' name='region' value="Analamanga"></input></p>
                  <div class="resultContainer suggestregion">
                    <ul>
                        <?php for ($i=0; $i < count($values["region"]); $i++) { ?>
                            <li>
                                <?php echo $values["region"][$i]["des_region"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p class='district'>district: <input type='text' name='district' value="Atsimondrano"></input></p>
                  <div class="resultContainer suggestdistrict">
                    <ul>
                        <?php for ($i=0; $i < count($values["district"]); $i++) { ?>
                            <li>
                                <?php echo $values["district"][$i]["des_district"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p class='district'>commune: <input type='text' name='commune' value="Bemasoandro"></input></p>
                  <div class="resultContainer suggestcommune">
                    <ul>
                        <?php for ($i=0; $i < count($values["commune"]); $i++) { ?>
                            <li>
                                <?php echo $values["commune"][$i]["des_commune"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p class='fokotany'>fokotany: <input type='text' name='fokotany' value="Ambohidahy"></input></p>
                  <div class="resultContainer suggestfokotany">
                    <ul>
                        <?php for ($i=0; $i < count($values["fokotany"]); $i++) { ?>
                            <li>
                                <?php echo $values["fokotany"][$i]["des_fokotany"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p>Population beneficiaire: <input type="text" name="populationBeneficiaire" value="Malagasy"></p>
              <p>Cout estimatif: <input type="number" name="coutEstimatif" min=0 value="3000000000"></p>
              <p>Source de financement: <input type="text" name="sourceDefinancement" value="Entreprise"></p>
              <fieldset class="moyen_humain">
                <legend><h3>Liste des moyens humains : </h3></legend>
                <button type="button" onclick="cloneRow('moyen_humain', 'humain')">+</button>
                <p class="humain">
                    Moyen humain : <input type="text" name="moyensHumain[]">
                </p>
              </fieldset><br>
              <fieldset class="moyen_materiel">
                <legend><h3>Liste des moyens materiel : </h3></legend>
                <button type="button" onclick="cloneRow('moyen_materiel', 'materiel')">+</button>
                <p class="materiel">
                    Moyen materiel : <input type="text" name="moyensMateriel[]">
                </p>
              </fieldset><br>
    </fieldset>
    <center><button type="submit">Valider</button></center><br>
  </form>
</div>
<script src=<?php echo base_url("Js/jquery.js");?>></script>
<script src=<?php echo base_url("Js/cloneLine.js");?>></script>
<script src="<?= base_url('Js/function.js') ?>"></script>
<script src="<?= base_url('Js/regex.js') ?>"></script>
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

    suggest('district');
    suggest('region');
    suggest('fokotany');
    suggest('province');
    suggest('commune');
    function suggest(namepost){
        const temp=document.createElement('div');
        let oldHtml=document.documentElement.innerHTML;
        const name=".suggest"+namepost;
        const className="."+namepost;
        let input=document.querySelector("input[name='"+namepost+"']");
        const result=document.querySelector(name);
        placeSuggestion(namepost);
        input.addEventListener("input", function(e){
            const target=e.target.value;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("Ong_mere/index") ?>",
                data: { [namepost]: target },
                success:function(response){
                    temp.innerHTML = response;
                    const suggestionList = temp.querySelector('.suggest'+namepost+' ul');
                    result.innerHTML = suggestionList.outerHTML;
                },
                error: function(xhr, status, error) {
                  console.log("Error:", error);
                }
            });
        });
    }

</script>
</body>
</html>
