<!doctype html>
<html lang="pt-BR">
<head>
    <title>Consulta de Professores</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../swe/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <script src="../swe/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../swe/sweetalert2-11.22.2/package/dist/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="../2YBDPHP/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<body>

<header>
    <div class="jumbotron jumbotron-fluid bg-dark text-light">
        <div class="container">
            <h1 class="display-4">Consulta de Professores e Disciplinas</h1>
        </div>
    </div>
</header>

<div class="container mt-5">
    <main>
        <form method="post" action="" class="mb-4">

            <div class="form-group">
                <label class="font-weight-bold">Sigla do Professor:</label>
                <input type="text" name="profsigla" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Sigla do Curso:</label>
                <input type="text" name="siglacurso" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Série:</label>
                <input type="text" name="serie" class="form-control" required>
            </div>

            <button type="submit" style="width:100px;" class="btn btn-info">Pesquisar</button>
            <button type="reset" style="width:100px;" class="btn btn-danger">Cancelar</button>
        </form>
    </main>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdaulas";

    $conexao_bd = new mysqli($servidor, $usuario, $senha, $bd);

    if ($conexao_bd->connect_error) {
        die("<div class='alert alert-danger'>Falha na conexão: " . $conexao_bd->connect_error . "</div>");
    }

    $profsigla   = $_POST['profsigla'];
    $siglacurso  = $_POST['siglacurso'];
    $serie       = $_POST['serie'];

    $sql = "CALL lista_professor(?,?,?)";
    $stmt = $conexao_bd->prepare($sql);

    if (!$stmt) {
        die("<div class='alert alert-danger'>Erro na preparação da query: " . $conexao_bd->error . "</div>");
    }

    $stmt->bind_param("sss", $profsigla, $siglacurso, $serie);

    if (!$stmt->execute()) {
        die("<div class='alert alert-danger'>Erro na execução: " . $stmt->error . "</div>");
    }

    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        echo "<div class='alert alert-warning'>Nenhum registro encontrado.</div>";
    } else {

        echo "<br><table class='table table-bordered table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Matéria</th>
                        <th>Sigla da Matéria</th>
                        <th>Série</th>
                        <th>Professor</th>
                        <th>Sigla do Professor</th>
                    </tr>
                </thead>
                <tbody>";

        while ($campo = $res->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($campo["Materia"]) . "</td>
                    <td>" . htmlspecialchars($campo["SiglaMateria"]) . "</td>
                    <td>" . htmlspecialchars($campo["Serie"]) . "</td>
                    <td>" . htmlspecialchars($campo["Professor"]) . "</td>
                    <td>" . htmlspecialchars($campo["SiglaProf"]) . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    }

    $stmt->close();
    $conexao_bd->close();
}
?>
</div>

<script src="../2YBDPHP/bootstrap-4.1.3-dist/js/jquery-3.7.1.min.js"></script>
<script src="../2YBDPHP/bootstrap-4.1.3-dist/js/popper.js"></script>
<script src="../2YB DPHP/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>

</body>
</html>