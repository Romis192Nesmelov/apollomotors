<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;

use App\Models\ActionQuestion;
use App\Models\Brand;
use App\Models\Action;
use App\Models\ActionBrand;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminActionsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function actions(Request $request, $slug=null): View
    {
        if ($request->has('id')) {
            $this->data['actions'] = Action::all();
            $this->data['brands'] = Brand::all();
            $this->data['selected_ids'] = ActionBrand::where('action_id',$request->id)->pluck('brand_id')->toArray();
        }
        return $this->getSomething(
            $request,
            'action',
            'head',
            new Action(),
            $slug
        );
    }

    public function actionQuestions(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            'action_question',
            'question',
            new ActionQuestion(),
            $slug,
            'action',
            'head',
            new Action(),
        );
    }
}
