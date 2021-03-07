
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
          <th scope = "col">id</th>
          <th scope = "col">nom</th>
          <th scope = "col">prenom</th>
          <th scope = "col">region</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des vins est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getId(), $element->getNom(), $element->getPrenom(), $element->getRegion());
          }
          ?>
      </tbody>
    </table>
    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
          <input type="hidden" name='action' value='producteurDeletedConfirm'>
          <?php echo "<input type=\"hidden\" name='id' value=$producteur_id>"; ?>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">confirmer</button>
    </form>           
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->