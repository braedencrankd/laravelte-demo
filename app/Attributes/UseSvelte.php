<?php

namespace App\Attributes;

use Livewire\Features\SupportAttributes\Attribute as LivewireAttribute;

#[\Attribute, \Override]
class UseSvelte extends LivewireAttribute
{
    public function dehydrate($context)
    {
      $component = $this->getComponent();
      $componentName = $component->getName();
      $svelteComponentPath = str_replace('.', '/', $componentName);

      $props = collect($component->all())
            ->map(fn($value) => is_object($value) ? $value->toArray() : $value)
            ->toJson();

      $method = <<<JS
      console.log('svelte component mounted');
      // Get the target element using the component ID
      const target = document.getElementById('counter');

      if (!target) {
        console.error('Target element not found');
        return;
      }

      const SvelteComponent = window.components["/resources/js/livewire/{$svelteComponentPath}.svelte"].default;

      // mount the component
      svelte.mount(SvelteComponent, {
        target: target,
        props: {$props}
      });

      JS;

      $context->pushEffect('js', $method, 'mountSvelteComponent');
   
    }
} 