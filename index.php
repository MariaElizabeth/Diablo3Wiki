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
    <script type='text/javascript' src='js/funcoes.js'></script>

  </head>
  <!--Body-->
  <body>
      <!--Menu-->
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #8B1A1A;  border-color: #000;">
              <div class="container">
                <div class="navbar-header">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                      <ul class="nav navbar-nav">
                          <li><a href="#"><font color="white">Diablo 3 Wiki</font></a></li>
                      </ul> 
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#Char" class="scroll"><font color="white">Carrer profile</font></a></li>
                        <li><a href="#Hero" class="scroll"><font color="white">Hero profile</font></a></li>
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
                                                                            <option value='sea'>SEA</option>
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
                                echo"<a "; echo'onclick='; echo"'change(";echo'"heroes"';echo")'>HEROES</a>";
                            
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
                                                    echo "<h3>".$count." Hero : <a "; echo'onclick="document.getElementById(';echo"'heroform".$count."'"; echo').submit();"';echo">".$array[$i]->name."</a></h3>";
                                            
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
                                                                            <option value='sea'>SEA</option>
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
                                        <input type="number" class="form-control input-lg" placeholder="id of hero  ex : 66241367" name='heroid' id='heroid'/>
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
                                
                                echo "<h2>".$json->name."</h2>";
                                echo "<h4> class: ".$json->class."</h4>";
                                echo "<h4> level: ".$json->level."</h4>";
                                echo "<h4> paragon level: ".$json->paragonLevel."</h4>";
                                $count=0;
                                
                                echo "<h3> Skills </h3><hr>";
                                /*Mostro as informacoes sobre cada Skill e/ou Runa*/
                                for($i=0; $i<sizeof($array2); $i++)
                                {   
                                    $count++;
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

                                    echo "<hr>";
                                }
                                /*Mostro as informacoes sobre cada Skill e/ou Runa*/
                                
                            }
                        }
                    }
                
                ?>
            </div>
        </div>         
    </div>
  </div>   
<!--Div para pesquisa de heroi-->
    
      
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
        </div>
            
      </div>
    </div>
</footer>    
<!--Rodape com as informacoes de contato-->

  </body>
</html>