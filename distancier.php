<?php
require_once("menu.php");
require_once('connexion.php');

?>

</br>
</br>

<?php

$zone= array();

$sql = 'SELECT ID, Zone FROM zone'; 
$reponse = $db->prepare($sql);
$reponse->execute();

        while($res = $reponse->fetch(PDO::FETCH_ASSOC)){ 
            array_push($zone, $res['Zone']);
        }

        
$sql = 'SELECT ID, Zone FROM zone'; 
$reponse = $db->prepare($sql);
$reponse->execute();
$a=0;

?>
<form id="MonFormulaire" method="post" action="testExcel/Classes/recup.php">   
    <div>
        <div>
            <label for="modele">Sélectionnez le modèle</label><br />
            <select name="modele" id="modele">
                <option value="zone">ZONE</option>
                <option value="entreZone">ENTRE ZONE</option>
                <option value="paris">PARIS</option>
                <!--<option value="idf">ILE-DE-FRANCE</option>-->
                <option value="usei">USEI</option>
                <option value="france">FRANCE</option>
            </select>
            <br><br>
        </div>

        <!-- ZOOOOOOOOOOOOOOOONE -->
        <script>
            $(document).ready(function(){
                $('#divVitesse').show();
                $('#modele').click(function(){

                    switch ($("#modele option:selected").val()) {
                        case "zone":
                        $('#divZone').show();
                        $('#divEntreZoneGeneral').hide();
                        $('#divUsei').hide();
                        break;
                        case "entreZone":
                        $('#divZone').hide();
                        $('#divEntreZoneGeneral').show();
                        $('#divUsei').hide();
                        break;  
                        case "usei":
                        $('#divZone').hide();
                        $('#divEntreZoneGeneral').hide();
                        $('#divUsei').show();
                        break;
                        default:
                        $('#divZone').hide();
                        $('#divEntreZoneGeneral').hide();
                        $('#divUsei').hide();
                    }

                 if($('select option:selected').val()!==null )
                        $('#divVitesse').show();
                });


            });

        </script>
        <?php
        $sql = 'SELECT DISTINCT ID, Zone FROM zone'; 
        $reponse = $db->prepare($sql);
        $reponse->execute();
        ?>
        <br><br>
        <div id="divZone">
            <label for="zone">Sélectionnez une Zone</label><br />
            <select name="zone" id="zone">
                <?php
                while($res = $reponse->fetch(PDO::FETCH_ASSOC)){ 
                    echo('<option value='.$res["Zone"].'>'.str_replace(' ', '_', $res["Zone"]).'</option>');
                }
                ?>
            </select>   <br><br><br><br>   </div>
            <!-- ENTRE ZOOOOOOOOOOOOOOOONE -->


            <?php
            $sql = 'SELECT DISTINCT ID, Zone FROM zone'; 
            $reponse = $db->prepare($sql);
            $reponse->execute();?>

            <div id="divEntreZoneGeneral"  style="display:none;position:relative;bottom: 20px;">
                <br><br>
                <label for="nombrePlaque">Nombre de Zones ?</label><br />
                <select name="nombrePlaque" id="nombrePlaque">
                    <?php
                    $i=2;
                    echo'<option value="0">?</option>';
                    while($res = $reponse->fetch(PDO::FETCH_ASSOC)){
                        ?> 
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                        $i++;

                    }
                    ?>
                </select>
                <br><br><br><br>

                <script type="text/javascript">
                    $(document).ready(function()
                    {

                        //Programme qui permet d'améliorer l'ergonomie du formulaire pour le distancier

                        $('#nombrePlaque').on('change', function() 
                        {
                            $('#divEntreZoneGeneral').append('<div id="divEntreZone"></div>');


                            var nbPlaque=$('#nombrePlaque').val();

                            $('#divEntreZone').html('<br><label for="entreZone">Sélectionnez les Zones</label><br><br><select class="liste"></select>');


                 for(var i=0;i<nbPlaque;i++){

                    namezone='liste'+i;
                    $('.liste').attr('name',namezone);
                    $('select').eq(i+3).removeClass("liste");


                    if(i!=nbPlaque-1)
                        $('#divEntreZone').append('<select class="liste"></select>');   //Affiche autant de liste déroulante que le nombre de zones choisis

                 var zone = [<?php echo '"'.implode('","',  $zone ).'"' ?>];    //conversion des valeurs php en javascript
                                  

                    
                    for(var j=0;j<zone.length;j++){

                        $('select').eq(i+3).append('<option class="opt">'+zone[j]+'</option>'); // Affiche autant de valeurs qu'il y'a de zone dans la base de données
                    }  
                 }
                 $('#divEntreZone').append('<br><br><br><br>');

             });

                    }); 
                </script>
                <?php
                $sql = 'SELECT ID, Zone FROM zone'; 
                $reponse = $db->prepare($sql);
                $reponse->setFetchMode(PDO::FETCH_ASSOC);
                $reponse->execute();
                $rows=$reponse->fetchAll(); 
    // foreach($rows as $r){
    //          echo($r["Zone"]);
    //          echo '<br>';
    //              }

    //json_encode($rows);?>
    <!--<script type="text/javascript" src="distancierForm.js"<script/>-->
</div>
<!-- PARIIIIIIIIIIIIIIIIIIIIIS -->

<?php

$sql = 'SELECT DISTINCT ID, CODE_POSTAL FROM base where CODE_POSTAL like "75%"'; 
$reponse = $db->prepare($sql);
$reponse->execute();
?>

<!-- USEEEEEEEEEEEEEEEEEEEEEIIIIII -->
<?php

$sql = 'SELECT DISTINCT base.ID, usei.USEI FROM base inner join zone on base.secteur= zone.id inner join usei on zone.usei = usei.id group by USEI'; 
$reponse = $db->prepare($sql);
$reponse->execute();?>

<div id="divUsei" style="display:none;">
    <label for="usei">Sélectionnez un USEI</label><br />
    <select name="usei" id="usei">

        <?php          while($res = $reponse->fetch(PDO::FETCH_ASSOC)){ 
            echo('<option value='.$res["USEI"].'>'.str_replace(' ', '_', $res["USEI"]).'</option>');
        }
        ?>
    </select><br><br><br><br><br>
</div> 

<!-- TOUTE LA FRAAAAAAAAAAAAAAAAAAAAAANCE -->     
<?php

$sql = 'SELECT DISTINCT ID, CODE_POSTAL FROM base where CODE_POSTAL REGEXP"([01-95 ]{5})"'; 
$reponse = $db->prepare($sql);
$reponse->execute();

?>     


</div>

<div id="divVitesse" style="display:none;">
<label for="usei">Vitesse moyenne</label><br />
        <input name="vitesse" type="number" step="1" value="16" min="10" max="130">
</div><br><br><br><br><br><br><br><br>
<!--<input type="submit" value="Envoyer"/>-->

<input id="distancier" type="submit" value="Génerer le distancier"/> 
</form>

<!--
<script type="text/javascript">
    function envoiFormulaire(form){
        form.submit();
        form.style.display='none';
        var obj=document.getElementById("load");
        if(obj){
            obj.src=obj.src;
            obj.style.display='block';
        }    
        return false;
    }
</script>
-->
<style>
    #itineraire{
        text-align:center;
        margin-left:40% ;
        margin-right:40%;
        width:20%;

    }



</style>
</br>
<!--<div align="center">
<img id="load" src="../img/load.gif" alt="" style="display:none;"/>
</div>-->
</body>
</html>
