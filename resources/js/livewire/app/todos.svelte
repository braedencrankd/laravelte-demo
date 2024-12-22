<script lang="ts">
    const { wire } = $props();

    let todos = $state(wire.todos.map((todo) => ({ ...todo })));
    let errors = $state({});

    const addTodo = async (e: SubmitEvent) => {
        e.preventDefault();

        const form = e.target as HTMLFormElement;
        const formData = new FormData(form);
        const title = formData.get("title") as string;
        const res = await wire.addTodo(title);

        if (res.errors) {
            errors = res.errors;
            return;
        }

        todos = res;

        form.reset();
    };

    const deleteTodo = async (e: SubmitEvent) => {
        e.preventDefault();

        const form = e.target as HTMLFormElement;
        const formData = new FormData(form);
        const id = formData.get("id") as string;

        todos = await wire.deleteTodo(id);
    };
</script>

<div>
    <h1 class="mb-4 text-2xl font-bold">Todos</h1>

    <form onsubmit={addTodo} class="flex flex-col gap-2 mb-6">
        <div class="flex gap-2">
            <input
                type="text"
                name="title"
                class="p-2 rounded-md border border-gray-300"
            />
            <button type="submit" class="p-2 text-white bg-blue-500 rounded-md"
                >Add Todo</button
            >
        </div>
        {#if errors.title}
            <p class="text-sm text-red-500">{errors.title[0]}</p>
        {/if}
    </form>

    <ul class="space-y-2">
        {#if todos.length > 0}
            {#each todos as todo}
                <li
                    class="flex justify-between items-center p-2 rounded-md border border-gray-300"
                >
                    <span>
                        {todo.title}
                    </span>
                    <form onsubmit={deleteTodo}>
                        <input type="hidden" name="id" value={todo.id} />
                        <button
                            class="p-1 text-white bg-red-500 rounded-md"
                            aria-label="delete todo"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                                ><path
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M6 18L18 6M6 6l12 12"
                                /></svg
                            >
                        </button>
                    </form>
                </li>
            {/each}
        {:else}
            <li class="p-2 rounded-md border border-gray-300">
                No todos found
            </li>
        {/if}
    </ul>
</div>
