<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diablo3Wiki</title>


    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,200' rel='stylesheet' type='text/css'>    

      <script type="text/javascript">

      $(document).ready(function(){
         $window = $(window);
         $('section[data-type="background"]').each(function(){
           var $scroll = $(this);                 
            $(window).scroll(function() {
              var yPos = -($window.scrollTop() / $scroll.data('speed')); 
               var coords = '50% '+ yPos + 'px';
              $scroll.css({ backgroundPosition: coords });    
            });
         });  
      }); 
      </script>  

  </head>
  <body>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #8B1A1A;  border-color: #000;">
      <div class="container">
        <div class="navbar-header">
        </div>
        <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                  <li><a href="#"><font color="white">Diablo 3 Wiki</font></a></li>
              </ul> 
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#Char"><font color="white">Carrer profile</font></a></li>
                <li><a href="#Bosses"><font color="white">Hero profile</font></a></li>
                <li><a href="#Contato"><font color="white">Contato</font></a></li>
              </ul>
        </div>
      </div>
</nav>

  <section id="parallaxBar" data-speed="6" data-type="background">
    <div class="container-fluid">
          
            
        
    </div>
  </section>         

<a name="Char"></a> 
  <div class="container" id="containerMiddle">
    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">CAREER PROFILE</h1>
            <div style="text-align: left; margin-left:250px; width:800px;  font-size:18px;">
               
                <form action="manipula.php" method="post" enctype="multipart/form-data" name='charform' id='charform'>
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
                                            <input type="hidden" name='a' id='a' value='char'>
                                            Search:
                                            <div id="custom-search-input">
                                                <div class="input-group col-md-12">

                                                    <input name='char' id='char' type="text" class="form-control input-lg" placeholder="your BATTLETAG  ex: Jokefish-2265"/>
                                                    <span class="input-group-btn" >
                                                        <button class="btn btn-info btn-lg" type="button" style="background-color: #8B1A1A;" onclick="document.getElementById('charform').submit();">
                                                            <i class="glyphicon glyphicon-search" ></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                </form>
                <?php
                    if(isset($_POST['meuJSON']))
                    {
                            //echo  'daawdawd';
                            //var_dump($_POST['meuJSON']);
                            
                            $json = json_decode($_POST['meuJSON']);
                        
                        //print_r($json);
                        //var_dum($_POST);
                        //var_dump($json);
                        if($json == null)
                        {
                            echo"<h2>NOTFOUND...</h2>";
                        }
                        else
                        {
                            
                            if(isset($json->code))
                            {
                                echo "<h2>".$json->code."</h2>";
                                echo "<h4>".$json->reason."</h4>";
                            }else
                            if(isset($json->battleTag))  
                            {
                                echo "<h2>".$json->battleTag."</h2>";
                                echo "<h4> paragon Level: ".$json->paragonLevel."</h4>";
                                echo "<h4> paragon Level Hardcore: ".$json->paragonLevelHardcore."</h4>";
                                echo "<h4> paragon Level season: ".$json->paragonLevelSeason."</h4>";
                                echo "<h4> guild name: ".$json->guildName."</h4>";
                            }
                            
                            
                        }
                    }
                
                ?>
            </div>
        </div>         
    </div>
  </div>  
      
<a name="Bosses"></a> 
  <div class="container" id="containerMiddle">
    <div class="row" id="rowContainerMiddle">
        <div class="col-md-6">
          <h1 id="h1Topo">Hero profile</h1>
            <div style="text-align: left; margin-left:250px; width:800px;  font-size:18px;">
                
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
                                        <input type="text" class="form-control input-lg" placeholder="id of hero  ex : 66241367" name='heroid' id='heroid'/>
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
                 <?php
                    if(isset($_POST['meuJSONhero']))
                    {
                        $json = json_decode($_POST['meuJSONhero']);
                        
                        if($json == null)
                        {
                            echo"<h2>NOTFOUND...</h2>";
                        }
                        else
                        {
                            if(isset($json->code))
                            {
                                echo "<h2>".$json->code."</h2>";
                                echo "<h4>".$json->reason."</h4>";
                            }else
                            if(isset($json->name))  
                            {
                                echo "<h2>".$json->name."</h2>";
                                echo "<h4> class: ".$json->class."</h4>";
                                echo "<h4> level: ".$json->level."</h4>";
                                echo "<h4> paragon level: ".$json->paragonLevel."</h4>";
                            }
                        }
                    }
                
                ?>
            </div>
        </div>         
    </div>
  </div>  
   
       
  <footer>
      <a name="Contato"></a>
    <div class="container">
      <div class="row-fluid" style="margin-top:15px;">
        <div class="col-md-6">
          <span class="spanFooterBar"><br><br><br><br>
              <h4 style="opacity:1;">Desenvolvido por: <br>Maria Elizabeth da Silva Bezerra</h4>
              <br><br><br><br><br><br>
              <h4 style="opacity:1;">Desafio Tagview 2016</h4>
           </span>
       
        </div>
            <div class="col-md-6">
              <ul class="socialIcons" style="float:right;">
              <ul class="socialIcons" style="float:right;">
                <li><a class="fa fa-facebook-square fa" href="https://www.facebook.com/profile.php?id=100009597049659"  style="color:#fff;font-size:28px;"></a></li>        
              </ul>
            </div>  
      </div>
    </div>
  </footer>  

  </body>
</html>