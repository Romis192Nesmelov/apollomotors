<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;

use App\Models\ActionQuestion;
use App\Models\Brand;
use App\Models\Action;
use App\Models\ActionBrand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminActionsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function actions(Request $request, $slug=null): View
    {
        $this->getFirstBreadcrumbDefActions();
        $this->data['actions'] = Action::all();
        $this->data['brands'] = Brand::all();
        $this->data['selected_ids'] = ActionBrand::where('action_id',$request->id)->pluck('brand_id')->toArray();

        return $this->getSomething(
            $request,
            'action',
            'head',
            new Action(),
            $slug
        );
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function actionQuestions(Request $request, $slug=null): View
    {
        $this->getFirstBreadcrumbDefActions();
        if ($request->has('id')) {
            $this->data['action_question'] = ActionQuestion::findOrFail($request->input('id'));
            $this->getSecondBreadcrumbDefActions($this->data['action_question']->action);
        } else {
            $actionQuestion = ActionQuestion::findOrFail($request->input('parent_id'));
            $this->getSecondBreadcrumbDefActions($actionQuestion->action);
        }
        $this->data['actions'] = Action::all();

        return $this->getSomething(
            $request,
            'action_question',
            'question',
            new ActionQuestion(),
            $slug
        );
    }

    private function getFirstBreadcrumbDefActions(): void
    {
        $this->data['menu_key'] = 'actions';
        $this->breadcrumbs[] = [
            'href' => 'admin.actions',
            'params' => [],
            'name' => trans('admin_menu.actions'),
        ];
    }

    private function getSecondBreadcrumbDefActions(Action $action): void
    {
        $this->breadcrumbs[] = [
            'href' => 'admin.actions',
            'params' => ['id' => $action->id],
            'name' => trans('admin.'.(Gate::allows('edit') ? 'edit_' : 'view_').'action', ['action' => $action->head]),
        ];
    }
}
