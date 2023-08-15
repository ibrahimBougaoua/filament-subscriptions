<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\FilamentSubscription\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSubscription\Actions\UpStepAction;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;
use IbrahimBougaoua\FilamentSubscription\Resources\FeatureResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use Str;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'icon-feature';

    protected static ?string $navigationGroup = 'Plans';

    protected static ?string $navigationLabel = 'Features';

    protected static ?string $pluralLabel = 'Features';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')->label('Name')->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpan([
                                'md' => 6,
                            ]),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->disabled()
                            ->columnSpan([
                                'md' => 6,
                            ]),
                        TextInput::make('value')
                            ->label('value')
                            ->columnSpan([
                                'md' => 6,
                            ]),
                        TextInput::make('resettable_period')
                            ->label('resettable_period')
                            ->numeric()
                            ->default(10)
                            ->columnSpan([
                                'md' => 6,
                            ]),
                        Select::make('resettable_interval')
                            ->label('resettable_interval')
                            ->options([
                                'month' => 'Month',
                                'day' => 'Day',
                                'year' => 'Year',
                            ])
                            ->default('month')
                            ->columnSpan([
                                'md' => 6,
                            ]),
                        Select::make('status')->label('Status')
                            ->options([
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ])->default('1')->disablePlaceholderSelection()
                            ->columnSpan([
                                'md' => 6,
                            ]),
                        MarkdownEditor::make('description')->label(__('panel.description'))
                            ->columnSpan([
                                'md' => 12,
                            ]),
                        FileUpload::make('image')->label(__('panel.image'))
                            ->columnSpan([
                                'md' => 12,
                            ]),
                    ])
                    ->columns([
                        'md' => 12,
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Name')
                    ->icon('heroicon-o-rectangle-stack')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('plans_count')
                    ->label('Plans')
                    ->color(static function ($state): string {
                        if ($state === 0) {
                            return 'danger';
                        }

                        return 'success';
                    })
                    ->counts('plans'),
                TextColumn::make('resettable_period')
                    ->label('Resettable Period'),
                TextColumn::make('resettable_interval')
                    ->label('Resettable Interval'),
                IconColumn::make('status')
                    ->label('Status')->boolean()
                    ->trueIcon('heroicon-o-rectangle-stack')
                    ->falseIcon('heroicon-o-rectangle-stack'),
                TextColumn::make('created_at')->label('Created at'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
                Filter::make('created_at')
                    ->label(__('panel.created_at'))->form([
                        Forms\Components\DatePicker::make('created_from')->label('Created from'),
                        Forms\Components\DatePicker::make('created_until')->label('Created until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                DownStepAction::make(),
                UpStepAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
