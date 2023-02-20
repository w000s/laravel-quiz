<script>
export default {
    props: ["categories", "answerTypes", "successMessage"],
    emits: ["post-question"],
    data() {
        return {
            booleanAnswerTypes: ["True", "False"],
            questionData: {
                question: "",
                answer: "",
                category: "",
                type: 1,
                incorrectAnswersEnabled: false,
                incorrectAnswersList: [],
            },
        };
    },
    methods: {
        setDataAndCreateQuestion() {
            this.questionData.incorrectAnswersList = [];

            // if type is boolean, set incorrect answer based on answer given.
            if (this.questionData.type.id == 3) {
                this.questionData.incorrectAnswersList =
                    // if the answer given is true, this will automatically make the wrong answer false.
                    this.booleanAnswerTypes.filter(
                        (s) => !s.includes(this.questionData.answer)
                    );
                // type is not boolean
            } else {
                this.questionData.incorrectAnswersList.push(
                    this.questionData.incorrectAnswersOne,
                    this.questionData.incorrectAnswersTwo,
                    this.questionData.incorrectAnswersThree
                );
            }

            this.$emit("post-question", this.questionData);
        },
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
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        >
                            Correct Answer
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            v-if="questionData.type.id == 3"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            v-model="questionData.answer"
                            id="answer"
                            name="answer"
                            placeholder="Answer"
                            required
                        >
                            <option
                                v-for="(
                                    booleanAnswerType, i
                                ) in booleanAnswerTypes"
                                :value="booleanAnswerType"
                                :key="i"
                            >
                                {{ booleanAnswerType }}
                            </option>
                        </select>
                        <input
                            v-else
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
                <div
                    class="md:flex md:items-center mb-6"
                    v-if="questionData.type.id != 3"
                >
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-password"
                        >
                            Add Incorrect answers
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            type="checkbox"
                            id="incorrect_answers"
                            name="incorrect_answers"
                            v-model="questionData.incorrectAnswersEnabled"
                        />
                        <input
                            v-if="questionData.incorrectAnswersEnabled"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="incorrect_answers_1"
                            v-model="questionData.incorrectAnswersOne"
                            name="incorrect_answers_1"
                            placeholder="Incorrect Answer 1"
                            type="text"
                        />
                        <input
                            v-if="questionData.incorrectAnswersEnabled"
                            class="mt-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="incorrect_answers_2"
                            v-model="questionData.incorrectAnswersTwo"
                            name="incorrect_answers_2"
                            placeholder="Incorrect Answer 2"
                            type="text"
                        />
                        <input
                            v-if="questionData.incorrectAnswersEnabled"
                            class="mt-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="incorrect_answers_3"
                            v-model="questionData.incorrectAnswersThree"
                            name="incorrect_answers_3"
                            placeholder="Incorrect Answer 3"
                            type="text"
                        />
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label
                            class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
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
                    @click.prevent="setDataAndCreateQuestion(this.questionData)"
                    class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
</template>
