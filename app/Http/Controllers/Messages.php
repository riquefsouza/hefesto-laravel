<?php

namespace App\Http\Controllers;

abstract class Messages
{
public const MESSAGES = [

    'lang.change' => 'Alterar o idioma',
    'lang.en_US' => 'Inglês',
    'lang.pt_BR' => 'Português',

    'main.framework' => 'Hefesto',
    'main.app.title' => 'System',
    'main.app.welcome' => 'Bem-vindo ao Hefesto System.',
    'main.no.record' => 'Nenhum registro encontrado.',

    'validator.EmptyStringValidator' => 'O campo não pode estar vazio!',

    'message.select.table' => 'Por favor, selecione um registro da tabela para fazer esta ação!',

    'alert.success' => 'Sucesso',
    'alert.danger' => 'Perigo',
    'alert.warning' => 'Aviso',
    'alert.info' => 'Informação',

    'button.yes' => 'Sim',
    'button.no' => 'Não',
    'button.export' => 'Exportar',
    'button.add' => 'Adicionar',
    'button.edit' => 'Editar',
    'button.delete' => 'Excluir',
    'button.back' => 'Voltar',
    'button.save' => 'Salvar',
    'button.reset' => 'Limpar',
    'button.cancel' => 'Cancelar',
    'button.send' => 'Enviar',

    'reportTypeGroups.docs' => 'Documentos',
    'reportTypeGroups.sheets' => 'Planilhas',
    'reportTypeGroups.text' => 'Texto puro',
    'reportTypeGroups.others' => 'Outros',
    'dlgAlertMessage.text' => 'Alerta!',

    'dlgAlertMessage.title' => 'Alerta',
    'dlgDeleteConfirmation.text' => 'Confirma exclusão?',
    'dlgDeleteConfirmation.title' => 'Confirmação',

    'login.wrongUser' => 'Usuário ou senha errada!',
    'login.title' => 'Autentique-se',
    'login.username' => 'Usuário:',
    'login.username.placeholder' => 'Informe seu nome de usuário ',
    'login.password' => 'Senha:',
    'login.password.placeholder' => 'Informe sua senha',
    'login.rememberme' => 'Lembre de mim:',
    'login.button' => 'Entrar',
    'login.forgotPassword' => 'Esqueceu a senha?',
    'login.becomeMember' => 'Cadastrar-se',

    'forgotPassword.sendMail' => 'Email enviado!',
    'forgotPassword.noSendMail' => 'Email não enviado!',
    'forgotPassword.textMail' => 'ATENÇÃO: Esta é uma notificação enviada pelo sistema e não deve ser respondida.',

    'dlgBecomeMember.title' => 'Seja bem vindo!',
    'dlgBecomeMember.email' => 'E-mail:',
    'dlgBecomeMember.okSave' => 'Bem vindo novo membro!',
    'dlgBecomeMember.noSave' => 'Usuário não salvo!',
    'dlgBecomeMember.noRole' => 'Papel não existe!',

    'changePassword.title' => 'Alterar Senha ',
    'changePassword.currentPassword' => 'Senha atual:',
    'changePassword.newPassword' => 'Nova senha:',
    'changePassword.confirmNewPassword' => 'Confirme nova senha:',
    'changePassword.dlgChangePassword' => 'Confirma Alterar Senha?',
    'dlgChangePassword.title' => 'Confirmação',

    'changePasswordView.validation' => 'Por favor, preencha todos os campos!',
    'changePasswordView.notEqual' => 'Senha nova e confirma senha não conferem!',
    'changePasswordView.currentPwdNotEqual' => 'Senha atual não confere.',
    'changePasswordView.checkFields' => 'Verifique os campos!',
    'changePasswordView.passwordChanged' => 'Senha alterada!',
    'changePasswordView.validatePassword' => 'A senha atual não atende aos critérios de segurança.',

    'menu.sessionExpires' => 'Session expires:',
    'menu.administrative' => 'Administrativo',
    'menu.roles' => 'Papéis',
    'menu.users' => 'Usuários',
    'menu.settings' => 'Definições',
    'menu.changePassword' => 'Alterar Senha',
    'menu.about' => 'Sobre',
    'menu.exit' => 'Sair',
    'menu.admParameterCategory' => 'Categoria dos Parâmetros de Configuração',
    'menu.admParameter' => 'Parâmetros de Configuração',
    'menu.admPage' => 'Administrar Página',
    'menu.admMenu' => 'Administrar Menu',
    'menu.admProfile' => 'Administrar Perfil',
    'menu.admUser' => 'Visualizar os Usuários',

    'infoUser.title' => 'Informação do usuário',
    'infoUser.email' => 'E-mail:',
    'infoUser.roles' => 'Papéis:',

    'accessDenied.title' => 'Acesso negado',
    'accessDenied.text' => 'Desculpe, você não tem permissão para visualizar esta página.',
    'accessDenied.backHome' => 'Clique aqui para voltar para a página inicial.',

    'sessionExpired.title' => 'Sessão expirada',
    'sessionExpired.text' => 'Sessão expirada devido a inatividade.',
    'sessionExpired.backLogin' => 'Retornar para a tela de login',

    'sessionTimeOut.title' => 'Aviso de tempo da sessão.',
    'sessionTimeOut.expire' => 'Sua sessão expirará em',
    'sessionTimeOut.seconds' => 'segundos.',
    'sessionTimeOut.stay' => 'Permanecer logado',
    'sessionTimeOut.leave' => 'Sair',

    'error.title' => 'Página de erro',
    'error.backHome' => 'Voltar para a página inicial',

    'error403.title' => 'Página de erro',
    'error403.text' => 'PROIBIDO',
    'error403.backHome' => 'Voltar para a página inicial',

    'about.title' => 'Sobre',
    'about.developedBy' => 'Desenvolvido por',
    'about.version' => 'versão',
    'about.rights' => 'Todos os direitos reservados para',

    'panelReport.cmbReportType' => 'Escolha o tipo de relatório:',
    'panelReport.forceDownload' => 'Forçar download',

    'listAutRole.title' => 'Papéis',
    'editAutRole.title' => 'Papél',
    'editAutRole.name' => 'Nome:',

    'listAutUser.title' => 'Usuários',
    'editAutUser.title' => 'Usuário',
    'editAutUser.name' => 'Nome:',
    'editAutUser.email' => 'E-mail:',
    'editAutUser.urlPhoto' => 'urlPhoto:',
    'editAutUser.pickListRoles' => 'Papéis do Usuário:',
    'editAutUser.sourceCaptionRoles' => 'Disponíveis',
    'editAutUser.targetCaptionRoles' => 'Selecionados',

    'listAdmParameterCategory.title' => 'Categoria dos Parâmetros de Configuração',
    'editAdmParameterCategory.title' => 'Categoria dos Parâmetros de Configuração',
    'editAdmParameterCategory.description' => 'Descrição:',
    'editAdmParameterCategory.order' => 'Ordem:',

    'listAdmParameter.title' => 'Parâmetros de Configuração',
    'editAdmParameter.title' => 'Parâmetros de Configuração',
    'editAdmParameter.category' => 'Parâmetros de Configuração',
    'editAdmParameter.code' => 'Código:',
    'editAdmParameter.description' => 'Descrição:',
    'editAdmParameter.value' => 'Valor:',

    'listAdmMenu.title' => 'Administrar Menu',
    'editAdmMenu.title' => 'Administrar Menu',
    'editAdmMenu.page' => 'Página:',
    'editAdmMenu.description' => 'Nome do item de menu:',
    'editAdmMenu.menuParent' => 'Menu pai:',
    'editAdmMenu.order' => 'Ordem:',

    'listAdmPage.title' => 'Administrar Página',
    'editAdmPage.title' => 'Administrar Página',
    'editAdmPage.url' => 'Página:',
    'editAdmPage.description' => 'Descrição:',
    'editAdmPage.pickListProfiles' => 'Perfil(s) da Página:',
    'editAdmPage.sourceCaptionProfiles' => 'Disponíveis',
    'editAdmPage.targetCaptionProfiles' => 'Selecionados',

    'listAdmProfile.title' => 'Administrar Perfil',
    'editAdmProfile.title' => 'Administrar Perfil',
    'editAdmProfile.description' => 'Descrição:',
    'editAdmProfile.sourceCaptionUsers' => 'Disponíveis',
    'editAdmProfile.targetCaptionUsers' => 'Selecionados',
    'editAdmProfile.sourceCaptionPages' => 'Disponíveis',
    'editAdmProfile.targetCaptionPages' => 'Selecionados',
    'editAdmProfile.pickListUsers' => 'Usuário(s) do Perfil:',
    'editAdmProfile.pickListPages' => 'Página(s) do Perfil:',

    'listAdmUser.title' => 'Usuários',
    'editAdmUser.title' => 'Usuário',
    'editAdmUser.login' => 'Login:',
    'editAdmUser.name' => 'Nome:',
    'editAdmUser.email' => 'E-mail:',
    'editAdmUser.active' => 'Ativo',
    'listVwAdmLog.title' => 'Log de Auditoria',
    'editVwAdmLog.title' => 'Log de Auditoria',
    'editVwAdmLog.name' => 'Nome:'

];
}
