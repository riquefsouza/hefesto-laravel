<?php

namespace App\Base\Report;

class ReportType
{
    private int $type;

    private string $group;

    private string $contentType;

    private string $description;

    private string $fileExtension;

    public function __construct(int $type, string $group,
        string $contentType, string $description, string $fileExtension)
    {
        $this->type = $type;
        $this->group = $group;
        $this->contentType = $contentType;
        $this->description = $description;
        $this->fileExtension = $fileExtension;
    }

    /**
     * @return string[]|null
     */
    public static function groups()
    {
        return array("Documentos", "Planilhas", "Texto puro", "Outros");
    }

    /**
     * @return ReportType[]|null
     */
    public static function allTypes()
    {
        $rt = array();

        array_push($rt, new ReportType(ReportTypeEnum::PDF, "Documentos", "application/pdf", "Portable Document Format (.pdf)", "pdf"));
        array_push($rt, new ReportType(ReportTypeEnum::DOCX, "Documentos", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "Microsoft Word XML (.docx)", "docx"));
        array_push($rt, new ReportType(ReportTypeEnum::RTF, "Documentos", "application/rtf", "Rich Text Format (.rtf)", "rtf"));
        array_push($rt, new ReportType(ReportTypeEnum::ODT, "Documentos", "application/vnd.oasis.opendocument.text", "OpenDocument Text (.odt)", "odt"));
        //array_push($rt, new ReportType(ReportTypeEnum::XLS, "Planilhas", "application/vnd.ms-excel", "Microsoft Excel (.xls)"));
        array_push($rt, new ReportType(ReportTypeEnum::XLSX, "Planilhas", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "Microsoft Excel XML (.xlsx)", "xlsx"));
        array_push($rt, new ReportType(ReportTypeEnum::ODS, "Planilhas", "application/vnd.oasis.opendocument.spreadsheet", "OpenDocument Spreadsheet (.ods)", "ods"));
        array_push($rt, new ReportType(ReportTypeEnum::CSV, "Texto puro", "text/plain", "Valores Separados Por Vírgula (.csv)", "csv"));
        array_push($rt, new ReportType(ReportTypeEnum::TXT, "Texto puro", "text/plain", "Somente Texto (.txt)", "txt"));
        array_push($rt, new ReportType(ReportTypeEnum::PPTX, "Outros", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "Microsoft Powerpoint XML (.pptx)", "pptx"));
        //array_push($rt, new ReportType(ReportTypeEnum::HTML, "Outros", "text/html", "Linguagem de Marcação de Hipertexto (.html)"));
        array_push($rt, new ReportType(ReportTypeEnum::HTML, "Outros", "application/zip", "Linguagem de Marcação de Hipertexto (.html)", "html"));

        return $rt;
    }

    /**
     * @return ReportType
     */
    public static function getReportType(int $type): ReportType
    {
        $rt = ReportType::allTypes();

        foreach ($rt as $item) {
            if ($item->getType() === $type){
                return $item;
            }
        }
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $value): void
    {
        $this->type = $value;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $value): void
    {
        $this->group = $value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $value): void
    {
        $this->description = $value;
    }

    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    public function setFileExtension(string $value): void
    {
        $this->fileExtension = $value;
    }

}
