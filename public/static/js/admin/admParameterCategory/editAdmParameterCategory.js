class EditAdmParameterCategory extends HFSSystemUtil {
	constructor()
	{
		super();

		this.hideQueryString();

		this._page = $('#admParameterCategoryView');
	}

	btnCancelClick(sUrl) {
		window.location.replace(sUrl);
	}

}

const editAdmParameterCategory = new EditAdmParameterCategory();

$(function() {
	//const editAdmParameterCategory = new EditAdmParameterCategory();

	//$('#btnCancel').click(editAdmParameterCategory.btnCancelClick.bind(editAdmParameterCategory));

});
