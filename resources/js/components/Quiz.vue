<script>
export default {
    props: [
        "idx",
        "questions",
        "correctAnswers",
        "wrongAnswers",
        "selectedAnswer",
        "count",
        "categoryId",
    ],
    emits: [
        "answered",
        "next-question",
        "show-results",
        "start-quiz",
        "get-categories",
    ],
};
</script>

<template>
    <div class="bg-white p-12 rounded-lg shadow-lg w-full mt-8">
        <div v-if="idx < count && questions.length > 0">
            <p class="text-2xl font-bold">
                {{ questions[idx].question }}
            </p>
            <label
                v-for="answer in questions[idx].answer_list"
                :key="answer"
                :for="answer"
                class="block mt-4 border border-gray-300 rounded-lg py-2 px-6 text-lg cursor-pointer"
                :class="
                    ({
                        'hover:bg-gray-100 cursor-pointer':
                            selectedAnswer == '',
                    },
                    {
                        'bg-red-200': selectedAnswer == answer,
                    },
                    {
                        'bg-green-200':
                            answer == questions[idx].answer &&
                            selectedAnswer != '',
                    })
                "
            >
                <input
                    :id="answer"
                    type="radio"
                    class="hidden"
                    :value="answer"
                    @change="$emit('answered', $event)"
                    :disabled="selectedAnswer != ''"
                />
                {{ answer }}
            </label>
            <div class="my-12">
                <button
                    class="float-left bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                    @click="$emit('get-categories')"
                >
                    Back
                </button>
            </div>
            <div class="mt-6 flow-root">
                <button
                    @click="$emit('next-question')"
                    v-show="selectedAnswer != '' && idx < count - 1"
                    class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                >
                    Next &gt;
                </button>
                <button
                    @click="$emit('show-results')"
                    v-show="selectedAnswer != '' && idx == count - 1"
                    class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                >
                    Finish
                </button>
            </div>
        </div>
        <div v-else>
            <h2 class="text-bold text-3xl">Results</h2>
            <div class="flex justify-start space-x-4 mt-6">
                <p>
                    Correct Answers:
                    <span class="text-2xl text-green-700 font-bold">{{
                        correctAnswers
                    }}</span>
                </p>
                <p>
                    Wrong Answers:
                    <span class="text-2xl text-red-700 font-bold">{{
                        wrongAnswers
                    }}</span>
                </p>
            </div>
            <div class="mt-6 flow-root">
                <button
                    @click="$emit('start-quiz', categoryId)"
                    class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                >
                    Start Quiz
                </button>
                <button
                    @click="$emit('get-categories')"
                    class="float-left bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                >
                    Categories
                </button>
            </div>
        </div>
    </div>
</template>
