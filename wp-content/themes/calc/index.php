<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Document</title>
        <?php wp_head(); ?>
</head>
<body>
    <div class="container my-4">  

        <div class="calculator card">
        
            <input type="text" class="calculator-screen z-depth-1" value="" disabled />
        
            <div class="calculator-keys">
        
              <button type="button" class="operator btn btn-dark" value="+">+</button>
              <button type="button" class="operator btn btn-dark" value="-">-</button>
              <button type="button" class="operator btn btn-dark" value="*">&times;</button>
              <button type="button" class="operator btn btn-dark" value="/">&divide;</button>
        
              <button type="button" value="7" class="btn btn-light waves-effect">7</button>
              <button type="button" value="8" class="btn btn-light waves-effect">8</button>
              <button type="button" value="9" class="btn btn-light waves-effect">9</button>
        
        
              <button type="button" value="4" class="btn btn-light waves-effect">4</button>
              <button type="button" value="5" class="btn btn-light waves-effect">5</button>
              <button type="button" value="6" class="btn btn-light waves-effect">6</button>
        
        
              <button type="button" value="1" class="btn btn-light waves-effect">1</button>
              <button type="button" value="2" class="btn btn-light waves-effect">2</button>
              <button type="button" value="3" class="btn btn-light waves-effect">3</button>
        
        
              <button type="button" value="0" class="btn btn-light waves-effect">0</button>
              <button type="button" class="decimal function btn btn-secondary" value=".">.</button>
              <button type="button" class="all-clear function btn btn-dark btn-sm" value="all-clear">Стереть</button>
        
              <button type="button" class="equal-sign operator btn btn-dark btn-default ravno" value="=">=</button>
        
            </div>
            <div class="results" id="results"></div>
          </div>
        </div>

    <script src="/wp-content/themes/calc/script.js"></script>
</body>
</html>
