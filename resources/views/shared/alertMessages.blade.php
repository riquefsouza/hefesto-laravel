<span id="message-select-table" style="display: none">{{ $messages["message.select.table"] }}</span>

<span id="message-alert-success" style="display: none">{{ $messages["alert.success"] }}</span>
<span id="message-alert-danger" style="display: none">{{ $messages["alert.danger"] }}</span>
<span id="message-alert-warning" style="display: none">{{ $messages["alert.warning"] }}</span>
<span id="message-alert-info" style="display: none">{{ $messages["alert.info"] }}</span>

<span id="message-button-yes" style="display: none">{{ $messages["button.yes"] }}</span>
<span id="message-button-no" style="display: none">{{ $messages["button.no"] }}</span>
<span id="validator-emptyStringValidator" style="display: none">{{ $messages["validator.EmptyStringValidator"] }}</span>


<div class="alert alert-primary alert-dismissible fade show" id="alert-primary" style="display: none" role="alert">
    <strong><span id="text-alert-primary"></span></strong>
    <button id="btnAlertPrimary" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-secondary alert-dismissible fade show" id="alert-secondary" style="display: none" role="alert">
    <strong><span id="text-alert-secondary"></span></strong>
    <button id="btnAlertSecondary" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-success alert-dismissible fade show" id="alert-success" style="display: none" role="alert">
    <strong><span id="text-alert-success"></span></strong>
    <button id="btnAlertSuccess" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-danger alert-dismissible fade show" id="alert-danger" style="display: none" role="alert">
    <strong><span id="text-alert-danger"></span></strong>
    <button id="btnAlertDanger" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-warning alert-dismissible fade show" id="alert-warning" style="display: none" role="alert">
    <strong><span id="text-alert-warning"></span></strong>
    <button id="btnAlertWarning" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-info alert-dismissible fade show" id="alert-info" style="display: none" role="alert">
    <strong><span id="text-alert-info"></span></strong>
    <button id="btnAlertInfo" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-light alert-dismissible fade show" id="alert-light" style="display: none" role="alert">
    <strong><span id="text-alert-light"></span></strong>
    <button id="btnAlertLight" type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="alert alert-dark alert-dismissible fade show" id="alert-dark" style="display: none" role="alert">
    <strong><span id="text-alert-dark"></span></strong>
    <button id="btnAlertDark" type="button" class="btn-close" aria-label="Close"></button>
</div>

@if (strlen(trim($alertMessage->PrimaryMessage)) > 0)
{
<div class="alert alert-primary alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->PrimaryMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->SecondaryMessage)) > 0)
{
<div class="alert alert-secondary alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->SecondaryMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->SuccessMessage)) > 0)
{
<div class="alert alert-success alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->SuccessMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->DangerMessage)) > 0)
{
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->DangerMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->WarningMessage)) > 0)
{
<div class="alert alert-warning alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->WarningMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->InfoMessage)) > 0)
{
<div class="alert alert-info alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->InfoMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->LightMessage)) > 0)
{
<div class="alert alert-light alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->LightMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}

@if (strlen(trim($alertMessage->DarkMessage)) > 0)
{
<div class="alert alert-dark alert-dismissible" role="alert">
    <strong><span>{{ $alertMessage->DarkMessage }}</span></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
}


<div class="modal fade" id="dlgAlertMessage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span>{{ $messages["dlgAlertMessage.title"] }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><span id="dlgAlertMessage-text">{{ $messages["dlgAlertMessage.text"] }}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
