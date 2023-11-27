<?php

    include('../config.php');
    include(DBAPI);

    $animals = null;
    $animal = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $animal;
        $animals = find_all("animal");
    }

    /**
     *  Visualização de um Cliente
     */
    function view($id = null) {
        global $animal;
        $animals = find("animal", $id);
    }

    /**
    *  Cadastro de Clientes
     */
    function add() {
        if (!empty($_POST['customer'])) {
            $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $animal = $_POST['animal'];
            $customer['dataNasc'] = $today->format("Y-m-d H:i:s");
            save('animal', $animal);
            header('location: index.php');
        }
    }

    
    /**
     *	Atualizacao/Edicao de Cliente
    */
    function edit() {

        $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
    
        if (isset($_GET['id'])) {
    
        $id = $_GET['id'];
    
        if (isset($_POST['animal'])) {
    
            $customer = $_POST['animal'];
            $animal['dataNasc'] = $now->format("Y-m-d H:i:s");
    
            update('animal', $id, $animal);
            header('location: index.php');
        } else {
    
            global $customer;
            $customer = find('animal', $id);
        } 
        } else {
        header('location: index.php');
        }
    }

    function delete($id = null) {

        global $animal;
        $animal = remove('animal', $id);
      
        header('location: index.php');
      }

?>
