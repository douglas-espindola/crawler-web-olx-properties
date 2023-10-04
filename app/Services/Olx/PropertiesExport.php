<?php

    namespace App\Services\Olx;

    use Illuminate\Support\Collection;
    use Maatwebsite\Excel\Concerns\FromCollection;
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Maatwebsite\Excel\Concerns\WithMapping;

    class PropertiesExport implements FromCollection, WithHeadings, WithMapping
    {
        protected $properties;
        public function __construct($properties)
        {
            $this->properties = $properties;
        }
        public function collection(): Collection
        {
            return collect($this->properties);
        }
        public function headings(): array
        {
            return [
                'Preço',
                'Link',
                'Título',
            ];
        }
        public function map($row): array
        {
            return [
                $row['price'],
                $row['url'],
                $row['title'],
            ];
        }
    }
