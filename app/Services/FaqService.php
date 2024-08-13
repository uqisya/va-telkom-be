<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FaqService
{
    public function getAllFaq()
    {
        $listFaq = DB::select(
            'SELECT id, question, answer
            FROM faqs'
        );

        return $listFaq;
    }
}
