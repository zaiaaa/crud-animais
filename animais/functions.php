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
        $animals = find_all("customers");
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
            $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
            save('customers', $customer);
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
    
        if (isset($_POST['customer'])) {
    
            $customer = $_POST['customer'];
            $customer['modified'] = $now->format("Y-m-d H:i:s");
    
            update('customers', $id, $customer);
            header('location: index.php');
        } else {
    
            global $customer;
            $customer = find('customers', $id);
        } 
        } else {
        header('location: index.php');
        }
    }

    function delete($id = null) {

        global $customer;
        $customer = remove('customers', $id);
      
        header('location: index.php');
      }

?>
