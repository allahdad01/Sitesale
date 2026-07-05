<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Faq;

class FaqController
{
    public function index(): void
    {
        $faqs = Faq::allAdmin();
        View::render('admin.faq.index', [
            'title' => 'FAQ',
            'faqs'  => $faqs,
        ], 'admin');
    }

    public function add(Request $request): void
    {
        Faq::create([
            'question'     => $request->post('question', ''),
            'question_en'  => $request->post('question_en', ''),
            'question_ps'  => $request->post('question_ps', ''),
            'question_fa'  => $request->post('question_fa', ''),
            'answer'       => $request->post('answer', ''),
            'answer_en'    => $request->post('answer_en', ''),
            'answer_ps'    => $request->post('answer_ps', ''),
            'answer_fa'    => $request->post('answer_fa', ''),
            'sort_order'   => Faq::maxSortOrder() + 1,
            'active'       => 1,
        ]);

        Session::set('_success', 'FAQ added.');
        Response::redirect(base_url('admin/faq'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        Faq::delete($id);
        Session::set('_success', 'FAQ deleted.');
        Response::redirect(base_url('admin/faq'));
    }
}
