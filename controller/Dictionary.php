<?php


namespace controller;

class Dictionary {

	public static function find($key, $lang) {
		switch (strtolower($key)) {
			case "user details":
				if ($lang == "pt") { return "Detalhes do usuário"; }
				if ($lang == "eng") { return "User details"; }
				break;
			case "first name":
				if ($lang == "pt") { return "Primeiro nome"; }
				if ($lang == "eng") { return "First name"; }
				break;
			case "last name":
				if ($lang == "pt") { return "Apelido"; }
				if ($lang == "eng") { return "Last name"; }
				break;
			case "username":
				if ($lang == "pt") { return "Nome de usuário"; }
				if ($lang == "eng") { return "Username"; }
				break;
			case "email":
				if ($lang == "pt") { return "E-mail"; }
				if ($lang == "eng") { return "E-mail"; }
				break;
			case "user type":
				if ($lang == "pt") { return "Tipo de usuário"; }
				if ($lang == "eng") { return "User type"; }
				break;
			case "list of all created users":
				if ($lang == "pt") { return "Lista de todos os usuários criados"; }
				if ($lang == "eng") { return "List of all created users"; }
				break;
			case "id":
				if ($lang == "pt") { return "Id"; }
				if ($lang == "eng") { return "Id"; }
				break;
			case "action":
				if ($lang == "pt") { return "Action"; }
				if ($lang == "eng") { return "Action"; }
				break;
			case "accounts":
				if ($lang == "pt") { return "Contas"; }
				if ($lang == "eng") { return "Accounts"; }
				break;
			case "create user":
				if ($lang == "pt") { return "Criar usuário"; }
				if ($lang == "eng") { return "Create user"; }
				break;
			case "active":
				if ($lang == "pt") { return "Activo"; }
				if ($lang == "eng") { return "Active"; }
				break;
			case "inactive":
				if ($lang == "pt") { return "Inactivo"; }
				if ($lang == "eng") { return "Inactive"; }
				break;
			case "actions":
				if ($lang == "pt") { return "Acções"; }
				if ($lang == "eng") { return "Actions"; }
				break;
			case "change user password":
				if ($lang == "pt") { return "Alterar senha de usuário"; }
				if ($lang == "eng") { return "Change user password"; }
				break;
			case "user permissions":
				if ($lang == "pt") { return "Previlêgios do usuário"; }
				if ($lang == "eng") { return "User permissions"; }
				break;
			case "enable or disable user":
				if ($lang == "pt") { return "Hablitar ou desabilitar usuário"; }
				if ($lang == "eng") { return "Enable or disable user"; }
				break;
			case "profile":
				if ($lang == "pt") { return "Perfil"; }
				if ($lang == "eng") { return "Profile"; }
				break;
			case "settings":
				if ($lang == "pt") { return "Definições"; }
				if ($lang == "eng") { return "Settings"; }
				break;
			case "logout":
				if ($lang == "pt") { return "Terminar sessão"; }
				if ($lang == "eng") { return "Logout"; }
				break;
			case "home":
				if ($lang == "pt") { return "Inicio"; }
				if ($lang == "eng") { return "Home"; }
				break;
			case "admin":
				if ($lang == "pt") { return "Admin"; }
				if ($lang == "eng") { return "Admin"; }
				break;
			case "dashboard":
				if ($lang == "pt") { return "Principal"; }
				if ($lang == "eng") { return "Dashboard"; }
				break;
			case "payments":
				if ($lang == "pt") { return "Pagamentos"; }
				if ($lang == "eng") { return "Payments"; }
				break;
			case "expense":
				if ($lang == "pt") { return "Despesa"; }
				if ($lang == "eng") { return "Expense"; }
				break;
			case "cheque":
				if ($lang == "pt") { return "Cheque"; }
				if ($lang == "eng") { return "Cheque"; }
				break;
			case "cash":
				if ($lang == "pt") { return "Caixa"; }
				if ($lang == "eng") { return "Cash"; }
				break;
			case "fixed cash fund":
				if ($lang == "pt") { return "Fundo fixo de caixa"; }
				if ($lang == "eng") { return "Fixed cash fund"; }
				break;
			case "transfer":
				if ($lang == "pt") { return "Transferência"; }
				if ($lang == "eng") { return "Transfer"; }
				break;
			case "bank accounts":
				if ($lang == "pt") { return "Contas bancárias"; }
				if ($lang == "eng") { return "Bank accounts"; }
				break;
			case "cost center":
				if ($lang == "pt") { return "Centro de custo"; }
				if ($lang == "eng") { return "Cost center"; }
				break;
			case "bank":
				if ($lang == "pt") { return "Banco"; }
				if ($lang == "eng") { return "Bank"; }
				break;
			case "expense group":
				if ($lang == "pt") { return "Grupo de despesa"; }
				if ($lang == "eng") { return "expense group"; }
				break;
			case "reports":
				if ($lang == "pt") { return "Relatórios"; }
				if ($lang == "eng") { return "Reports"; }
				break;
			case "sales":
				if ($lang == "pt") { return "Vendas"; }
				if ($lang == "eng") { return "Sales"; }
				break;
			case "customers":
				if ($lang == "pt") { return "Clientes"; }
				if ($lang == "eng") { return "Customers"; }
				break;
			case "stock":
				if ($lang == "pt") { return "Estoque"; }
				if ($lang == "eng") { return "Stock"; }
				break;
			case "product":
				if ($lang == "pt") { return "Producto"; }
				if ($lang == "eng") { return "Product"; }
				break;
			case "purchase":
				if ($lang == "pt") { return "Compra"; }
				if ($lang == "eng") { return "Purchase"; }
				break;
			case "supplier":
				if ($lang == "pt") { return "Fornecedor"; }
				if ($lang == "eng") { return "Supplier"; }
				break;
			case "category":
				if ($lang == "pt") { return "Categoria"; }
				if ($lang == "eng") { return "Category"; }
				break;
			case "warehouse":
				if ($lang == "pt") { return "Armazém"; }
				if ($lang == "eng") { return "Warehouse"; }
				break;
			case "mark":
				if ($lang == "pt") { return "Marca"; }
				if ($lang == "eng") { return "Mark"; }
				break;
			case "bill payments":
				if ($lang == "pt") { return "Pagamentos de facturas"; }
				if ($lang == "eng") { return "Bill payments"; }
				break;
			case "purchases":
				if ($lang == "pt") { return "Compras"; }
				if ($lang == "eng") { return "Purchases"; }
				break;
			case "short description":
				if ($lang == "pt") { return "Breve descrição"; }
				if ($lang == "eng") { return "Short description"; }
				break;
			case "expense id":
				if ($lang == "pt") { return "Id da Despesa"; }
				if ($lang == "eng") { return "Expense id"; }
				break;
			case "payment method":
				if ($lang == "pt") { return "Método de pagamento"; }
				if ($lang == "eng") { return "Payment method"; }
				break;
			case "payment date":
				if ($lang == "pt") { return "Data de pagamento"; }
				if ($lang == "eng") { return "Payment date"; }
				break;
			case "value":
				if ($lang == "pt") { return "Valor"; }
				if ($lang == "eng") { return "Value"; }
				break;
			case "expenses":
				if ($lang == "pt") { return "Despesas"; }
				if ($lang == "eng") { return "Expense"; }
				break;
			case "view details":
				if ($lang == "pt") { return "Ver detalhes"; }
				if ($lang == "eng") { return "View details"; }
				break;
			case "edit details":
				if ($lang == "pt") { return "Editar detalhes"; }
				if ($lang == "eng") { return "Edit details"; }
				break;
			case "delete":
				if ($lang == "pt") { return "Remover"; }
				if ($lang == "eng") { return "Delete"; }
				break;
			case "expense short description":
				if ($lang == "pt") { return "Breve descrição da despesa"; }
				if ($lang == "eng") { return "Expense short description"; }
				break;
			case "expense value":
				if ($lang == "pt") { return "valor da despesa"; }
				if ($lang == "eng") { return "Expense value"; }
				break;
			case "value to pay":
				if ($lang == "pt") { return "Valor a pagar"; }
				if ($lang == "eng") { return "Value to pay"; }
				break;
			case "paid value":
				if ($lang == "pt") { return "Valor pago"; }
				if ($lang == "eng") { return "Paid value"; }
				break;
			case "date added":
				if ($lang == "pt") { return "Data de adição"; }
				if ($lang == "eng") { return "Date added"; }
				break;
			case "pay expense":
				if ($lang == "pt") { return "Pagar despesa"; }
				if ($lang == "eng") { return "Pay expense"; }
				break;
			case "payment status":
				if ($lang == "pt") { return "Estado do pagamento"; }
				if ($lang == "eng") { return "Payment status"; }
				break;
			case "paid":
				if ($lang == "pt") { return "Pago"; }
				if ($lang == "eng") { return "Paid"; }
				break;
			case "not paid":
				if ($lang == "pt") { return "Não pago"; }
				if ($lang == "eng") { return "Not paid"; }
				break;
			case "add expense":
				if ($lang == "pt") { return "Adicionar despesa"; }
				if ($lang == "eng") { return "Add expense"; }
				break;
			case "optional":
				if ($lang == "pt") { return "Opcional"; }
				if ($lang == "eng") { return "Optional"; }
				break;
			case "expense details":
				if ($lang == "pt") { return "Detalhes da despesa"; }
				if ($lang == "eng") { return "Expense details"; }
				break;
			case "purchase id":
				if ($lang == "pt") { return "Id da compra"; }
				if ($lang == "eng") { return "Purchase id"; }
				break;
			case "purchase value":
				if ($lang == "pt") { return "Valor da compra"; }
				if ($lang == "eng") { return "Purchase value"; }
				break;
			case "variable expense":
				if ($lang == "pt") { return "Despesa variável"; }
				if ($lang == "eng") { return "Variable expense"; }
				break;
			case "fixed expense":
				if ($lang == "pt") { return "Despesa fixa"; }
				if ($lang == "eng") { return "Fixed expense"; }
				break;
			case "permission denied by administrator":
				if ($lang == "pt") { return "Permissão negada pelo administrador"; }
				if ($lang == "eng") { return "Permission denied by administrator"; }
				break;
			case "loading":
				if ($lang == "pt") { return "Carregando"; }
				if ($lang == "eng") { return "Loading"; }
				break;
			case "name":
				if ($lang == "pt") { return "Nome"; }
				if ($lang == "eng") { return "Name"; }
				break;
			case "balance":
				if ($lang == "pt") { return "Saldo"; }
				if ($lang == "eng") { return "Balance"; }
				break;
			case "total":
				if ($lang == "pt") { return "Total"; }
				if ($lang == "eng") { return "Total"; }
				break;
			case "add cash":
				if ($lang == "pt") { return "Adicionar caixa"; }
				if ($lang == "eng") { return "Add cash"; }
				break;
			case "open cash":
				if ($lang == "pt") { return "Abrir caixa"; }
				if ($lang == "eng") { return "Open cash"; }
				break;
			case "merge funds to make a new investments":
				if ($lang == "pt") { return "Combine valores para fazer novos investimentos"; }
				if ($lang == "eng") { return "Merge funds to make a new investments"; }
				break;
			case "cash value":
				if ($lang == "pt") { return "Valor do caixa"; }
				if ($lang == "eng") { return "Cash value"; }
				break;
			case "cash balance":
				if ($lang == "pt") { return "Saldo do caixa"; }
				if ($lang == "eng") { return "Cash balance"; }
				break;
			case "back":
				if ($lang == "pt") { return "Voltar"; }
				if ($lang == "eng") { return "Back"; }
				break;
			case "these are the payments made by the selected cash":
				if ($lang == "pt") { return "Estes são os pagamentos efectuados pelo caixa selecionado"; }
				if ($lang == "eng") { return "These are the payments made by the selected cash"; }
				break;
			case "no payments have been made":
				if ($lang == "pt") { return "Nenhum pagamento foi efectuado"; }
				if ($lang == "eng") { return "No payments have been made"; }
				break;
			case "open":
				if ($lang == "pt") { return "Abrir"; }
				if ($lang == "eng") { return "Open"; }
				break;
			case "sale id":
				if ($lang == "pt") { return "Id da venda"; }
				if ($lang == "eng") { return "Sale Id"; }
				break;
			case "bill id":
				if ($lang == "pt") { return "Id da factura"; }
				if ($lang == "eng") { return "Bill Id"; }
				break;
			case "bill payment details":
				if ($lang == "pt") { return "Detalhes do pagamento da factura"; }
				if ($lang == "eng") { return "Bill payment details"; }
				break;
			case "edit bill payment details":
				if ($lang == "pt") { return "Editar detalhes do pagamento da factura"; }
				if ($lang == "eng") { return "Edit bill payment details"; }
				break;
			case "value to pay":
				if ($lang == "pt") { return "Valor a pagar"; }
				if ($lang == "eng") { return "Value to pay"; }
				break;
			case "enterprise data":
				if ($lang == "pt") { return "Dados da empresa"; }
				if ($lang == "eng") { return "Enterprise data"; }
				break;
			case "enterprise":
				if ($lang == "pt") { return "Empresa"; }
				if ($lang == "eng") { return "Enterprise"; }
				break;
			case "contact":
				if ($lang == "pt") { return "Contacto"; }
				if ($lang == "eng") { return "Contact"; }
				break;
			case "fax":
				if ($lang == "pt") { return "Fax"; }
				if ($lang == "eng") { return "Fax"; }
				break;
			case "postal code":
				if ($lang == "pt") { return "Codigo postal"; }
				if ($lang == "eng") { return "Postal code"; }
				break;
			case "address":
				if ($lang == "pt") { return "Endereço"; }
				if ($lang == "eng") { return "Address"; }
				break;
			case "nuit":
				if ($lang == "pt") { return "NUIT"; }
				if ($lang == "eng") { return "TIN"; }
				break;
			case "tax identification number":
				if ($lang == "pt") { return "Número de identificação tributária"; }
				if ($lang == "eng") { return "Tax identification number"; }
				break;
			case "description":
				if ($lang == "pt") { return "Descrição"; }
				if ($lang == "eng") { return "Description"; }
				break;
			case "save":
				if ($lang == "pt") { return "Salvar"; }
				if ($lang == "eng") { return "Save"; }
				break;
			case "cancel":
				if ($lang == "pt") { return "Cancelar"; }
				if ($lang == "eng") { return "Cancel"; }
				break;
			case "edit information":
				if ($lang == "pt") { return "Editar informação"; }
				if ($lang == "eng") { return "Edit information"; }
				break;
			case "bill number":
				if ($lang == "pt") { return "Número da factura"; }
				if ($lang == "eng") { return "Bill number"; }
				break;
			case "emission date":
				if ($lang == "pt") { return "Data da emissão"; }
				if ($lang == "eng") { return "Emission date"; }
				break;
			case "customer name":
				if ($lang == "pt") { return "Nome do cliente"; }
				if ($lang == "eng") { return "Customer name"; }
				break;
			case "product id":
				if ($lang == "pt") { return "Id do producto"; }
				if ($lang == "eng") { return "Product id"; }
				break;
			case "amount":
				if ($lang == "pt") { return "Quantidade"; }
				if ($lang == "eng") { return "Amount"; }
				break;
			case "product":
				if ($lang == "pt") { return "Producto"; }
				if ($lang == "eng") { return "Product"; }
				break;
			case "price per unity":
				if ($lang == "pt") { return "Preço por unidade"; }
				if ($lang == "eng") { return "Price per unity"; }
				break;
			case "sub total":
				if ($lang == "pt") { return "Sub total"; }
				if ($lang == "eng") { return "Sub total"; }
				break;
			case "total without":
				if ($lang == "pt") { return "Total sem"; }
				if ($lang == "eng") { return "Total without"; }
				break;
			case "total with":
				if ($lang == "pt") { return "Total com"; }
				if ($lang == "eng") { return "Total with"; }
				break;
			case "change password":
				if ($lang == "pt") { return "Alterar senha"; }
				if ($lang == "eng") { return "Change password"; }
				break;
			case "current password":
				if ($lang == "pt") { return "Senha actual"; }
				if ($lang == "eng") { return "Current password"; }
				break;
			case "new password":
				if ($lang == "pt") { return "Nova senha"; }
				if ($lang == "eng") { return "New Password"; }
				break;
			case "confirm new password":
				if ($lang == "pt") { return "Confirmar nova senha"; }
				if ($lang == "eng") { return "Confirm new password"; }
				break;
			case "create new user":
				if ($lang == "pt") { return "Criar novo usuário"; }
				if ($lang == "eng") { return "Create new user"; }
				break;
			case "first name":
				if ($lang == "pt") { return "Primeiro nome"; }
				if ($lang == "eng") { return "First name"; }
				break;
			case "last name":
				if ($lang == "pt") { return "Apelido"; }
				if ($lang == "eng") { return "Last name"; }
				break;
			case "user name":
				if ($lang == "pt") { return "Nome do usuário"; }
				if ($lang == "eng") { return "User name"; }
				break;
			case "create user":
				if ($lang == "pt") { return "Criar usuário"; }
				if ($lang == "eng") { return "Create user"; }
				break;
			case "create":
				if ($lang == "pt") { return "Criar"; }
				if ($lang == "eng") { return "Create"; }
				break;
			case "password":
				if ($lang == "pt") { return "Senha"; }
				if ($lang == "eng") { return "Password"; }
				break;
			case "confirm password":
				if ($lang == "pt") { return "Confirmar senha"; }
				if ($lang == "eng") { return "confirm password"; }
				break;
			case "new sale":
				if ($lang == "pt") { return "Nova venda"; }
				if ($lang == "eng") { return "New sale"; }
				break;
			case "customer":
				if ($lang == "pt") { return "Cliente"; }
				if ($lang == "eng") { return "Customer"; }
				break;
			case "discount":
				if ($lang == "pt") { return "Desconto"; }
				if ($lang == "eng") { return "Discount"; }
				break;
			case "tax":
				if ($lang == "pt") { return "Imposto"; }
				if ($lang == "eng") { return "Tax"; }
				break;
			case "tax percentage":
				if ($lang == "pt") { return "Percentagem do imposto"; }
				if ($lang == "eng") { return "Tax percentage"; }
				break;
			case "final price":
				if ($lang == "pt") { return "Preço final"; }
				if ($lang == "eng") { return "Final price"; }
				break;
			case "bill value":
				if ($lang == "pt") { return "Valor da fatura"; }
				if ($lang == "eng") { return "Bill value"; }
				break;
			case "sale details":
				if ($lang == "pt") { return "Detalhes da venda"; }
				if ($lang == "eng") { return ""; }
				break;
			case "price with discount":
				if ($lang == "pt") { return "Preço com desconto"; }
				if ($lang == "eng") { return ""; }
				break;
			case "value to pay":
				if ($lang == "pt") { return "Valor a pagar"; }
				if ($lang == "eng") { return "Value to pay"; }
				break;
			case "add payment":
				if ($lang == "pt") { return "Adicionar pagamento"; }
				if ($lang == "eng") { return "Add Payment"; }
				break;
			case "print bill":
				if ($lang == "pt") { return "Imprimir fatura"; }
				if ($lang == "eng") { return "Print bill"; }
				break;
			case "view products":
				if ($lang == "pt") { return "Ver productos"; }
				if ($lang == "eng") { return "View products"; }
				break;
			case "discount type":
				if ($lang == "pt") { return "Tipo de desconto"; }
				if ($lang == "eng") { return "Discount type"; }
				break;
			case "discount percentage":
				if ($lang == "pt") { return "Percentagem do desconto"; }
				if ($lang == "eng") { return "Discount percentage"; }
				break;
			case "percentage":
				if ($lang == "pt") { return "Percentagem"; }
				if ($lang == "eng") { return "Percentage"; }
				break;
			case "available amount":
				if ($lang == "pt") { return "Quantidade desponível"; }
				if ($lang == "eng") { return "Available amount"; }
				break;
			case "quantity":
				if ($lang == "pt") { return "Quantidade"; }
				if ($lang == "eng") { return "Quantity"; }
				break;
			case "total price":
				if ($lang == "pt") { return "Preço total"; }
				if ($lang == "eng") { return "Total price"; }
				break;
			case "observation":
				if ($lang == "pt") { return "Observação"; }
				if ($lang == "eng") { return "Observation"; }
				break;
			case "submit":
				if ($lang == "pt") { return "Submeter"; }
				if ($lang == "eng") { return "Submit"; }
				break;
			case "products":
				if ($lang == "pt") { return "Productos"; }
				if ($lang == "eng") { return "Products"; }
				break;
			case "add customer":
				if ($lang == "pt") { return "Adicionar cliente"; }
				if ($lang == "eng") { return "Add customer"; }
				break;
			case "edit customer details":
				if ($lang == "pt") { return "Editar detalhes do cliente"; }
				if ($lang == "eng") { return "Edit customer details"; }
				break;
			case "add":
				if ($lang == "pt") { return "Adicionar"; }
				if ($lang == "eng") { return "Add"; }
				break;
			case "customer details":
				if ($lang == "pt") { return "Detalhes do cliente"; }
				if ($lang == "eng") { return "Customer details"; }
				break;
			case "add product":
				if ($lang == "pt") { return "Adicionar producto"; }
				if ($lang == "eng") { return "Add product"; }
				break;
			case "price of sell":
				if ($lang == "pt") { return "Preço de venda"; }
				if ($lang == "eng") { return "Price of sell"; }
				break;
			case "model":
				if ($lang == "pt") { return "Modelo"; }
				if ($lang == "eng") { return "Model"; }
				break;
			case "bar code":
				if ($lang == "pt") { return "Codigo de barra"; }
				if ($lang == "eng") { return "Bar code"; }
				break;
			case "purchase price":
				if ($lang == "pt") { return "Preço de compra"; }
				if ($lang == "eng") { return "Purchase price"; }
				break;
			case "purchase date":
				if ($lang == "pt") { return "Data de compra"; }
				if ($lang == "eng") { return "Purchase date"; }
				break;
			case "purchase details":
				if ($lang == "pt") { return "Detalhes da compra"; }
				if ($lang == "eng") { return "Purchase details"; }
				break;
			case "user added":
				if ($lang == "pt") { return "Usuário que adicionou"; }
				if ($lang == "eng") { return "User added"; }
				break;
			case "user modify":
				if ($lang == "pt") { return "Usuário que modificou"; }
				if ($lang == "eng") { return "User modify"; }
				break;
			case "date modify":
				if ($lang == "pt") { return "Data da ultima alteração"; }
				if ($lang == "eng") { return "Date modify"; }
				break;
			case "product details":
				if ($lang == "pt") { return "Detalhes do producto"; }
				if ($lang == "eng") { return "Product details"; }
				break;
			case "add purchase":
				if ($lang == "pt") { return "Adicionar compra"; }
				if ($lang == "eng") { return "Add purchase"; }
				break;
			case "new purchase":
				if ($lang == "pt") { return "Nova compra"; }
				if ($lang == "eng") { return "New purchase"; }
				break;
			case "edit purchase":
				if ($lang == "pt") { return "Editar compra"; }
				if ($lang == "eng") { return "Edit purchase"; }
				break;
			case "add supplier":
				if ($lang == "pt") { return "Adicionar fornecedor"; }
				if ($lang == "eng") { return "Add supplier"; }
				break;
			case "website":
				if ($lang == "pt") { return "Website"; }
				if ($lang == "eng") { return "Website"; }
				break;
			case "edit supplier details":
				if ($lang == "pt") { return "Editar detalhes do fornecedor"; }
				if ($lang == "eng") { return "Edit supplier details"; }
				break;
			case "supplier details":
				if ($lang == "pt") { return "Detalhes do fornecedor"; }
				if ($lang == "eng") { return "Supplier details"; }
				break;
			case "close":
				if ($lang == "pt") { return "Fechar"; }
				if ($lang == "eng") { return "Close"; }
				break;
			case "add category":
				if ($lang == "pt") { return "Adicionar categoria"; }
				if ($lang == "eng") { return "Add category"; }
				break;
			case "edit category":
				if ($lang == "pt") { return "Editar categoria"; }
				if ($lang == "eng") { return "Edit category"; }
				break;
			case "add warehouse":
				if ($lang == "pt") { return "Adicionar Armazém"; }
				if ($lang == "eng") { return "Add warehouse"; }
				break;
			case "edit warehouse details":
				if ($lang == "pt") { return "Editar detalhes do armazém"; }
				if ($lang == "eng") { return "Edit warehouse details"; }
				break;
			case "add mark":
				if ($lang == "pt") { return "Adicionar marca"; }
				if ($lang == "eng") { return "Add mark"; }
				break;
			case "edit mark details":
				if ($lang == "pt") { return "Editar detalhes da marca"; }
				if ($lang == "eng") { return "Edit mark details"; }
				break;
			case "mark details":
				if ($lang == "pt") { return "Detalhes da marca"; }
				if ($lang == "eng") { return "Mark details"; }
				break;
			case "edit profile":
				if ($lang == "pt") { return "Editar perfil"; }
				if ($lang == "eng") { return "Edit profile"; }
				break;
			case "picture":
				if ($lang == "pt") { return "Foto"; }
				if ($lang == "eng") { return "Picture"; }
				break;
			case "user profile":
				if ($lang == "pt") { return "Perfil do usuário"; }
				if ($lang == "eng") { return "User profile"; }
				break;
			case "change picture":
				if ($lang == "pt") { return "Alterar foto"; }
				if ($lang == "eng") { return "Change picture"; }
				break;
			case "edit user":
				if ($lang == "pt") { return "Editar usuário"; }
				if ($lang == "eng") { return "Edit user"; }
				break;
			case "general":
				if ($lang == "pt") { return "Geral"; }
				if ($lang == "eng") { return "General"; }
				break;
			case "language":
				if ($lang == "pt") { return "Linguagem"; }
				if ($lang == "eng") { return "Language"; }
				break;
			case "portuguese":
				if ($lang == "pt") { return "Português"; }
				if ($lang == "eng") { return "Portuguese"; }
				break;
			case "english":
				if ($lang == "pt") { return "Inglês"; }
				if ($lang == "eng") { return "English"; }
				break;
			case "account":
				if ($lang == "pt") { return "Conta"; }
				if ($lang == "eng") { return "Account"; }
				break;
			case "receipt":
				if ($lang == "pt") { return "Recibo"; }
				if ($lang == "eng") { return "Receipt"; }
				break;
			case "receipts":
				if ($lang == "pt") { return "Recibos"; }
				if ($lang == "eng") { return "Receipts"; }
				break;
			case "add receipt":
				if ($lang == "pt") { return "Adicionar recibo"; }
				if ($lang == "eng") { return "Add receipt"; }
				break;
			case "receipt number":
				if ($lang == "pt") { return "Número do recibo"; }
				if ($lang == "eng") { return "Receipt number"; }
				break;
			case "attached file":
				if ($lang == "pt") { return "Ficheiro anexado"; }
				if ($lang == "eng") { return "Attached file"; }
				break;
			case "download file":
				if ($lang == "pt") { return "Baixar ficheiro"; }
				if ($lang == "eng") { return "Download file"; }
				break;
			case "receipt details":
				if ($lang == "pt") { return "Detalhes do recibo"; }
				if ($lang == "eng") { return "Receipt details"; }
				break;
			case "file":
				if ($lang == "pt") { return "Ficheiro"; }
				if ($lang == "eng") { return "File"; }
				break;
			case "edit receipt":
				if ($lang == "pt") { return "Editar recibo"; }
				if ($lang == "eng") { return "Edit receipt"; }
				break;
			case "attached":
				if ($lang == "pt") { return "Anexo"; }
				if ($lang == "eng") { return "Attached"; }
				break;
			case "metrics of users":
				if ($lang == "pt") { return "Gráficos dos usuários"; }
				if ($lang == "eng") { return "Metrics of users"; }
				break;
			case "analysing users data":
				if ($lang == "pt") { return "Analizando dados dos usuários"; }
				if ($lang == "eng") { return "Analysing users data"; }
				break;
			case "taxes":
				if ($lang == "pt") { return "Taxas"; }
				if ($lang == "eng") { return "Taxes"; }
				break;
			case "taxes settings":
				if ($lang == "pt") { return "Configuração das taxas"; }
				if ($lang == "eng") { return "Taxes settings"; }
				break;
			case "edit product":
				if ($lang == "pt") { return "Editar producto"; }
				if ($lang == "eng") { return "Edit Product"; }
				break;
			case "selled amount":
				if ($lang == "pt") { return "Quantidade vendida"; }
				if ($lang == "eng") { return "Selled amount"; }
				break;
			case "zenbox finance software":
				if ($lang == "pt") { return "ZENBOX Software De Finanças"; }
				if ($lang == "eng") { return "ZENBOX Finance Software"; }
				break;
			case "view sales":
				if ($lang == "pt") { return "Ver vendas"; }
				if ($lang == "eng") { return "View sales"; }
				break;
			case "filter":
				if ($lang == "pt") { return "Filtrar"; }
				if ($lang == "eng") { return "Filter"; }
				break;
			case "advanced search":
				if ($lang == "pt") { return "Pesquisa avançada"; }
				if ($lang == "eng") { return "Advanced search"; }
				break;
			case "date start":
				if ($lang == "pt") { return "Data Início"; }
				if ($lang == "eng") { return "Date Start"; }
				break;
			case "date end":
				if ($lang == "pt") { return "Data Fim"; }
				if ($lang == "eng") { return "Date End"; }
				break;
			case "total invoiced":
				if ($lang == "pt") { return "Total facturado"; }
				if ($lang == "eng") { return "Total invoiced"; }
				break;
			case "paid":
				if ($lang == "pt") { return "Pago"; }
				if ($lang == "eng") { return "Paid"; }
				break;
			case "more":
				if ($lang == "pt") { return "Mais"; }
				if ($lang == "eng") { return "More"; }
				break;
			case "sale":
				if ($lang == "pt") { return "Venda"; }
				if ($lang == "eng") { return "Sale"; }
				break;
			case "status":
				if ($lang == "pt") { return "Estado"; }
				if ($lang == "eng") { return "Status"; }
				break;
			case "opened":
				if ($lang == "pt") { return "Aberto"; }
				if ($lang == "eng") { return "Opened"; }
				break;
			case "closed":
				if ($lang == "pt") { return "Fechado"; }
				if ($lang == "eng") { return "Closed"; }
				break;
			case "close cash":
				if ($lang == "pt") { return "Fechar caixa"; }
				if ($lang == "eng") { return "Close cash"; }
				break;
			case "merge funds":
				if ($lang == "pt") { return "Unir fundos"; }
				if ($lang == "eng") { return "Merge funds"; }
				break;
			case "cash flow":
				if ($lang == "pt") { return "Fluxo de caixa"; }
				if ($lang == "eng") { return "Cash flow"; }
				break;
			case "inputs":
				if ($lang == "pt") { return "Entradas"; }
				if ($lang == "eng") { return "Inputs"; }
				break;
			case "outputs":
				if ($lang == "pt") { return "Saídas"; }
				if ($lang == "eng") { return "Outputs"; }
				break;
			case "others":
				if ($lang == "pt") { return "Outros"; }
				if ($lang == "eng") { return "Others"; }
				break;
			case "documents":
				if ($lang == "pt") { return "Documentos"; }
				if ($lang == "eng") { return "Documents"; }
				break;
			case "documents":
				if ($lang == "pt") { return "Documentos"; }
				if ($lang == "eng") { return "Documents"; }
				break;
			case "add document":
				if ($lang == "pt") { return "Adicionar Documento"; }
				if ($lang == "eng") { return "Add Document"; }
				break;
			case "user":
				if ($lang == "pt") { return "Usuário"; }
				if ($lang == "eng") { return "User"; }
				break;
			case "users":
				if ($lang == "pt") { return "Usuários"; }
				if ($lang == "eng") { return "Users"; }
				break;
			case "lengthmenu":
				if ($lang == "pt") { return "Mostrar _MENU_ registros por página"; }
				if ($lang == "eng") { return "Showing _MENU_ entries"; }
				break;
			case "zerorecords":
				if ($lang == "pt") { return "Nenhum registo encontrado"; }
				if ($lang == "eng") { return "Nothing found"; }
				break;
			case "infoempty":
				if ($lang == "pt") { return "Sem registros disponíveis"; }
				if ($lang == "eng") { return "No records available"; }
				break;
			case "infofiltered":
				if ($lang == "pt") { return "filtrado de _MAX_ registros totais"; }
				if ($lang == "eng") { return "filtered _MAX_ entries"; }
				break;
			case "loadingrecords":
				if ($lang == "pt") { return "Carregando..."; }
				if ($lang == "eng") { return "Loading..."; }
				break;
			case "processing":
				if ($lang == "pt") { return "Processando..."; }
				if ($lang == "eng") { return "Processing..."; }
				break;
			case "search":
				if ($lang == "pt") { return "Pesquisar"; }
				if ($lang == "eng") { return "Search"; }
				break;
			case "first":
				if ($lang == "pt") { return "Primeiro"; }
				if ($lang == "eng") { return "First"; }
				break;
			case "last":
				if ($lang == "pt") { return "Último"; }
				if ($lang == "eng") { return "Last"; }
				break;
			case "next":
				if ($lang == "pt") { return "Próximo"; }
				if ($lang == "eng") { return "Next"; }
				break;
			case "previous":
				if ($lang == "pt") { return "Anterior"; }
				if ($lang == "eng") { return "Previous"; }
				break;
			case "info":
				if ($lang == "pt") { return "Mostrando página _PAGE_ de _PAGES_ páginas"; }
				if ($lang == "eng") { return "Showing page _PAGE_ of _PAGES_"; }
				break;
			case "please fill this field":
				if ($lang == "pt") { return "Por favor preencha este campo!"; }
				if ($lang == "eng") { return "Please fill this field"; }
				break;
			case "different passwords":
				if ($lang == "pt") { return "As passwords são diferentes"; }
				if ($lang == "eng") { return "Different passwords"; }
				break;
			case "error":
				if ($lang == "pt") { return "Erro"; }
				if ($lang == "eng") { return "Error"; }
				break;
			case "success":
				if ($lang == "pt") { return "Sucesso"; }
				if ($lang == "eng") { return "Success"; }
				break;
			case "added successfuly":
				if ($lang == "pt") { return "Adicionado com sucesso"; }
				if ($lang == "eng") { return "Added successfuly"; }
				break;
			case "updated successfuly":
				if ($lang == "pt") { return "Actualizado com sucesso"; }
				if ($lang == "eng") { return "Updated successfuly"; }
				break;
			case "session expired":
				if ($lang == "pt") { return "Sessão expirada"; }
				if ($lang == "eng") { return "Session Expired"; }
				break;
			case "passwords do not match":
				if ($lang == "pt") { return "Passwords differentes"; }
				if ($lang == "eng") { return "Passwords do not match"; }
				break;
			case "avatar":
				if ($lang == "pt") { return "Avatar"; }
				if ($lang == "eng") { return "Avatar"; }
				break;
			case "authentication error":
				if ($lang == "pt") { return "Falha na autenticação"; }
				if ($lang == "eng") { return "Authentication error"; }
				break;
			case "e-mail or password incorrect":
				if ($lang == "pt") { return "E-mail ou password incorrecto"; }
				if ($lang == "eng") { return "E-mail or password incorrect"; }
				break;
			case "this account is disactivated! please contact system administrator":
				if ($lang == "pt") { return "Esta conta está desactiva! Porfavor contacte o administrador"; }
				if ($lang == "eng") { return "This account is disactivated! please contact system administrator"; }
				break;
			case "password incorrect":
				if ($lang == "pt") { return "Password incorrecta"; }
				if ($lang == "eng") { return "Password incorrect"; }
				break;
			case "authentication success":
				if ($lang == "pt") { return "Autenticação bem sucedida!"; }
				if ($lang == "eng") { return "Authentication success"; }
				break;
			case "edit profile picture":
				if ($lang == "pt") { return "Alterar foto de perfil"; }
				if ($lang == "eng") { return "Edit profile picture"; }
				break;
			case "image format not allowed":
				if ($lang == "pt") { return "Formato não permitido"; }
				if ($lang == "eng") { return "image format not allowed"; }
				break;
			case "failed to send request":
				if ($lang == "pt") { return "Falha ao enviar pedido"; }
				if ($lang == "eng") { return "Failed to send request"; }
				break;
			case "drag and drop the image here or":
				if ($lang == "pt") { return "Arraste e deixe a imagem aqui ou"; }
				if ($lang == "eng") { return "Drag and drop the image here or"; }
				break;
			case "select one":
				if ($lang == "pt") { return "Selecione uma"; }
				if ($lang == "eng") { return "Select one"; }
				break;
			case "yes":
				if ($lang == "pt") { return "Sim"; }
				if ($lang == "eng") { return "Yes"; }
				break;
			case "do you wish to delete this item":
				if ($lang == "pt") { return "Deseja apagar este item"; }
				if ($lang == "eng") { return "Do you wish to delete this item"; }
				break;
			case "inserted value must be a number":
				if ($lang == "pt") { return "Valor inserido deve ser um número"; }
				if ($lang == "eng") { return "Inserted value must be a number"; }
				break;
			case "minimum value is 1":
				if ($lang == "pt") { return "Valor minimo é 1"; }
				if ($lang == "eng") { return "Minimum value is 1"; }
				break;
			case "server error":
				if ($lang == "pt") { return "Error do servidor"; }
				if ($lang == "eng") { return "Server error"; }
				break;
			case "session time":
				if ($lang == "pt") { return "Tempo de sessão"; }
				if ($lang == "eng") { return "Session time"; }
				break;
			case "session will end in":
				if ($lang == "pt") { return "A sessão terminará em"; }
				if ($lang == "eng") { return "Session will end in"; }
				break;
			case "seconds":
				if ($lang == "pt") { return "Segundos"; }
				if ($lang == "eng") { return "Seconds"; }
				break;
			case "payment information":
				if ($lang == "pt") { return "Informação de pagamento"; }
				if ($lang == "eng") { return "Payment information"; }
				break;
			case "stock available":
				if ($lang == "pt") { return "Estoque desponível"; }
				if ($lang == "eng") { return "Stock available"; }
				break;
			case "price of sale":
				if ($lang == "pt") { return "Preço de venda"; }
				if ($lang == "eng") { return "Price of sale"; }
				break;
			case "total (vat included)":
				if ($lang == "pt") { return "Total (IVA incluído)"; }
				if ($lang == "eng") { return "Total (VAT included)"; }
				break;
			case "vat":
				if ($lang == "pt") { return "IVA"; }
				if ($lang == "eng") { return "VAT"; }
				break;
			case "price per unity":
				if ($lang == "pt") { return "Preço por unidade"; }
				if ($lang == "eng") { return "Price per unity"; }
				break;
			case "item":
				if ($lang == "pt") { return "Item"; }
				if ($lang == "eng") { return "Item"; }
				break;
			case "search":
				if ($lang == "pt") { return "Pesquisar"; }
				if ($lang == "eng") { return "Search"; }
				break;
			case "qty":
				if ($lang == "pt") { return "Quant"; }
				if ($lang == "eng") { return "QTY"; }
				break;
			case "price":
				if ($lang == "pt") { return "preço"; }
				if ($lang == "eng") { return "Price"; }
				break;
			case "item with inserted name already exists":
				if ($lang == "pt") { return "Item com o nome inserido já existe"; }
				if ($lang == "eng") { return "Item with inserted name already exists"; }
				break;
			case "item with inserted name alreay exists":
				if ($lang == "pt") { return "Item com o nome inserido já existe"; }
				if ($lang == "eng") { return "Item with inserted name already exists"; }
				break;
			case "item already exists":
				if ($lang == "pt") { return "Item already exists"; }
				if ($lang == "eng") { return "Item já existe"; }
				break;
			case "item alreay exists":
				if ($lang == "pt") { return "Item already exists"; }
				if ($lang == "eng") { return "Item já existe"; }
				break;
			case "prices":
				if ($lang == "pt") { return "Preços"; }
				if ($lang == "eng") { return "Prices"; }
				break;
			case "no price":
				if ($lang == "pt") { return "Sem preço"; }
				if ($lang == "eng") { return "No price"; }
				break;
			case "price list":
				if ($lang == "pt") { return "Lista de preços"; }
				if ($lang == "eng") { return "Price list"; }
				break;
			case "add price":
				if ($lang == "pt") { return "Adicionar preço"; }
				if ($lang == "eng") { return "Add price"; }
				break;
			case "profit":
				if ($lang == "pt") { return "Lucro"; }
				if ($lang == "eng") { return "Profit"; }
				break;
			case "default price":
				if ($lang == "pt") { return "Preço padrão"; }
				if ($lang == "eng") { return "Default Price"; }
				break;
			case "you cannot delete the default price":
				if ($lang == "pt") { return "Não pode remover o preço padrão"; }
				if ($lang == "eng") { return "You cannot delete the default price"; }
				break;
			case "edit price":
				if ($lang == "pt") { return "Editar preço"; }
				if ($lang == "eng") { return "Edit price"; }
				break;
			case "add stock":
				if ($lang == "pt") { return "Adicionar estoque"; }
				if ($lang == "eng") { return "Add stock"; }
				break;
			case "edit stock":
				if ($lang == "pt") { return "Editar estoque"; }
				if ($lang == "eng") { return "Edit stock"; }
				break;
			case "itens":
				if ($lang == "pt") { return "Itens"; }
				if ($lang == "eng") { return "Itens"; }
				break;
			case "order":
				if ($lang == "pt") { return "Ordem"; }
				if ($lang == "eng") { return "Order"; }
				break;
			case "sale order":
				if ($lang == "pt") { return "Ordem de venda"; }
				if ($lang == "eng") { return "Sale order"; }
				break;
			case "purchase order":
				if ($lang == "pt") { return "Ordem de compra"; }
				if ($lang == "eng") { return "Purchase order"; }
				break;
			case "available stock":
				if ($lang == "pt") { return "Estoque disponivel"; }
				if ($lang == "eng") { return "Available stock"; }
				break;
			case "change logo":
				if ($lang == "pt") { return "Alterar logotipo"; }
				if ($lang == "eng") { return "Change logo"; }
				break;
			case "service":
				if ($lang == "pt") { return "Serviço"; }
				if ($lang == "eng") { return "Service"; }
				break;
			case "stock type":
				if ($lang == "pt") { return "Tipo de estoque"; }
				if ($lang == "eng") { return "Stock type"; }
				break;
			case "generate invoice":
				if ($lang == "pt") { return "Gerar Fatura"; }
				if ($lang == "eng") { return "Generate Invoice"; }
				break;
			case "do you wish to generate invoice for this sale":
				if ($lang == "pt") { return "Deseja gerar fatura para esta venda"; }
				if ($lang == "eng") { return "Do you wish to generate invoice for this sale"; }
				break;
			case "confirm to generate invoice":
				if ($lang == "pt") { return "Confirme para gerar a fatura"; }
				if ($lang == "eng") { return "Confirm to generate invoice"; }
				break;
			case "invoice date":
				if ($lang == "pt") { return "Data da fatura"; }
				if ($lang == "eng") { return "Invoice date"; }
				break;
			case "invoice due date":
				if ($lang == "pt") { return "Data vencimento"; }
				if ($lang == "eng") { return "invoice due date"; }
				break;
			case "confirm":
				if ($lang == "pt") { return "Confirmar"; }
				if ($lang == "eng") { return "Confirm"; }
				break;
			case "print invoice":
				if ($lang == "pt") { return "Imprimir fatura"; }
				if ($lang == "eng") { return "Print invoice"; }
				break;
			case "print proforma":
				if ($lang == "pt") { return "Imprimir proforma"; }
				if ($lang == "eng") { return "Print proforma"; }
				break;
			case "generate proforma":
				if ($lang == "pt") { return "Gerar proforma"; }
				if ($lang == "eng") { return "Generate proforma"; }
				break;
			case "do you wish to generate proforma for this sale":
				if ($lang == "pt") { return "Deseja gerar fatura proforma para esta venda"; }
				if ($lang == "eng") { return "Do you wish to generate proforma for this sale"; }
				break;
			case "confirm to generate proforma":
				if ($lang == "pt") { return "Confirme para gerar a fatura proforma"; }
				if ($lang == "eng") { return "Confirm to generate proforma"; }
				break;
			case "proforma date":
				if ($lang == "pt") { return "Data da fatura proforma"; }
				if ($lang == "eng") { return "Proforma date"; }
				break;
			case "proforma due date":
				if ($lang == "pt") { return "Data vencimento"; }
				if ($lang == "eng") { return "Proforma due date"; }
				break;
			case "price/unit":
				if ($lang == "pt") { return "Preço/Unid"; }
				if ($lang == "eng") { return "Price/Unit"; }
				break;
			case "phone":
				if ($lang == "pt") { return "Telefone"; }
				if ($lang == "eng") { return "Phone"; }
				break;
			case "contact 1":
				if ($lang == "pt") { return "Contacto 1"; }
				if ($lang == "eng") { return "Contact 1"; }
				break;
			case "contact 2":
				if ($lang == "pt") { return "Contacto 2"; }
				if ($lang == "eng") { return "Contact 2"; }
				break;
			case "e-mail":
				if ($lang == "pt") { return "E-mail"; }
				if ($lang == "eng") { return "E-mail"; }
				break;
			case "invoiced to":
				if ($lang == "pt") { return "Faturado a"; }
				if ($lang == "eng") { return "Invoiced to"; }
				break;
			case "proforma":
				if ($lang == "pt") { return "Proforma"; }
				if ($lang == "eng") { return "Proforma"; }
				break;
			case "subtotal (- discount)":
				if ($lang == "pt") { return "Subtotal (- Disconto)"; }
				if ($lang == "eng") { return "Subtotal (- discount)"; }
				break;
			case "processed by computer":
				if ($lang == "pt") { return "Processado por computador"; }
				if ($lang == "eng") { return "Processed by computer"; }
				break;
			case "printed at":
				if ($lang == "pt") { return "Imprimido aos"; }
				if ($lang == "eng") { return "Printed at"; }
				break;
			case "invoice":
				if ($lang == "pt") { return "Fatura"; }
				if ($lang == "eng") { return "Invoice"; }
				break;
			case "proformas":
				if ($lang == "pt") { return "Proformas"; }
				if ($lang == "eng") { return "Proformas"; }
				break;
			case "invoices":
				if ($lang == "pt") { return "Faturas"; }
				if ($lang == "eng") { return "Invoices"; }
				break;
			case "document number":
				if ($lang == "pt") { return "Número do documento"; }
				if ($lang == "eng") { return "Document number"; }
				break;
			case "attachment":
				if ($lang == "pt") { return "Anexo"; }
				if ($lang == "eng") { return "Attachment"; }
				break;
			case "invalid request":
				if ($lang == "pt") { return "Pedido inválido"; }
				if ($lang == "eng") { return "Invalid request"; }
				break;
			case "total spent":
				if ($lang == "pt") { return "Total gasto"; }
				if ($lang == "eng") { return "Total spent"; }
				break;
			case "submit to stock":
				if ($lang == "pt") { return "Submeter ao estoque"; }
				if ($lang == "eng") { return "Submit to stock"; }
				break;
			case "do you wish to submit to stock":
				if ($lang == "pt") { return "Deseja submeter ao estoque"; }
				if ($lang == "eng") { return "Do you wish to submit to stock"; }
				break;
			case "you will not be able to revert this action":
				if ($lang == "pt") { return "Não poderá reverter esta acção"; }
				if ($lang == "eng") { return "You will not be able to revert this action"; }
				break;
			case "create receipt":
				if ($lang == "pt") { return "Criar recibo"; }
				if ($lang == "eng") { return "Create receipt"; }
				break;
			case "print receipt":
				if ($lang == "pt") { return "Imprimir recibo"; }
				if ($lang == "eng") { return "Print Receipt"; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			case "":
				if ($lang == "pt") { return ""; }
				if ($lang == "eng") { return ""; }
				break;
			default:
				# code...
				break;
		}
	}
}