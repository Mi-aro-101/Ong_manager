<!DOCTYPE html>
<html lang="en">
<head>
    <title>OBJECTIF</title>
</head>
<body>
    <div class="boss">
        <form action="" method="get">
            <p>Titre du projet: <input type="text" name="titre"></p>
            <p>Objectif principal: <input type="text" name="principal"></p>
            <p>Objectifs specifiques:</p><textarea name="specific" cols="30" rows="10"></textarea>
            <p>Activite1: <input type="text" name="activite"></p>
            <p>Resultats attendues:</p><textarea name="resultats" cols="30" rows="10"></textarea>
            <p class='region'>region: <input type='text' name='region' value=""></input></p>
                <div class="resultContainer suggestregion">
                    <?php for ($i=0; $i < count($values["region"]); $i++) { ?>
                        <a href="#">
                            <?php echo $values["region"][$i]["des_region"]; ?>
                        </a>
                    <?php } ?>
                </div>
            </p>
            <p class='district'>district: <input type='text' id='district' name='district' value=""></input></p>
                <div class="resultContainer suggestdistrict">
                    <?php for ($i=0; $i < count($values["district"]); $i++) { ?>
                        <a href="#">
                            <?php echo $values["district"][$i]["des_fiv"]; ?>
                        </a>
                    <?php } ?>
                </div>
            </p>
            <p class='fokotany'>fokotany: <input type='text' name='fokotany' value=""></input></p>
                <div class="resultContainer suggestfokotany">
                    <?php for ($i=0; $i < count($values["fokotany"]); $i++) { ?>
                        <a href="#">
                            <?php echo $values["fokotany"][$i]["Fokotany_anarany"]; ?>
                        </a>
                    <?php } ?>
                </div>
            </p>
            <p>Population beneficiaire: <input type="text" name="population"></p>
            <p>Cout estimatif: <input type="number" name="cout" min=0></p>
            <p>Source de financement: <input type="text" name="source"></p>
            <p>Liste des moyens humains:</p><textarea name="lshumain" cols="30" rows="10"></textarea>
            <p>Moyens materiels: </p><textarea name="materiels" cols="30" rows="10"></textarea>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('Js/function.js') ?>"></script>
<script>
    suggest('region');
    suggest('district');
    suggest('fokotany');
    function suggest(namepost){
        let oldHtml=document.documentElement.innerHTML;
        const name=".suggest"+namepost;
        const suggestlist=document.querySelector(name);
        const className="."+namepost;
        let input=document.querySelector("input[name='"+namepost+"']");
        const result=document.querySelector(name);
        const all=document.doctype;
        placeSuggestion(namepost);
        input.addEventListener("input", function(e){
            const target=e.target.value;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("Ong_mere/Objectif") ?>",
                data: { [namepost]: target },
                success:function(response){
                    result.innerHTML=response;
                }
            });
        });
    }
</script>
<style>
    .resultContainer p, .resultContainer textarea{
        display: none;
    }
    .resultContainer a{
        text-decoration:none;color:black;display:block;
        border-right: solid black 1px;
        width: 200px;
        font-size: 13px;
    }
    .resultContainer a:hover{
        transition: 0.5s;
        background-color: whitesmoke;
    }
    .resultContainer{max-height: 200px;overflow: auto;}
    .boss{
        margin-left: 2vw;
    }
</style>
</html>
