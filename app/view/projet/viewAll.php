
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      ?>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">nom</th>
          <th scope = "col">cru</th>
          <th scope = "col">quantite</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des vins est dans une variable $results                                            
                                while ($donnees=$results->fetch()){ ?>
                                <tr>
                                    <td><?php echo $donnees['nom']; ?></td>
                                    <td><?php echo $donnees['nombreDeCru']; ?></td>
                                    <td><?php echo $donnees['somme']; ?></td>
                                </tr>
                              <?php  } ?>
         
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->