<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Inserir Filmes</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="<?php echo base_url()?>assets/css/agency.min.css" rel="stylesheet">
    
    <style>
    
        .center_div
        {
            margin: 0 auto;
            width: 30%;
        }
        
    </style>
    
    
</head>
<body>

    <div class="container center_div">
        
        Dados:
		- Partida: <?php echo $dados->partida; ?>
		- Destino: <?php echo $dados->destino; ?>
		- Horário: <?php echo $dados->horario; ?>
                
     </div>
            
        
        
 
    
    <!--<table>
        <thead>
            <tr>
                <th> Nome </th>            
                <th> Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $filme): ?>
            <tr>
                <td><?php echo $filme->nome ?></td>
                <td><?php echo $filme->descricao ?></td>
            </tr>
            <?php endforeach ?>
            
        </tbody>
    </table>
        <?php
        $this->table->set_heading('Name','Description');
        foreach($list as $filme){
            $this->table->add_row($filme->nome, $filme->descricao);
        }
        echo $this->table->generate(); ?>
-->

</body>
</html>