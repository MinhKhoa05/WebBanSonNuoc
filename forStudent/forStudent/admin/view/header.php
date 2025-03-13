<html>
<head>
    <title>PHP2-Demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>
  <div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php?act=cate">Danh muc</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?act=product">San pham</a>
        </li>
        <?php
          if(isset($_SESSION["admin"]))
          {
            echo ' <li class="nav-item">
            <a class="nav-link" href="index.php?act=logout">Logout:'.$_SESSION["admin"].'</a>
          </li>';
          }
           
        ?>
       
      </ul>
    </nav>