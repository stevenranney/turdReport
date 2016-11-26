<html dir="ltr" lang="en-US" >
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="/css/simpleStyle.css">
<title>Upload or Search</title>
</head>
<body>

<h1>Upload</h1>
<div>
<form method="post" action="upload.php"/>
  <label>Name:
    <input type="test" name="name" required />
    <br><br>
  </label>
  <label>Date of turd:
    <input type="datetime-local" name="date"  required />
    <br><br>
  </label>

  <label>  <a href='https://en.wikipedia.org/wiki/Bristol_stool_scale' target="_blank">Type (between 1 and 7):</a>
    <input type="number" name="type" min="1" max="7" required />
    <br><br>
  </label>
  <label>Color:
    <input type="color" name="color" required />
    <br><br>
  </label>
  <label>Notes:
    <textarea name="notes" rows="5" cols="40" />
    </textarea>
    <br><br>
  <input type="submit" value="Upload" />
</form>
</div>

<br>
<hr>
<br>

<h1>Search By Name</h1>

<div>
<form action="search.php" method="post">
  <label>Name:
  <input type="text" name="keyname" />
  </label>
  <input type="submit" value="Search" />
</form>
</div>

</body>
</html>