<?php
    session_start();
    include('../config.php');
    include(DBAPI);
    include(PDF);
    $customers = null;
    $customer = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $customers;
        $customers = find_all("customers");
    }

    /**
     *  Visualização de um Cliente
     */
    function view($id = null) {
        global $customer;
        $customer = find("customers", $id);
    }

    /**
    *  Cadastro de Clientes
     */
    function add() {
        if (!empty($_POST['customer'])) {
            $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $customer = $_POST['customer'];
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


    function pdf($p = null){
        $pdf = new PDF();

        $pdf->SetTitle('Listagem de Clientes', true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);
        $pdf->SetMargins(10,10,10);
        $customers = null;

        if($p){
            $customers = filter("customers", "name like '%" . $p . "%'");
        }else{
            $customers = find_all("customers");
        }

        foreach($customers as $customer){
            $pdf->Cell(100, 10, '(' . $customer['id'] . ')' .  ' - ' .$customer['name'] . ' - ' . $customer['mobile'], 0, 0, 'C');
        }

        $pdf->Output();
    }
