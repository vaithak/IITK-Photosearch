<!DOCTYPE html>
<html lang="en">

<head>

  <title>IITK-Advanced-Student-Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/profilePage.scss">
  <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://widget.cloudinary.com/global/all.js"></script>
  <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.css">
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

</head>

<body>

  <nav class="nav red">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo left">Student-Search</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a id="textSearch" href="../search/textSearch.php">TextSearch</a></li>
            <li><a id="photoSearch" href="../search/photoSearch.php">PhotoSearch</a></li>
            <li><a id="profileMenu" href="profilePage.php"><?php echo ucwords($_SESSION['user']) ?> &#x1F603;</a></li>
            <li><a id="logoutMenu"href="../includes/logout.inc.php">Logout</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a id="textSearch" href="../search/textSearch.php">TextSearch</a></li>
            <li><a id="photoSearch" href="../search/photoSearch.php">PhotoSearch</a></li>
            <li><a id="profileMenu" href="profilePage.php"><?php echo ucwords($_SESSION['user']) ?> &#x1F603;</a></li>
            <li><a id="logoutMenu" href="../includes/logout.inc.php">Logout</a></li>
        </ul>
    </div>
  </nav>
