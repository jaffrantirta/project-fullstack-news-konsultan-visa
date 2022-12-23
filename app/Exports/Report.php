<?php
namespace App\Exports;

use App\Invoice;
use App\Models\Feedback;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class Report implements FromQuery, WithHeadings
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
        return Feedback::query()
        ->select('questions.question', 'answers.answer', DB::raw('COUNT(feedback.answer_id) as answer_count'), 'feedback.created_at')
        ->join('questions', 'questions.id', 'feedback.question_id')
        ->join('answers', 'answers.id', 'feedback.answer_id')
        ->where('place_id', $this->place_id)
        ->groupBy(DB::raw('feedback.question_id'), DB::raw('feedback.answer_id'))
        ->whereBetween('feedback.created_at', [$this->date_start, $this->date_end]);
    }
    public function headings(): array
    {
        return ['Pertanyaan', 'Jawaban', 'Jumlah Yang Menjawab', 'Tanggal'];
    }
}