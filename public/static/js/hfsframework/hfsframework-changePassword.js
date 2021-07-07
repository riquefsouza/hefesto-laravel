class HFSChangePassword extends HFSSystemUtil {
	constructor()
	{
		super();

		this._anchorHomePage = $('#anchorHomePage');

	}

	btnCancelClick(sUrl) {
		window.location.replace(sUrl);
	}

}

const hfsChangePassword = new HFSChangePassword();

$(function() {
	//const hfsChangePassword = new HFSChangePassword();

	//$('#btnCancel').click(hfsChangePassword.btnCancelClick.bind(hfsChangePassword));

});
