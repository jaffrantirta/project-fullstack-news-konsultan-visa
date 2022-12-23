<?php
namespace App\Exports;

use App\Invoice;
use App\Models\Rating;
use App\Models\Place;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ToiletReport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct($place_id, $date_start, $date_end)
    {
        $this->place_id = $place_id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
    }

    public function query()
    {
        return Rating::query()
        ->select('name', 'score', 'comments', 'ratings.created_at')
        ->join('places', 'places.id', 'ratings.place_id')
        ->where('place_id', $this->place_id)
        ->whereBetween('ratings.created_at', [$this->date_start, $this->date_end]);
    }
    public function headings(): array
    {
        return ['Nama Toilet', 'Nilai', 'Komentar', 'Tanggal'];
    }
}