<script lang="ts">
    const { initialCount } = $props();

    let count: number = $state(initialCount);
    const increment = () => {
        count += 1;
    };
</script>

<div class="pl-2 text-lg font-semibold">
    <button onclick={increment}>
        count is {count}
    </button>
</div>
