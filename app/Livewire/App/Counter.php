<?php

namespace App\Livewire\App;

use App\Attributes\UseSvelte;
use Livewire\Attributes\Js;
use Livewire\Component;

#[UseSvelte]
class Counter extends Component
{
    public $initialCount = 5;

    #[Js]
    public function test()
    {
        return <<<JS
            console.log('test js');
        JS;
    }
}