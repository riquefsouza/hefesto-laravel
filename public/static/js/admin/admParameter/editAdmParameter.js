class EditAdmParameter extends HFSSystemUtil {
	constructor()
	{
		super();

		this.hideQueryString();

		this._page = $('#admParameterView');
	}

	btnCancelClick(sUrl) {
		window.location.replace(sUrl);
	}

}

const editAdmParameter = new EditAdmParameter();

$(function() {
	//const editAdmParameter = new EditAdmParameter();

	//$('#btnCancel').click(editAdmParameter.btnCancelClick.bind(editAdmParameter));

});
