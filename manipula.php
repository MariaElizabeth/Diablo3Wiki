<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<?php
header('Content-type: text/html; charset=utf-8');
// usar condição para nao enviar 
$key    = "apag2k44akvwj7dcbm4ube5cwe8ngscf";
$region = "us";
$locale = "en_US";
$char   = "";
$heroid   = "";

if(!isset($_POST['a']))
        header("location:index.php");


if(isset($_POST['region']))   
{
    $region = $_POST['region'];
    
    switch ($region) {
    case 'eu':
        $locale = "en_GB";
        break;
    case 'us':
        $locale = "en_US";
        break;
    case 'kr':
        $locale = "ko_KR";
        break;
    case 'tw':
        $locale = "zh_TW";
        break;
}
}

 // for search CAREER PROFILE
if(isset($_POST['char']) && $region !=""&& $_POST['a'] = 'char')
{
    $char = $_POST['char'];
    
    if($char == '')
        header("location:index.php");
   
        echo"
        <form  method='post' name='enviar' id='enviar' action='index.php'>
            <input type='hidden' value='' name='meuJSON' id='meuJSON'>
        </form>
        ";
    
        echo"
        <script>
        var endereco = 'https://".$region.".api.battle.net/d3/profile/".$char."/?locale=".$locale."&apikey=".$key."';

        var meuJSON;

        $.ajax({
            url: endereco,
            complete: function(res){
            
                var response = res.responseText;
            
                var meuJSON = response.replace('#', '-');
                //alert(meuJSON);
            
                document.getElementById('meuJSON').value = meuJSON;
            
                document.getElementById('enviar').submit();
            
               // window.location='index.php?jsonchar='+res+'';
                           

            }
        });
        
        
        </script>
        ";
    //http://mariaelizabeth.16mb.com/projetos/diablo/
}

 // for search HERO PROFILE
if(isset($_POST['heroid']) && isset($_POST['charhero']) && $region !=""&& $_POST['a'] = 'hero')
{
    $char = $_POST['charhero'];
    $heroid = $_POST['heroid'];
    
    if($heroid == '' || $char == '')
        header("location:index.php");
    
     echo"
        <form  method='post' name='enviarhero' id='enviarhero' action='index.php'>
            <input type='hidden' value='' name='meuJSONhero' id='meuJSONhero'>
        </form>
        ";
    
        echo"
        <script>
        var endereco = 'https://".$region.".api.battle.net/d3/profile/".$char."/hero/".$heroid."?locale=".$locale."&apikey=".$key."';

        var meuJSON;

        $.ajax({
            url: endereco,
            complete: function(res){
            
                  var response = res.responseText;
            
                var meuJSON = response.replace('#', '-');
                //alert(meuJSON);
            
                document.getElementById('meuJSONhero').value = meuJSON;
            
                document.getElementById('enviarhero').submit();
            }
        });

        </script>
        ";
}



?> 