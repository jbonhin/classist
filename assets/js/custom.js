// Função para pesquisar os produtos no banco de dados e carregar no formulário
async function carregarEquipamentos(option, valor) {

    // Acessa o IF quando usuário digitar 2 caracteres
    if (valor.length >= 2) {
       console.log(valor);

      // Fazer a requisição para o arquivo PHP responsável em recuperar do banco de dados os equipamentos
      const dados = await fetch('listEquipments.php?nome=' + valor);

      // Ler os valores retornado
      const resposta = await dados.json();

      // Abrir a lista de equipamentos
      var conteudoHTML = "<ul class='list-group position-fixed'>";

      if (resposta['status']) {

          // Percorrer a lista de equipamentos retornado do banco de dados
          for (i = 0; i < resposta['dados'].length; i++) {

              // Criar a lista de equipamentos
              conteudoHTML += "<li class='list-group-item list-group-itemaction' style='cursor: pointer;' onclick='getNameEqp("+ option +","+ resposta['dados'][i].id + "," + JSON.stringify(resposta['dados'][i].equipment_name) + ")'>" + resposta['dados'][i].equipment_name + "</li>";
          }
      } else {
          // Criar o item da lista com o erro retornado do PHP
          conteudoHTML += "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
      }

      // Fechar a lista de equipamentos 
      conteudoHTML += "</ul>";

      // Enviar para o HTML a lista de equipamentos
      document.getElementById('resultado-pesquisa').innerHTML = conteudoHTML;
  } else {
      // Fechar a lista de equipamentos ou o erro
      document.getElementById("resultado-pesquisa").innerHTML = "";
  }
}

function getNameEqp(option, id_eqp, nome) {
  // Enviar o nome do equipamento para o campo equipamento o nome
  switch (option) {
    case 2:
      //Opção 2 - Atualizar
      document.getElementById("eqp_up").value = nome;
      break;
      
    default:
      //Opção 1 - Cadastrar
      document.getElementById("equipamento").value = nome;
      break;
  }
  // Enviar o ID do equipamento para o campo oculto
  document.getElementById("id_eqp").value = id_eqp;

  // Fechar a lista de equipamentos ou o erro
  document.getElementById("resultado-pesquisa").innerHTML = "";
  
}

function alarmStatus(value){
  if (value == 1) {
    status_alarme = "Desativado";        
  } else if(value == 2) {
    status_alarme = "Ativado";
  }
  open_popup(status_alarme);
}
		
function open_popup(at_desat) {
  document.querySelector("[name='alarm_status']").value = at_desat;
}


