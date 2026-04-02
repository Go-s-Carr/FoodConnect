<?php

$q="SELECT * FROM commande where etat='en cours' ";
$res=mysqli_query($bd,$q);
if(mysqli_num_rows($res)>0)
        {
            echo '<table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID Commande</th>
                            <th>Date</th>
                            <th>client</th>
                            <th>item(ken fast food wle ghiro)</th>
                            <th>Action</th>
                        </tr>';
                    
                    while($ligne=mysqli_fetch_row($res))
                    {
                        echo '<tr>';
                        echo '<td><strong>#'.htmlspecialchars($ligne['id_commande']).'</strong></td>';
                        echo '<td>'.htmlspecialchars($ligne['date_commande']).'</td>';
                        echo '<td>'.htmlspecialchars($ligne['client_id']).'</td>';
                        echo '<td>'.htmlspecialchars($ligne['item']).'</td>';
                        echo '<td class="actions-cell">';
                        echo '<form method="POST" class="action-form">';
                        echo '<input type="hidden" name="id_commande" value="'.htmlspecialchars($ligne['id_commande']).'">';
                        echo '<button type="submit" name="valider" value="valider" class="btn btn-success">Valider</button>';
                        echo '</form>';
                        echo '</tr>';
                    }
echo '</thead><tbody>';}
else{
    echo '<p>Aucune commande en cours.</p>';
}
if(isset($_POST['valider']))
{
    $id_commande=$_POST['id_commande'];
    $q="UPDATE commande SET etat='valide' where id_commande='$id_commande'";
    mysqli_query($bd,$q);
    header("Location: ../FoodConnect/commande.php");
}
?>