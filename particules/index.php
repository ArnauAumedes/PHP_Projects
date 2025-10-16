<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari</title>
</head>

<body>
    <form action="recepcio.php" method="GET" name="">
    <br>
        <input type="text" placeholder="Nom" name="nom">
        <!-- <input type="submit" value="Enviar"> -->
        <br><br>
        <input type="radio" name="sexe" id="home" value="home">
                <label for="home">Home</label> 
        <input type="radio" name="sexe" id="dona" value="dona">
                <label for="home">Dona</label>      
            <select name="any" id="any">
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2001">2002</option>
            <option value="2001">2003</option>
            <option value="2001">2004</option>
            <option value="2001">2005</option>
        </select>   
    <!-- Checkbox -->
    
        <label for="termes">Termes i condicions</label>
        <input type="checkbox" name="termes" value="ok" id="termes">
        <br><br>
        <input type="submit" name="btn-enviar" vale="Enviar">
    </form>


</body>
</html>


