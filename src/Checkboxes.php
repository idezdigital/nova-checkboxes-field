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
     * The callback to be used to hydrate the model attribute after get only checked options.
     *
     * @var (callable(object, string, array):mixed)|null
     */
    public $setValueCallback;

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
     * Specify a callback that should be used to hydrate the model attribute for the field.
     *
     * @param  callable(object, string, array):mixed  $setValueCallback
     * @return self
     */
    public function setValueUsing(callable $setValueCallback): static
    {
        $this->setValueCallback = $setValueCallback;

        return $this;
    }

    /**
     * Override default method to avoid errors. Use setValueUsing to customize the model atribute hydratation.
     *
     * @param $fillCallback
     * @return \Idez\NovaCheckboxesField\Checkboxes
     */
    public function fillUsing($fillCallback): Checkboxes
    {
        return $this;
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            /**
             * Split checked options and remove unchecked options.
             */
            if (! is_array($checkedOptions = $request[$requestAttribute])) {
                $checkedOptions = collect(explode(',', $checkedOptions))
                    ->reject(fn ($name) => empty($name))
                    ->all();
            }

            if (isset($this->setValueCallback)) {
                return call_user_func($this->setValueCallback, $model, $attribute, $checkedOptions);
            }

            $model->{$attribute} = $checkedOptions;
        }
    }
}
