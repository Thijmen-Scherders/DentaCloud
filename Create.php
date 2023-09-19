<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootsrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Dentacloud Crud</title>
</head>
<body>

    <div class="container">
    <form methode ="post">

  <div class="form-group">
    <label>Voornaam</label>
    <input type="voornaam" class="form-control" placeholder="Vul hier uw voornaam in">
  </div>

 
  
  <div class="form-group">
    <label>Achternaam</label>
    <input type="text" class="form-control" placeholder="Vul hier uw achternaam in">
  </div>


  <div class="form-group">
    <label>Telefoonummer</label>
    <input type="text" class="form-control" placeholder="Vul hier uw telefoonummer in">
  </div>


  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" placeholder="Vul hier uw email in">
  </div>



  <div class="form-group">
    <label>Diensten</label>
    <select name="dienst" id="diensten">
        <option value="test"></option>
        <option value="test2"></option>
        <option value="test3"></option>
        <option value="test4"></option>
        <option value="test5"></option>

    </select>
  </div>


  <div class="form-group">
    <label>Datum</label>
    <input type="Date" class="form-control" placeholder="Vul hier uw datum in">
  </div>

  <div class="form-group">
    <label>Tijd</label>
    <input type="time" class="form-control" placeholder="Vul hier uw tijd in">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    
    </div>
    
</body>
</html>