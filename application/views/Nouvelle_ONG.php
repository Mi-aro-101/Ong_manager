<?php
  $error=explode("¨",urldecode($values['error']));
?>
<link rel="stylesheet" href=<?php echo base_url("css/Nouvelle_ONG.css");?> >
<title>Inscription ONG</title>
<center><h1>Inscription ONG</h1></center>
<div class="content">
  <?php if($error[0]!=="No error"){ ?>
    <div class="error">
      <fieldset>
        <legend><h3>Error</h3></legend>
        <?php for ($i=0; $i < count($error); $i++) { ?>
          <p style='color: red;'><?php echo $error[$i] ?></p>
        <?php } ?>
      </fieldset>
    </div>
  <?php } ?>
  <!-- A propos de l'ONG -->
  <form action=<?php echo site_url("Ong_mere/inserereOngMere");?> method="post">
    <fieldset>
      <legend><h2>Fiche de renseignement sur l'ONG mere</h2></legend>
          Denomination : <input type="text" name="denomination" >
          <p>Doit-etre de 2 a 40 caracteres et seulement de type alphanumerique</p>

          Date de creation : <input type="date" name="dateDeCreation">
          <p>Ne doit pas depasser la date aujourd'hui</p>

          <p>
              Nationalite : <input type="text" name="nationalite" class="country" data-suggestions=".country-suggestions">
              <ul class="resultContainer country-suggestions"></ul>
          </p>

          <p>Numero d'enregistrement : <input type="text" name="numeroEnregistrement" list="a"></p>
          Objectifs statuaires : <textarea name="objectifStatuaire" id="" cols="30" rows="1"></textarea>
          <p>Domaine d'activites : <input type="text" name="domaineActivite"></p>

          <fieldset class="partenaire">
              <legend><h3>Autres pays intervenants</h3></legend>
              <button type="button" onclick="cloneRow()">+</button>
              <p class="intervenants">
                  Autres pays d'intervention : <input type="text" name="Autres_pays_d_intervention[]" class="intervenant" data-suggestions=".intervenant-suggestions">
                  <ul class="resultContainer intervenant-suggestions"></ul>
              </p>
      </fieldset>

          Effectifs des membres : <input type="number" name="effectifMembres">
          <p>Mode de donations financieres : <input type="text" name="modeDonationFinanciere"></p>
          <p>Organigramme de l'organisation : <input type="text" name="organigramme"></p>
          <p id="huhu"></p>
    </fieldset>

    <!-- President -->

    <fieldset>
      <legend><h2>President</h2></legend>
              <p>Nom : <input type="text" name="nom" id=""></p>
              <p>Prenom : <input type="text" name="prenom" id=""></p>
              Date de naissance : <input type="date" name="dateNaissance" id="">
              <p>Date non valide</p>
              <p>Lieu de naissance : <input type="text" name="lieuNaissance" id=""></p>
              <p>
                  Nationalite : <input type="text" name="nationalite" class="country" autocomplete="off" data-suggestions=".country-suggestions">
                  <ul class="resultContainer country-suggestions"></ul>
              </p>
              <fieldset><legend>Situation matrimoniale</legend>
                  <?php foreach($values['situationMatrimoniale'] as $sm) { ?>
                      <p><input type="radio" name="idSituationMatrimoniale" value="<?php echo $sm->idSituationMatrimoniale;?>"><?php echo $sm->designation;?></p>
                  <?php } ?>
              </fieldset>
              <p>Adresse personelle : <input type="text" name="adressePersonelle" id=""></p>
              <p>Emploi : <input type="text" name="emploi" id=""></p>
              <p>Societe employeur : <input type="text" name="societeEmployeur" id=""></p>
              <p>Experience dans le domaine humanitaire : <textarea name="experienceHumanitaire" id="" cols="30" rows="1"></textarea></p>
              Telephone : <input type="text" name="telephone_president" id="">
              <p>Numero de telephone invalide</p>
              Mail : <input type="mail" name="mail_president" id="">
              <p>Adresse email invalide</p>
    </fieldset>

    <!-- Representant -->

    <fieldset>
      <legend><h2>Representant</h2></legend>
              <p>Nom : <input type="text" name="nom" id=""></p>
              <p>Prenom : <input type="text" name="prenom" id=""></p>
              Date de naissance : <input type="date" name="dateNaissance" id="">
              <p>Date non valide</p>
              <p>Lieu de naissance : <input type="text" name="lieuNaissance" id=""></p>
              <p>
                  Nationalite : <input type="text" name="nationalite" class="country" autocomplete="off" data-suggestions=".country-suggestions">
                  <ul class="resultContainer country-suggestions"></ul>
              </p>
              <fieldset><legend>Situation matrimoniale</legend>
                  <?php foreach($values['situationMatrimoniale'] as $sm) { ?>
                      <p><input type="radio" name="idSituationMatrimoniale" value="<?php echo $sm->idSituationMatrimoniale;?>"><?php echo $sm->designation;?></p>
                  <?php } ?>
              </fieldset>
              <p>Adresse personelle : <input type="text" name="adressePersonelle" id=""></p>
              <p>Emploi : <input type="text" name="emploi" id=""></p>
              <p>Societe employeur : <input type="text" name="societeEmployeur" id=""></p>
              <p>Experience dans le domaine humanitaire : <textarea name="experienceHumanitaire" id="" cols="30" rows="1"></textarea></p>
              Telephone : <input type="text" name="telephone_representant" id="">
              <p>Numero de telephone invalide</p>
              Mail : <input type="mail" name="mail_representant" id="">
              <p>Adresse email invalide</p>
    </fieldset>

    <!-- Objectifs -->

    <fieldset>
      <legend><h2>Objectif</h2></legend>
              <p>Titre du projet: <input type="text" name="titre"></p>
              <p>Objectif principal: <input type="text" name="principal"></p>
              <p>Objectifs specifiques:</p><textarea name="specific" cols="30" rows="1"></textarea>
              <p>Activite1: <input type="text" name="activite"></p>
              <p>Resultats attendues:</p><textarea name="resultats" cols="30" rows="1"></textarea>
              <p class='region'>region: <input type='text' name='region' value=""></input></p>
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
              <p class='district'>district: <input type='text' name='district' value=""></input></p>
                  <div class="resultContainer suggestdistrict">
                    <ul>
                        <?php for ($i=0; $i < count($values["district"]); $i++) { ?>
                            <li>
                                <?php echo $values["district"][$i]["des_fiv"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p class='fokotany'>fokotany: <input type='text' name='fokotany' value=""></input></p>
                  <div class="resultContainer suggestfokotany">
                    <ul>
                        <?php for ($i=0; $i < count($values["fokotany"]); $i++) { ?>
                            <li>
                                <?php echo $values["fokotany"][$i]["Fokotany_anarany"]; ?>
                          </li>
                        <?php } ?>
                    </ul>
                  </div>
              </p>
              <p>Population beneficiaire: <input type="text" name="population"></p>
              <p>Cout estimatif: <input type="number" name="cout" min=0></p>
              <p>Source de financement: <input type="text" name="source"></p>
              <p>Liste des moyens humains:</p><textarea name="lshumain" cols="30" rows="1"></textarea>
              <p>Moyens materiels: </p><textarea name="materiels" cols="30" rows="1"></textarea>
    </fieldset>
    <center><button type="submit">Suivant</button></center><br>
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
<style>
    .resultContainer li{
        text-decoration:none;color:black;display:block;
        border-right: solid black 1px;
        width: 30%;
        font-size: 85%;
    }
    .resultContainer li:hover{
        cursor: pointer;
        transition: 0.5s;
        background-color: whitesmoke;
    }
    .resultContainer{max-height: 200px;overflow: auto;}
    .boss{
        margin-left: 2vw;
    }
</style>
