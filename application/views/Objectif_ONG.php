<!DOCTYPE html>
<html lang="en">
<head>
    <title>OBJECTIF</title>
</head>
<body>
    <form action="" method="get">
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
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('Js/function.js') ?>"></script>
<script>
    suggest('region');
    suggest('district');
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
    .resultContainer p{
        display: none;
    }
    a{text-decoration:none;color:blue;display:block;}
</style>
</html>
