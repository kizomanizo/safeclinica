
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Initial Setup</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/loader.css') }}">
  </head>

  <body>

        <div class="container col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2 vcenter">
            <div class="row vcenter">
                <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
                    <a class="navbar-brand" href="#">Welcome</a>
                </nav>
            </div>
            <div class="row">         
                <div class="panel panel-default col-sm-12">
                    <div class="panel-heading">
                        <h1 class="text-center">Initial Setup</h1>
                    </div>
                    <div class="panel-body">
                        <p class="lead text-center">
                         <!-- $pdo = new PDO('mysql:host=localhost;dbname=;charset=utf8mb4', 'root', 'safefocus'); @endphp
                             ($pdo->query('select database()')->fetchColumn() == '') -->
                                @php
                                    $db = new mysqli('localhost', 'root', 'safefocus');
                                    $database="safefocus";
                                    $query="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME=?";
                                    $stmt = $db->prepare($query);
                                    $stmt->bind_param('s',$database);
                                    $stmt->execute();
                                    $stmt->bind_result($data);
                                    if($stmt->fetch())
                                    {
                                        if (!Schema::hasTable('migrations')) {
                                        echo "
                                            <div class='list-group col-md-8 col-md-offset-2'>
                                                <a href='createdatabase' class='list-group-item text-center disabled'>
                                                    <span><s>1- Create DB</s></span>
                                                    <i class='fa fa-check text-success'></i></a>
                                                <a href='migratedatabase' id='migrateLink' class='list-group-item text-center'>
                                                    2- Make Tables
                                                </a>
                                                <a href='seeddatabase' class='list-group-item text-center'>
                                                    3- Seed Database
                                                </a>
                                            </div>
                                            "; } else {
                                        echo "
                                            <div class='list-group col-md-8 col-md-offset-2'>
                                                <a href='createdatabase' class='list-group-item text-center disabled'>
                                                    <span><s>1- Create DB</s></span>
                                                    <i class='fa fa-check text-success'></i>
                                                </a>
                                                <a href='migratedatabase' id='migrateLink' class='list-group-item text-center disabled'>
                                                    <span><s>2- Make Tables</s></span>
                                                    <i class='fa fa-check text-success'></i>
                                                </a>
                                                <a href='seeddatabase' id='seedLink' class='list-group-item text-center'>
                                                    <span id='seedDatabase'>3- Seed Database</span>
                                                    <i id='faCheck' class=''></i>
                                                </a>
                                                <br>
                                                <div id='loader' class='loader centered' style='display: none;'></div>
                                            </div>
                                        ";}
                                    }
                                    else
                                    {
                                        echo " 
                                            <div class='list-group col-md-8 col-md-offset-2'>
                                                <a href='createdatabase' id='createLink' class='list-group-item text-center disabled'>
                                                    <span><s>1- Create DB</s></span>
                                                    <i class='fa fa-check text-success'></i>
                                                </a>
                                                <a href='migratedatabase' class='list-group-item text-center disabled'>
                                                    <span><s>2- Make Tables</s></span>
                                                    <i class='fa fa-check text-success'></i>
                                                </a>
                                                <a href='seeddatabase' class='list-group-item text-center'>
                                                    3- Seed Database
                                                </a>
                                            </div>
                                        ";}
                                    $stmt->close();
                                @endphp
                        </p>

                    </div>
                </div>
            </div>
        </div><!-- /.container -->

  </body>
  <script type="text/javascript" src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/paper/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
    var create_button      = $("#createLink");
    var migrate_button      = $("#migrateLink");
    var seed_button      = $("#seedLink");
        $(create_button).click(function(e){
            e.preventDefault();
            document.getElementById('createLink').className += ' disabled';
            document.getElementById("faCheckCreate").className += "fa fa-check";
            document.getElementById('createDatabase').innerHTML = '<s>Create DB</s>';
            document.getElementById('loader').style.display= 'block';
            location.href = $(this).attr('href');
        }),

        $(migrate_button).click(function(e){
            e.preventDefault();
            document.getElementById('migrateLink').className += ' disabled';
            document.getElementById("faCheckMigrate").className += "fa fa-check";
            document.getElementById('migrateDatabase').innerHTML = '<s>Migrate Tables</s>';
            document.getElementById('loader').style.display= 'block';
            location.href = $(this).attr('href');
        }),

        $(seed_button).click(function(e){
            e.preventDefault();
            document.getElementById('seedLink').className += ' disabled';
            document.getElementById("faCheckSeed").className += "fa fa-check";
            document.getElementById('seedDatabase').innerHTML = '<s>Seed Database</s>';
            document.getElementById('loader').style.display= 'block';
            location.href = $(this).attr('href');
        })
    });
</script>
</html>       
