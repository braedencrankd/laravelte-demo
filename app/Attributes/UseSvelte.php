<?php

namespace App\Attributes;

use Livewire\Features\SupportAttributes\Attribute as LivewireAttribute;

#[\Attribute]
class UseSvelte extends LivewireAttribute
{

    public function hydrate()
    {
      $this->component->skipRender();
    }

    public function dehydrate($context)
    {
      
      $component = $this->getComponent();
      $componentName = $component->getName();
      $svelteComponentPath = str_replace('.', '/', $componentName);

      $method = <<<JS
      const target = document.querySelector(`[wire\\\:id="{$component->getId()}"]`);

      if (!target) {
        console.error('Target element not found');
        return;
      }

      const SvelteComponent = window.components["/resources/js/livewire/{$svelteComponentPath}.svelte"].default;

      const props = {
        wire: \$wire
      }

      // mount the component
      svelte.mount(SvelteComponent, {
        target: target,
        props: props
      });

      JS;

      $context->pushEffect('js', $method, 'mountSvelteComponent');
   
    }
} 