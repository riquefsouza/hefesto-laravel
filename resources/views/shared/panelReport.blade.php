<div class="col-md-3 form-group">
    <label for="cmbReportType">{{ $messages["panelReport.cmbReportType"] }}</label>
    <select class="form-select" id="cmbReportType">
        @foreach ($listReportType as $group)
            <optgroup label="{{ $group->getGroup() }}">
                @foreach ($group->getTypes() as $option)
                    <option value="{{ $option->getType() }}">{{ $option->getDescription() }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>
<div class="col-md-3 form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="forceDownload">
        <label class="form-check-label" for="forceDownload">
            &nbsp;{{ $messages["panelReport.forceDownload"] }}
        </label>
    </div>
</div>
