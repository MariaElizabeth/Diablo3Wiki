<!--Pagina desenvolvida para a manipulacao da API da battle.net-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<?php
header('Content-type: text/html; charset=utf-8');

/*Variaveis necessarias para a API*/
$key    = "apag2k44akvwj7dcbm4ube5cwe8ngscf";/*Key de acesso*/
$region = "";/*regiao do jogador*/
$locale = "";/*local*/
$char   = "";/*battleTag*/
$heroid   = "";/*id do heroi*/

/*Se essa pagina nao for acessada atraves de um form, redireciono para a pagina principal*/
if(!isset($_POST['a']))
        header("location:index.php");

/*Se a regiao for recebida, atualizo a variavel*/
if(isset($_POST['region']))   
{
    /*Inicio a session se nao estiver iniciada*/
    if (!isset($_SESSION)) 
    {
	   session_start();
    }
    /*Salvo a regiao escolhida pelo usuario para futuras consultas*/
    $_SESSION['region'] = $_POST['region'];
    $region = $_POST['region'];
    
    /*Switch para os locais de acordo com a regiao*/
    switch ($region)
    {
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

  function validateBattletag($battlenet_tag) {
        $pattern = '/^[\p{L}\p{Mn}][\p{L}\p{Mn}0-9]{2,11}-[0-9]{4,5}+$/u';
        return (preg_match($pattern, $battlenet_tag)) ? true : false;
    }

/*Codigo necessario para a pesquisa por perfil*/
if(isset($_POST['char']) && $region !=""&& $_POST['a'] = 'char')
{   /*valido a battleTag para nao dar erro no Json*/
    $char = str_replace('#','-',$_POST['char']);
    /*se a battleTag nao for informada redireciono para a pagina principal*/
    if($char == ''||validateBattletag($char)== false)
        header("location:index.php?invalidBattletag=true#Char");
    
       /*form que sera retornado com o Json para a pagina principal*/
        echo"
        <form  method='post' name='enviar' id='enviar' action='index.php#Char'>
            <input type='hidden' value='' name='meuJSON' id='meuJSON'>
        </form>
        ";
    
        /*Script para pedir o Json com as informacoes da Api referentes ao perfil*/
        echo"
        <script>
        //url para pedir as informacoes do perfil
        var endereco = 'https://".$region.".api.battle.net/d3/profile/".$char."/?locale=".$locale."&apikey=".$key."';

        var meuJSON;

        $.ajax({
            url: endereco,
            complete: function(res){
                // pego o Json
                var response = res.responseText;
                // retiro caracteres invalidos
                var meuJSON = response.replace('#', '-');
                //alert(meuJSON);
                // adiciono o Json no form
                document.getElementById('meuJSON').value = meuJSON;
                // envio o form
                document.getElementById('enviar').submit();
            
               // window.location='index.php?jsonchar='+res+'';
                           

            }
        });
        
        </script>
        ";
    
    
}

/*Codigo necessario para a pesquisa por Heroi*/
if(isset($_POST['heroid']) && isset($_POST['charhero']) && $region !=""&& $_POST['a'] = 'hero')
{
    $char = str_replace('#','-',$_POST['charhero']);
    $heroid = $_POST['heroid'];
    
    if($heroid == '' || $char == ''||validateBattletag($char)== false)
        header("location:index.php?invalidBattletagHero=true#Hero");
     /*form que sera retornado com o Json para a pagina principal*/
     echo"
        <form  method='post' name='enviarhero' id='enviarhero' action='index.php#HeroFound'>
            <input type='hidden' value='' name='meuJSONhero' id='meuJSONhero'>
        </form>
        ";
    /*Script para pedir o Json com as informacoes da Api referentes ao Heroi*/
        echo"
        <script>
        
        //url para pedir as informacoes do heroi
        var endereco = 'https://".$region.".api.battle.net/d3/profile/".$char."/hero/".$heroid."?locale=".$locale."&apikey=".$key."';

        var meuJSON;

        $.ajax({
            url: endereco,
            complete: function(res){
                // pego o Json
                var response = res.responseText;
                // retiro caracteres invalidos
                var meuJSON = response.replace('#', '-');
                //alert(meuJSON);
            
                // adiciono o Json no form
                document.getElementById('meuJSONhero').value = meuJSON;
                // envio o form
                document.getElementById('enviarhero').submit();
            }
        });

        </script>
        ";
}

/*para buscar seguidor/follower https://eu.api.battle.net/d3/data/follower/templar?locale=en_GB&apikey=apag2k44akvwj7dcbm4ube5cwe8ngscf*/
/*Codigo necessario para a pesquisa de follower*/
if(isset($_POST['followerselect']) && $region !=""&& $_POST['a'] = 'follower')
{
    $follower = $_POST['followerselect'];
    
  /*  if($heroid == '' || $char == ''||validateBattletag($char)== false)
        header("location:index.php?invalidBattletagHero=true#Hero");*/
     /*form que sera retornado com o Json para a pagina principal*/
     echo"
        <form  method='post' name='enviarfollower' id='enviarfollower' action='index.php#followerFound'>
            <input type='hidden' value='' name='meuJSONfollower' id='meuJSONfollower'>
        </form>
        ";
    /*Script para pedir o Json com as informacoes da Api referentes ao Heroi*/
        echo"
        <script>
        
        //url para pedir as informacoes do heroi
        //https://eu.api.battle.net/d3/data/follower/templar?locale=en_GB&apikey=apag2k44akvwj7dcbm4ube5cwe8ngscf
        var endereco = 'https://".$region.".api.battle.net/d3/data/follower/".$follower."?locale=".$locale."&apikey=".$key."';

        var meuJSON;

        $.ajax({
            url: endereco,
            complete: function(res){
                // pego o Json
                var response = res.responseText;
                // retiro caracteres invalidos
                var meuJSON = response.replace('#', '-');
                //alert(meuJSON);
            
                // adiciono o Json no form
                document.getElementById('meuJSONfollower').value = meuJSON;
                // envio o form
                document.getElementById('enviarfollower').submit();
            }
        });

        </script>
        ";
}



/*para buscar /artisan https://eu.api.battle.net/d3/data/artisan/jeweler?locale=en_GB&apikey=apag2k44akvwj7dcbm4ube5cwe8ngscf*/
/*Codigo necessario para a pesquisa de artisan*/
if(isset($_POST['artisanselect']) && $region !="" && $_POST['a'] = 'artisan')
{
    $artisan = $_POST['artisanselect'];
   
  /*  if($heroid == '' || $char == ''||validateBattletag($char)== false)
        header("location:index.php?invalidBattletagHero=true#Hero");*/
     /*form que sera retornado com o Json para a pagina principal*/
     echo"
        <form  method='post' name='enviarartisan' id='enviarartisan' action='index.php#artisanFound'>
            <input type='hidden' value='' name='meuJSONartisan' id='meuJSONartisan'>
        </form>
        ";
    /*Script para pedir o Json com as informacoes da Api referentes ao Heroi*/
        echo"
        <script>
        
        //url para pedir as informacoes do heroi
        //https://eu.api.battle.net/d3/data/artisan/jeweler?locale=en_GB&apikey=apag2k44akvwj7dcbm4ube5cwe8ngscf
        var endereco = 'https://".$region.".api.battle.net/d3/data/artisan/".$artisan."?locale=".$locale."&apikey=".$key."';

        var meuJSON;

        $.ajax({
            url: endereco,
            complete: function(res){
                // pego o Json
                var response = res.responseText;
                // retiro caracteres invalidos
                var meuJSON = response.replace('#', '-');
                //alert(meuJSON);
            
                // adiciono o Json no form
                document.getElementById('meuJSONartisan').value = meuJSON;
                // envio o form
                document.getElementById('enviarartisan').submit();
            }
        });

        </script>
        ";
}
?> 


<!--Loading-->
<div id="preloader">
    <h1>CARREGANDO</h1>
</div>

<div id="conteudo">
    <img src="img/loading.gif">
</div>

