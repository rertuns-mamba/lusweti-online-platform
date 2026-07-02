<?php


namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Editorial Content')->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->minLength(5)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set) {
                                // Auto-generate the slug only during creation so we don't break existing links on edit
                                if ($operation === 'create' && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->validationMessages([
                                'required' => 'The article title is required.',
                                'min' => 'The title must be at least 5 characters.',
                                'max' => 'The title cannot exceed 255 characters.',
                            ]),

                        TextInput::make('slug')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->alphaDash()
                            // Force the field to visually update when the set() method is called by the title
                            ->live() 
                            ->helperText('Auto-generated from title if left blank.')
                            ->validationMessages([
                                'unique' => 'This slug is already in use.',
                                'alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',
                            ]),

                        Textarea::make('summary')
                            ->rows(3)
                            ->maxLength(500)
                            ->minLength(20)
                            ->helperText('Used for the BBC-style grid descriptions. Min 20 characters.')
                            ->validationMessages([
                                'min' => 'The summary must be at least 20 characters.',
                                'max' => 'The summary cannot exceed 500 characters.',
                            ]),

                        RichEditor::make('content')
                            ->required()
                            ->minLength(50)
                            ->validationMessages([
                                'required' => 'The article content is required.',
                                'min' => 'The content must be at least 50 characters.',
                            ]),
                    ]),

                    Section::make('Media')->schema([
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->collection('featured_image')
                            ->image()
                            ->imageEditor()
                            ->responsiveImages()
                            ->maxSize(10240) // 10MB max
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/avif'])
                            ->imageResizeTargetWidth(1200)
                            ->imageResizeTargetHeight(675)
                            ->imageResizeMode('cover')
                            ->helperText('This image drives the Hero and Thumbnail layouts. Recommended: 1200x675px, max 10MB.')
                            ->required(fn (string $operation): bool => $operation === 'create'),
                    ]),
                ])->columnSpan(['lg' => 2]),

                // RIGHT SIDEBAR
                Group::make()->schema([
                    Section::make('Routing & Classification')->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('page_id')
                            ->relationship('page', 'title')
                            ->searchable()
                            ->preload()
                            ->helperText('Assigning to a page applies specific background/text colors.'),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(Auth::id())
                            ->searchable(),

                        TextInput::make('topic_label')
                            ->label('Kicker / Topic Label')
                            ->placeholder('e.g. Analysis, Live, Breaking'),
                    ]),

                    Section::make('Publishing')->schema([
                        DateTimePicker::make('published_at')
                            ->default(now())
                            ->required(),

                        Toggle::make('is_visible')
                            ->label('Visible to Public')
                            ->default(true),

                        Toggle::make('is_featured_in_row')
                            ->label('Featured in Row')
                            ->default(false),

                        Toggle::make('is_prime')
                            ->label('Prime Article')
                            ->default(false),
                    ]),

                    Section::make('Advanced Layouts')->schema([
                        Select::make('content_type')
                            ->options([
                                'article' => 'Standard Article',
                                'video' => 'Video Post',
                                'gallery' => 'Gallery Post',
                            ])
                            ->default('article'),

                        TextInput::make('external_url')
                            ->url()
                            ->helperText('Provide if this links out to an external source.'),
                    ])->collapsed(),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);

    }
}
