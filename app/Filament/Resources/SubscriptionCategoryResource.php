<?php

namespace AppFilamentResources;

use AppFilamentResourcesSubscriptionCategoryResourcePages;
use AppModelsSubscriptionCategory;
use FilamentFormsComponentsTextarea;
use FilamentFormsComponentsTextInput;
use FilamentResourcesResource;
use FilamentSchemasSchema;
use FilamentTables;
use FilamentTablesTable;
use IlluminateDatabaseEloquentBuilder;

class SubscriptionCategoryResource extends Resource
{
    protected static ?string $model = SubscriptionCategory::class;
    protected static string|UnitEnum|null $navigationGroup = 'Subscriptions';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->maxLength(255),
            Textarea::make('description')->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TablesColumnsTextColumn::make('name')->searchable()->sortable(),
            TablesColumnsTextColumn::make('subscriptions_count')->counts('subscriptions')->label('Subscriptions'),
            TablesColumnsTextColumn::make('created_at')->dateTime()->sortable(),
        ])->actions([
            TablesActionsEditAction::make(),
            TablesActionsDeleteAction::make(),
        ])->bulkActions([
            TablesActionsDeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => PagesListSubscriptionCategories::route('/'),
            'create' => PagesCreateSubscriptionCategory::route('/create'),
            'edit' => PagesEditSubscriptionCategory::route('/{record}/edit'),
        ];
    }
}