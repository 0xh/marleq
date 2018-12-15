<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Trix;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Users';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Avatar::make('Picture')
                ->disk('local')
                ->prunable()
                ->path('user-pictures'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Surname')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->hideFromIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            Trix::make('Biography')->hideFromIndex(),

            File::make('Document')
                ->disk('local')
                ->preview(function () {
                    return $this->value
                        ? Storage::disk($this->disk)->url(ltrim($this->value, '/storage'))
                        : null;
                })
                ->prunable()
                ->path('user-documents'),

            Text::make('Title')
                ->rules( 'max:254')->hideFromIndex(),

            Text::make('Social Network')
                ->rules( 'max:254')->hideFromIndex(),

            BelongsToMany::make('Roles')->sortable(),

            Select::make('Status')->options([
                1 => 'Published',
                0 => 'Unpublished'
            ])->displayUsingLabels(),

            Select::make('Featured')->options([
                1 => 'Yes',
                0 => 'No'
            ])->displayUsingLabels(),

            BelongsTo::make('Level')->nullable(),

            BelongsToMany::make('Specialties'),

            BelongsToMany::make('Services'),

            BelongsToMany::make('Countries'),

            BelongsToMany::make('Languages'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
