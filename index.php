<!DOCTYPE html>
<html ng-app="listaTelefonica">
<head>
	<title>Lista Telefonica</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		.jumbotron{
			width: 800px;
			text-align: center;
			margin-top: 20px;
			margin-left: auto;
			margin-right: auto;
		}
		.table{
			margin-top: 20px;
		}
		.form-control{
			margin-bottom: 10px;
			max-width: auto;
		}
	</style>
	<script src="js/angular.js"></script>
	<script type="text/javascript">
		angular.module("listaTelefonica", []);
		angular.module("listaTelefonica").controller("listaTelefonicaCtrl", function($scope){
			$scope.app = "Lista Telefonica";
			$scope.contatos = [
			/*	
				{ nome: "Rhuan Carlos", cidade: "Teresina", telefone: "86999856027", operadora: "Vivo" },
				{ nome: "Liana Karina", cidade: "Teresina", telefone: "86999875279" },
				{ nome: "Maria Rosa", cidade: "Codó", telefone: "99999933339" },
				{ nome: "Antonio Carlos", cidade: "Codó", telefone: "99999992345" },
			*/
			];
			$scope.operadoras = [
				{ nome: "Oi", codigo: "031"},
				{ nome: "Tim", codigo: "041"},
				{ nome: "Claro", codigo: "021"},
				{ nome: "Vivo", codigo: "015"}
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
			};
		});
	</script>
</head>
<body ng-controller="listaTelefonicaCtrl">
	
	<div class="jumbotron">
		<h2 ng-bind="app"></h2>
	<table class="table table-striped">
		<tr>
			<th>Nome</th>
			<th>Cidade</th>
			<th>Telefone</th>
			<th>Operadora</th>
		</tr>
		<tr ng-repeat="contato in contatos">
<!-- 			<td ng-repeat="(key, value) in contato">
				{{value}}
			</td> -->
			<td>{{contato.nome}}</td>
			<td>{{contato.cidade}}</td>
			<td>{{contato.telefone}}</td>
			<td>{{contato.operadora.nome + ' ' + contato.operadora.codigo}}</td>
		</tr>
	</table>
	<hr>
	<!-- {{ operadoras }} -->
	<!-- {{ contato 	}} -->
	<input class="form-control" type="text" placeholder="Nome" ng-model="contato.nome">
	<input class="form-control" type="text" placeholder="Cidade" ng-model="contato.cidade">
	<input class="form-control" type="text" placeholder="Telefone" ng-model="contato.telefone" maxlength="11">
	<select class="form-control" ng-model="contato.operadora" ng-options="operadora.nome for operadora in operadoras">
	<option value="">Selecione uma opção</option>
	</select>
	<!-- <button class="btn btn-primary btn-block" ng-click="adicionaContato(nome, cidade, telefone)"> Adicionar Contato</button><br> //forma 2-->
	<button class="btn btn-primary btn-block" ng-click="adicionaContato(contato)" ng-disabled="!contato.nome || !contato.cidade || !contato.telefone"> Adicionar Contato</button><br>
	<small class="small"><strong>Detalhes de Cadastro</strong></small><br>
<!-- 	<label class="alert alert-info">{{nome}}</label>
	<label class="alert alert-danger">{{ cidade}}</label>
	<label class="alert alert-success">{{telefone}}</div> -->

</body>
</html>