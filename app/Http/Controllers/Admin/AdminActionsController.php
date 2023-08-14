<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;

use App\Models\ActionQuestion;
use App\Models\Brand;
use App\Models\Action;
use App\Models\ActionBrand;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Str;
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

    public function editAction(Request $request): RedirectResponse
    {
        $action = $this->editSomething(
            $request,
            ['head' => $this->validationString, 'text' => $this->validationLongText],
            new Action(),
            ['image' => $this->validationJpg, 'image_small' => $this->validationJpg],
            'storage/images/actions/',
        );
        $action->brand()->sync($request->input('brands_id'));
        $this->setSeo($request, $action);
        return redirect(route('admin.actions'));
    }

    public function deleteAction(Request $request): JsonResponse
    {
        $this->deleteSomething($request, new Action(), ['image', 'image_small']);
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

    public function editActionQuestion(Request $request): RedirectResponse
    {
        $actionQuestion = $this->editSomething(
            $request,
            ['question' => $this->validationString, 'answer' => $this->validationText, 'action_id' => 'required|integer|exists:actions,id'],
            new ActionQuestion()
        );
        return redirect(route('admin.actions', ['id' => $actionQuestion->action->id]));
    }

    public function deleteActionQuestion(Request $request): JsonResponse
    {
        $this->deleteSomething($request, new ActionQuestion());
    }
}
