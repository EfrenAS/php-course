<?php
if (!isset($_SESSION['loginCorrect'])) {
  echo '<script>
    window.location = "login";
  </script>';
  return;
} else {
  if ($_SESSION['loginCorrect'] != 'ok') {
    echo '<script>
      window.location = "login";
    </script>';
    return;
  }
}
$users = formController::selectRecords(null, null);
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Creado el</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($users as $key=>$value):
    ?>
    <tr>
      <th><?php echo $key+1; ?></th>
      <th><?php echo $value['fullname']; ?></th>
      <td><?php echo $value['email']; ?></td>
      <td><?php echo $value['created_at']; ?></td>
      <td>
        <div class="btn-group">
          <a href="index.php?url=edit&token=<?php echo $value["token"]; ?>" class="btn btn-warning mr-2"><i class="fas fa-pencil-alt"></i></a>
          <form method="post">
            <input type="hidden" value="<?php echo $value['token']; ?>" name="token">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            <?php
              $request = new formController;
              $request->deleteRecord();
            ?>
          </form>
        </div>
      </td>
    </tr>
    <?php
      endforeach
    ?>
  </tbody>
</table>