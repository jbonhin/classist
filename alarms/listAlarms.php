<?php
session_start();
//require "config.php";
require "../core/connection.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Buscar dados em tempo real com PHP, MySQL e AJAX">
  <meta name="author" content="João">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Classist</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.5.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
  <main>
    <div class="container py-4 text-center">
      <h2>Alarmes</h2>
			<?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
      ?>

      <div class="row g-4">

        <div class="col-auto">
          <label for="num_registros" class="col-form-label">Mostrar: </label>
        </div>

        <div class="col-auto">
          <select name="num_registros" id="num_registros" class="form-select">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>

        <div class="col-auto">
          <label for="num_registros" class="col-form-label">registros </label>
        </div>

        <div class="col-2">
          <label for="campo" class="col-form-label">Buscar: </label>
        </div>
        <div class="col-auto">
          <input type="text" name="campo" id="campo" class="form-control">
        </div>

        <div class="col-2"></div>

        <div class="col-1">
          <a class="btn btn-success btn-sm" style="width: 76px;" href="../index.php" >Menu</a>
        </div>

        <div class="col-auto">
          <a href="./formAddAlarm.php" class="btn-cadastrar btn btn-primary btn-sm">Cadastrar</a>
        </div>
      </div>

      <div class="row py-4">
        <div class="col">
          <table class="table table-sm table-bordered table-striped">
            <thead>
              <th class="sort asc">ID</th>
              <th class="sort asc">Descrição</th>
              <th class="sort asc">Nome do Equipamento</th>
              <th class="sort asc">Classificação</th>
              <th class="sort asc">Data do Cadastro</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </thead>

            <!-- El id del cuerpo de la tabla. -->
            <tbody id="content">
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-6">
          <label id="lbl-total"></label>
        </div>

        <div class="col-6" id="nav-pagination"></div>

        <input type="hidden" id="pagina" value="1">
        <input type="hidden" id="orderCol" value="0">
        <input type="hidden" id="orderType" value="asc">
      </div>
    </div>
  </main>

  <script>
  /* Chamando a função getData() */
  getData()

  /* Ouça um evento keyup no campo de entrada e chame a função getData. */
  document.getElementById("campo").addEventListener("keyup", function() {
    getData()
  }, false)
  document.getElementById("num_registros").addEventListener("change", function() {
    getData()
  }, false)

  /* AJAX */
  function getData() {
    let input = document.getElementById("campo").value
    let num_registros = document.getElementById("num_registros").value
    let content = document.getElementById("content")
    let pagina = document.getElementById("pagina").value
    let orderCol = document.getElementById("orderCol").value
    let orderType = document.getElementById("orderType").value

    if (pagina == null) {
      pagina = 1
    }

    let url = "./loadAlarms.php"
    let formaData = new FormData()
    formaData.append('campo', input)
    formaData.append('registros', num_registros)
    formaData.append('pagina', pagina)
    formaData.append('orderCol', orderCol)
    formaData.append('orderType', orderType)

    fetch(url, {
        method: "POST",
        body: formaData
      }).then(response => response.json())
      .then(data => {
        content.innerHTML = data.data
        document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFilter +
          ' de ' + data.totalRegisters + ' registros'
        document.getElementById("nav-pagination").innerHTML = data.pagination
      }).catch(err => console.log(err))
  }

  function nextPage(pagina) {
    document.getElementById('pagina').value = pagina
    getData()
  }

  let columns = document.getElementsByClassName("sort")
  let tamanho = columns.length
  for (let i = 0; i < tamanho; i++) {
    columns[i].addEventListener("click", ordenar)
  }

  function ordenar(e) {
    let elemento = e.target

    document.getElementById('orderCol').value = elemento.cellIndex

    if (elemento.classList.contains("asc")) {
      document.getElementById("orderType").value = "asc"
      elemento.classList.remove("asc")
      elemento.classList.add("desc")
    } else {
      document.getElementById("orderType").value = "desc"
      elemento.classList.remove("desc")
      elemento.classList.add("asc")
    }

    getData()
  }
  </script>

  <!-- Bootstrap core JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>