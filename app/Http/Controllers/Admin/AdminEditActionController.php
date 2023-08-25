<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperTrait;

use App\Models\Action;
use App\Models\ActionQuestion;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminEditActionController extends AdminEditController
{
    use HelperTrait;

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
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

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function editActionQuestion(Request $request): RedirectResponse
    {
        $actionQuestion = $this->editSomething(
            $request,
            ['question' => $this->validationString, 'answer' => $this->validationText, 'action_id' => 'required|integer|exists:actions,id'],
            new ActionQuestion()
        );
        return redirect(route('admin.actions', ['id' => $actionQuestion->action->id]));
    }
}
