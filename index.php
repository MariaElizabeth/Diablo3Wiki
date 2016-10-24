<!DOCTYPE html>
<!--
Este site foi desenvolvido por Maria Elizabeth da Silva Bezerra em Outubro de 2016.
-->
<?php
// se a session não estiver setada
if (!isset($_SESSION)) 
{
     session_start();
}

?>
<html lang="en">
  <!--Head-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diablo3Wiki</title>
      
    <!--CSS e Jquery-->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,200' rel='stylesheet' type='text/css'>    
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js'></script>
    <script src="http://us.battle.net/d3/static/js/tooltips.js"></script>
    <script type='text/javascript' src='js/funcoes.js'></script>

  </head>
  <!--Body-->
  <body>
  <div id="todo">      
      <!--Menu-->
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #8B1A1A;  border-color: #000;">
              <div class="container">
                <div class="navbar-header">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                      <ul class="nav navbar-nav">
                          <li><a href="#parallaxBar" class="scroll"><font color="white">Diablo 3 Wiki</font></a></li>
                          <!--Este campo do menu será ativado quando o usuario pesquisar por algum heroi-->
                          <?php
                          if(isset($_POST['meuJSONhero']))
                          {
                              echo'<li class="dropdown">
                                  <a href="#" class="scroll dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><font color="white">Hero Menu</font> <span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#stats" class="scroll">Stats</a></li>
                                    <li><a href="#skills" class="scroll">Skills Active</a></li>
                                    <li><a href="#skillspassive" class="scroll">Skills Passive</a></li>
                                    <li><a href="#equipment" class="scroll">Equipment</a></li>
                                  </ul>
                                </li>';
                          }
                          ?>
                          <!--Este campo do menu será ativado quando o usuario pesquisar por algum heroi-->
                      </ul> 
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#Char" class="scroll"><font color="white">Carrer profile</font></a></li>
                        <li><a href="#Hero" class="scroll"><font color="white">Hero profile</font></a></li>
                        <li><a href="#follower" class="scroll"><font color="white">Follower</font></a></li>
                        <li><a href="#artisan" class="scroll"><font color="white">Artisan</font></a></li>
                        <li><a href="#map" class="scroll"><font color="white">World Map</font></a></li>
                        <li><a href="#Contact" class="scroll"><font color="white">Contact</font></a></li>
                      </ul>
                </div>
              </div>
        </nav>
      <!--Fim do menu-->
      
<!--Paralax com a imagem-->
<a href="#Char" class="scroll">
  <section id="parallaxBar" data-speed="6" data-type="background">
    <div class="container-fluid">
    </div>
  </section>  
</a>
<!--Paralax com a imagem-->      

<!--Div para pesquisa de perfil-->
<div id="Char"><a name="Char"></a></div>
  <div class="container" id="containerMiddle">
    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">CAREER PROFILE</h1>
            <div style="text-align: left; margin-left:250px; width:800px;  font-size:18px;">
                
                <!--Form para a busca do perfil-->
                <form action="manipula.php" method="post" enctype="multipart/form-data" name='charform' id='charform'>
                            <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <!--Regioes aceitas pela API-->
                                               Set your region:         <select class="form-control input-lg" name='region' id='region'>
                                                                            <option value='eu'>EU</option>
                                                                            <option value='kr'>KR</option>
                                                                            <option value='tw'>TW</option>
                                                                            <option value='us'>US</option>
                                                                        </select>
                                            <!--Regioes aceitas pela API-->
                                            <br>
                                            
                                            <!--condição valida para o usuario nao abrir a manipula.php sem o request do form-->
                                            <input type="hidden" name='a' id='a' value='char'>
                                           
                                            <!--Barra de pesquisa-->
                                            Search:
                                            <div id="custom-search-input">
                                                <div class="input-group col-md-12">

                                                    <input name='char' id='char' type="text" class="form-control input-lg" placeholder="your BATTLETAG  ex: Jokefish-2265"/>
                                                    <span class="input-group-btn" >
                                                         <!--Submit para a manipula.php-->
                                                        <button class="btn btn-info btn-lg" type="button" style="background-color: #8B1A1A;" onclick="document.getElementById('charform').submit();">
                                                            <i class="glyphicon glyphicon-search" ></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                             <!--Barra de pesquisa-->
                                        </div>
                                    </div>
                            </div>
                </form>
                 <!--Fim do form de busca do perfil-->
                <?php
                    /*
                        Se esta página receber algum Json da manipula.php ela valida mostra os dados para o usuario.
                    */
                    if(isset($_GET['invalidBattletag']))
                    {
                        echo"<h2>Invalid battleTag</h2>";
                    }
                
                    if(isset($_POST['meuJSON']))
                    {
                        $json = json_decode($_POST['meuJSON']);
                    
                        /*Caso o json seja nulo*/
                        if($json == null)
                        {
                            echo"<h2>NOTFOUND...</h2>";
                        }
                        else
                        {   /*caso o perfil nao seja encontrado, dou a informacao para o usuario*/
                            if(isset($json->code))
                            {
                                echo "<h2>".$json->code."</h2>";
                                echo "<h4>".$json->reason."</h4>";
                            }
                            else    
                            if(isset($json->battleTag))/*Se o perfil for encontrado, mostro as informacoes para o usuario*/
                            {
                                /*array com informacoes do perfil*/
                                $array = $json->heroes;
                                
                                echo "<h2>".$json->battleTag."</h2>";
                                echo "<h4> paragon Level: ".$json->paragonLevel."</h4>";
                                echo "<h4> paragon Level Hardcore: ".$json->paragonLevelHardcore."</h4>";
                                echo "<h4> paragon Level season: ".$json->paragonLevelSeason."</h4>";
                                echo "<h4> guild name: ".$json->guildName."</h4>";
                                $count=0;
                                
                                /*Mostro todos os Herois desse perfil*/
                                echo"<button class='btn btn-default'"; echo'onclick='; echo"'change(";echo'"heroes"';echo")'>HEROES";
                                echo'<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
                                echo"</button>";
                            
                                    echo"<div id='heroes' name='heroes' style = 'visibility:hidden;';>";
                                        for($i=0; $i<sizeof($array); $i++)
                                        {   
                                            $count++;
                                            /*
                                                Form para cada Heroi, ao clicar no nome redireciono a manipula.php para que me retorne um Json com as
                                                informacoes desse heroi, onde sera manipulado na parte de heroi do site
                                            */
                                         echo'<form name="heroform'.$count.'" id="heroform'.$count.'" action="manipula.php" method="post" enctype="multipart/form-data">';
                                                /*
                                                    Informacoes necessarias para que a manipula.php possa pedir o Json desse heroi
                                                */
                                            echo'<input type="hidden"  name="heroid" id="heroid" value="'.$array[$i]->id.'"/>';
                                            echo'<input type="hidden"  name="charhero" id="charhero" value="'.$json->battleTag.'"/>';
                                            echo"<input type='hidden' name='a' id='a' value='char'>";

                                            if(isset($_SESSION['region']))
                                            {
                                                /*passo a regiao escolhida anteriormente pelo form para que seja encontrado o heroi*/
                                                echo"<input type='hidden' name='region' id='region' value='".$_SESSION['region']."'>";
                                            }       
                                                    /*Link que ao ser clicado da submit no form*/
                                                    echo "<h3>".$count." Hero : <a title='
Click to see the hero'"; echo'onclick="document.getElementById(';echo"'heroform".$count."'"; echo').submit();"';echo">".$array[$i]->name."";
                                             echo'&nbsp;<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>';
                                            echo"</a></h3>";
                                            
                                                    echo "<h5> ID : ".$array[$i]->id."</h5>";
                                                    echo "<h5> Class : ".$array[$i]->class."</h5>";
                                                    echo "<h5> Level : ".$array[$i]->level."</h5>";
                                                    echo "<h5> Paragon Level : ".$array[$i]->paragonLevel."</h5>";
                                             echo'</form>';
                                       }
                                    echo"</div>";
                                /*Mostro todos os Herois desse perfil*/
                            }
                            
                            
                        }
                    }
                
                ?>
            </div>
        </div>         
    </div>
  </div>  
      
<!--Div para pesquisa de heroi-->
<div id="Hero"><a name="Hero"></a></div>
  <div class="container" id="containerMiddle">
    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">Hero profile</h1>
            <div style="text-align: left; margin-left:250px; width:800px;  font-size:18px;">
               
                <!--Form para a pesquisa de Heroi por battleTag e id de heroi se o usuario desejar -->
                <form name='heroform' id='heroform' action="manipula.php" method="post" enctype="multipart/form-data">
                   <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                   Set your region:  <select class="form-control input-lg" name='region' id='region'>
                                                                            <option value='eu'>EU</option>
                                                                            <option value='kr'>KR</option>
                                                                            <option value='tw'>TW</option>
                                                                            <option value='us'>US</option>
                                                                        </select>
                                            <br>
                                            <input type="hidden" name='a' id='a' value='hero'>
                                 BATTLETAG: <input type="text" class="form-control input-lg" placeholder="your BATTLETAG ex: Jokefish-2265" name='charhero' id='charhero'/>
                                            <br>
                                Search:
                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="number" class="form-control input-lg" placeholder="id of hero  ex : 66241367" name='heroid' id='heroid'/><a name="HeroFound"></a>
                                        <span class="input-group-btn" >
                                            <button class="btn btn-info btn-lg" type="button" style="background-color: #8B1A1A;" onclick="document.getElementById('heroform').submit();">
                                                <i class="glyphicon glyphicon-search" ></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Fim form de pesquisa-->
                
                 <?php
                    /*
                        Se esta página receber algum Json da manipula.php ela valida mostra os dados para o usuario.
                    */
                     if(isset($_GET['invalidBattletagHero']))
                        {
                            echo"<h2>Invalid battleTag</h2>";
                        }
                    if(isset($_POST['meuJSONhero']))
                    {
                        $json = json_decode($_POST['meuJSONhero']);
                         /*Caso o json seja nulo*/
                        if($json == null)
                        {
                            echo"<h2>NOTFOUND...</h2>";
                        }
                        else
                        {/*caso o heroi nao seja encontrado, dou a informacao para o usuario*/
                            if(isset($json->code))
                            {
                                echo "<h2>".$json->code."</h2>";
                                echo "<h4>".$json->reason."</h4>";
                            }else
                            if(isset($json->name)) /*Se o heroi for encontrado, mostro as informacoes para o usuario*/ 
                            {
                                /*monto um vetor com as skills ativas do heroi*/
                                $array2 = $json->skills->active;
                                /*monto um vetor com as skills passivas do heroi*/
                                $array3 = $json->skills->passive;
                                /*monto um vetor com os stats do heroi*/
                                $stats  = $json->stats;
                                echo'<div id="stats"><a name="stats"></a></div><br><br>';
                                echo "<h1 id='h1TopoHero'>".$json->name."</h1>";
                                
                                /*imagens de classes*/
                                if($json->class == "barbarian")
                                    echo "<img src='img/barbarian.png'>";
                                else
                                if($json->class == "witch-doctor") 
                                    echo "<img src='img/witchDoctor.png'>";
                                else
                                if($json->class == "demon-hunter") 
                                    echo "<img src='img/demonHunter.png'>";
                                else
                                if($json->class == "crusader") 
                                    echo "<img src='img/crusader.png'>";
                                else
                                if($json->class == "wizard") 
                                    echo "<img src='img/wizard.png'>";
                                else
                                if($json->class == "monk") 
                                    echo "<img src='img/monk.png'>";
                                    
                                    
                                    
                                echo "<h4> <b>Class:</b> ".$json->class."</h4>";
                                echo "<h4> <b>Level:</b> ".$json->level."</h4>";
                                echo "<h4> <b>Paragon level</b>: ".$json->paragonLevel."</h4>";
                                echo "<h3> <b>Stats</b>: </h3>
                                <ul>";
                                /*Stats*/
                                echo "<li><h4> <b>Life</b>:".$stats->life." </h4></li>";
                                echo "<li><h4> <b>Damage</b>:".$stats->damage." </h4></li>";
                                echo "<li><h4> <b>Toughness</b>:".$stats->toughness." </h4></li>";
                                echo "<li><h4> <b>Healing</b>:".$stats->healing." </h4></li>";
                                echo "<li><h4> <b>Attack Speed</b>:".$stats->attackSpeed." </h4></li>";
                                echo "<li><h4> <b>Armor</b>:".$stats->armor." </h4></li>";
                                echo "<li><h4> <b>Strength</b>:".$stats->strength." </h4></li>";
                                echo "<li><h4> <b>Dexterity</b>:".$stats->dexterity." </h4></li>";
                                echo "<li><h4> <b>Vitality</b>:".$stats->vitality." </h4></li>";
                                echo "<li><h4> <b>Intelligence</b>:".$stats->intelligence." </h4></li>";
                                echo "<li><h4> <b>Physical Resist</b>:".$stats->physicalResist." </h4></li>";
                                echo "<li><h4> <b>Fire Resist</b>:".$stats->fireResist." </h4></li>";
                                echo "<li><h4> <b>lightning Resist</b>:".$stats->lightningResist." </h4></li>";
                                echo "<li><h4> <b>Physical Resist</b>:".$stats->physicalResist." </h4></li>";
                                echo "<li><h4> <b>Poison Resist</b>:".$stats->poisonResist." </h4></li>";
                                echo "<li><h4> <b>Arcane Resist</b>:".$stats->arcaneResist." </h4></li>";
                                echo "<li><h4> <b>Crit Damage</b>:".$stats->critDamage." </h4></li>";
                                echo "<li><h4> <b>Block Chance</b>:".$stats->blockChance." </h4></li>";
                                echo "<li><h4> <b>Crit Chance</b>:".$stats->critChance." </h4></li>";
                                echo "<li><h4> <b>Damage Reduction</b>:".$stats->damageReduction." </h4></li>";
                                echo "<li><h4> <b>Thorns</b>:".$stats->thorns." </h4></li>";
                                echo "<li><h4> <b>Life Steal</b>:".$stats->lifeSteal." </h4></li>";
                                echo "<li><h4> <b>Life Per Kill</b>:".$stats->lifePerKill." </h4></li>";
                                echo "<li><h4> <b>Gold Find</b>:".$stats->goldFind." </h4></li>";
                                echo "<li><h4> <b>Primary Resource</b>:".$stats->primaryResource." </h4></li>";
                                echo "<li><h4> <b>Secondary Resource</b>:".$stats->secondaryResource." </h4></li>";
                                echo "</ul>";
                                
                                $count=0;/*Menu das categorias*/
                                echo'<hr><h2><a href="#skills" class="scroll">Skills Active</a></h2>';
                                echo'<hr><h2><a href="#skillspassive" class="scroll">Skills Passive</a></h2>';
                                echo'<hr><h2><a href="#equipment" class="scroll">Equipment</a></h2>';
                                
                                /*Mostro as informacoes sobre cada Skill e/ou Runa*/
                                echo'<div id="skills"><a name="skills"></a></div><br><br>';
                                echo'<h2 id="h1TopoHero">Skills Active</h2>';
                                for($i=0; $i<sizeof($array2); $i++)
                                {   
                                    /*Skill*/
                                    if(isset($array2[$i]->skill->slug))
                                            echo "<h3><b> ".strtoupper($array2[$i]->skill->slug)."</b><h3>";
                                    /*Icone da skill*/
                                    if(isset($array2[$i]->skill->icon))
                                            echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/skills/64/".$array2[$i]->skill->icon.".png'><h4>";
                                    if(isset($array2[$i]->skill->level))
                                            echo "<h4><b> level: </b>".$array2[$i]->skill->level    ."<h4>";
                                     if(isset($array2[$i]->skill->categorySlug))
                                            echo "<h4><b> Category: </b>".$array2[$i]->skill->categorySlug    ."<h4>";
                                     if(isset($array2[$i]->skill->description))
                                            echo "<h4><b> Description: </b>".$array2[$i]->skill->description    ."<h4>";                                   
                                    /*Runa se houver*/
                                    if(isset($array2[$i]->rune->slug))
                                            echo "<h3>Rune</h3>";
                                     if(isset($array2[$i]->rune->slug))
                                            echo "<h4><b>".strtoupper($array2[$i]->rune->slug)."</b><h4>";
                                     if(isset($array2[$i]->rune->type))
                                            echo "<h4><b> Type: </b>".$array2[$i]->rune->type    ."<h4>";
                                     if(isset($array2[$i]->rune->name))
                                            echo "<h4><b> Name: </b>".$array2[$i]->rune->name    ."<h4>";
                                     if(isset($array2[$i]->rune->description))
                                            echo "<h4><b> Description: </b>".$array2[$i]->rune->description    ."<h4>";  
                                    
                                    $count++;
                                    echo "<hr>";
                                }
                                /*Mostro as informacoes sobre cada Skill e/ou Runa*/
                                
                                echo'<div id="skillspassive"><a name="skillspassive"></a></div><br><br>';
                                echo'<h2 id="h1TopoHero">Skills Passive</h2>';
                                 for($i=0; $i<sizeof($array3); $i++)
                                {   
                                    /*Skill*/
                                    if(isset($array3[$i]->skill->slug))
                                            echo "<h3><b> ".strtoupper($array3[$i]->skill->slug)."</b><h3>";
                                    /*Icone da skill*/
                                    if(isset($array3[$i]->skill->icon))
                                            echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/skills/64/".$array3[$i]->skill->icon.".png'><h4>";
                                    if(isset($array3[$i]->skill->level))
                                            echo "<h4><b> level: </b>".$array3[$i]->skill->level    ."<h4>";
                                     if(isset($array3[$i]->skill->categorySlug))
                                            echo "<h4><b> Category: </b>".$array3[$i]->skill->categorySlug    ."<h4>";
                                     if(isset($array3[$i]->skill->description))
                                            echo "<h4><b> Description: </b>".$array3[$i]->skill->description    ."<h4>";    
                                     if(isset($array3[$i]->skill->flavor))
                                            echo "<h4'><b> Flavor: </b><i>".$array3[$i]->skill->flavor    ."</i><h4>";                                   
                                    /*Runa se houver*/
                                    if(isset($array3[$i]->rune->slug))
                                            echo "<h3>Rune</h3>";
                                     if(isset($array3[$i]->rune->slug))
                                            echo "<h4><b>".strtoupper($array3[$i]->rune->slug)."</b><h4>";
                                     if(isset($array3[$i]->rune->type))
                                            echo "<h4><b> Type: </b>".$array3[$i]->rune->type    ."<h4>";
                                     if(isset($array3[$i]->rune->name))
                                            echo "<h4><b> Name: </b>".$array3[$i]->rune->name    ."<h4>";
                                     if(isset($array3[$i]->rune->description))
                                            echo "<h4><b> Description: </b>".$array3[$i]->rune->description    ."<h4>";  

                                    $count++;
                                    echo "<hr>";
                                }
                                
                                
                              
                                echo'<div id="equipment"><a name="equipment"></a></div><br><br>';
                                
                                echo'<h1 id="h1TopoHero">Equipment</h1>';   
                                echo'<table>';
                                
                                echo'<tr>';
                                    echo'<td>';
                                    echo'<h2 id="nameItems">Head</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->head->name))
                                                echo "<h3><b> ".strtoupper($json->items->head->name)."</b><h3>";
                                        /*Icone do equipamento*/
                                        if(isset($json->items->head->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->head->icon.".png'><h4>";
                                        if(isset($json->items->head->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->head->displayColor."<h4>";
                                     echo'</td>';
                                
                                     echo'<td>';
                                     echo'<h2 id="nameItems">Torso</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->torso->name))
                                                echo "<h3><b> ".strtoupper($json->items->torso->name)."</b><h3>";
                                        /*Icone da skill*/
                                        if(isset($json->items->torso->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->torso->icon.".png'><h4>";
                                        if(isset($json->items->torso->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->torso->displayColor."<h4>";
                                     echo'</td>';

                                     echo'<td>';
                                    echo'<h2 id="nameItems">Feet</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->feet->name))
                                                echo "<h3><b> ".strtoupper($json->items->feet->name)."</b><h3>";
                                        /*Icone da skill*/
                                        if(isset($json->items->feet->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->feet->icon.".png'><h4>";
                                        if(isset($json->items->feet->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->feet->displayColor."<h4>";
                                     echo'</td>';
                                
                                 echo'</tr>';
                                 echo'<tr>';
                                     echo'<td>';
                                     echo'<h2 id="nameItems">Hands</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->hands->name))
                                                echo "<h3><b> ".strtoupper($json->items->hands->name)."</b><h3>";
                                        /*Icone do equipamento*/
                                        if(isset($json->items->hands->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->hands->icon.".png'><h4>";
                                        if(isset($json->items->hands->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->hands->displayColor."<h4>";      
                                     echo'</td>';
                                     echo'<td>';
                                     echo'<h2 id="nameItems">Shoulders</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->shoulders->name))
                                                echo "<h3><b> ".strtoupper($json->items->shoulders->name)."</b><h3>";
                                        /*Icone da skill*/
                                        if(isset($json->items->shoulders->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->shoulders->icon.".png'><h4>";
                                        if(isset($json->items->shoulders->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->shoulders->displayColor."<h4>";
                                     echo'</td>';
                                     echo'<td>';
                                     echo'<h2 id="nameItems">Legs</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->legs->name))
                                                echo "<h3><b> ".strtoupper($json->items->legs->name)."</b><h3>";
                                        /*Icone da skill*/
                                        if(isset($json->items->legs->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->legs->icon.".png'><h4>";
                                        if(isset($json->items->legs->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->legs->displayColor."<h4>";
                                      echo'</td>';
                                 echo'</tr>';
                                 echo'<tr>';
                                        echo'<td>';
                                        echo'<h2 id="nameItems">Bracers</h2>';
                                             /*equipamento*/
                                            if(isset($json->items->bracers->name))
                                                    echo "<h3><b> ".strtoupper($json->items->bracers->name)."</b><h3>";
                                            /*Icone do equipamento*/
                                            if(isset($json->items->bracers->icon))
                                                    echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->bracers->icon.".png'><h4>";
                                            if(isset($json->items->bracers->displayColor))
                                                    echo "<h4><b>Display Color: </b>".$json->items->bracers->displayColor."<h4>";
                                         echo'</td>';
                                
                                        echo'<td>';
                                        echo'<h2 id="nameItems">MainHand</h2>';
                                             /*equipamento*/
                                            if(isset($json->items->mainHand->name))
                                                    echo "<h3><b> ".strtoupper($json->items->mainHand->name)."</b><h3>";
                                            /*Icone da skill*/
                                            if(isset($json->items->mainHand->icon))
                                                    echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->mainHand->icon.".png'><h4>";
                                            if(isset($json->items->mainHand->displayColor))
                                                    echo "<h4><b>Display Color: </b>".$json->items->mainHand->displayColor."<h4>";

                                         echo'</td>';
                             
                                        echo'<td>';
                                        echo'<h2 id="nameItems">OffHand</h2>';
                                            /*Skill*/
                                            if(isset($json->items->offHand->name))
                                                    echo "<h3><b> ".strtoupper($json->items->offHand->name)."</b><h3>";
                                            /*Icone da skill*/
                                            if(isset($json->items->offHand->icon))
                                                    echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->offHand->icon.".png'><h4>";
                                            if(isset($json->items->offHand->displayColor))
                                                    echo "<h4><b>Display Color: </b>".$json->items->offHand->displayColor."<h4>";

                                        echo'</td>';
                                 echo'</tr>'; 
                                 echo'<tr>';
                                    
                                    echo'<td>';
                                    echo'<h2 id="nameItems">Waist</h2>';
                                         /*equipamento*/
                                        if(isset($json->items->waist->name))
                                                echo "<h3><b> ".strtoupper($json->items->waist->name)."</b><h3>";
                                        /*Icone do equipamento*/
                                        if(isset($json->items->waist->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->waist->icon.".png'><h4>";
                                        if(isset($json->items->waist->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->waist->displayColor."<h4>";

                                     echo'</td>';

                                    echo'<td>';
                                    echo'<h2 id="nameItems">Right Finger</h2>';
                                        /*equipamento*/
                                        if(isset($json->items->rightFinger->name))
                                                echo "<h3><b> ".strtoupper($json->items->rightFinger->name)."</b><h3>";
                                        /*Icone do equipamento*/
                                        if(isset($json->items->rightFinger->icon))
                                                echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->rightFinger->icon.".png'><h4>";
                                        if(isset($json->items->rightFinger->displayColor))
                                                echo "<h4><b>Display Color: </b>".$json->items->rightFinger->displayColor."<h4>";

                                     echo'</td>';
                               
                                        echo'<td>';
                                        echo'<h2 id="nameItems">Left Finger</h2>';
                                            /*equipamento*/
                                            if(isset($json->items->leftFinger->name))
                                                    echo "<h3><b> ".strtoupper($json->items->leftFinger->name)."</b><h3>";
                                            /*Icone do equipamento*/
                                            if(isset($json->items->leftFinger->icon))
                                                    echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/items/large/".$json->items->leftFinger->icon.".png'><h4>";
                                            if(isset($json->items->leftFinger->displayColor))
                                                    echo "<h4><b>Display Color: </b>".$json->items->leftFinger->displayColor."<h4>";
                                         echo'</td>';
                                 echo'</tr>';
                                echo'</table>';
                                
                            }
                        }
                    }
                
                ?>
            </div>
        </div>         
    </div>
  </div>   
<!--Div para pesquisa de heroi-->

<!--Div para pesquisa de seguidor-->
<div id="follower"><a name="follower"></a></div>
  <div class="container" id="containerMiddle">
    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">Search Follower</h1>
            <div style="text-align: left; margin-left:250px; width:800px;  font-size:18px;">
               
                <!--Form para a pesquisa de Heroi por battleTag e id de heroi se o usuario desejar -->
                <form name='followerform' id='followerform' action="manipula.php" method="post" enctype="multipart/form-data">
                   <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                   Set your region:  <select class="form-control input-lg" name='region' id='region'>
                                                                            <option value='eu'>EU</option>
                                                                            <option value='kr'>KR</option>
                                                                            <option value='tw'>TW</option>
                                                                            <option value='us'>US</option>
                                                    </select>
                                            <br>
                                 Set follower:  <select class="form-control input-lg" name='followerselect' id='followerselect'>
                                                                            <option value='templar'>templar</option>
                                                                            <option value='enchantress'>enchantress</option>
                                                                            <option value='scoundrel'>scoundrel</option>
                                                    </select>
                                            <input type="hidden" name='a' id='a' value='follower'>
                        <br>
                                    <div class="input-group col-md-12">
                                       <span class="input-group-btn" >
                                            <button class="btn btn-info btn-lg" type="button" style="background-color: #8B1A1A;" onclick="document.getElementById('followerform').submit();">Search
                                                <i class="glyphicon glyphicon-search" ></i>
<div id="followerFound"><a name="followerFound"></a></div>
                                            </button>
                                        </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
<?php
if(isset($_POST['meuJSONfollower']))
{
    $arrayFollower = json_decode($_POST['meuJSONfollower']);
    
    if($arrayFollower == null)
    {
        echo"<h2>NOTFOUND...</h2>";
    }
    else
    {
       // print_r($arrayFollower);
        $skillfActive = $arrayFollower->skills->active;
        echo "<h1 id='h1TopoHero'>".$arrayFollower->slug."</h1>";
        echo "<img src='img/".$arrayFollower->slug.".png'>";
        echo "<h2 id='h1TopoHero'><b>Skills active </b></h2>";
       
        for($k=0; $k<sizeof($skillfActive);$k++)
        {
            /*Skill*/
            if(isset($skillfActive[$k]->slug))
                    echo "<h3><b> ".strtoupper($skillfActive[$k]->slug)."</b><h3>";
         /*Icone da skill*/
            if(isset($skillfActive[$k]->icon))
                    echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/skills/64/".$skillfActive[$k]->icon.".png'><h4>";
            if(isset($skillfActive[$k]->level))
                    echo "<h4><b> level: </b>".$skillfActive[$k]->level    ."<h4>";
             if(isset($skillfActive[$k]->categorySlug))
                    echo "<h4><b> Category: </b>".$skillfActive[$k]->categorySlug    ."<h4>";
             if(isset($skillfActive[$k]->description))
                    echo "<h4><b> Description: </b>".$skillfActive[$k]->description    ."<h4>";          
        
        }
        
        $skillfPassive = $arrayFollower->skills->passive;
        if(sizeof($skillfPassive)>0)
        {
            echo "<h1 id='h1TopoHero'>".$arrayFollower->slug."</h1>";
            echo "<h2 id='h1TopoHero'><b>Skills passive </b></h2>";

            for($k=0; $k<sizeof($skillfPassive);$k++)
            {
                /*Skill*/
                if(isset($skillfPassive[$k]->slug))
                        echo "<h3><b> ".strtoupper($skillfPassive[$k]->slug)."</b><h3>";
             /*Icone da skill*/
                if(isset($skillfPassive[$k]->icon))
                        echo "<h4><b> <img src='http://media.blizzard.com/d3/icons/skills/64/".$skillfPassive[$k]->icon.".png'><h4>";
                if(isset($skillfPassive[$k]->level))
                        echo "<h4><b> level: </b>".$skillfPassive[$k]->level    ."<h4>";
                 if(isset($skillfPassive[$k]->categorySlug))
                        echo "<h4><b> Category: </b>".$skillfPassive[$k]->categorySlug    ."<h4>";
                 if(isset($skillfPassive[$k]->description))
                        echo "<h4><b> Description: </b>".$skillfPassive[$k]->description    ."<h4>";          

            }
        }
    }
}
?>             
            </div>
        </div>
    </div>
</div>
<!--Div para pesquisa de seguidor-->
    
<!--Div para pesquisa de artesao-->
<div id="artisan"><a name="artisan"></a></div>
  <div class="container" id="containerMiddle">
    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">Search Artisan</h1>
            <div style="text-align: left; margin-left:250px; width:800px;  font-size:18px;">
               
                <!--Form para a pesquisa de Heroi por battleTag e id de heroi se o usuario desejar -->
                <form name='artisanform' id='artisanform' action="manipula.php" method="post" enctype="multipart/form-data">
                   <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                   Set your region:  <select class="form-control input-lg" name='region' id='region'>
                                                                            <option value='eu'>EU</option>
                                                                            <option value='kr'>KR</option>
                                                                            <option value='tw'>TW</option>
                                                                            <option value='us'>US</option>
                                                    </select>
                                            <br>
                                 Set Artisan:  <select class="form-control input-lg" name='artisanselect' id='artisanselect'>
                                                                            <option value='blacksmith'>BlackSmith</option>
                                                                            <option value='jeweler'>Jeweler</option>
                                                                            <option value='mystic'>Mystic</option>
                                                    </select>
                                            <input type="hidden" name='a' id='a' value='artisan'>
                        <br>
                                    <div class="input-group col-md-12">
                                       <span class="input-group-btn" >
                                            <button class="btn btn-info btn-lg" type="button" style="background-color: #8B1A1A;" onclick="document.getElementById('artisanform').submit();">Search
                                                <i class="glyphicon glyphicon-search" ></i>
<div id="artisanFound"><a name="artisanFound"></a></div>
                                            </button>
                                        </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
<?php
if(isset($_POST['meuJSONartisan']))
{
    $arrayArtisan = json_decode($_POST['meuJSONartisan']);
    
    
    if($arrayArtisan == null)
    {
        echo"<h2>NOTFOUND...</h2>";
    }
    else
    {
       // print_r($arrayArtisan);
        $skillAActive = $arrayArtisan->training->tiers;
        echo "<h1 id='h1TopoHero'>".$arrayArtisan->name."</h1>";
        echo "<img src='img/".$arrayArtisan->slug.".png'>";
        echo "<h2 id='h1TopoHero'><b>Item Produced </b></h2>";
        if(sizeof($skillAActive)<1)
             echo"<h2>
0 items</h2>";
        for($t=0; $t<sizeof($skillAActive);$t++)
        {
            for($l=0; $l<sizeof($skillAActive);$l++)
            {   
                
                if(isset($skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->name))
                echo'<br>';
                /*nome do item*/
                if(isset($skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->name))
                 echo "<h3><b> ".strtoupper($skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->name)."</b></h3>";
                /*icone do item*/
                if(isset($skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->icon))
                 echo"<img src='http://media.blizzard.com/d3/icons/items/large/".$skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->icon.".png'>";
                /*cor do item*/
                if(isset($skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->displayColor))
                 echo"<h3><b>Display Color: </b>".$skillAActive[$l]->levels[$t]->trainedRecipes[$l]->itemProduced->displayColor."</h3>";
                /*preco do item*/
                if(isset($skillAActive[$l]->levels[$t]->trainedRecipes[$l]->cost))
                 echo "<h3><b> Cost: ".$skillAActive[$l]->levels[$t]->trainedRecipes[$l]->cost."</b></h3>";
               
            }
        }
       
    }
}
?>             
            </div>
        </div>
    </div>
</div>
<!--Div para pesquisa de artesao-->
      
<!--Div para o mapa do mundo-->
<div id="map"> <a name="map"></a></div>
<div class="container">

    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">World Map</h1>
            
                <img src="img/map.png">
        <br><br>
        </div>
      </div>

</div>
      
<!--Div para o mapa do mundo-->
      
<!--Rodape com as informacoes de contato-->
<footer>
<div id="Contact"> <a name="Contact"></a></div>
    <div class="container">
      <div class="row-fluid" style="margin-top:15px;">
          
        <div class="col-md-6">
          <span class="spanFooterBar"><br><br><br><br>
              <h4 style="opacity:1;">Developed by: <br>Maria Elizabeth da Silva Bezerra</h4>
              <br><br><br><br><br><br>
              <h4 style="opacity:1;">Desafio Tagview 2016</h4>
           </span>
        </div>
          
        <div class="col-md-6">
          <ul class="socialIcons" style="float:right;">
              <ul class="socialIcons" style="float:right;">
                  <!--Link do perfil do facebook-->
                <li><a class="fa fa-facebook-square fa" href="https://www.facebook.com/profile.php?id=100009597049659"  style="color:#fff;font-size:28px;"></a></li>   
              </ul>
          </ul>
        </div>
            
      </div>
    </div>
</footer>    
<!--Rodape com as informacoes de contato-->
</div>
  </body>
</html>