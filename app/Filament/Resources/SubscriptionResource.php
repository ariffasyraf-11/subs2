<?php

namespace AppFilamentResources;

use AppFilamentResourcesSubscriptionResourcePages;
use AppModelsSubscription;
use FilamentFormsComponentsDatePicker;
use FilamentFormsComponentsSelect;
use FilamentFormsComponentsTextarea;
use FilamentFormsComponentsTextInput;
use FilamentFormsComponentsToggle;
use FilamentResourcesResource;
use FilamentSchemasComponentsSection;
use FilamentSchemasSchema;
use FilamentTables;
use FilamentTablesTable;
use IlluminateDatabaseEloquentBuilder;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static string|UnitEnum|null $navigationGroup = 'Subscriptions';
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Subscription')
                ->schema([
                    TextInput::make('provider')->required()->maxLength(255),
                    TextInput::make('name')->required()->label('Subscription Name')->maxLength(255),
                    TextInput::make('plan_name')->label('Plan')->maxLength(255),
                    Select::make('category_id')
                        ->relationship('category', 'name', modifyQueryUsing: fn (Builder $query) => $query->where('user_id', auth()->id()))
                        ->searchable()
                        ->preload(),
                    Select::make('status')
                        ->options([
                            'active' => 'Active',
                            'paused' => 'Paused',
                            'cancelled' => 'Cancelled',
                            'expired' => 'Expired',
                        ])
                        ->required()
                        ->default('active'),
                ])->columns(2),

            Section::make('Billing')
                ->schema([
                    TextInput::make('price')->numeric()->prefix('RM')->required()->minValue(0),
                    Select::make('currency')
                        ->options(['MYR' => 'MYR - Malaysian Ringgit', 'USD' => 'USD - US Dollar', 'SGD' => 'SGD - Singapore Dollar'])
                        ->required()
                        ->default('MYR'),
                    Select::make('billing_cycle')
                        ->options([
                            'weekly' => 'Weekly',
                            'monthly' => 'Monthly',
                            'quarterly' => 'Quarterly',
                            'half_yearly' => 'Half-yearly',
                            'yearly' => 'Yearly',
                        ])
                        ->required()
                        ->default('monthly'),
                    Select::make('payment_method')
                        ->options([
                            'cash' => 'Cash',
                            'bank_transfer' => 'Bank Transfer',
                            'debit_card' => 'Debit Card',
                            'credit_card' => 'Credit Card',
                            'online_payment' => 'Online Payment',
                            'other' => 'Other',
                        ]),
                ])->columns(2),

            Section::make('Dates & Renewal')
                ->schema([
                    DatePicker::make('start_date')->required()->default(now()),
                    DatePicker::make('next_renewal_date')->label('Next Renewal')->required(),
                    DatePicker::make('end_date')->label('Expiry Date')->afterOrEqual('start_date'),
                    Toggle::make('auto_renew')->label('Auto Renew')->default(true),
                ])->columns(2),

            Section::make('Notes')
                ->schema([
                    Textarea::make('notes')->rows(4)->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('next_renewal_date')
            ->columns([
                TablesColumnsTextColumn::make('provider')->searchable()->sortable(),
                TablesColumnsTextColumn::make('name')->label('Subscription')->searchable()->sortable(),
                TablesColumnsTextColumn::make('plan_name')->label('Plan')->toggleable(),
                TablesColumnsTextColumn::make('price')->money('MYR')->sortable(),
                TablesColumnsTextColumn::make('billing_cycle')->badge(),
                TablesColumnsTextColumn::make('next_renewal_date')->date()->sortable(),
                TablesColumnsTextColumn::make('status')->badge(),
                TablesColumnsIconColumn::make('auto_renew')->boolean()->label('Auto'),
            ])
            ->filters([
                TablesFiltersSelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'paused' => 'Paused',
                        'cancelled' => 'Cancelled',
                        'expired' => 'Expired',
                    ]),
                TablesFiltersSelectFilter::make('billing_cycle')
                    ->options([
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                        'quarterly' => 'Quarterly',
                        'half_yearly' => 'Half-yearly',
                        'yearly' => 'Yearly',
                    ]),
            ])
            ->actions([
                TablesActionsEditAction::make(),
                TablesActionsDeleteAction::make(),
            ])
            ->bulkActions([
                TablesActionsDeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => PagesListSubscriptions::route('/'),
            'create' => PagesCreateSubscription::route('/create'),
            'edit' => PagesEditSubscription::route('/{record}/edit'),
        ];
    }
}