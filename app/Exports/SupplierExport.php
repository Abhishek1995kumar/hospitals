<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection; // Added missing interface
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Illuminate\Support\Collection;

class SupplierExport implements FromCollection, WithStrictNullComparison, WithEvents, WithHeadings, ShouldAutoSize 
{
    protected $columns, $rows, $alphabetsArray, 
              $hospitalIndex, $hospitalOption, 
              $firmIndex, $firmOption, 
              $partyTypeIndex, $partyTypeOption;

    public function __construct($columnName, $supplierSheetRow, $data) {
        $this->columns = $columnName;
        $this->rows = $supplierSheetRow;
        
        $this->hospitalIndex = $data['hospital_column_index'] ?? null;
        $this->hospitalOption = $data['hospital_column'] ?? [];
        
        $this->firmIndex = $data['firm_location_column_index'] ?? null;
        $this->firmOption = $data['firm_location_column'] ?? [];
        
        $this->partyTypeIndex = $data['party_type_column_index'] ?? null;
        $this->partyTypeOption = $data['party_type_column'] ?? [];

        // Alphabets map
        $this->alphabetsArray = array_merge(
            range('A', 'Z'), 
            ['AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ']
        );
    }

    public function collection(): Collection {
        // Blank sample template rows return karne ke liye
        return collect([]); 
    }

    public function headings(): array {
        return $this->columns;
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                // 1. Hospital Dropdown
                if (!is_null($this->hospitalIndex) && count($this->hospitalOption) > 0) {
                    $drop_column = $this->alphabetsArray[$this->hospitalIndex];
                    $optionsStr = implode(',', $this->hospitalOption);

                    if (strlen($optionsStr) <= 255) {
                        $validation = new DataValidation();
                        $validation->setType(DataValidation::TYPE_LIST);
                        $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                        $validation->setAllowBlank(false);
                        $validation->setShowInputMessage(true);
                        $validation->setShowErrorMessage(true);
                        $validation->setShowDropDown(true);
                        $validation->setErrorTitle('Input error');
                        $validation->setError('Value is not in list.');
                        $validation->setPromptTitle('Pick from list');
                        $validation->setPrompt('Please pick a hospital from the drop-down list.');
                        $validation->setFormula1(sprintf('"%s"', $optionsStr));

                        // Apply from Row 2 to $this->rows
                        for ($i = 2; $i <= $this->rows; $i++) {
                            $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                        }
                    }
                }

                // 2. Firm Location Dropdown
                if (!is_null($this->firmIndex) && count($this->firmOption) > 0) {
                    $drop_column = $this->alphabetsArray[$this->firmIndex];
                    $optionsStr = implode(',', $this->firmOption);

                    if (strlen($optionsStr) <= 255) {
                        $validation = new DataValidation();
                        $validation->setType(DataValidation::TYPE_LIST);
                        $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                        $validation->setAllowBlank(false);
                        $validation->setShowInputMessage(true);
                        $validation->setShowErrorMessage(true);
                        $validation->setShowDropDown(true);
                        $validation->setErrorTitle('Input error');
                        $validation->setError('Value is not in list.');
                        $validation->setPromptTitle('Pick from list');
                        $validation->setPrompt('Please pick a firm location from the drop-down list.');
                        $validation->setFormula1(sprintf('"%s"', $optionsStr));

                        for ($i = 2; $i <= $this->rows; $i++) {
                            $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                        }
                    }
                }

                // 3. Party Type Dropdown
                if (!is_null($this->partyTypeIndex) && count($this->partyTypeOption) > 0) {
                    $drop_column = $this->alphabetsArray[$this->partyTypeIndex];
                    $optionsStr = implode(',', $this->partyTypeOption);

                    if (strlen($optionsStr) <= 255) {
                        $validation = new DataValidation();
                        $validation->setType(DataValidation::TYPE_LIST);
                        $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                        $validation->setAllowBlank(false);
                        $validation->setShowInputMessage(true);
                        $validation->setShowErrorMessage(true);
                        $validation->setShowDropDown(true);
                        $validation->setErrorTitle('Input error');
                        $validation->setError('Value is not in list.');
                        $validation->setPromptTitle('Pick from list');
                        $validation->setPrompt('Please pick a party type from the drop-down list.');
                        $validation->setFormula1(sprintf('"%s"', $optionsStr));

                        for ($i = 2; $i <= $this->rows; $i++) {
                            $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                        }
                    }
                }

            },
        ];
    }
}


