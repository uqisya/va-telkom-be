<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/*
    FaqService -> class untuk menghandle query/business logic terkait Faq
    - getAllFaq -> method untuk mendapatkan semua list faq (limit 5)
*/

class FaqService
{

    // method untuk mendapatkan semua list faq (limit 5)
    public function getAllFaq()
    {
        $listFaq = DB::select(
            'SELECT id, question, answer
            FROM faqs
            LIMIT 5
            '
        );
        return $listFaq;
    }
}
