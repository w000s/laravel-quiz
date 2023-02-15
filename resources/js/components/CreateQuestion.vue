<script>
export default {
    props: ["categories", "answerTypes", "successMessage"],
    emits: ["post-question"],
    data() {
        return {
            questionData: {
                question: "",
                answer: "",
                category: "",
                type: "",
            },
        };
    },
};
</script>
<template>
    <div class="w-full max-w-xl p-3 h-screen">
        <h1 class="font-bold text-5xl text-center text-indigo-700">
            Add question
        </h1>
        <form
            id="question-form"
            class="bg-white p-12 rounded-lg shadow-lg w-full mt-8"
        >
            <form class="w-full max-w-sm">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-full-name"
                        >
                            Question
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="question"
                            v-model="questionData.question"
                            name="question"
                            placeholder="Question"
                            type="text"
                            required
                        />
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-password"
                        >
                            Answer
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="answer"
                            v-model="questionData.answer"
                            name="answer"
                            placeholder="Answer"
                            type="text"
                            required
                        />
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-password"
                        >
                            Category
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            v-model="questionData.category"
                            id="category"
                            name="category"
                            placeholder="Question category"
                            required
                        >
                            <option
                                v-for="(category, i) in categories"
                                :value="category"
                                :key="i"
                            >
                                {{ category["category_name"] }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-password"
                        >
                            Answer Type
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            v-model="questionData.type"
                            id="answerType"
                            name="answerType"
                            placeholder="Answer Type"
                            required
                        >
                            <option
                                v-for="(answerType, i) in answerTypes"
                                :value="answerType"
                                :key="i"
                            >
                                {{ answerType["type_name"] }}
                            </option>
                        </select>
                    </div>
                </div>
            </form>
            <div
                v-if="successMessage"
                class="border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3"
                role="alert"
            >
                {{ successMessage }}
            </div>
            <div class="my-12">
                <button
                    class="float-left bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                    @click="$emit('get-categories')"
                >
                    Back
                </button>
                <button
                    @click.prevent="$emit('post-question', this.questionData)"
                    class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
</template>
