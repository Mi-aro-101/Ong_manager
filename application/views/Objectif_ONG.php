<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <form action="" method="get">
        <p class='region'>region: <input type='text' name='region'></input></p>
        <div class="resultContainer suggestregion">
            <?php for ($i=0; $i < count($values["region"]); $i++) { ?>
                <a href="#" class="">
                    <?php echo $values["region"][$i]["des_region"]; ?>
                </a>
            <?php } ?>
        </div>
        <p>
      </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    suggest('region');

    function not(className){
        const elements=document.querySelectorAll(className);
    }

    function suggest(namepost){
        const name=".suggest"+namepost;
        const suggestlist=document.querySelector(name);
        const className="."+namepost;
        let input=document.querySelector(className);
        const result=document.querySelector(".resultContainer");
        result.addEventListener('click', function(e){
            const target=e.target.textContent.trim();
            const spacename="<p class='"+namepost+"'>"+namepost+": <input type='text' name='"+namepost+"' value='"+target+"'></input></p>";
            input.innerHTML=spacename;
            suggestlist.textContent="";
        });
        input.addEventListener("input", function(e){
            const target=e.target.value;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("Ong_mere/index") ?>",
                data: { [namepost]: target },
                success:function(response){
                    const post=document.querySelector(".resultContainer");
                    result.innerHTML=response;
                },
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
