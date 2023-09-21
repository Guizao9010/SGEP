<?php
require_once "src/controller/user.php";
$user_obj = new User();
if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $user_data = $user_obj->procurar_user_por_id($_SESSION['user_id']);
    if ($user_data ===  false) {
        header('Location: logout.php');
        exit;
    }
} else {
    header('Location: logout.php');
    exit;
}

?>
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
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg nav-color">
        <div class="container-fluid">
            <a class="navbar-brand" href="admDashboard.php">SGEP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admDashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastroCliente.php">Cadastrar cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
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
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">Alterar</button>
                    <button type="button" class="btn btn-danger">Apagar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Praia Grande</td>
                <td>PG-013-A</td>
                <td>,GW~ax?vdWFF</td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">Alterar</button>
                    <button type="button" class="btn btn-danger">Apagar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Santos</td>
                <td>SA-013-A</td>
                <td>BBn&qXbY8Max</td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">Alterar</button>
                    <button type="button" class="btn btn-danger">Apagar</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuário</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Cliente</label>
                            <input type="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Código</label>
                            <input type="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
