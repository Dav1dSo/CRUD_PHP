
<?php
    // --Conexao com banco de dados--
    $pdo = new PDO('mysql:host=localhost;dbname=crud', 'root', 'password');

    // --Insercao de dados nas tabelas--
    if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO Clientes VALUES (null, ?, ?)");
        $sql->execute(array($_POST['nome'], $_POST['email']));
        echo "<h1>Dados inseridos com sucesso!</h1>";
    }

    // --Deletar dados da tabela--
    
    else if(isset($_GET['delete'])){
        $id = (int)$_GET['delete'];
        $pdo->exec("DELETE FROM Clientes WHERE id = $id");
        echo "<h1>Deletado com sucesso!</h1>";
    }
?>

<form id="form" method="post">    
    <input id="nome" type="text" name="nome" placeholder="Nome:">
    <input id="email" type="email" name="email" placeholder="Email:">
    <input id="enviar" type="submit" value="Enviar" >
</form>

<?php
    $sql = $pdo->prepare("SELECT * FROM Clientes");
    $sql->execute();
    
    $fetchClientes = $sql->fetchAll();
    
    foreach($fetchClientes as $key => $value) {
        echo $value['nome'].' | '.$value['email'].'<a href="?delete='.$value['id'].'">( X )</a>';
        echo '<br>';
    }
?>

<style>
    
    *{
        margin: 0;
        padding: 0;
    }

    body {
        margin: auto;
        max-width: 500px;
        text-align: center;
        background-color: black ;
        color: #F5F9FF;
        box-shadow: 0px 0px 20px 1px #1E90FF;
    }

    #form {
        display: flex;
        flex-direction: column;
        margin: auto; 
    }
    
    input {
        margin: auto;
        width: 370px;
        height: 40px;
        margin-top: 20px;
        border: none;
        border-radius: 4px;
    }

    #enviar {
        background-color: #1E90FF;
        width: 100px;
        margin-bottom: 25px;
    }

    a{
        font-size: 20px;
        margin-left: 10px;
        text-decoration: none;
        color: red;
    }


</style>