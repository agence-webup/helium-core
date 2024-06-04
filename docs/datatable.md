# Datatable

For the moment, we can only have one datatable per view.


## Create a livewire component

```php
use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Webup\HeliumCore\Datatable\Column;
use Webup\HeliumCore\Datatable\Datatable;

class CategoryDatatable extends Datatable
{
    public function baseQuery()
    {
        return Category::query();
    }

    public function link($category)
    {
        return route('category.edit', ['id' => $category->id]);
    }

    public function columns()
    {
        return [
            Column::select('name')
                ->label('Name')
                ->sortable()
                ->searchable(),

            Column::select('status')
                ->label('Status')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return new HtmlString(Blade::render(
                        '<x-hui::tag label="{{ $label }}" modifier="{{ $color }}" />',
                        [
                            'label' => $value->getLabel(),
                            'color' => $value->getColor(),
                        ]
                    ));
                }),

            Column::select('highlighted')
                ->label('highlighted')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    $label = $value ? '✔' : '✘';
                    $modifier = $value ? 'green' : 'red';

                    return new HtmlString(Blade::render(sprintf(
                        '<x-hui::tag label="%s" modifier="%s" />',
                        $label, $modifier
                    )));
                }),
        ];
    }
}
```

## Use the component

```php
<livewire:category-datatable sharedKey="category-datatable" />
```
