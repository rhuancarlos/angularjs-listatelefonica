<!DOCTYPE html>
<html ng-app="listaTelefonica">
<head>
	<title>Lista Telefonica</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		.container{
			margin-left: 30px;
			margin-right: 30px;
			padding: 10px 60px 0 60px;
			max-width: 90%;
		}
		.jumbotron{
			/* width: 800px; */
			text-align: center;
			margin-top: 5px;
			margin-bottom: 5px;
			margin-left: auto;
			margin-right: auto;
			padding-top: 14px;
		}
		.table{
			margin-top: 20px;
		}
		.form-control{
			margin-bottom: 10px;
			max-width: auto;
		}
		.selecionado{
			background-color: #fd7d1450;
			font-weight: bold;
		}
	</style>
	<script src="js/angular.js"></script>
	<script type="text/javascript">
		angular.module("listaTelefonica", []);
		angular.module("listaTelefonica").controller("listaTelefonicaCtrl", function($scope){
			$scope.appTitle1 = "Cadastro de Contatos";
			$scope.appTitle2 = "Contatos Registrados";

			$scope.contatos = [
 				{ nome: "Rhuan Carlos", cidade: "Teresina", telefone: "86999856027", operadora: {nome: "Vivo", codigo: "015"}, cor: "#4286f4" },
				{ nome: "Liana Karina", cidade: "Teresina", telefone: "86999875279", operadora: {nome: "Tim", codigo: "041"}, cor: "#041633" },
				{ nome: "Maria Rosa", cidade: "Codó", telefone: "99999933339", operadora: {nome: "Claro", codigo: "021"}, cor: "#065608" },
				{ nome: "Antonio Carlos", cidade: "Codó", telefone: "99999992345", operadora: {nome: "Oi", codigo: "031"}, cor: "#935b07" },
			];
			$scope.operadoras = [
				{ nome: "Oi", codigo: "031"},
				{ nome: "Tim", codigo: "041"},
				{ nome: "Claro", codigo: "021"},
				{ nome: "Vivo", codigo: "015"}
			];
			
			$scope.cores = [
				{ nome: "Indigo", cor: "#6610f2"},
				{ nome: "Purple", cor: "#6f42c1"},
				{ nome: "Pink", cor: "#e83e8c"},
				{ nome: "Red", cor: "#dc3545"},
				{ nome: "Orange", cor: "#fd7d1450"},
				{ nome: "yellow", cor: "#ffc107"},
				{ nome: "Green", cor: "#28a745"},
				{ nome: "Teal", cor: "#20c997"},
				{ nome: "Cyan", cor: "#17a2b8"},
				{ nome: "Gray", cor: "#6c757d"},
			];

			$scope.adicionaContato = function(contato){
			/* 
				$scope.adicionaContato = function(nome, cidade, telefone){
				Forma menos eficiente, pois quebra o mantra. Deve-se evitar fazer leitura no controler.
				$scope.contatos.push({nome: $scope.nome, cidade: $scope.cidade, telefone: $scope.telefone});

				Ainda não muito legal, afeta o mantra
				$scope.contatos.push({nome:nome, cidade:cidade, telefone:telefone});
			*/
			$scope.contatos.push(angular.copy(contato));
			delete $scope.contato;
			};

			$scope.apagarContato = function(contatos){
/* 				var contatosSelecionados = contatos.filter(function (contato){
					if (contato.selecionado) return contato;
				});
				console.log(contatosSelecionados); */
				$scope.contatos = contatos.filter(function (contato){
					if (!contato.selecionado) return contato;
				});
			}

			$scope.isContatoSelecionado = function(contatos){
				return contatos.some(function(contato){
					return contato.selecionado;
				});
			}
		});
	</script>
</head>
<body ng-controller="listaTelefonicaCtrl">

<div class="container">
	<div class="row">
		<div class="col-4">
		<div class="jumbotron">
			<h3 ng-bind="appTitle1"></h3>
		<!-- {{ operadoras }} -->
		<!-- {{ cores }} -->
		{{contato.cor}}
		<input class="form-control" type="text" placeholder="Nome" ng-model="contato.nome">
		<input class="form-control" type="text" placeholder="Cidade" ng-model="contato.cidade">
		<input class="form-control" type="text" placeholder="Telefone" ng-model="contato.telefone" maxlength="11">
		<select class="form-control" ng-model="contato.operadora" ng-options="operadora.nome for operadora in operadoras">
			<option value="">Selecione uma opção</option>
		</select>
		<select class="form-control" ng-model="contato.cor" ng-options="cor.nome for cor in cores">
			<option value="">Selecione uma cor</option>
		</select>
		<button class="btn btn-primary btn-block" ng-click="adicionaContato(contato)" ng-disabled="!contato.nome || !contato.cidade || !contato.telefone"> Adicionar Contato</button>
		
		<!-- Using Diretive 'ng-disabled' on button apagar -->
		<!-- <button class="btn btn-danger btn-block" ng-click="apagarContato(contatos)" ng-disabled="!isContatoSelecionado(contatos)"> Apagar Contato</button><br> -->

		<!-- Using Directive 'ng-show' on button apagar -->
		<!-- NG-HIDE interage com o elemento de forma que trabalha apenas na visibilidade do elemento na página. Desta forma o elemento apenas recebe um 'display: none;' em seu css. -->
		<!-- <button class="btn btn-danger btn-block" ng-click="apagarContato(contatos)" ng-show="isContatoSelecionado(contatos)"> Apagar Contato</button> -->
		
		<!-- Using Directive 'ng-hide' on button apagar -->
		<!-- NG-HIDE interage com o elemento de forma que trabalha apenas na visibilidade do elemento na página. Desta forma o elemento apenas recebe um 'display: none;' em seu css. -->
		<!-- <button class="btn btn-danger btn-block" ng-click="apagarContato(contatos)" ng-hide="isContatoSelecionado(contatos)"> Apagar Contato</button> -->

		<!-- Using Directive 'ng-show' on button apagar -->
		<!-- NG-IF interage diretamente com o DOM do navegador, desta forma o elemento passa a existir no escopo html somente após condição ser TRUE. -->
		<button class="btn btn-danger btn-block" ng-click="apagarContato(contatos)" ng-if="isContatoSelecionado(contatos)"> Apagar Contato</button>
		</div>
		</div>
		<div class="col-8">
		<div class="jumbotron">
			<h3 ng-bind="appTitle2"></h3>
			<table class="table" ng-show="contatos.length > 0">
				<tr>
					<th></th>
					<th>Nome</th>
					<th>Cidade</th>
					<th>Telefone</th>
					<th>Operadora</th>
					<th></th>
				</tr>
				<tr ng-class="{'selecionado': contato.selecionado}" ng-repeat="contato in contatos">
					<td><input type="checkbox" ng-model="contato.selecionado"></td>
					<td>{{contato.nome}}</td>
					<td>{{contato.cidade}}</td>
					<td>{{contato.telefone}}</td>
					<td>{{contato.operadora.nome + ' ' + contato.operadora.codigo}}</td>
					<th><div style="width: 20px; height: 20px;" ng-style="{'background-color': contato.cor}"></div></th>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>

	<div ng-include="'footer.php'" style="text-align: center;">

	</div>
</body>
</html>