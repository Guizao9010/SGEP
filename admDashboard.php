<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>MENU</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg nav">
        <div class="container-fluid">           
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" style="color: white;" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white;" href="#">Cadastrar Cliente</a>
                    </li>                   
                </ul>
                <button type="button" class="btn exit"><iconify-icon icon="system-uicons:exit-left" style="color: white;" width="40" height="40"></iconify-icon></button>
            </div>
        </div>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Código</th>
                <th scope="col">Senha</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <th scope="row">1</th>
                <td>São Vicente</td>
                <td>SV-013-A</td>
                <td>CWa6&/8B-Z&4</td>
                <td>
                    <button type="button" class="btn btn-warning">Alterar</button>
                    <button type="button" class="btn btn-danger">Apagar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Praia Grande</td>
                <td>PG-013-A</td>
                <td>,GW~ax?vdWFF</td>
                <td>
                    <button type="button" class="btn btn-warning">Alterar</button>
                    <button type="button" class="btn btn-danger">Apagar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Santos</td>
                <td>SA-013-A</td>
                <td>BBn&qXbY8Max</td>
                <td>
                    <button type="button" class="btn btn-warning">Alterar</button>
                    <button type="button" class="btn btn-danger">Apagar</button>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>