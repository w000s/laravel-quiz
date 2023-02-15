<script>
export default {
    props: ["categories"],
    emits: ["add-question", "start-quiz"],
    methods: {},
};
</script>

<template>
    <h1 class="font-bold text-5xl text-center text-indigo-700">Laravel Quiz</h1>
    <div class="bg-white p-12 rounded-lg shadow-lg w-full h-full mt-8">
        <button
            @click="$emit('add-question')"
            class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
        >
            Add Question
        </button>
        <div>
            <p class="text-2xl mb-10 font-bold">Categories</p>
            <label
                v-for="category in categories"
                :key="category.id"
                :for="category.id"
                class="block mt-4 border border-gray-300 rounded-lg py-2 px-6 text-lg hover:bg-gray-100 cursor-pointer"
            >
                <input
                    :id="category.id"
                    type="button"
                    class="hidden"
                    :value="category.id"
                    @click="$emit('start-quiz', $event)"
                />
                {{ category.category_name }}
            </label>
        </div>
    </div>
</template>
