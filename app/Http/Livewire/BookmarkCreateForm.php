<?php

namespace App\Http\Livewire;

use App\Bookmark;
use Kdion4891\LaravelLivewireForms\ArrayField;
use Kdion4891\LaravelLivewireForms\Field;
use Kdion4891\LaravelLivewireForms\FormComponent;

class BookmarkCreateForm extends FormComponent
{
    public function fields()
    {
        return [
            Field::make('URL')->input()->rules('required'),
            Field::make('Title')->input()->rules('required'),
            Field::make('Description')->textarea(),
            Field::make('Tags')->textarea(),
        ];
    }

    public function success()
    {
        Bookmark::create($this->form_data);
    }

    public function saveAndStayResponse()
    {
        return redirect()->route('bookmarks.create');
    }

    public function saveAndGoBackResponse()
    {
        return redirect()->route('bookmarks.index');
    }
}
