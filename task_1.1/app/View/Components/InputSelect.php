<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelect extends Component
{
    public $name;
    public $label;
    public $options;
    public $required;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param array $options
     * @param bool $required
     * @param string|null $selected
     */
    public function __construct(string $name, string $label, array $options, bool $required = false, $selected = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->required = $required;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.input-select');
    }
}
