class EditAdmMenu extends HFSSystemUtil {
	constructor()
	{
		super();

		this.hideQueryString();

		this._page = $('#admMenuView');
	}

	btnCancelClick(sUrl) {
		window.location.replace(sUrl);
	}

}

const editAdmMenu = new EditAdmMenu();

$(function() {
	//const editAdmMenu = new EditAdmMenu();

	//$('#btnCancel').click(editAdmMenu.btnCancelClick.bind(editAdmMenu));

});
