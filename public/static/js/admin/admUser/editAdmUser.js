class EditAdmUser extends HFSSystemUtil {
	constructor()
	{
		super();

		this.hideQueryString();

		this._page = $('#admUserView');
	}

	btnCancelClick(sUrl) {
		window.location.replace(sUrl);
	}

}

const editAdmUser = new EditAdmUser();

$(function() {
	//const editAdmUser = new EditAdmUser();

	//$('#btnCancel').click(editAdmUser.btnCancelClick.bind(editAdmUser));

});
