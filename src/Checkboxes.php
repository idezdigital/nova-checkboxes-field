<?php

namespace Idez\NovaCheckboxesField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Checkboxes extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-checkboxes-field';

    /**
     * Specify the available options
     *
     * @param  array  $options
     * @return self
     */
    public function options(array $options): Checkboxes
    {
        return $this->withMeta(['options' => $options]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param  string                                  $requestAttribute
     * @param  object                                  $model
     * @param  string                                  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            /**
             * Split checked options and remove unchecked options.
             */
            if (!is_array($checkedOptions = $request[$requestAttribute])) {
                $checkedOptions = collect(explode(',', $checkedOptions))
                    ->reject(fn ($name) => empty($name))
                    ->all();
            }

            $model->{$attribute} = $checkedOptions;
        }
    }
}
